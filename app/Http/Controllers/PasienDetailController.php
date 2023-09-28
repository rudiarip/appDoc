<?php

namespace App\Http\Controllers;

use App\DataTables\PasienDetailsDataTable;

use App\Models\Pasien;
use App\Models\PasienDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\View\View;
use Yajra\DataTables\DataTables;
use App\Response\ResponseStatus;

class PasienDetailController extends Controller
{
    public function index(PasienDetailsDataTable $dt)
    {
        return $dt->render('pasien-detail.index');
    }

    public function store(Request $request, Pasien $pasien)
    {
        $validate = Validator::make(
            $request->only(['nama', 'tgl_lahir']),
            [
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

        $pasien_detail = $pasien->pasienDetail()->create([
            'nama' => $request->nama,
            'tgl_lahir' => $request->tgl_lahir
        ]);

        if ($pasien_detail) {
            return ResponseStatus::successCreated("Data berhasil ditambahkan");
        }
        return ResponseStatus::internalError("Internal Server Error");
    }

    public function show($id)
    {
        $pasien_detail = PasienDetail::find($id);
        if (!$pasien_detail) {
            return ResponseStatus::notFound("Data tidak ditemukan");
        }
        $pasien = Pasien::find($pasien_detail->id_pasien);
        if (!$pasien) {
            return ResponseStatus::internalError("Internal Server Error");
        }
        $pasien_detail["alamat"] = $pasien->alamat;
        $pasien_detail["no_kartu"] = $pasien->no_kartu;
        $pasien_detail["no_hp"] = $pasien->no_hp;
        return ResponseStatus::successResponse($pasien_detail);
    }


    public function update(Request $request, $id)
    {
        $pasien_detail = PasienDetail::find($id);
        if (!$pasien_detail) {
            return ResponseStatus::notFound("Data tidak ditemukan");
        }

        $detailPayload = [
            "nama" => $request->nama,
            "tgl_lahir" => $request->tgl_lahir,
        ];
        $pasien_detail->update($detailPayload);
        $pasienPayload = [
            "no_kartu" => $request->no_kartu,
            "no_hp" => $request->no_hp,
            "alamat" => $request->alamat,
        ];
        $pasien = Pasien::find($pasien_detail["id_pasien"])
            ->update($pasienPayload);
        return ResponseStatus::successMessage("Data di update");
    }
    public function destroy($id)
    {
        $pasien = PasienDetail::find($id);

        if (!$pasien) {
            return ResponseStatus::notFound("Data tidak ditemukan");
        }
        $pasien->delete();
        return ResponseStatus::successMessage("Data berhasil dihapus");
    }

    public function viewDetail($id)
    {
        return view('pasien-detail.detail', [
            "id" => $id
        ]);
    }
}
