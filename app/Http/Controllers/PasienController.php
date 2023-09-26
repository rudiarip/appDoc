<?php

namespace App\Http\Controllers;

use App\DataTables\PasiensDataTable;
use Illuminate\Http\Request;
use App\Models\Pasien;
use App\Models\PasienDetail;
use Illuminate\Support\Facades\Validator;

class PasienController extends Controller
{
    // public function index(PasiensDataTable $dataTables)
    // {
    //     return $dataTables->render("pasien.index");
    // }

    public function addNew(Request $request)
    {
    }
    public function store(Request $request)
    {
        $validate = Validator::make(
            $request->only(['no_kartu', 'alamat', 'no_hp', 'nama', 'tgl_lahir']),
            [
                'no_kartu' => 'required',
                'no_hp' => 'required',
                'alamat' => 'required',
                'nama' => 'required',
                'tgl_lahir' => 'required',
            ],
        );
        if ($validate->fails()) {
            return response()->json([
                'status' => 'fail',
                'errors' => $validate->errors()->toArray(),
                'message' => 'Data gagal ditambahkan',
                'code' => 422
            ], 422);
        }

        $pasien = Pasien::create([
            'no_kartu' => $request->no_kartu,
            'alamat' => $request->alamat,
            'no_hp' => $request->no_hp,
        ]);
        $pasien_detail = $pasien->pasienDetail()->create([
            'nama' => $request->nama,
            'tgl_lahir' => $request->tgl_lahir
        ]);

        if ($pasien && $pasien_detail) {
            return response()->json([
                'status' => 'success',
                'message' => 'Data berhasil ditambahkan',
                'code' => 201
            ], 201);
        }
        return response()->json([
            'status' => 'fail',
            'message' => 'Internal Server Error',
            'code' => 500
        ], 500);
    }

    public function show($id)
    {
        $pasien = Pasien::find($id);
        if (!$pasien) {
            return response()->json([
                'status' => 'fail',
                'message' => 'Data tidak ditemukan'
            ], 404);
        }
        return response()->json([
            'status' => 'success',
            'data' => $pasien,
        ]);
    }
    public function detail($id)
    {
        $pasien = Pasien::find($id);
        if (!$pasien) {
            return response()->json([
                'status' => 'fail',
                'message' => 'Data tidak ditemukan'
            ], 404);
        }
        return response()->json([
            'status' => 'success',
            'data' => $pasien,
        ]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'no_kartu' => 'required',
            'alamat' => 'required',
            'no_hp' => 'required',
        ]);

        $pasien = Pasien::findOrFail($id);
        if (!$pasien) {
            return response()->json([
                'status' => 'fail',
                'message' => 'Data tidak ditemukan'
            ], 404);
        }

        $pasien->update([
            'no_kartu' => $request->no_kartu,
            'alamat' => $request->alamat,
            'no_hp' => $request->no_hp,
        ]);

        return response()->json([
            'message' => 'Data berhasil diperbarui'
        ]);
    }

    public function destroy($id)
    {

        $pasien = Pasien::findOrFail($id);
        return response()->json([
            'status' => 'fail',
            'message' => 'Data tidak ditemukan'
        ], 404);
        if (!$pasien) {
        }

        $pasien->delete();
        return response()->json([
            'status' => 'success',
            'message' => 'Data berhasil dihapus'
        ], 200);
    }
}
