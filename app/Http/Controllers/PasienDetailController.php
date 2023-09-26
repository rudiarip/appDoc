<?php

namespace App\Http\Controllers;

use App\DataTables\PasienDetailsDataTable;

use App\Models\Pasien;
use App\Models\PasienDetail;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Yajra\DataTables\DataTables;

class PasienDetailController extends Controller
{
    public function index(PasienDetailsDataTable $dt)
    {
        return $dt->render('pasien-detail.index');
    }

    public function show($id)
    {
        $pasien_detail = PasienDetail::find($id);
        if (!$pasien_detail) {
            return response()->json([
                'status' => 'fail',
                'message' => 'Data tidak ditemukan'
            ], 404);
        }
        $pasien = Pasien::find($pasien_detail->id_pasien);
        if (!$pasien) {
            return response()->json([
                'status' => 'fail',
                'data' => "Something went wrong",
            ], 500);
        }
        $pasien_detail["alamat"] = $pasien->alamat;
        $pasien_detail["no_kartu"] = $pasien->no_kartu;
        $pasien_detail["no_hp"] = $pasien->no_hp;
        return response()->json([
            'status' => 'success',
            'data' => $pasien_detail,
        ]);
    }


    public function update(Request $request, $id)
    {
        $pasien_detail = PasienDetail::find($id);
        if (!$pasien_detail) {
            return response()->json([
                "status"  => "fail",
                "message" => "Data tidak ditemukan",
                "code"    => 404
            ], 404);
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
        return response()->json([
            "status"  => "success",
            "message" => "Data di update",
            "code"    => 200,
        ]);
    }
    public function destroy($id)
    {
        $pasien = PasienDetail::find($id);

        if (!$pasien) {
            return response()->json([
                "status"  => "fail",
                "message" => "Data tidak ditemukan",
                "code"    => 404
            ], 404);
        }
        $pasien->delete();
        return response()->json([
            "status"  => "success",
            "message" => "Data berhasil dihapus",
            "code"    => 200
        ], 200);
    }
}
