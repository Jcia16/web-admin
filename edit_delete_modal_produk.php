<!-- Edit Modal -->
<div class="modal fade" id="editModal<?= $idproduk; ?>" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="post">
                <div class="modal-header">
                    <h5 class="modal-title" id="editModalLabel">Edit Data Produk</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">

                    <input type="number" name="idproduk" value="<?= $data['idproduk']; ?>" class="form-control" required>
                    <br>
                    <input type="text" name="namaproduk" value="<?= $data['namaproduk']; ?>" class="form-control" required>
                    <br>
                    <input type="number" name="hargasatuan" value="<?= $data['hargasatuan']; ?>" class="form-control" required>
                    <br>
                    
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-primary" name="editProduk">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Delete Modal -->
<div class="modal fade" id="deleteModal<?= $idproduk; ?>" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="post">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteModalLabel">Hapus Data Produk</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Apakah Anda yakin ingin menghapus data produk <strong><?= $data['namaproduk']; ?></strong>?
                    <input type="hidden" name="idproduk" value="<?= $idproduk; ?>">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-danger" name="deleteProduk">Hapus</button>
                </div>
            </form>
        </div>
    </div>
</div>
