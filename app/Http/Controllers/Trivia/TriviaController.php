<?php

namespace App\Http\Controllers\Trivia;

use App\Models\Trivia\Trivia;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TriviaController extends Controller
{
    /**
     * Display a listing of the trivia
     *
     * @param  \App\Models\Trivia  $model
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $trivia = Trivia::latest()->paginate(5);
        return view('trivia.index', compact('trivia'))->with('i', (request()->input('page', 1) - 1) * 20);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('trivia.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $rq
     * @return \Illuminate\Http\Response
     */
    public function store(Request $rq)
    {
        Trivia::create($rq->all());
        return redirect()->route('trivia.index')->with('success', 'Trivia created successfully.');
    }

    /**
     * Show the form for editing the profile.
     *
     * @return \Illuminate\View\View
     */
    public function edit(Trivia $trivia)
    {
        return view('trivia.edit', compact('trivia'));
    }

    /**
     * Show the form for viewing the profile.
     *
     * @return \Illuminate\View\View
     */
    public function view(Trivia $trivia)
    {
        return view('trivia.view', compact('trivia'));
    }

    /**
     * Update the resource
     *
     * @param  \App\Http\Requests\Request  $rq
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $rq, Trivia $trivia)
    {
        try {
            $trivia->update($rq->all());
            return redirect()->route('trivia.index')->with('success', 'Trivia updated successfully.');
        } catch (\Exception $exception) {
            return redirect()->back()->withError('Error while updating Trivia');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Apptime  $apptime
     * @return \Illuminate\Http\Response
     */
    public function destroy(Trivia $trivia)
    {
        $trivia->delete();
        return redirect()->route('trivia.index')->with('success', 'Trivia deleted successfully');
    }
    
}
