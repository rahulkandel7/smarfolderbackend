<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\AssetRequest;
use App\Models\Asset;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class AssetController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $assets = Asset::where('user_id', auth()->id())->get();
        return response()->json([
            'data' => $assets,
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(AssetRequest $request)
    {
        $data = $request->all();
        $data['user_id'] = auth()->id();

        if ($request->has('photopath')) {
            $fname = time();
            $fexe = $request->file('photopath')->extension();
            $fpath = "$fname.$fexe";

            $request->file('photopath')->move(public_path() . '/public/assets/', $fpath);

            $data['photopath'] = 'assets/' . $fpath;
        }


        $asset = Asset::create($data);

        return response()->json([
            'data' => $asset,
            'message' => 'Asset created successfully'
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Asset $asset)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Asset $asset)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Asset $asset)
    {
        if ($asset->photopath) {
            File::delete('public/' . $asset->photopath);
        }
        $asset->delete();

        return response()->json([
            'message' => 'Assets Deleted Successfully',
            'status' => true,
        ], 200);
    }
}
