<div class="modal" id="confirmationModal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Delete Confirmation</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>Are you sure you want to delete this item?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" id="confirmDeleteBtn">Delete</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
            </div>
        </div>
    </div>
</div>

<script>
var deleteBtn = document.querySelectorAll('.deleteBtn');
var confirmDeleteBtn = document.getElementById('confirmDeleteBtn');
var confirmationModal = document.getElementById('confirmationModal');

deleteBtn.forEach((btn) => {
    btn.addEventListener('click', (e) => {
        e.preventDefault();
        var deleteUrl = btn.getAttribute('href');
        confirmationModal.classList.add('show');
        confirmationModal.style.display = 'block';

        confirmDeleteBtn.addEventListener('click', () => {
            window.location.href = deleteUrl;
        });
    });
});

confirmationModal.addEventListener('hide.bs.modal', () => {
    confirmationModal.classList.remove('show');
    confirmationModal.style.display = 'none';
});

let closeBtn = document.querySelectorAll('.close');
closeBtn.forEach((btn) => {
    btn.addEventListener("click", () => {
        confirmationModal.style.display = "none";
    });
});
let CancelBtn = document.querySelectorAll('.btn-secondary');
CancelBtn.forEach((btn) => {
    btn.addEventListener("click", () => {
        confirmationModal.style.display = "none";
    });
});
</script>