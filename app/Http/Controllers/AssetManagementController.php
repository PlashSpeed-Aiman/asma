<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Asset;
use App\Models\AssetLoan;
use App\Services\ICsvService;
use Illuminate\Http\Request;


class AssetManagementController extends Controller
{
    private ICsvService $icsv;
    public function __construct(ICsvService $icsv){
        $this->icsv = $icsv;
    }

    public function index(){

        $assets = Asset::all();
        $totalAssets = $assets->count();
        $inUseAssets = AssetLoan::where('status', 'approved')->count();
        $recentAssets = Asset::where('created_at', '>=', now()->subDays(7))->orderBy('created_at', 'desc')->get();
        return view('asset-management-main', ['assets' => $assets, 'totalAssets' => $totalAssets, 'inUseAssets' => $inUseAssets, 'recentAssets' => $recentAssets]);
    }

    public function list(): \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory|\Illuminate\Foundation\Application
    {
        $assets = Asset::all();
        return view('asset-management-list', ['assets' => $assets]);
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
        $asset->status = $request->status;
        $asset->save();

        return redirect()->back()->with('success', 'Asset submitted successfully');
    }

    public function delete($id){
        $asset = Asset::find($id);
        $asset->delete();
        return response()->noContent();
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

    public function import(Request $request){
        $file = $request->file('file');
        $fileContents = file($file->getPathname());

        $result = $this->icsv->parseToArray($fileContents);

        foreach($result as $asset){
            $asset->save();
        }

        return redirect()->back()->with('success', 'File uploaded successfully');
    }

    public function export(){

    }
}
