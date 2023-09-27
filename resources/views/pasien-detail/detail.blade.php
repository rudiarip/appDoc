@extends('layout.index')
@section('title', 'Data Pasien')
@section('content')
    <div id="detailModal">
        <div class="" id="detail-pasien">
            @method('PUT')
            <div class="modal-header">
                <h5 class="modal-title" id="detailModalTitle">Detail Data Pasien</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
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
                <hr>
                <div class="row justify-content-end mb-3">
                    <div class="col ms-auto">

                        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#backDropModal">add
                            new</button>
                    </div>
                </div>

                <div class="row">
                    <div id="all-pasien">
                    </div>
                </div>
            </div>

        </div>
    </div>
    @include('pasien-detail.modal.add-new-pasien')
@endsection
@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        function getDetail() {
            const url = '{{ route('pasien.show', request()->id) }}';
            $.ajax({
                url,
                method: "get",
                success: function(res) {
                    const pasien = Object.entries(res.data)

                    $.each(pasien, function(idx, val) {
                        const [key, value] = val;
                        const x = $('#' + key).val(value);
                        const element = $('#detailModal .modal-input#' + key);
                        element.val(value).attr("readonly", true);

                        if (typeof value == "object" && Array.isArray(value)) {
                            // Loop melalui array pasien
                            var detail = "";

                            value.forEach(function(pasien, index) {
                                detail += `
                                <div class="row g-2 mb-2">
                                  <div class="col mb-0">
                                      <input type="text" value="${pasien.nama}" id="name" class="form-control" readonly>
                                  </div>
                                  <div class="col mb-0">
                                    <input type="text" value="${pasien.tgl_lahir}" id="tgl_lahir" class="form-control" placeholder="DD / MM / YY" readonly>
                                  </div>
                                </div>
                                `
                            });
                            const header = `
                            <div class="row g-2">
                                <div class="col mb-0">
                                    <label for="name" class="form-label">nama</label>
                                    </div>
                                <div class="col mb-0">
                                        <label for="tgl_lahir" class="form-label">Tanggal Lahir</label>
                                </div>
                            </div>
                            `
                            $("#all-pasien").html(header + detail)
                        }
                    })
                },
                error({
                    responseJSON,
                    responseText,
                    status
                }) {
                    toastr.error(responseJSON.message, {
                        timeOut: 1500,
                        progressBar: true,

                    })
                    setTimeout(() => {
                        window.location.href = "{{ route('detail.index') }}"
                    }, 1500)
                },
            })
        }
        getDetail()

        $("#add-new-pasien").on('submit', function(e) {
            e.preventDefault();
            $.ajax({
                url: "{{ route('detail.store', request()->id) }}",
                method: "post",
                processData: false,
                contentType: false,
                dataType: 'json',
                data: new FormData(e.target),
                beforeSend: function(res) {
                    $(e.target).find("div.error-text").text("");
                },
                success: function(res) {
                    getDetail()
                    $("#backDropModal").modal("hide")
                    $(e.target)[0].reset();
                    toastr.success(res.message)
                },
                error: function({
                    responseJSON,
                    responseText
                }) {
                    $.each(responseJSON.errors, function(prefix, val) {
                        $('div.' + 'error_' + prefix).text(val[0]);
                    })
                }
            })
        })
    </script>
@endpush
