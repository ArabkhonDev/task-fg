<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePostRequest;
use App\Models\Category;
use App\Models\Post;
use App\Models\Region;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{

    public function index(Request $request)
    {
        $query = Post::query();
        $search = $request->search;
        $region_id = $request->region_id;
        $category_id = $request->category_id;
        $min_price = $request->min_price;
        $max_price = $request->max_price;

        if ($request->filled('category_id')) {
            $query->where('category_id', $category_id);
        }
        if ($request->filled('search')) {
            $query->where('title', $search);
        }
        if ($request->filled('search')) {
            $query->where('content', $search);
        }
        if ($request->filled('region_id')) {
            $query->where('region_id', $region_id);
        }
        if ($request->filled('min_price')) {
            $query->where('price', '>=', $min_price);
        }
        if ($request->filled('max_price')) {
            $query->where('price', '<=', $max_price);
        }

        if ($query->get()) {
            $posts = $query->get();
            $count = 0;
            foreach ($posts as $post) {
                $count++; // Qo‘lda sanash
            }
        } else {
            $posts = Post::latest()->simplePaginate(6);
        }

        return view('admin.post.index')->with([
            'posts' => $posts,
            'count' => $count,
            'categories' => Category::all(),
            'regions' => Region::all(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.post.create')->with([
            'categories' => Category::all(),
            'regions' => Region::all(),
            'tags' => Tag::all()
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
            'user_id' => auth()->user()->id,
            'title' => $request->title,
            'content' => $request->content,
            'region_id' => $request->region_id,
            'category_id' => $request->category_id,
            'price' => $request->price,
            'image' => $path ?? null
        ]);

        if (isset($request->tags)) {
            foreach ($request->tags as $tag) {
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
        if (auth()->user()->id != $post->user_id) {
            $post->increment('view_count');
        }
        return view('admin.post.show')->with([
            'post' => $post,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {
        if (auth()->user()->id == $post->user_id) {
            return view('admin.post.edit')->with([
                'post' => $post,
                'categories' => Category::all(),
                'regions' => Region::all(),
                'tags' => Tag::all()
            ]);
        }
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
            'title' => $request->title,
            'content' => $request->content,
            'region_id' => $request->region_id,
            'category_id' => $request->category_id,
            'price' => $request->price,
            'image' => $path ?? null
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
    public function filter(Request $request, $id)
    {
        dd($request);
        // $query = Post::query();

        // // Title bo‘yicha filter
        // if ($request->has('search')) {
        //     $query->where('title', 'like', '%' . $request->name . '%');
        // } else if ($request->has('search')) {
        //     $query->where('content', 'like', '%' . $request->name . '%');
        // }

        // // Natijani olish
        // $posts = $query->get();

        // // ID faqat raqam ekanligini tekshirish
        // if (!ctype_digit($id)) {
        //     return response()->json([
        //         'error' => 'Invalid ID format. It must be a number.'
        //     ], 400);
        // }

        // // Postni olish
        // $post = Post::find($id);

        // if (!$post) {
        //     return response()->json([
        //         'error' => 'Post not found.'
        //     ], 404);
        // }

        // return response()->json($post);
        // return view('admin.post.index');
    }
}
