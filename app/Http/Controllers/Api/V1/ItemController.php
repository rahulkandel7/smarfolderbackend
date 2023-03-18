<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\ItemRequest;
use App\Models\Item;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class ItemController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // $items = Item::where('asset_id', auth()->id())->get();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ItemRequest $request)
    {
        $data = $request->all();

        if ($request->has('photopath')) {
            $fname = time();
            $fexe = $request->file('photopath')->extension();
            $fpath = "$fname.$fexe";

            $request->file('photopath')->move(public_path() . '/public/items/', $fpath);

            $data['photopath'] = 'items/' . $fpath;
        }

        $item = Item::create($data);

        return response()->json([
            'data' => $item,
            'message' => 'Item created successfully'
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Item $item)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Item $item)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Item $item)
    {
        if ($item->photopath) {
            File::delete('public/' . $item->photopath);
        }
        $item->delete();

        return response()->json([
            'message' => 'Item Deleted Successfully',
            'status' => true,
        ], 200);
    }

    public function getItem($asset_id)
    {
        $items = Item::where('asset_id', $asset_id)->get();
        return response()->json([
            'data' => $items,
        ], 200);
    }
}
