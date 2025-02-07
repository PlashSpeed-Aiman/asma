<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Asset;
use App\Models\AssetLoan;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class AssetLendingController extends Controller
{
    public function index()
    {
        $assets = Asset::where('status', 'available')->get();
        return view('greeting',['assets' => $assets]);
    }

    /**
     * Handle a request to create a new asset loan.
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function create(Request $request)
    {
        $assetLoan = AssetLoan::create([
            'asset_id' => $request->asset_id,
            'name' => $request->borrower_name,
            'telephone_number' => $request->telephone_number,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
        ]);

        $asset = Asset::find($assetLoan->asset_id);
        $asset->status = 'in_use';
        $asset->save();
        // Process the form data
        $assetLoan->save();

        // Redirect to the form page with a success message
        return redirect()->back()->with('success', 'Form submitted successfully');
    }

    /**
     * @return View|Factory|Application
     */
    public function list(Request $request): \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory|\Illuminate\Foundation\Application
    {
        $perPage = $request->query('per_page', 10); // Default to 10 items per page
        $assets = AssetLoan::with('asset')->paginate($perPage);
        $totalPage = $assets->lastPage();
        return view('assetlist',['assets' => $assets,'totalPage'=> $totalPage]);
    }


}
