<?php

namespace App\Http\Controllers\Data;

use App\Models\Data\Word;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class WordController extends Controller
{
    
    /**
     * search a listing of the words
     *
     * @param  \Illuminate\Http\Request  $rq
     * @return \Illuminate\Http\Response
     */

    public function search(Request $request){
        
        if($request->ajax()) {
            $qry = $request->searchQry;
            
            if (strpos($qry, ' ') !== false) 
                $data = Word::where('meaning', 'LIKE', '%'.$qry.'%')->get();
            else  
                $data = Word::where('title', 'LIKE', $qry.'%')->get();

            $output = '';
           
            if (count($data)>0) {              
                $output = '<div class="table-responsive">
                <table class="table align-items-center table-flush">
                    <thead class="thead-light">
                        <tr>
                            <th scope="col"></th>
                            <th scope="col">Word</th>
                            <th scope="col">Meaning</th>
                            <th scope="col">Synonyms</th>
                            <th scope="col">Conjugation</th>
                            <th scope="col">Searched</th>
                            <th scope="col"></th>
                        </tr>
                    </thead>
                    <tbody>';          
                foreach ($data as $word){
                    $output .= '<tr>
                        <td align="right">' . $word->id . '.</td>
                        <td onclick="window.location.href=\'words/view/' . $word->id . '\';" style="cursor: pointer;" valign="top">' . $word->title . '</td>
                        <td onclick="window.location.href=\'words/view/' . $word->id . '\';" style="cursor: pointer;white-space: normal;">' . $word->meaning . '</td>
                        <td onclick="window.location.href=\'words/view/' . $word->id . '\';" style="cursor: pointer;white-space: normal;">' . $word->synonyms . '</td>
                        <td onclick="window.location.href=\'words/view/' . $word->id . '\';" style="cursor: pointer;white-space: normal;">' . $word->conjugation . '</td>
                        <td align="right"></td>
                        <td class="text-right">
                            <div class="dropdown">
                                <a class="btn btn-sm btn-icon-only text-light" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="fas fa-ellipsis-v"></i>
                                </a>
                                <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                <a class="dropdown-item" href="words/edit/' . $word->id . '">Edit Word</a>
                                <a class="dropdown-item" href="words/delete/' . $word->id . '" onclick="return confirm(\'Are you sure you want to delete: ' . $word->name . ' from the system? \nBe careful, this action can not be reversed.\')">Delete Word</a>   
                                <a class="dropdown-item" href="questions/create/' . $word->id . '">Create a Question</a>
                                </div>
                            </div>
                        </td>
                    </tr>';
                }        
                $output .= '</tbody>
                </table>                
            </div>';
            }
            else {             
                $output .= '<h3>No results</h3>';
            }           
            return $output;
        }
    }

    /**
     * find a listing of the words
     *
     * @param  \Illuminate\Http\Request  $rq
     * @return \Illuminate\Http\Response
     */

    public function find(Request $request){
        
        if($request->ajax()) {
            $varQry = explode(":", $request->findQry); 
          
            $data = Word::where('title', 'LIKE', $varQry[1].'%')->get();
           
            $output = '<br>';
           
            if (count($data)>0) {         
                foreach ($data as $word){
                    $output .= '<input type="radio" name="option1" id="format' . $word->id . '" value="' . $word->title . '" > ';
                    $output .= '<label for="format' . $word->id . '" onclick="setValue(\''. $varQry[2] . '\', \'' . $word->title . '\')"> ' . $word->title . ' </label>';
                    $output .= '<br>';
                }        
            }
            else {             
                $output .= '<h3>No results</h3>';
            }           
            return $output;
        }
    }

    /**
     * Display a listing of the words
     *
     * @param  \App\Models\Word  $model
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $words = Word::paginate(20);
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
        return view('words.view', compact('word'));
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