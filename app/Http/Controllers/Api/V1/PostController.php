<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Post::all();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //$data = $request->all();
        //$data = $request->only('title', 'body');
        $data = $request->validate([
            'title' => 'required|string|min:2',
            'body' => 'required|string|min:2'
        ]);
        $data['author_id'] = 1;

        $post = Post::create($data);
        return 
        response()->json($post, 201)
        //->setStatusCode(201)
        ; 
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post) // string $id
    {
        /*
        return response()->json([
            'id' => 1,
            'title' => 'Test',
            'body' => 'Body'
        ])
        ->header('Test', 'Bojan')
        ->setStatusCode(201)
        ; */

        //$post = Post::findOrFail($id);

        return response()->json($post, 201);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Post $post) // string $id
    {
        $data = $request->validate([
            'title' => 'required|string|min:2',
            'body' => 'required|string|min:2'
        ]);

        $post->update($data);

        return $post;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post) //string $id
    {
        $post->delete();
        return response()->noContent();
    }
}
