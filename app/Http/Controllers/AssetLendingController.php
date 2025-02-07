<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Asset;
use App\Models\AssetLoan;
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
        $asset = AssetLoan::create([
            'asset_id' => $request->asset_id,
            'name' => $request->borrower_name,
            'telephone_number' => $request->telephone_number,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
        ]);
        // Process the form data
        $asset->save();

        // Redirect to the form page with a success message
        return redirect()->back()->with('success', 'Form submitted successfully');
    }


}
