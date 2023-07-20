<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function() {
    $('.reply-comment').each(function() {
        $(this).click(function() {
            var replyContainer = $(this).closest('.comment').find('.reply-form');
            replyContainer.toggle();
        });
    });

    $('.comment-menu').on('click', function() {
        $(this).siblings('.comment-menu-options').toggle();
    });

    $('.reply-menu').on('click', function() {
        $(this).siblings('.reply-menu-options').toggle();
    });
});

// Wait for the document to be fully loaded
document.addEventListener("DOMContentLoaded", function() {
    // Get the button element
    var rateButton = document.querySelector('.btn[data-target="#ratingModal"]');

    // Add a click event listener to the button
    rateButton.addEventListener("click", function(event) {
        event.preventDefault(); // Prevent the default behavior of the link

        // Show the modal
        var ratingModal = document.querySelector('#ratingModal');
        console.log(ratingModal);
        ratingModal.style.display = "block";
    });

    // Get the close button element inside the modal
    var closeButton = document.querySelector('.modal .close');

    // Add a click event listener to the close button
    closeButton.addEventListener("click", function() {
        // Hide the modal
        var ratingModal = document.querySelector('#ratingModal');
        ratingModal.style.display = "none";
    });

    // Get the form element inside the modal
    var ratingForm = document.querySelector('.modal-body form');

    // Add a submit event listener to the form
    ratingForm.addEventListener("submit", function(event) {
        event.preventDefault(); // Prevent the form from submitting

        // Perform your desired actions here, such as submitting the form data using AJAX

        // After completing your actions, hide the modal
        var ratingModal = document.querySelector('#ratingModal');
        ratingModal.style.display = "none";
    });
});
</script>

<style>
.campo-image {
    border-top-left-radius: 5vh;
    border-bottom-right-radius: 5vh;
}

.campo-details strong {
    font-size: 20px;
}
</style>

<!--Like Style-->
<!--Like Style-->
<!--Like Style-->
<style>
.like-comment {
    font-size: large;
    position: relative;
    border: none;
    color: blue;
    background-color: transparent;
    transition: transform 0.3s ease;
}

.like-comment:hover>* {
    transform: scale(1.2);
}

#like-form-8,
#like-form-4 {
    margin: 0;
}
</style>