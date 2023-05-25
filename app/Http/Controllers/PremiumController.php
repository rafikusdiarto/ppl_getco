<?php

namespace App\Http\Controllers;

use App\Models\AkunPremiumNew;
use App\Models\SyaratPremiumAkun;
use Illuminate\Http\Request;

class PremiumController extends Controller
{
    public function index(){
        $syarat = SyaratPremiumAkun::first();
        return view('pages.syarat-akun-premium.index', [
            'syarat' =>$syarat
        ]);
    }
    public function store(){
        AkunPremiumNew::create([
            'user_id' => auth()->user()->id,
            'status' => false
        ]);
        return redirect()->back();
    }
}
