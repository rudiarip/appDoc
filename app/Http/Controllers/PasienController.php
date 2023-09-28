<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pasien;
use Illuminate\Support\Facades\Validator;
use App\Response\ResponseStatus;

class PasienController extends Controller
{
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
            return ResponseStatus::unprocessContent(
                "payload is not suitable",
                $validate->errors()->toArray()
            );
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
            return ResponseStatus::successCreated("Data berhasil ditambahkan");
        }
        return ResponseStatus::internalError("Internal Server Error");
    }

    public function show($id)
    {
        $pasien = Pasien::find($id);
        if (!$pasien) {
            return ResponseStatus::notFound("Data tidak ditemukan");
        }
        return ResponseStatus::successResponse($pasien);
    }
    public function detail($id)
    {
        $pasien = Pasien::find($id);
        if (!$pasien) {
            return ResponseStatus::notFound("Data tidak ditemukan");
        }
        return ResponseStatus::successResponse($pasien);
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
            return ResponseStatus::notFound("Data tidak ditemukan");
        }

        $pasien->update([
            'no_kartu' => $request->no_kartu,
            'alamat' => $request->alamat,
            'no_hp' => $request->no_hp,
        ]);
        return ResponseStatus::successMessage("Data berhasil diperbarui");
    }

    public function destroy($id)
    {

        $pasien = Pasien::findOrFail($id);
        if (!$pasien) return ResponseStatus::notFound("Data tidak ditemukan");
        $pasien->delete();
        return ResponseStatus::successMessage("Data berhasil dihapus");
    }
}
