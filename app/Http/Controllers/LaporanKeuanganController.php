<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LaporanKeuanganController extends Controller
{
    private $param;
    public function __construct(){
        // $this->middleware(['role:admin']);
    }

    public function index(){
        try {
            // $countUser = User::whereHas('roles', function($thisRole){
            //     $thisRole->where('name', 'user');
            // })->count();

            // $this->param ['countProduct'] = Product::count();
            // $this->param ['countUser'] = $countUser;

            return view('pages.rekap-laporan-keuangan.index');
        } catch (\Exception $e) {
            return redirect()->back()->withError($e->getMessage());
        } catch (\Illuminate\Database\QueryException $e) {
            return redirect()->back()->withError('Terjadi kesalahan pada database', $e->getMessage());
        }
    }
}

