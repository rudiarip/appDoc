<?php

namespace App\Http\Controllers;

use App\DataTables\PasienDetailsDataTable;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Yajra\DataTables\DataTables;

class PasienDetailController extends Controller
{
    public function index(PasienDetailsDataTable $dt)
    {
        return $dt->render('pasien-detail.index');
    }
}
