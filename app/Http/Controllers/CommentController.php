<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class CommentController extends Controller
{

    public function store(Request $request)
    {
        $request->validate(['text' => 'required']);

        $comment = new Comment;
        $comment->user_id = auth()->user()->id;
        $comment->post_id = $request->input('post_id');
        $comment->text = $request->input('text');
        $comment->save();
    }


    public function update(Request $request, Comment $comment)
    {
        //
    }

    public function destroy(int $id)
    {
        $comment = Comment::find($id);
        $comment->delete();
    }
}
