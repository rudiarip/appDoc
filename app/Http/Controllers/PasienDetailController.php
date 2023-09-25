<?php

namespace App\Http\Controllers;

use App\DataTables\PasienDetailsDataTable;
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
