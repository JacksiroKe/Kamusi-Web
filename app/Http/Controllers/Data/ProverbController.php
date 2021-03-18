<?php

namespace App\Http\Controllers\Data;

use App\Models\Data\Proverb;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProverbController extends Controller
{
    /**
     * Display a listing of the proverbs
     *
     * @param  \App\Models\Proverb  $model
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $proverbs = Proverb::paginate(15);
        return view('proverbs.index', compact('proverbs'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('proverbs.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $rq
     * @return \Illuminate\Http\Response
     */
    public function store(Request $rq)
    {
        Proverb::create($rq->all());
        return redirect()->route('proverbs.index')->with('success', 'Proverb created successfully.');
    }

    /**
     * Show the form for editing the profile.
     *
     * @return \Illuminate\View\View
     */
    public function edit(Proverb $proverb)
    {
        return view('proverbs.edit', compact('proverb'));
    }

    /**
     * Show the form for viewing the profile.
     *
     * @return \Illuminate\View\View
     */
    public function view(Proverb $proverb)
    {
        return view('proverbs.view', compact('proverb'));
    }

    /**
     * Update the resource
     *
     * @param  \App\Http\Requests\Request  $rq
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $rq, Proverb $proverb)
    {
        try {
            $proverb->update($rq->all());
            return redirect()->route('proverbs.index')->with('success', 'Proverb updated successfully.');
        } catch (\Exception $exception) {
            return redirect()->back()->withError('Error while updating Proverb');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Apptime  $apptime
     * @return \Illuminate\Http\Response
     */
    public function destroy(Proverb $proverb)
    {
        $proverb->delete();
        return redirect()->route('proverbs.index')->with('success', 'Proverb deleted successfully');
    }
    
}
