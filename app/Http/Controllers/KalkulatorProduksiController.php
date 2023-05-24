<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class KalkulatorProduksiController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(['role:Pemilik Usaha']);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('pages.kalkulator-produksi.index');
    }
}
