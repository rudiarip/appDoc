@extends('layout.index')
@section('title', 'Data Pasien')
@section('content')
    @push('datables')
        <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.css" />
        <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.js"></script>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css" />
        <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
    @endpush

    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light"></span> Pasien</h4>
        <div class="row">
            <div class="col-2">

                <button type="button" id="open-modal" class="btn btn-primary" data-bs-toggle="modal"
                    data-bs-target="#backDropModal">Add
                    Data</button>
            </div>
        </div>
        <div class="card-datatable pt-0">
            {{ $dataTable->table() }}
        </div>
        <!--/ Basic Bootstrap Table -->

    </div>
    @include('pasien.modal.add')
@endsection
@push('scripts')
    {{ $dataTable->scripts(attributes: ['type' => 'module']) }}
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        window.addEventListener('deletePost', function(e) {

        })
    </script>
    <script>
        const reloadData = () => {
            window.LaravelDataTables["pasien-detail"].ajax.reload();
        }

        function showModal({
            idName,
            title
        }) {
            // backDropModalTitle
            const modal = $('#' + idName)
            modal.modal('show');
            if (title) {
                modal.find('.modal-title').text(title)
            }
            return modal
        }

        function hideModal(idName) {
            return $('#' + idName).modal('hide');
        }


        $(document).ready(function() {
            $("#open-modal").on('click', function(e) {
                e.preventDefault();
                const targetModal = $(this).attr('data-bs-target');
                const form = $(targetModal + " " + 'form')
                form[0].reset();
                const formInputs = $(form).find('input');
                formInputs.each(function() {
                    if ($(this).attr('readonly')) {
                        $(this).attr('readonly', false)
                    }
                });
            })

            $(document).on('click', "button.edit-pasien", function(e) {
                e.preventDefault();
                const id = $(this).attr('data-id');
                $.ajax({
                    url: `pasien/${id}`,
                    method: "get",
                    success: function(res) {
                        const pasien = Object.entries(res.data)
                        const {
                            id
                        } = res.data

                        showModal({
                            idName: 'backDropModal',
                            title: 'Edit Data Pasien'
                        })
                        //set id to modal
                        $("form#add-pasien").attr('action', `pasien/${id}/edit`)
                        $.each(pasien, function(idx, val) {
                            const [key, value] = val;
                            $('#' + key).val(value);
                            if (key == 'no_kartu' || key == 'no_hp') {
                                $('#' + key).attr('readonly', true);
                            }
                            if (typeof value == 'object' && value != null) {
                                console.log(key, value)
                            }
                        })
                    },
                    error: function({
                        responseJSON,
                        responseText
                    }) {
                        toastr.error(responseJSON.message)
                    },
                })

            })
            $(document).on('click', "button.delete-pasien", function(e) {
                e.preventDefault();
                const id = $(this).attr('data-id');
                swal.fire({
                    html: "Are you sure want delete this data?",
                    title: "<strong>Delete data </strong>",
                    imageWidth: 48,
                    imageHeight: 48,
                    showCloseButton: true,
                    showCancelButton: true,
                    cancelButtonText: 'Cancel',
                    confirmButtonText: 'Yes, delete',
                    cancelButtonColor: '#d33',
                    confirmButtonColor: '#3085d6',
                    width: 300,
                    allowOutsideClick: false
                }).then((res) => {
                    if (res.isConfirmed) {
                        $.ajax({
                            url: `detail/${id}`,
                            method: "delete",
                            success: function(res) {
                                // reloadData()
                                toastr.success(res.message)
                            },
                            error: function({
                                responseJSON,
                                responseText
                            }) {
                                toastr.error(responseJSON.message)
                            },
                        })
                    }
                })

            })
            $("#add-pasien").on('submit', function(e) {
                e.preventDefault();
                $.ajax({
                    url: $(this).attr('action'),
                    method: $(this).attr('method'),
                    processData: false,
                    contentType: false,
                    dataType: 'json',
                    data: new FormData(e.target),
                    beforeSend: function(res) {
                        $(e.target).find("span.error-text").text("");
                    },
                    success: function(res) {
                        $(e.target)[0].reset();
                        hideModal('backDropModal').fadeOut(1000)
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
        })
    </script>
@endpush
