<?php

namespace App\Http\Controllers;

use App\Models\Saying;
use Illuminate\Http\Request;

class SayingController extends Controller
{
    /**
     * Display a listing of the sayings
     *
     * @param  \App\Models\Saying  $model
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $sayings = Saying::simplePaginate(15);
        return view('sayings.index', compact('sayings'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('sayings.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $rq
     * @return \Illuminate\Http\Response
     */
    public function store(Request $rq)
    {
        Saying::create($rq->all());
        return redirect()->route('sayings.index')->with('success', 'Saying created successfully.');
    }

    /**
     * Show the form for editing the profile.
     *
     * @return \Illuminate\View\View
     */
    public function edit(Saying $saying)
    {
        return view('sayings.edit', compact('saying'));
    }

    /**
     * Show the form for viewing the profile.
     *
     * @return \Illuminate\View\View
     */
    public function view(Saying $saying)
    {
        return view('sayings.view', compact('saying'));
    }

    /**
     * Update the resource
     *
     * @param  \App\Http\Requests\Request  $rq
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $rq, Saying $saying)
    {
        try {
            $saying->update($rq->all());
            return redirect()->route('sayings.index')->with('success', 'Saying updated successfully.');
        } catch (\Exception $exception) {
            return redirect()->back()->withError('Error while updating Saying');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Apptime  $apptime
     * @return \Illuminate\Http\Response
     */
    public function destroy(Saying $saying)
    {
        $saying->delete();
        return redirect()->route('sayings.index')->with('success', 'Saying deleted successfully');
    }
    
}
