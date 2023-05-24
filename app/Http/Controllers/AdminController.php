<?php

namespace App\Http\Controllers;

use App\Models\AkunPremium;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class AdminController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(['role:Admin']);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {
        try {
            $akun = AkunPremium::all();
            $this->param['getAkunPremium'] = $akun;
            return view('pages.akun-premium.index', $this->param);

        } catch (Exception $e) {
            dd($e->getMessage());
            DB::rollBack();
            return redirect()->back()->with('error', $e->getMessage());
        }
    }
    public function create()
    {
        return view("pages.akun-premium.create");
    }

    public function store(Request $request)
    {
        $request->validate([
            "nama" => "required",
            "no_rek" => "required",
            "tanggal_bayar" => "required",
            "expired_date" => "required",
       ]);

       DB::beginTransaction();
       try {
            AkunPremium::create(([
               "nama" => $request->nama,
               "no_rek" => $request->no_rek,
               "tanggal_bayar" => $request->tanggal_bayar,
               "expired_date" => $request->expired_date
           ]));
           DB::commit();
           return redirect()->route("akun-premium")->with("success", "Data berhasil ditambahkan");
       } catch (Exception $e) {
           dd($e->getMessage());
           DB::rollBack();
           return redirect()->back()->with('error', $e->getMessage());
       }

    }

    public function edit(AkunPremium $akunpremium){
        try {
            $this->param['getDetailAkun'] = AkunPremium::find($akunpremium->id);
            return view('pages.akun-premium.edit', $this->param);
        } catch(\Throwable $e){
            return redirect()->back()->withError($e->getMessage());
        } catch(\Illuminate\Database\QueryException $e){
            return redirect()->back()->withError($e->getMessage());
        }
    }

    public function update(Request $request)
    {
        $request->validate([
            "nama" => "required",
            "no_rek" => "required",
            "tanggal_bayar" => "required",
            "expired_date" => "required",
       ]);

       DB::beginTransaction();
       try {
            AkunPremium::create($request([
               "nama" => $request->nama,
               "no_rek" => $request->no_rek,
               "tanggal_bayar" => $request->tanggal_bayar,
               "expired_date" => $request->expired_date
           ]));
           DB::commit();
           return redirect()->route("akun-premium")->with("success", "Data berhasil ditambahkan");
       } catch (Exception $e) {
           dd($e->getMessage());
           DB::rollBack();
           return redirect()->back()->with('error', $e->getMessage());
       }

    }
}
