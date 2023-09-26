<div class="modal fade" id="editModal" data-bs-backdrop="static" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <form class="modal-content" action="" id="edit-pasien" method="post">
            @method('PUT')
            <div class="modal-header">
                <h5 class="modal-title" id="editModalTitle">Edit Data</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col mb-3">
                        <label for="nama" class="form-label">Nama</label>
                        <input type="text" id="nama" name="nama" class="form-control modal-input"
                            placeholder="Enter Nama">
                        <div id="defaultFormControlHelp" class="form-text text-danger text-error error_no_kartu"></div>

                    </div>
                </div>
                <div class="row">
                    <div class="col mb-3">
                        <label for="tgl_lahir" class="form-label">Tgl lahir</label>
                        <input type="text" id="tgl_lahir" name="tgl_lahir" class="form-control modal-input"
                            placeholder="Enter tgl lahir">
                        <div id="defaultFormControlHelp" class="form-text text-danger text-error error_no_kartu"></div>

                    </div>
                </div>
                <div class="row">
                    <div class="col mb-3">
                        <label for="no_kartu" class="form-label">No Kartu</label>
                        <input type="number" id="no_kartu" name="no_kartu" class="form-control modal-input"
                            placeholder="Enter NO Kartu">
                        <div id="defaultFormControlHelp" class="form-text text-danger text-error error_no_kartu"></div>

                    </div>
                </div>
                <div class="row">
                    <div class="col mb-3">
                        <label for="no_hp" class="form-label">No HP</label>
                        <input type="text" id="no_hp" name="no_hp" class="form-control modal-input"
                            placeholder="Enter No HP">
                        <div id="defaultFormControlHelp" class="form-text text-danger text-error error_no_hp"></div>
                    </div>
                </div>
                <div class="row">
                    <div class="col mb-3">
                        <label for="alamat" class="form-label">Alamat</label>
                        <textarea name="alamat" placeholder="Enter..." class=" form-control modal-input" id="alamat" cols="15"
                            rows="4"></textarea>
                        <div id="defaultFormControlHelp" class="form-text text-danger text-error error_alamat"></div>
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
