<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\PostResource;
use App\Models\Post;
use Illuminate\Http\Request;

class PostApiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
//        return Post::all();
        return PostResource::collection(Post::all());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if ($request->hasFile('photo')) {

            $name = $request->file('photo')->getClientOriginalName();
            $path = $request->file('photo')->storeAs('post-photos', $name);
        }

        $post = Post::create([
//            'user_id' => auth()->user()->id,
            'user_id' => 1 ,
            'category_id' => $request->category_id,
            'title' => $request->title,
            'short_content' => $request->short_content,
            'contents' => $request->contents,
            'photo' => $path ?? null,
        ]);

        if (isset($request->tags)) {
            foreach ($request->tags as $tag){
                $post->tags()->attach($tag);
            }
        }

        return response(['success' => 'Post Successfully created']);
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
//        return $post;
        return new PostResource($post);
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
