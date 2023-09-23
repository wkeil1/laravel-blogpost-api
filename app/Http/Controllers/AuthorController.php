<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Author;

class AuthorController extends Controller
{
    public function index()
    {
      return Author::all();
    }

    public function store(Request $request)
    {
        //
        $author = Author::create($request->all());
        return response()->json($author, 201);
    }

    public function show(string $id)
    {
      $author = Author::find($id);

      if (!$author) {
        return response()->json([
          'message' => 'Author not found'
        ], 404);
      }  
      return $author;
    }

    /**
    * @param  \Illuminate\Http\Request  $request
    * @param  string  $id
    * @return \Illuminate\Http\Response
    */
    public function update(Request $request, string $id)
    {
      $author = Author::find($id);

      if (!$author) {
        return response()->json(['message' => 'Author not found'], 404);
      }

      $author->update($request->all());

      return response()->json($author);
    }

    public function destroy(string $id)
    {
      $author = Author::find($id);

      if (!$author) {
        return response()->json(['message' => 'Author not found'], 404);
      }
      
      $author->delete();

      return response()->json(['message' => 'Author deleted']);
    }
}
