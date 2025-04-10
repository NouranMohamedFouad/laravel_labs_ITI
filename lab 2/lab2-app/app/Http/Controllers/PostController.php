<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


use App\Models\Post;
use App\Models\User;

class PostController extends Controller
{

    public function index() 
    {
        $posts = Post::with('user')->paginate(3);
        return view('posts.index', ['posts' => $posts]);
    }

    public function show($id)
    {
        $post = Post::find($id);

        return view('posts.show', [
            'post' => $post,
        ]);
    }
    public function create()
    {
        $users = User::all();

        return view('posts.create', [
            'users' => $users,
        ]);

        return view('posts.create');
    }

   
    public function store(Request $request)
    {

        $title = request()->title;
        $description = request()->description;
        $postCreator = request()->post_creator;

        Post::create([
            'title' => $title,
            'description' => $description,
            'user_id' => $postCreator
        ]);

        return to_route('posts.index');
    }
  
    public function edit($id)
    {
        $post = Post::find($id);
        $users = User::all();

        return view('posts.edit', [
            'post' => $post,
            'users' => $users,
        ]);
    }
    public function update(Request $request, $id)
    {
        $post = Post::find($id);

        $post->update([
            'title' => $request->title,
            'description' => $request->description,
            'user_id' => $request->post_creator,
        ]);

        return to_route('posts.index');
    }

    public function destroy($id)
    {
        $post = Post::find($id);
        $post->delete();
        return to_route('posts.index');
    }

}
