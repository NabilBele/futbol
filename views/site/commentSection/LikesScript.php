<script>
$(".like-comment").on("click", function(event) {
    event.preventDefault();

    var likeButton = $(this);
    var likesCount = likeButton.siblings(".likes-count");

    $.post({
        url: likeButton.data("action"),
        data: likeButton.data("params"),
        success: function(response) {
            if (response === "success") {
                // Toggle the like button's class and update the likes count
                likeButton.find("i").toggleClass("fas far");
                likesCount.text(
                    parseInt(likesCount.text()) +
                    (likeButton.find("i").hasClass("fas") ? 1 : -1)
                );
            }
        },
    });
});
</script>