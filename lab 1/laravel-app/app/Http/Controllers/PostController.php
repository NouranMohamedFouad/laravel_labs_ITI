<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index() 
    {
        $posts = [
            ['id' => 1 , 'title' => 'First Post', 'posted_by' => 'Ahmed', 'created_at' => '2025-11-10 10:00:00'],
            ['id' => 2 , 'title' => 'Second Post','posted_by' => 'Rahma', 'created_at' => '2025-12-10 10:00:00'],
            ['id' =>3 , 'title' => 'Third Post','posted_by' => 'Mohamed', 'created_at' => '2025-13-10 10:00:00'],
        ];

        return view('posts.index', ['posts' => $posts]);
    }

    public function show()
    {
        $post = [
            'title' => 'Greeting Post',
            'description' => 'a new post',
            'user' => [
                'name' => 'Nouran',
                'email' => 'Nouran@gmail.com',
                'created_at' => '2024-10-01 10:00:00'
            ]
        ];

        return view('posts.show',[
            'post' => $post,
        ]);
    }

    public function create()
    {
        return view('posts.create');
    }

    public function store(Request $request)
    {
        dd($request->all());
        return to_route('posts.index');
    }


    public function edit($id)
    {
        $post = [
            'id' => $id,
            'title' => 'Sample Post Title',
            'description' => 'Sample Post Description',
            'posted_by' => 'Noran'
        ];

        return view('posts.edit', ['post' => $post]);
    }

    public function update(Request $request, $id)
    {
        dd('Updated Post', $id, $request->all());
        return to_route('posts.index');
    }

    public function destroy($id)
    {
        dd("Deleted Post with ID: $id");
        return to_route('posts.index');
    }

}
