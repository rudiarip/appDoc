@extends('layout.index')
@section('title', 'Data Pasien')
@section('content')

    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light"></span> Pasien</h4>
        <div class="row">
            <div class="col-2">

                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#backDropModal">Add
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
    <script>
        $(document).ready(function() {


            $("#add-pasien").on('submit', function(e) {
                e.preventDefault();
                $.ajax({
                    url: $(this).attr('action'),
                    method: $(this).attr('method'),
                    processData: false,
                    contentType: 'json',
                    dataType: false,
                    data: new FormData(e.target),
                    beforeSend: function(res) {
                        console.log(new FormData(e.target), this)
                    },
                    success: function(res) {

                    },
                    error: function(res) {

                    }
                })
            })

            {{ $dataTable->scripts(attributes: ['type' => 'module']) }}

        })
    </script>
@endpush
