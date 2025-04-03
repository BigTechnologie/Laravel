<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginFormRequest;
use App\Http\Requests\UserFormRequest;
use App\Models\Post;
use App\Models\Category;
use EsperoSoft\Faker\Faker;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class BlogController extends Controller
{


    public function index() {
        /*
        $user = User::find(Auth::user()->id);
        $user->roles = json_encode(["ROLE_ADMIN", "ROLE_USER"]);
        $user->save();
        */
        $title = "Welcome to Blog";
        $description = "<h3>Welcome to Blog description</h3>";
        
        $faker = new Faker();

        if(Category::count() === 0) {
            for ($i = 0; $i < 10; $i++) {
                Category::create([
                    "name"=> $faker->title(25),
                    "description" => $faker->title(60),
                    "imageUrl" => $faker->image(),
                ]);
    
            }
        }
      
      if(Post::count() === 0) {
        for ($i = 0; $i < 280; $i++) {
            $title = $faker->title(30);
            Post::create([
                "title"=> $title,
                "slug" => Str::slug($title),
                "description" => $faker->title(60),
                "content" => $faker->text(),
                "imageUrl" => $faker->image(),
                "category_id" => rand(1,10)
            ]);

        }
      }
        
        $posts = Post::paginate(24);

        return view('blog.home',['title'=> $title,'description'=> $description, 'posts'=> $posts]);
    }

  
    public function show(string $slug, $id) {

        $post = Post::find($id);

        if($post->slug !== $slug) {
            return to_route('post.show', ['slug'=>$post->slug,'id'=> $post->id]);
        }


        return view('blog.show', ['post'=>$post]);
    }

    public function categories() {
        $categories = Category::paginate(4);

        return view('blog.categories', ["categories" => $categories]);
    }

    public function showCategory($id) 
    {
        $category = Category::findOrFail($id);
        $posts = $category->posts()->paginate(8);

        return view('blog.showCategory', ["category" => $category, "posts" => $posts]);
    }

    public function register()
    {
        return view("blog.register");
    }

    public function registerSave(UserFormRequest $request)
    {
        $data = $request->validated();
       

        $data["password"] = bcrypt($data["password"]);
        //dd($data);
        $user = User::create($data);

        return redirect()->route('login')->with("success", "Enregistrement avec succès !");
    }

    public function authenticate(LoginFormRequest $request)
    {
        $user = $request->validated();
        //dd($user);

        if(Auth::attempt($user)) {
            return redirect()->route("welcome")->with("success", "Vous ête connecté !");
        }else {
            return redirect()->route("login")->with("error", "identifiant incorrect !");
        }
    }

    public function login()
    {
        return view("blog.login");
    }

    public function logout()
    {
        Auth::logout();

        return redirect()->route("welcome")->with("success", "Vous êtes déconnecté !");
    }
    
}
