<?php

namespace App\Http\Controllers;

use App\Models\SyaratPremiumAkun;
use App\Models\SyaratPremiumDetail;
use Carbon\Carbon;
use App\Models\User;
use App\Models\AkunPremium;
use Exception;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\AkunPremiumNew;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

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
            $waiting_akun = AkunPremiumNew::all();
            $syarat = SyaratPremiumAkun::first();
            $akun_kadaluwarsa = AkunPremium::where('expired_date', '<', \Carbon\Carbon::now())->count();


            // $valid = $akun->where('expired_date', '>', \Carbon\Carbon::now());
            // $expired = $akun->where('expired_date', '<', \Carbon\Carbon::now());
            // foreach ($valid as $i){
            //     $user = $i->user;
            //     User::where('id', $user->id)->update(['is_premium' => true]);
            // }
            // foreach ($expired as $i){
            //     $user = $i->user;
            //     User::where('id', $user->id)->update(['is_premium' => false]);
            // }
            
            return view('pages.akun-premium.index', [
                'getAkunPremium' => $akun,
                'getWaitingAkun' => $waiting_akun,
                'getExpiredAkun' => $akun_kadaluwarsa,
                'getSyarat' => $syarat->body
            ]);

        } catch (Exception $e) {
            dd($e->getMessage());
            DB::rollBack();
            return redirect()->back()->with('error', $e->getMessage());
        }
    }


    public function edit(AkunPremium $akunpremium){
        try {
            $this->param['getPremium'] = AkunPremium::find($akunpremium->id);
            return view('pages.akun-premium.edit', $this->param);
        } catch(\Throwable $e){
            return redirect()->back()->withError($e->getMessage());
        } catch(\Illuminate\Database\QueryException $e){
            return redirect()->back()->withError($e->getMessage());
        }
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            "user_id" => "required",
            "no_rek" => "required",
            "tanggal_bayar" => "required",
            "expired_date" => "required",
       ]);

       DB::beginTransaction();
       try {
            $premium = AkunPremium::find($id);
            $premium
            ->update([
                "user_id" => $request->user_id,
                "no_rek" => $request->no_rek,
                "tanggal_bayar" => $request->tanggal_bayar,
                "expired_date" => $request->expired_date
            ]);
           DB::commit();
           return redirect()->route("akun-premium")->with("success", "Data berhasil diubah");
       } catch (Exception $e) {
           dd($e->getMessage());
           DB::rollBack();
           return redirect()->back()->with('error', $e->getMessage());
        }

    }

    public function destroy($id)
    {
        $user = AkunPremium::find($id)->user;
        try {
            User::where('id', $user->id)->update(['is_premium' => false]);
            AkunPremium::find($id)->delete();
            return redirect()->route("akun-premium")->with("success", "Data berhasil dihapus");
        } catch(\Throwable $e){
            return redirect()->back()->withError($e->getMessage());
        } catch(\Illuminate\Database\QueryException $e){
            return redirect()->back()->withError($e->getMessage());
        }
    }


    public function acc(Request $request)
    {
        $add_expired_date = \Carbon\Carbon::now()->addDays(90)->format('d/m/y');
        DB::beginTransaction();
        try{
            AkunPremium::create([
                'user_id' => $request->id,
                'tanggal_bayar' => \Carbon\Carbon::now(),
                'expired_date' => $add_expired_date
            ]);
            AkunPremiumNew::where('user_id', $request->id)->update(['status' => true]);
            User::where('id', $request->id)->update(['is_premium' => true]);
            DB::commit();
            return redirect()->back();
        }catch (Exception $e){
            dd($e->getMessage());
            DB::rollBack();
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function editSyaratPremium(){
        $syarat = SyaratPremiumAkun::first();
        $cek = 'cek';
        return view('pages.akun-premium.edit-syarat', [
            'syarat' => $syarat->body,
            'cek' => $cek
        ]);
    }
    public function updateSyaratPremium(Request $request){
        $validate = $request->validate([
            'body' => 'required'
        ]);
        SyaratPremiumAkun::first()->update($validate);
        return redirect()->route("akun-premium");
    }

    public function reject($id){
        try {
            AkunPremiumNew::find($id)->delete();
            return redirect()->route("akun-premium")->with("failed", "Permintaan akun premium ditolak");
        } catch(\Throwable $e){
            return redirect()->back()->withError($e->getMessage());
        } catch(\Illuminate\Database\QueryException $e){
            return redirect()->back()->withError($e->getMessage());
        }

    }
}
