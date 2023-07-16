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
.center-image {
    position: fixed;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    max-width: 90%;
    max-height: 70vh;
    z-index: 9999;
}

.login-message {
    margin-top: 10px;
    font-size: 14px;
    color: red;
}

.campo-image {
    width: 100% !important;
    height: auto;
}

.comments-section {
    margin-top: 20px;
}

.comment {
    margin-bottom: 20px;
    padding: 10px;
    border: 1px solid #ccc;
    background-color: #f6f7f8;
}

.comment-author {
    font-weight: bold;
    margin: 0;
}

.comment-content {
    margin-top: 5px;
}

.comment-actions,
.reply-actions {
    margin-top: 5px;
    font-size: 12px;
    color: #888;
}

.comment-actions span {
    cursor: pointer;
    margin-right: 10px;
}

.reply-form {
    padding: 10px;
    background-color: #f6f7f8;
    border: 1px solid #ccc;
    border-radius: 4px;
    margin-top: 10px;
}

.reply-form input[type="text"],
.reply-form textarea {
    width: 100%;
    padding: 8px;
    border: none;
    border-radius: 4px;
    background-color: #fff;
    resize: vertical;
    outline: none;
}

.reply-form .btn-primary {
    margin-top: 10px;
}

.reply {
    margin-top: 10px;
}

.reply-bubble {
    padding: 10px;
    background-color: #f6f7f8;
    border: 1px solid #ccc;
    border-radius: 4px;
}

.reply-author {
    font-weight: bold;
    margin-bottom: 5px;
}

.reply-content {
    margin: 0;
}

.comment-header,
.reply-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.comment-actions,
.reply-actions {
    position: relative;
}

.comment-menu,
.reply-menu {
    cursor: pointer;
}

.comment-menu-options,
.reply-menu-options {
    position: absolute;
    top: 100%;
    right: 0;
    background-color: #fff;
    border: 1px solid #ddd;
    padding: 5px;
    display: none;
}

.comment-menu-option,
.reply-menu-option {
    display: block;
    cursor: pointer;
    padding: 5px;
    text-decoration: none;
}

.comment-menu-option:hover,
.reply-menu-option:hover {
    background-color: #f9f9f9;
}
</style>