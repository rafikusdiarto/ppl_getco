<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BahanBaku;
use App\Models\SupplierPemasukan;
use Carbon\Carbon;


class LaporanKeuanganController extends Controller
{
    private $param;
    public function __construct(){
        $this->middleware(['role:Supplier']);
    }

    public function index(){
        try {

            $this->param['getJanuary'] = SupplierPemasukan::whereMonth('date', '01')->sum('selling');
            $this->param['getFebruary'] = SupplierPemasukan::whereMonth('date', '02')->sum('selling');
            $this->param['getMarch'] = SupplierPemasukan::whereMonth('date', '03')->sum('selling');
            $this->param['getApril'] = SupplierPemasukan::whereMonth('date', '04')->sum('selling');
            $this->param['getMay'] = SupplierPemasukan::whereMonth('date', '05')->sum('selling');
            $this->param['getJune'] = SupplierPemasukan::whereMonth('date', '06')->sum('selling');
            $this->param['getJuly'] = SupplierPemasukan::whereMonth('date', '07')->sum('selling');
            $this->param['getAugust'] = SupplierPemasukan::whereMonth('date', '08')->sum('selling');
            $this->param['getSeptember'] = SupplierPemasukan::whereMonth('date', '09')->sum('selling');
            $this->param['getOctober'] = SupplierPemasukan::whereMonth('date', '10')->sum('selling');
            $this->param['getNovember'] = SupplierPemasukan::whereMonth('date', '11')->sum('selling');
            $this->param['getDecember'] = SupplierPemasukan::whereMonth('date', '12')->sum('selling');

            $this->param['getThisJanuary'] = SupplierPemasukan::whereMonth('date', '01')->sum('income');
            $this->param['getThisFebruary'] = SupplierPemasukan::whereMonth('date', '02')->sum('income');
            $this->param['getThisMarch'] = SupplierPemasukan::whereMonth('date', '03')->sum('income');
            $this->param['getThisApril'] = SupplierPemasukan::whereMonth('date', '04')->sum('income');
            $this->param['getThisMay'] = SupplierPemasukan::whereMonth('date', '05')->sum('income');
            $this->param['getThisJune'] = SupplierPemasukan::whereMonth('date', '06')->sum('income');
            $this->param['getThisJuly'] = SupplierPemasukan::whereMonth('date', '07')->sum('income');
            $this->param['getThisAugust'] = SupplierPemasukan::whereMonth('date', '08')->sum('income');
            $this->param['getThisSeptember'] = SupplierPemasukan::whereMonth('date', '09')->sum('income');
            $this->param['getThisOctober'] = SupplierPemasukan::whereMonth('date', '10')->sum('income');
            $this->param['getThisNovember'] = SupplierPemasukan::whereMonth('date', '11')->sum('income');
            $this->param['getThisDecember'] = SupplierPemasukan::whereMonth('date', '12')->sum('income');

            // $this->param['grafikPemasukan'] = whereMonth('date')->sum('income');
            $bahanBaku = SupplierPemasukan::all();
            $this->param['countIngredients'] = $bahanBaku->sum('selling');
            $this->param['countIncome'] = $bahanBaku->sum('income');


            return view('pages.rekap-laporan-keuangan.index', $this->param);
        } catch (\Exception $e) {
            return redirect()->back()->withError($e->getMessage());
        } catch (\Illuminate\Database\QueryException $e) {
            return redirect()->back()->withError('Terjadi kesalahan pada database', $e->getMessage());
        }
    }
}

