<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class CategoryController extends Controller
{
    /**
     * Display a listing of the categories
     *
     * @param  \App\Models\Category  $model
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $categories = Category::select(['*', DB::raw('(SELECT COUNT(*) FROM words WHERE words.trivia_cart = categories.id) as words')])->get();
        return view('categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('categories.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $rq
     * @return \Illuminate\Http\Response
     */
    public function store(Request $rq)
    {
        if ($rq->hasFile('image')) {
            if ($rq->file('image')->isValid()) {
                $imagename = time();
                $extension = $rq->image->extension();
                $rq->image->storeAs('/public', $imagename . "." . $extension);
                $url = Storage::url($imagename . "." . $extension);
                
                Category::create([
                    'number' => $rq->get('number'),
                    'title' => $rq->get('title'),
                    'description' => $rq->get('description'),
                    'icon' => $url
                ]);
            }
        }
        else 
            Category::create($rq->all());
        return redirect()->route('categories.index')->with('success', 'Category created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function view(Category $category)
    {
        return view('categories.show', compact('category'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        return view('categories.edit', compact('category'));
    }

    /**
     * Update the resource
     *
     * @param  \App\Http\Requests\Request  $rq
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $rq, Category $category)
    {
        try {

            $category->update($rq->all());
            return redirect()->route('categories.index')->with('success', 'Category updated successfully.');
        } catch (\Exception $exception) {
            return redirect()->back()->withError('Error while updating Category');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Apptime  $apptime
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        $category->delete();
        return redirect()->route('categories.index')->with('success', 'Category deleted successfully');
    }
}
