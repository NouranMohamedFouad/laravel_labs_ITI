<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Comment;
use App\Models\Post;

class CommentController extends Controller
{
    public function store(Request $request, Post $post)
    {
        $post->comments()->create([
            'body' => $request->comment
        ]);
        return to_route('posts.show', ['post' => $post->id]);


    }

    public function edit(Comment $comment)
    {
        return view('comments.edit', compact('comment'));
    }

    public function update(Request $request, Comment $comment)
    {
        $comment->update([
            'body' => $request->comment
        ]);

        return to_route('posts.show', ['post' => $comment->commentable_id]);
    }



    public function destroy(Comment $comment)
    {
        $postId = $comment->commentable_id;
        $comment->delete();
        return to_route('posts.show', ['post' => $postId]);
    } 
}