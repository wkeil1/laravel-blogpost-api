<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BlogPost;

class BlogPostController extends Controller
{
    public function index()
    {
      return BlogPost::all();
    }

    public function fetchPublishedPosts(Request $request)
    {
      $validatedData = $request->validate([
        'status' => 'required|in:Approval,Approved,Rejected'
      ]);

      $status = $validatedData['status'];

      $blogPostQuery = BlogPost::with(['author' => function($query) {
        $query->select('id', 'name'); 
      }])
        ->where('is_published', true)
        ->where('status', $status);

      dd($blogPostQuery->toSql(), $blogPostQuery->getBindings());

      $blogPosts = $blogPostQuery->get();

      return response()->json($blogPosts);
    }

    public function store(Request $request)
    {
      $validatedData = $request->validate([
        'title' => 'required|max:255',
        'content' => 'required',
        'isPublished' => 'boolean',
        'status' => 'required|in:Pending Approval,Approved,Rejected',
        'author_id' => 'required|exists:authors,id'
      ]);

      $blogPost = BlogPost::create($validatedData);
      return response()->json($blogPost, 201);
    }

    public function show(string $id)
    {
      $blogPost = BlogPost::find($id);

      if (!$blogPost) {
        return response()->json([
          'message' => 'Blog Post not found'
        ], 404);
      }

      return $blogPost;
    }

    public function update(Request $request, string $id)
    {
      $blogPost = BlogPost::find($id);

      if (!$blogPost) {
        return response()->json(['message' => 'BlogPost not found'], 404);
      }

      $validatedData = $request->validate([
        'title' => 'sometimes|max:255',      // 'sometimes' means the field is not always required
        'content' => 'sometimes',
        'is_published' => 'sometimes|boolean',
        'status' => 'sometimes|in:Pending Approval,Approved,Rejected',
        'author_id' => 'sometimes|exists:authors,id' // Ensure the author exists if provided
      ]);

      $blogPost->update($validatedData);

      return response()->json($blogPost);
    }

    public function destroy(string $id)
    {
      $blogPost = BlogPost::find($id);

      if (!$blogPost) {
        return response()->json(['message' => 'BlogPost not found'], 404);
      }

      $blogPost->delete();

      return response()->json(['message' => 'BlogPost deleted'], 204);
    }
}
