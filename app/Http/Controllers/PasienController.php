<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pasien;
use DataTables;
use App\Models\PasienDetail;

class PasienController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Pasien::rightJoin('pasien_details', 'pasiens.id', '=', 'pasien_details.id_pasien')
                ->select('pasiens.no_kartu', 'pasiens.no_hp', 'pasiens.alamat', 'pasien_details.nama', 'pasien_details.tgl_lahir')
                ->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $btn = '<a href="" class="edit btn btn-primary btn-sm">Edit</a>';
                    $btn .= '<button type="button" data-id="' . $row->id . '" class="delete btn btn-danger btn-sm ml-2">Delete</button>';
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);

            //return datatables()->of($data)->make(true);
        }

        return view('index');
    }


    public function store(Request $request)
    {
        $request->validate([
            'no_kartu' => 'required',
            'alamat' => 'required',
        ]);

        $pasien = Pasien::create([
            'no_kartu' => $request->no_kartu,
            'alamat' => $request->alamat,
        ]);

        return response()->json(['message' => 'Data berhasil ditambahkan']);
    }

    public function show($id)
    {
        $pasien = Pasien::findOrFail($id);
        return response()->json($pasien);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'no_kartu' => 'required',
            'alamat' => 'required',
        ]);

        $pasien = Pasien::findOrFail($id);
        $pasien->update([
            'no_kartu' => $request->no_kartu,
            'alamat' => $request->alamat,
        ]);

        return response()->json(['message' => 'Data berhasil diperbarui']);
    }

    public function destroy($id)
    {
        $pasien = Pasien::findOrFail($id);
        $pasien->delete();

        return response()->json(['message' => 'Data berhasil dihapus']);
    }
}
