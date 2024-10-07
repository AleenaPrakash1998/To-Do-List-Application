<div class="d-flex">
    <button type="button"
            class="btn btn-outline-secondary border-none rounded-pill d-flex align-items-center ms-auto"
            onclick="window.location.href='{{ route('tasks.edit', $model->id) }}'">
        <i class='bx bx-edit-alt'></i>
        &nbsp;&nbsp;Edit
    </button>
    <button type="button"
            class="btn btn-outline-secondary border-none rounded-pill d-flex align-items-center ms-auto"
            onclick="window.location.href='{{ route('tasks.showShareForm', $model->id) }}'">
        <i class='bx bx-share-alt'></i>
        &nbsp;&nbsp;Share
    </button>
    <button type="button"
            class="btn btn-outline-secondary border-none rounded-pill d-flex align-items-center ms-auto"
            onclick="showDeleteModal('{{ route('tasks.destroy', $model->id) }}')">
        <i class='bx bx-trash-alt'></i>
        &nbsp;&nbsp;Delete
    </button>
    <!-- Confirmation Modal -->
    <div class="modal fade" id="deleteConfirmModal" tabindex="-1" aria-labelledby="deleteConfirmModalLabel"
         aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteConfirmModalLabel">Confirm Delete</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Are you sure you want to delete this vendor? This action cannot be undone.
                </div>
                <div class="modal-footer">
                    <form id="deleteForm" method="POST" action="">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Delete</button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

