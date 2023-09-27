<div class="modal fade" id="backDropModal" data-bs-backdrop="static" tabindex="-1">
    <div class="modal-dialog">
        <form class="modal-content" id="add-new-pasien">
            <div class="modal-header">
                <h5 class="modal-title" id="backDropModalTitle">Tambah Pasien</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col mb-3">
                        <label for="nama" class="form-label">Nama</label>
                        <input type="text" id="nama" name="nama" class="form-control"
                            placeholder="Enter Nama">
                        <div id="defaultFormControlHelp" class="form-text text-danger text-error error_nama"></div>
                    </div>
                </div>
                <div class="row">
                    <div class="col mb-3">
                        <label for="tgl_lahir" class="form-label">Tangaal Lahir</label>
                        <input type="date" id="tgl_lahir" name="tgl_lahir" class="form-control">
                        <div id="defaultFormControlHelp" class="form-text text-danger text-error error_tgl_lahir"></div>
                    </div>
                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-label-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Save</button>
            </div>
        </form>
    </div>
</div>
