<?php

namespace App\Http\Controllers\Dashboard;


use App\Http\Controllers\Controller;
use App\Models\Tag;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;



class TagsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tags = Tag::paginate();
        return view('dashboard.tags.index',compact('tags'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $tag = new Tag();
        return view('dashboard.tags.create', compact('tag'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate(['name' => 'required|string']);
        $tag = Tag::create([
            'name' => $request->name
        ]);
        return Redirect::route('dashboard.tags.index')->with('success', 'Tag added');
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
            $tag = Tag::findOrFail($id);
        } catch (Exception $e) {
            return Redirect::route('dashboard.tags.index')
                ->with('info', 'record not found');
        }

        return view('dashboard.tags.edit', compact('tag'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate(['name' => 'required|string']);
        try {
            $tag = Tag::findOrFail($id);
        } catch (Exception $e) {
            return Redirect::route('dashboard.tags.index')
                ->with('info', 'record not found');
        }
        $tag = Tag::create([
            'name' => $request->name
        ]);
        return Redirect::route('dashboard.tags.index')->with('success', 'Tag updated');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $Tag = Tag::findOrFail($id);
        $Tag->delete();
        return response()->json([
            'success' => 'Tag deleted successfully!'
        ]);
        // return Redirect::route('dashboard.tags.index')
        //     ->with('success', 'Tag deleted successfully');
    }
}
