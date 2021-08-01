<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use App\Models\Tag;
use Illuminate\Http\Request;

class PostController extends Controller
{
    /**
     * Instantiate a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth')->except(['index', 'show']);
        // $this->middleware('can:update,post')->only(['edit', 'update']);
        // $this->middleware('can:delete,post')->only(['destroy']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $postsQuery = Post::with(['user', 'category'])->latest();
        if ($request->query('category')) $postsQuery->where('category_id', (int)$request->query('category'));
        if ($request->query('user')) $postsQuery->where('user_id', (int)$request->query('user'));
        $posts = $postsQuery->paginate(2)->withQueryString();
        return view('post.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        return view('post.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'category_id' => 'required|exists:categories,id',
            'title' => 'required|min:3',
            'content' => 'required',
            'tags' => 'nullable|string'
        ]);

        $post = new Post;
        $post->user_id = $request->user()->id;
        $post->category_id = $request->category_id;
        $post->title = $request->title;
        $post->content = $request->content;
        $post->save();

        //  etiketleri ekleyeceğiz
        //  etiketler tags halinde tek bir string olarak geliyor
        //  aralarında virgül var
        //  virgül haricinde aralarında boşluk olabilir
        //  öncelikle metni virgülden parçalayacağız
        //  her bir eleman için:
        //      virgüllerle ayrılan her bir parçanın başındaki ve sonundaki boşlukları temizleyeceğiz
        //      bu isimde bir etiket varsa seçilmesini, yoksa yaratılmasını sağlayacağız
        //      bu sayede artık bildiğimiz Tag'idsini yeni yarattığımız Post'a attach ile bağlayacağız

        if ($request->tags) {
            $tagsToAttach = array_unique(array_map('trim', explode(",", $request->tags)));
            foreach ($tagsToAttach as $tagName) {
                $tag = Tag::firstOrCreate([
                    'name' => $tagName
                ]);
                $post->tags()->attach($tag->id);
            }
        }

        session()->flash('status', __('Post created!'));

        return redirect()->route('posts.show', $post);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show($post)
    {
        $post = Post::with(['category', 'user', 'tags'])->findOrFail($post);
        return view('post.show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        $categories = Category::all();
        return view('post.edit', compact('post', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        $request->validate([
            'category_id' => 'required|exists:categories,id',
            'title' => 'required',
            'content' => 'required'
        ]);

        $post->user_id = $request->user()->id;
        $post->category_id = $request->category_id;
        $post->title = $request->title;
        $post->content = $request->content;
        $post->save();

        session()->flash('status', __('Post updated!'));

        return redirect()->route('posts.show', $post);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        $post->delete();

        session()->flash('status', __('Post deleted!'));

        return redirect()->route('posts.index');
    }
}