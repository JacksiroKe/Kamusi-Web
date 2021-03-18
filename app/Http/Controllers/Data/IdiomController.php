<?php

namespace App\Http\Controllers\Data;

use App\Models\Data\Idiom;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class IdiomController extends Controller
{
    /**
     * Display a listing of the idioms
     *
     * @param  \App\Models\Idiom  $model
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $idioms = Idiom::paginate(15);
        return view('idioms.index', compact('idioms'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('idioms.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $rq
     * @return \Illuminate\Http\Response
     */
    public function store(Request $rq)
    {
        Idiom::create($rq->all());
        return redirect()->route('idioms.index')->with('success', 'Idiom created successfully.');
    }

    /**
     * Show the form for editing the resource.
     *
     * @return \Illuminate\View\View
     */
    public function edit(Idiom $idiom)
    {
        return view('idioms.edit', compact('idiom'));
    }

    /**
     * Show the form for viewing the resource.
     *
     * @return \Illuminate\View\View
     */
    public function view(Idiom $idiom)
    {
        return view('idioms.view', compact('idiom'));
    }

    /**
     * Update the resource
     *
     * @param  \App\Http\Requests\Request  $rq
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $rq, Idiom $idiom)
    {
        try {
            $idiom->update($rq->all());
            return redirect()->route('idioms.index')->with('success', 'Idiom updated successfully.');
        } catch (\Exception $exception) {
            return redirect()->back()->withError('Error while updating Idiom');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Apptime  $apptime
     * @return \Illuminate\Http\Response
     */
    public function destroy(Idiom $idiom)
    {
        $idiom->delete();
        return redirect()->route('idioms.index')->with('success', 'Idiom deleted successfully');
    }
    
}
