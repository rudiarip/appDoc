<div class="modal fade" id="backDropModal" data-bs-backdrop="static" tabindex="-1">
    <div class="modal-dialog">
        <form class="modal-content" action="{{ route('pasien.store') }}" id="add-pasien" method="post">
            <div class="modal-header">
                <h5 class="modal-title" id="backDropModalTitle">Modal title</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col mb-3">
                        <label for="no_kartu" class="form-label">No Kartu</label>
                        <input type="text" id="no_kartu" name="no_kartu" class="form-control"
                            placeholder="Enter NO Kartu">
                    </div>
                </div>
                <div class="row">
                    <div class="col mb-3">
                        <label for="no_hp" class="form-label">No HP</label>
                        <input type="text" id="no_hp" name="no_hp" class="form-control"
                            placeholder="Enter No HP">
                    </div>
                </div>
                <div class="row">
                    <div class="col mb-3">
                        <label for="no_hp" class="form-label">Alamat</label>
                        <textarea name="alamat" placeholder="Enter..." class=" form-control" id="no_hp" cols="15" rows="4"></textarea>

                    </div>
                </div>
                {{-- <div class="row g-2">
                    <div class="col mb-0">
                        <label for="emailBackdrop" class="form-label">Email</label>
                        <input type="email" id="emailBackdrop" class="form-control" placeholder="xxxx@xxx.xx">
                    </div>
                    <div class="col mb-0">
                        <label for="dobBackdrop" class="form-label">DOB</label>
                        <input type="date" id="dobBackdrop" class="form-control">
                    </div>
                </div> --}}
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-label-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Save</button>
            </div>
        </form>
    </div>
</div>
