<style>
.card {
    width: auto;
    padding: 10px;
    border: 1px solid #ccc;
    border-radius: 5px;
    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
}

.card-img-top {
    width: 100%;
    height: auto;
    border-radius: 5px;
}

.card-title {
    margin-bottom: 10px;
}

.card-text {
    margin-bottom: 20px;
}

.qr-code {
    display: block;
    margin: 10px auto;
    max-width: 100%;
    height: auto;
}

.reservation-details {
    margin-top: 20px;
    font-size: 14px;
    line-height: 1.5;
}

.reservation-details strong {
    font-weight: bold;
}

.reserveCard {
    display: flex;
    flex-direction: column;
    max-width: 300px;
    margin: auto;
}

.strong {
    text-transform: capitalize;
    font-size: 20px;
}

p.card-text {
    text-align: center;
}
</style>
<?php //js
////
/// ?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.3.2/html2canvas.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.5.3/jspdf.debug.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

<script>
$(document).ready(function() {
    $('#downloadButton').click(function() {
        html2canvas(document.querySelector('.card')).then(function(canvas) {
            var imageData = canvas.toDataURL('image/jpeg');

            var pdf = new jsPDF();

            var pdfWidth = pdf.internal.pageSize.getWidth();
            var pdfHeight = pdf.internal.pageSize.getHeight();

            var imageWidth = pdfWidth;

            var offsetX = (pdfWidth - imageWidth) / 2;

            pdf.addImage(imageData, 'JPEG', offsetX, 0, imageWidth, pdfHeight);

            pdf.save('reservation.pdf');
        });
    });
});
</script>