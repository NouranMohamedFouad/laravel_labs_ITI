<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;
use Illuminate\Support\Facades\Storage;

use App\Jobs\PruneOldPostsJob;


use App\Models\Post;
use App\Models\User;

class PostController extends Controller
{

    public function index() 
    {
        $posts = Post::with('user')->withTrashed()->paginate(10);
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

   
    public function store(StorePostRequest $request)
    {

        $title = request()->title;
        $description = request()->description;
        $postCreator = request()->post_creator;
    
        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('posts', 'public');
        }

        Post::create([
            'title' => $title,
            'description' => $description,
            'user_id' => $postCreator,
            'image' => $imagePath
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
    public function update(UpdatePostRequest $request, $id)
    {
        $post = Post::find($id);

        $data = $request->validated();
    
        if ($request->hasFile('image')) {

            if ($post->image) {
                Storage::disk('public')->delete($post->image);
            }
            $data['image'] = $request->file('image')->store('posts', 'public');
        }

        $post->update([
            'title' => $request->title,
            'description' => $request->description,
            'user_id' => $request->post_creator,
            'image' => $data['image'] ?? $post->image
        ]);

        return to_route('posts.index');
    }

    public function destroy($id)
    {
        $post = Post::find($id);
        $post->comments()->delete();
        $post->delete();
        return to_route('posts.index');
    }

    public function prune()
    {
        PruneOldPostsJob::dispatch();
        return 'Old posts pruning job dispatched!';
    }

    public function restore($id)
    {
        $post = Post::withTrashed()->find($id);
        
        if ($post) {
            $post->restore();
            return to_route('posts.index');
        }
        return to_route('posts.index');
    }
    
}
