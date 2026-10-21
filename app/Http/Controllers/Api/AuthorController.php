<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Author;
use Illuminate\Http\Request;

class AuthorController extends Controller
{
    public function index() { return response()->json(Author::all()); }

    public function store(Request $request)
    {
        $data = $request->validate([
            'AuthorName' => 'required|string|max:255',
            'Gender' => 'nullable|string|max:10',
            'DOB' => 'nullable|date',
            'POB' => 'nullable|string',
            'Address' => 'nullable|string',
            'Phone' => 'nullable|string|max:30',
            'Email' => 'nullable|email',
            'Photo' => 'nullable|string',
        ]);
        return response()->json(Author::create($data), 201);
    }

    public function show($id) { return response()->json(Author::findOrFail($id)); }

    public function update(Request $request, $id)
    {
        $author = Author::findOrFail($id);
        $author->update($request->only($author->getFillable()));
        return response()->json($author);
    }

    public function destroy($id)
    {
        Author::findOrFail($id)->delete();
        return response()->json(['message' => 'Deleted successfully']);
    }
}
