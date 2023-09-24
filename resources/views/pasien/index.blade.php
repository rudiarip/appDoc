@extends('layout.index')
@section('title', 'Data Pasien')
@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light"></span> Pasien</h4>

    <!-- Basic Bootstrap Table -->
    <div class="card">
        <h5 class="card-header">Table Pasien</h5>
        <div class="table-responsive text-nowrap">
            <table class="table" id="pasienTable">
                <thead>
                    <tr>
                        <th>No. Kartu</th>
                        <th>No. HP</th>
                        <th>Alamat</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- Data pasien akan dimuat oleh DataTables -->
                </tbody>
            </table>
        </div>
    </div>
    <!--/ Basic Bootstrap Table -->
    <script>
        $(document).ready(function() {
            // Inisialisasi DataTables
            $('#pasienTable').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{{ route('pasien.index') }}', // Rute untuk mengambil data dari server
                columns: [{
                        data: 'no_kartu',
                        name: 'no_kartu'
                    },
                    {
                        data: 'no_hp',
                        name: 'no_hp'
                    },
                    {
                        data: 'alamat',
                        name: 'alamat'
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false
                    }
                ],
                "order": [
                    [0, "asc"]
                ], // Urutkan berdasarkan kolom pertama (No. Kartu)
                "pagingType": "full_numbers", // Tampilkan paginasi dengan nomor halaman
                "language": {
                    "url": "//cdn.datatables.net/plug-ins/1.10.24/i18n/Indonesian.json" // Bahasa Indonesia untuk DataTables
                }
            });
        });
    </script>
</div>
@endsection