<?php

namespace App\Http\Controllers;

use App\Models\Word;
use Illuminate\Http\Request;

class WordController extends Controller
{
    /**
     * Display a listing of the words
     *
     * @param  \App\Models\Word  $model
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $words = Word::simplePaginate(15);
        return view('words.index', compact('words'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('words.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $rq
     * @return \Illuminate\Http\Response
     */
    public function store(Request $rq)
    {
        Word::create($rq->all());
        return redirect()->route('words.index')->with('success', 'Word created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Word  $word
     * @return \Illuminate\Http\Response
     */
    public function view(Word $word)
    {
        return view('words.show', compact('word'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Word  $word
     * @return \Illuminate\Http\Response
     */
    public function edit(Word $word)
    {
        return view('words.edit', compact('word'));
    }

    /**
     * Update the resource
     *
     * @param  \App\Http\Requests\Request  $rq
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $rq, Word $word)
    {
        try {
            $word->update($rq->all());
            return redirect()->route('words.index')->with('success', 'Word updated successfully.');
        } catch (\Exception $exception) {
            return redirect()->back()->withError('Error while updating Word');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Apptime  $apptime
     * @return \Illuminate\Http\Response
     */
    public function destroy(Word $word)
    {
        $word->delete();
        return redirect()->route('words.index')->with('success', 'Word deleted successfully');
    }
}