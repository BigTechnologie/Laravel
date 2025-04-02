<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostFormRequest;
use App\Models\Post;
use Illuminate\Http\Request;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $posts = Post::orderBy("created_at","desc")->paginate(8);
        
        return view("posts.index", ["posts"=> $posts]);
    }

   
    public function view($id) 
    {
      
        $post = Post::findOrFail($id); 
        return view("posts.view", ["post"=> $post]); 
    }

     /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        return view("posts.create", ["categories"=> $categories]);
    }

      /**
     * Store a newly created resource in storage.
     */
    public function store(PostFormRequest $request)  
    {
        //
        $data = $request->validated();

        Post::create($this->filterData($data)); 

        return redirect()->route("admin.post.index")->with("success","Post has been saved !");
    } 

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    protected function filterData($data, Post $post = null)
    {
        // dd($data);
        if(isset($data["imageUrl"])) {
            if($post && !Str::startsWith($post->imageUrl, 'http')){
                Storage::disk('public')->delete($post->imageUrl); 
            }
            $imageUrl = $data["imageUrl"]->store('public/images/posts');
            $imageUrl = Str::after($imageUrl, 'public/');
            $data['imageUrl'] =  $imageUrl;
        }

        return $data;
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $post = Post::findOrFail($id);
        $categories = Category::all();
        return view("posts.create", ["categories" => $categories, 'post' => $post]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PostFormRequest $request, string $id)
    {
        $data = $request->validated();

        $post = Post::findOrFail($id);

        $post->update($this->filterData($data, $post));

        return redirect()->route("admin.post.index")->with("success", "Post has been updated !"); 
        
    }

    public function delete(string $id)
    {
        $post = Post::findOrFail($id);
        if(Storage::disk('public')->exists($post->imageUrl)) {
            Storage::disk('public')->delete($post->imageUrl);
        }

        $post->delete();

        return response()->json([
            'isSuccess' => true,
            'message' => 'Le post a bien été supprimé !'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
