<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class CategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::paginate();
        return view('dashboard.categories.index',compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $category = new Category();
        return view('dashboard.categories.create', compact('category'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate(['name' => 'required|string']);
        $category = Category::create([
            'name' => $request->name
        ]);
        return Redirect::route('dashboard.categories.index')->with('success', 'category added');
        
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        try {
            $category = Category::findOrFail($id);
        } catch (Exception $e) {
            return Redirect::route('dashboard.categories.index')
                ->with('info', 'record not found');
        }

        return view('dashboard.categories.edit', compact('category'));

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate(['name' => 'required|string']);
        try {
            $category = Category::findOrFail($id);
        } catch (Exception $e) {
            return Redirect::route('dashboard.categories.index')
                ->with('info', 'record not found');
        }
        $category = Category::create([
            'name' => $request->name
        ]);
        return Redirect::route('dashboard.categories.index')->with('success', 'category updated');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $category = Category::findOrFail($id);
        $category->delete();
        return response()->json([
            'success' => 'category deleted successfully'
        ]);
        // return Redirect::route('dashboard.categories.index')
        //     ->with('success', 'category deleted successfully');
    }
}
