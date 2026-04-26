<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\StorePostRequest;
use App\Http\Resources\PostResource;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = request()->user();
        $posts = $user->posts()->paginate();
        return PostResource::collection($posts); // ->get()
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePostRequest $request)
    {
        //$data = $request->all();
        //$data = $request->only('title', 'body');
        $data = $request->validated();
        $data['author_id'] = $request->user()->id;

        $post = Post::create($data);
        return 
        response()->json(new PostResource($post), 201) // $post
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

        //$user = request()->user(); 
        /*
        if($user->id != $post->author_id) {
            abort(403, 'Access Forbidden - You are not authorized');
        } */

        abort_if(Auth::id() != $post->author_id, 403, 'Access Forbidden - You are not authorized');
        return response()->json(new PostResource($post), 201);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Post $post) // string $id
    {
        abort_if(Auth::id() != $post->author_id, 403, 'Access Forbidden - You are not authorized');

        $data = $request->validate([
            'title' => 'required|string|min:2',
            'body' => 'required|string|min:2'
        ]);

        $post->update($data);

        return new PostResource($post);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post) //string $id
    {
        abort_if(Auth::id() != $post->author_id, 403, 'Access Forbidden - You are not authorized');
        
        $post->delete();
        return response()->noContent();
    }
}
