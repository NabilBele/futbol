<?php 

$dates = array();
$hours = array();
foreach ($fechas as $fecha) {
$date = date('Y-m-d', strtotime($fecha));
$hour = date('H', strtotime($fecha));

$dates[] = $date;
$hours[] = $hour;

}
?>
<script>
$(document).ready(function() {
    var disabledDates = <?php echo json_encode($dates); ?>;
    var fechas = <?php echo json_encode($fechas); ?>;
    var selectedDate;
    var checking = false;

    // Listen for the change event of the date picker
    $('input#w1').on('change', function() {
        selectedDate = $(this).val();
        for (let i = 0; i < disabledDates.length; i++) {
            if (selectedDate == disabledDates[i]) {
                checking = true;
                break;
            } else {
                console.log("empty");
                checking = false;
            }

        }

        if (selectedDate) {
            // Date is selected, show the fecha hora container
            $('#fecha_hora_container').removeClass('d-none');
            $('th.switch').addClass("d-none");

            $(".kv-datetime-picker").click();
            DisableHoras();
        } else {
            // No date selected, hide the fecha hora container
            $('#fecha_hora_container').addClass('d-none');

        }
    });
    $("input#fecha_hora").on('change', function() {
        var fechaHoraDate = $("#alquileres-fechahora");
        var hora = $(this).val();

        if ($(fechaHoraDate).val().length <= 10) {
            selectedDate = $('input#w1').val() + " " + hora;
            $(fechaHoraDate).val(selectedDate);
        } else {
            $(fechaHoraDate).val($(fechaHoraDate).val().slice(0, -2));
            selectedDate = $('input#w1').val() + " " + hora;
            $(fechaHoraDate).val(selectedDate);
        }
    });

    function DisableHoras() {
        console.log(selectedDate);
        selectedDate = $('input#w1').val();
        if (checking) {
            for (let i = 0; i < fechas.length; i++) {
                var dateTimeString = fechas[i];
                var date = dateTimeString.substring(0, 10);
                var hour = dateTimeString.substring(11, 16);

                if (date == selectedDate) {
                    $("span.hour").each(function() {
                        if ($(this).text() == hour) {
                            $(this).addClass('disabled');
                        }
                    });
                }
            }

        }
    }
    $(".kv-datetime-picker").on('click', function() {
        setTimeout(() => {
            DisableHoras();
        }, 100)
    });
});
</script>
<style>
th.next,
th.prev {
    display: none !important;
}
</style>