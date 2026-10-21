<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\BookAuthor;
use Illuminate\Http\Request;

class BookAuthorController extends Controller
{
    public function index()
    {
        return response()->json(BookAuthor::all());
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'BookID' => 'required|exists:tblBook,BookID',
            'AuthorID' => 'required|exists:tblAuthor,AuthorID',
            'AuthorDate' => 'nullable|date',
            'Remark' => 'nullable|string',
        ]);
        return response()->json(BookAuthor::create($data), 201);
    }

    public function show($bookId, $authorId)
    {
        return response()->json(
            BookAuthor::where('BookID', $bookId)->where('AuthorID', $authorId)->firstOrFail()
        );
    }

    public function update(Request $request, $bookId, $authorId)
    {
        $q = BookAuthor::where('BookID', $bookId)->where('AuthorID', $authorId);
        $q->firstOrFail();
        $q->update($request->only(['AuthorDate', 'Remark']));
        return response()->json($q->first());
    }

    public function destroy($bookId, $authorId)
    {
        BookAuthor::where('BookID', $bookId)->where('AuthorID', $authorId)->delete();
        return response()->json(['message' => 'Deleted successfully']);
    }
}
