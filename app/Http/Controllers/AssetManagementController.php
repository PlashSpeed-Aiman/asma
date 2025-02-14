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

        $asset = Asset::create([
            'name' => $request->name,
            'asset_number' => $request->asset_number,
            'description' => $request->description,
            ]);

        $asset->save();
        return redirect()->back()->with('success', 'Form submitted successfully');
    }

    public function update(Request $request, $id){
        $asset = Asset::find($id);
        $asset->name = $request->name;
        $asset->asset_number = $request->asset_number;
        $asset->description = $request->description;
        $asset->save();
    }

    public function list(): \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory|\Illuminate\Foundation\Application
    {
        $assets = Asset::all();
        return view('asset-management-list', ['assets' => $assets]);
    }

    public function show($id)
    {
        $asset = Asset::findOrFail($id);
        $loanHistory = AssetLoan::where('asset_id', $id)->get();

        return view('asset-management-show', [
            'asset' => $asset,
            'loanHistory' => $loanHistory
        ]);
    }


    public function asset_modal(){
        $assets = Asset::all();
        return view('modals.asset-list-modal', ['assets' => $assets]);
    }
}
