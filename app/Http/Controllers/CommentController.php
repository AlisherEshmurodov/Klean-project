<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function store(Request $request)
    {
        $comment = Comment::create([
           'post_id' => $request->post_id,
           'user_id' => auth()->user()->id,
           'body' => $request->comment,
        ]);

        $comment->save();

        return redirect()->back();
    }
}
