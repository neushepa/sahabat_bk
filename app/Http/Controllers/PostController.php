<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Category;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data= [
            'title' => 'List Artikel',
            'post'  => Post::get(),
            'route' => route('post.create'),
        ];
        return view('admin.post.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = [
            'title' => 'New Article',
            'method' => 'POST',
            'categories' => category::All(),
            'route' => route('post.store'),
        ];
        return view('admin.post.editor',$data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $post = new Post;
        $user_id = auth()->user()->id;

        $post->user_id = $user_id;
        $post->title = $request->title;
        $post->slug = $request->slug;
        $post->category_id = $request->category;
        $post->excerpt = $request->excerpt;
        $post->body = $request->body;
        $post->save();
        return redirect()->route('post.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = [
            'title' => 'Edit Article',
            'method' => 'PUT',
            'route' => route('post.update',$id),
            'post'=>Post::where('id',$id)->first(),
            'categories'=> Category::get(),
        ];
        return view('admin.post.editor',$data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $post= Post::find($id);
        $user_id = auth()->user()->id;

        $post->user_id = $user_id;
        $post->title = $request->title;
        $post->slug = $request->slug;
        $post->category_id = $request->category;
        $post->expert = $request->expert;
        $post->body = $request->body;
        $post->update();
        return redirect()->route('post.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $destroy = Post::where('id', $id);
        $destroy->delete();
        return redirect(route("post.index"));
    }

}
