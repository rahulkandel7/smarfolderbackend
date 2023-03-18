<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\NoteRequest;
use App\Models\Note;
use Illuminate\Http\Request;

class NoteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(NoteRequest $request)
    {
        $data = $request->all();

        $note = Note::create($data);

        return response()->json([
            'data' => $note,
            'message' => 'Note created successfully'
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Note $note)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(NoteRequest $request, Note $note)
    {
        $data = $request->all();

        $note->update($data);

        return response()->json([
            'data' => $note,
            'message' => 'Note updated successfully'
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Note $note)
    {
        $note->delete();

        return response()->json([
            'message' => 'Note deleted successfully'
        ], 200);
    }

    /**
     * Display a listing of the resource.
     */
    public function getNotesByAsset($asset_id)
    {
        $notes = Note::where('asset_id', $asset_id)->get();

        return response()->json([
            'data' => $notes,
        ], 200);
    }
}
