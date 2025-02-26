<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePostRequest;
use App\Models\Category;
use App\Models\Post;
use App\Models\Region;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $posts = Post::latest()->simplePaginate(6);
        return view('admin.post.index')->with([
            'posts'=>$posts,
            'categories'=>Category::all(),
            'regions'=>Region::all(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.post.create')->with([
            'categories'=>Category::all(),
            'regions'=>Region::all(),
            'tags'=>Tag::all()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePostRequest $request)
    {
        // dd($request);
        if ($request->hasFile('image')) {
            $name = $request->file('image')->getClientOriginalName();
            $path = $request->file('image')->storeAs('post-images', $name);
        }
        $post = Post::create([
            'user_id'=>auth()->user()->id,
            'title'=>$request->title,
            'content'=>$request->content,
            'region_id'=>$request->region_id,
            'category_id'=>$request->category_id,
            'price'=>$request->price,
            'image'=>$path ?? null
        ]);

        if(isset($request->tags)){
            foreach($request->tags as $tag){
                $post->tags()->attach($tag);
            }
        }
        return redirect()->route('posts.index');
         
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        // $redisKey = "post:{$post->id}:views";
        // Redis::incr($redisKey);
        $post->increment('view_count');
        return view('admin.post.show')->with(['post'=>$post]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {
        return view('admin.post.edit')->with(['post'=>$post]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Post $post)
    {
        if ($request->hasFile('image')) {
            if (isset($product->image)) {
                Storage::delete($product->image);
            }
            $name = $request->file('image')->getClientOriginalName();
            $path = $request->file('image')->storeAs('product-images', $name);
        }
        $post->update([
            'title'=>$request->title,
            'content'=>$request->content,
            'region_id'=>$request->region_id,
            'category_id'=>$request->category_id,
            'price'=>$request->price,
            'image'=>$path ?? null
        ]);
        return redirect()->route('posts.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        if ($post->photo) {
            Storage::delete($post->photo);
        }
        $post->delete();
        return redirect()->route('admin.post.index');
    }
    public function filter(){
        
    }
}
