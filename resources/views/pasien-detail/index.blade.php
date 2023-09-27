@extends('layout.index')
@section('title', 'Data Pasien')
@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light"></span> Pasien</h4>
        <div class="row">
            <div class="col-2">
                <button type="button" id="open-modal" class="btn btn-primary" data-bs-toggle="modal"
                    data-bs-target="#backDropModal">Add
                    Data</button>
            </div>
        </div>
        <div class="card mt-2 p-2">
            {{ $dataTable->table() }}
        </div>
        <!--/ Basic Bootstrap Table -->

    </div>
    @include('pasien.modal.detail')
    @include('pasien.modal.edit')
    @include('pasien.modal.add')
@endsection
@push('scripts')
    {{ $dataTable->scripts(attributes: ['type' => 'module']) }}
    <script src="/sweatalert/sweatalert.js"></script>
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
            // $(modal).find("span.error-text").text("");

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
            })

            $("form#edit-pasien").on('submit', function(e) {
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
                        reloadData()
                        hideModal('editModal').fadeOut(1000)
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

            $(document).on('click', "button.edit-pasien", function(e) {
                e.preventDefault();
                const id = $(this).attr('data-id');
                $.ajax({
                    url: `detail/${id}`,
                    method: "get",
                    success: function(res) {
                        const pasien = Object.entries(res.data)
                        const {
                            id
                        } = res.data

                        showModal({
                            idName: 'editModal',
                            title: 'Edit Data Pasien'
                        })
                        //set id to modal
                        $("form#edit-pasien").attr('action', `detail/${id}`)

                        $.each(pasien, function(idx, val) {
                            const [key, value] = val;
                            const x = $('#' + key).val(value);
                            const element = $('#editModal .modal-input#' + key);
                            element.val(value);

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
                                reloadData()
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
                        reloadData()
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
