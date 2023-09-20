<!-- resources/views/pasien/index.blade.php -->

@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Daftar Pasien</h2>

    <form id="tambahPasienForm">
        @csrf
        <div class="form-group">
            <label for="no_kartu">Nomor Kartu</label>
            <input type="text" class="form-control" id="no_kartu" name="no_kartu" required>
        </div>
        <div class="form-group">
            <label for="alamat">Alamat</label>
            <textarea class="form-control" id="alamat" name="alamat" required></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Tambah Pasien</button>
    </form>

    <table class="table">
        <thead>
            <tr>
                <th>No. Kartu</th>
                <th>Alamat</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody id="dataPasien">
        </tbody>
    </table>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    function tampilkanDataPasien() {
        $.ajax({
            url: '/pasien',
            method: 'GET',
            success: function(data) {
                $('#dataPasien').empty();
                data.forEach(function(pasien) {
                    $('#dataPasien').append(`
                        <tr>
                            <td>${pasien.no_kartu}</td>
                            <td>${pasien.alamat}</td>
                            <td>
                                <button class="btn btn-warning btn-edit" data-id="${pasien.id}">Edit</button>
                                <button class="btn btn-danger btn-hapus" data-id="${pasien.id}">Hapus</button>
                            </td>
                        </tr>
                    `);
                });
            }
        });
    }

    $(document).ready(function() {
        tampilkanDataPasien();
    });

    $('#tambahPasienForm').submit(function(e) {
        e.preventDefault();
        var formData = $(this).serialize();
        $.ajax({
            url: '/pasien',
            method: 'POST',
            data: formData,
            success: function(data) {
                tampilkanDataPasien();
                $('#tambahPasienForm')[0].reset();
            }
        });
    });

    $(document).on('click', '.btn-hapus', function() {
        var id = $(this).data('id');
        $.ajax({
            url: '/pasien/' + id,
            method: 'DELETE',
            success: function(data) {
                tampilkanDataPasien();
            }
        });
    });

    $(document).on('click', '.btn-edit', function() {
        var id = $(this).data('id');
        $.ajax({
            url: '/pasien/' + id + '/edit',
            method: 'GET',
            success: function(data) {
                $('#no_kartu').val(data.no_kartu);
                $('#alamat').val(data.alamat);
            }
        });
    });

    $('#editPasienForm').submit(function(e) {
        e.preventDefault();
        var id = $(this).data('id');
        var formData = $(this).serialize();
        $.ajax({
            url: '/pasien/' + id,
            method: 'PUT',
            data: formData,
            success: function(data) {
                tampilkanDataPasien();
                $('#editPasienModal').modal('hide');
            }
        });
    });
</script>