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

    public function destroy($id)    
    {
        $pasienDetail = PasienDetail::findOrFail($id);
        $pasienId = $pasienDetail->id;
        $pasienDetail2 = PasienDetail::with('id_pasien')->find($pasienId);
        if(!$pasienDetail2){
            $pasien = Pasien::findOrFail($id);
            $pasien->delete();
        }
        $pasienDetail->delete();


        return response()->json(['message' => 'Data berhasil dihapus']);
    }
}
