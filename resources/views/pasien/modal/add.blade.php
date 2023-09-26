<div class="modal fade" id="backDropModal" data-bs-backdrop="static" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <form class="modal-content" action="{{ route('pasien.store') }}" id="add-pasien" method="post">
            <div class="modal-header">
                <h5 class="modal-title" id="backDropModalTitle">Tambah Data Baru</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col mb-3">
                        <label for="no_kartu" class="form-label">No Kartu</label>
                        <input type="number" id="no_kartu" name="no_kartu" class="form-control"
                            placeholder="Enter NO Kartu">
                        <div id="defaultFormControlHelp" class="form-text text-danger text-error error_no_kartu"></div>

                    </div>
                </div>
                <div class="row">
                    <div class="col mb-3">
                        <label for="no_hp" class="form-label">No HP</label>
                        <input type="text" id="no_hp" name="no_hp" class="form-control"
                            placeholder="Enter No HP">
                        <div id="defaultFormControlHelp" class="form-text text-danger text-error error_no_hp"></div>
                    </div>
                </div>
                <div class="row">
                    <div class="col mb-3">
                        <label for="nama" class="form-label">Nama</label>
                        <input type="text" id="nama" name="nama" class="form-control"
                            placeholder="Enter nama">
                        <div id="defaultFormControlHelp" class="form-text text-danger text-error error_nama"></div>
                    </div>
                </div>
                <div class="row">
                    <div class="col mb-3">
                        <label for="tgl_lahir" class="form-label">Tanggal Lahir</label>
                        <input type="date" id="tgl_lahir" name="tgl_lahir" class="form-control" placeholder="">
                        <div id="defaultFormControlHelp" class="form-text text-danger text-error error_tgl_lahir"></div>
                    </div>
                </div>
                <div class="row">
                    <div class="col mb-3">
                        <label for="alamat" class="form-label">Alamat</label>
                        <textarea name="alamat" placeholder="Enter..." class=" form-control" id="alamat" cols="15" rows="4"></textarea>
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
