<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Asset;
use App\Models\AssetLoan;
use Illuminate\Http\Request;


class AssetManagementController extends Controller
{
    public function index(){

        $assets = Asset::all();
        $totalAssets = $assets->count();
        $inUseAssets = AssetLoan::where('status', 'approved')->count();

        return view('asset-management-main', ['assets' => $assets, 'totalAssets' => $totalAssets, 'inUseAssets' => $inUseAssets]);
    }

    public function create(Request $request){

    }
}
