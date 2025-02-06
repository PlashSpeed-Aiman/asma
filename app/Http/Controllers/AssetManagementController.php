<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;


class AssetManagementController extends Controller
{
    public function index(){
        return view('asset-management.index');
    }

    public function create(Request $request){

    }
}
