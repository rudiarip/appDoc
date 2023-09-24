<!-- resources/views/index.blade.php -->

@extends('layouts.app')


@section('content')
<div class="container">
    <h2>Daftar Pasien</h2>

    <!-- Tabel untuk menampilkan data pasien -->
    <table class="table" id="pasienTable">
        <thead>
            <tr>
                <th>No. Kartu</th>
                <th>No. Hp</th>
                <th>Alamat</th>
                <th>Nama</th>
                <th>Tgl Lahir</th>
            </tr>
        </thead>
        <tbody>
            <!-- Data pasien akan dimuat oleh DataTables -->
        </tbody>
    </table>
</div>

<!-- Skrip JavaScript untuk DataTables -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
<script>
    $(document).ready(function() {
        $('#pasienTable').DataTable({
            processing: true,
            serverSide: true,
            ajax: '{{ route('pasien.index') }}',
            columns: [
                { data: 'no_kartu', name: 'no_kartu' },
                { data: 'no_hp', name: 'no_hp' },
                { data: 'alamat', name: 'alamat' },
                { data: 'nama', name: 'nama' },
                { data: 'tgl_lahir', name: 'tgl_lahir' }
            ],
            "order": [
                [0, "asc"]
            ],
            "pagingType": "full_numbers",
            "language": {
                "url": "//cdn.datatables.net/plug-ins/1.10.24/i18n/Indonesian.json"
            }
        });
    });
</script>
@endsection