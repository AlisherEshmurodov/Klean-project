<?php

namespace App\Http\Controllers;

use App\Events\PostCreated;
use App\Http\Requests\StorePostRequest;
use App\Jobs\UploadBigFile;
use App\Models\Category;
use App\Models\Post;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Session\Store;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth')->except(['index', 'show']);
//        $this->authorizeResource(Post::class, 'post');
    }

    public function index()
    {


//        $post = Post::where('id', 3);
//        $post->delete();

//        Post::destroy(4);

//        $posts = DB::table('posts')->where('id', 2)->first();
//        $posts = DB::table('posts')->find(2);
//        $posts = DB::table('posts')->get()->chunk(4);
//        foreach ($posts as $item){
//            echo $item;
//            echo '<br>';
//        }
//        dd($posts);

//        Cache::pull('posts');

        $posts = Post::latest()->paginate(9);
//        $posts = Post::latest()->get();
//        Cache::flush();
//        $posts = Cache::remember('posts', 120, function () {
//            return Post::latest()->get();
////            $posts = Cache::get('posts');
//        });
        return view('posts.index')->with(['posts'=> $posts]);
    }


    public function create()
    {
        return view("posts.create")->with([
            'categories' => Category::all(),
            'tags' => Tag::all(),
        ]);
    }


    public function store(StorePostRequest $request)
    {

        if ($request->hasFile('photo')) {

            $name = $request->file('photo')->getClientOriginalName();
            $path = $request->file('photo')->storeAs('post-photos', $name);
        }

        $post = Post::create([
            'title' => $request->title,
            'user_id' => auth()->user()->id,
            'category_id' => $request->category_id,
            'short_content' => $request->short_content,
            'contents' => $request->contents,
            'photo' => $path ?? null,
        ]);


        if (isset($request->tags)) {
            foreach ($request->tags as $tag){
                $post->tags()->attach($tag);
            }
        }

        PostCreated::dispatch($post);

        auth()->user()->notify(new \App\Notifications\PostCreated($post));

//        $file = $request->file('photo');
//        UploadBigFile::dispatch($file);


        return redirect()->route('posts.index');
    }


    public function show(Post $post)
    {
//        $post = DB::table('posts')->find($id);
        return view('posts.show')->with([
            'post' => $post,
            'recent_posts' => Post::latest()->get()->except($post->id)->take(5), // post tableni oxirgi 5 ta qatorini ob keliw
            'tags' => Tag::all(),
            'categories' => Category::all(),
        ]);
    }


    public function edit(Post $post)
    {
//        if (! Gate::allows('update-post', $post)) {
//            abort(403);
//        }

//        Gate::authorize('update', $post);

        $this->authorize('update', $post);



        return view('posts.edit')->with([
            'post' => $post,
            'categories' => Category::all(),
            'tags' => Tag::all(),
        ]);
    }


    public function update(StorePostRequest $request, Post $post)
    {
        $this->authorize('update', $post);

        if ($request->hasFile('photo')) {
            if (isset($post->photo)) {
                Storage::delete($post->photo);
            }

            $name = $request->file('photo')->getClientOriginalName();
            $path = $request->file('photo')->storeAs('post-photos', $name);
        }

        $post->update([
            'title' => $request->title,
            'user_id' => auth()->user()->id,
            'category_id' => $request->category_id,
            'short_content' => $request->short_content,
            'contents' => $request->contents,
            'photo' => $path ?? $post->photo
        ]);

        if (isset($request->tags)) {
            foreach ($request->tags as $tag){
                $post->tags()->attach($tag);
            }
        }

        return redirect()->route('posts.show', ['post' => $post->id]);

    }


    public function destroy(Post $post)
    {
        if (isset($post->photo)) {
            Storage::delete($post->photo);
        }

        $post->delete();
        return redirect()->route('posts.index');

    }
}


