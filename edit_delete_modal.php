<!-- Edit Modal -->
<div class="modal fade" id="editModal<?= $idsupplier; ?>" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="post">
                <div class="modal-header">
                    <h5 class="modal-title" id="editModalLabel">Edit Data Supplier</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <input type="number" name="idsupplier" value="<?= $idsupplier; ?>" class="form-control" required>
                    <br>
                    <input type="text" name="namasupplier" value="<?= $namasupplier; ?>" class="form-control" required>
                    <br>
                    <input type="text" name="alamat" value="<?= $alamat; ?>" class="form-control" required>
                    <br>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary" name="editSupplier">Save changes</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Delete Modal -->
<div class="modal fade" id="deleteModal<?= $idsupplier; ?>" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="post">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteModalLabel">Hapus Data Supplier</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Apakah Anda yakin ingin menghapus data supplier <strong><?= $namasupplier; ?></strong>?
                    <input type="hidden" name="idsupplier" value="<?= $idsupplier; ?>">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-danger" name="deleteSupplier">Delete</button>
                </div>
            </form>
        </div>
    </div>
</div>
