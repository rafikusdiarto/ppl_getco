<?php

namespace App\Http\Controllers;

use App\Models\AkunPremiumNew;
use Illuminate\Http\Request;

class PremiumController extends Controller
{
    public function index(){
        return view('pages.syarat-akun-premium.index');
    }
    public function store(){
        AkunPremiumNew::create([
            'user_id' => auth()->user()->id,
            'status' => false
        ]);
        return redirect()->back();
    }
}
