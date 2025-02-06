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
        $assets = Asset::all();
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
        $validated = $request->validate([
            // Add validation rules here
        ]);

        // Process the form data
        AssetLoan::create($validated);

        return redirect()->back()->with('success', 'Form submitted successfully');
    }


}
