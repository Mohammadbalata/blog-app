<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\Category;
use App\Models\Tag;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;



class ArticlesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $userType = Auth::user()->is_admin;
        if($userType == 1){
            $articles = Article::with(['user', 'category'])->paginate();
        }else{
            $articles = auth()->user()->articles()->with(['user', 'category'])->paginate();
        }

        return view('dashboard.articles.index', compact('articles'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        $article = new Article();
        $tags = Tag::all()->pluck('name')->toArray();
        return view('dashboard.articles.create', compact('categories', 'article', 'tags'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate(Article::rules());
        
        $data = $request->except(['image', 'tags']);

        $data['image'] = Article::uploadImage($request);

        $article = auth()->user()->articles()->create($data);

        $tags = json_decode($request->post('tags'));
        $saved_tags = Tag::all();
        $tag_ids = [];
        foreach ($tags as $item) {
            $tag = $saved_tags->where('name', $item->value)->first();
            if ($tag) {
                $tag_ids[] = $tag->id;
            }
        }

        
        $article->tags()->sync($tag_ids);

        return Redirect::route('dashboard.articles.index')
            ->with('success', 'Successfully created');
    }
    

    /**
     * Display the specified resource.
     */
    public function show(Article $article)
    {
        
        return view('show', compact('article', ));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        try {
            if(Auth::user()->is_admin == 1){
                $article = Article::findOrFail($id);
            }else{
            $article = auth()->user()->articles()->findOrFail($id);

            }
        } catch (Exception $e) {
            return Redirect::route('dashboard.articles.index')
                ->with('info', 'not found');
        }
        $tags = Tag::all()->pluck('name')->toArray();
        $choosenTags = implode(' ,',$article->tags()->pluck('name')->toArray());
        

        $categories = Category::where('id', '<>', $article->category_id)
            ->get();

        return view('dashboard.articles.edit', compact('categories', 'article', 'tags','choosenTags'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate(Article::rules());

        $article = Article::findOrFail($id);
        $old_image = $article->image;
        $data = $request->except(['image', 'tags']);

        $new_image = Article::uploadImage($request);
        if ($new_image) {
            $data['image'] = $new_image;
        }
        $article->update($data);

        if ($old_image && $new_image) {
            Storage::disk('public')->delete($old_image);
        }

        
        $tags = json_decode($request->post('tags'));
        $saved_tags = Tag::all();
        $tag_ids = [];
        foreach ($tags as $item) {
            $tag = $saved_tags->where('name', $item->value)->first();
            if ($tag) {
                $tag_ids[] = $tag->id;
            }
        }

        $article->tags()->sync($tag_ids);

        return Redirect::route('dashboard.articles.index')
            ->with('success', 'Successfully updated ');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        if(Auth::user()->is_admin == 1){
            $article = Article::findOrFail($id);

        }else{
            $article = auth()->user()->articles()->findOrFail($id);
        }
        
        $old_image = $article->image;
        $article->delete();
        if ($old_image) {
            Storage::disk('public')->delete($old_image);
        }
        return response()->json([
            'success' => 'Article deleted successfully!'
        ]);

        // return Redirect::route('dashboard.articles.index')
        //     ->with('success', 'deleted successfully');
    }

}
