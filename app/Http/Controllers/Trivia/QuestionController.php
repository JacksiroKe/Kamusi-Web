<?php

namespace App\Http\Controllers\Trivia;

use App\Models\Data\Word;
use App\Models\Trivia\Category;
use App\Models\Trivia\Question;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class QuestionController extends Controller
{
    
    /**
     * search a listing of the questions
     *
     * @param  \Illuminate\Http\Request  $rq
     * @return \Illuminate\Http\Response
     */

    public function search(Request $request){
        
        if($request->ajax()) {
          
            $data = Question::where('title', 'LIKE', $request->searchQry.'%')->get();
           
            $output = '';
           
            if (count($data)>0) {              
                $output = '<div class="table-responsive">
                <table class="table align-items-center table-flush">
                    <thead class="thead-light">
                        <tr>
                            <th scope="col"></th>
                            <th scope="col">Question</th>
                            <th scope="col">Meaning</th>
                            <th scope="col">Synonyms</th>
                            <th scope="col">Conjugation</th>
                            <th scope="col">Searched</th>
                            <th scope="col">T.Cart</th>
                            <th scope="col">T.Level</th>
                            <th scope="col">T.Attempts</th>
                            <th scope="col"></th>
                        </tr>
                    </thead>
                    <tbody>';          
                foreach ($data as $question){
                    $output .= '<tr onclick="window.location.href = \'questions/view/' . $question->id . '\';" style="cursor: pointer;">
                        <td align="right">' . $question->id . '.</td>
                        <td valign="top">' . $question->title . '</td>
                        <td style="white-space: normal;">' . $question->meaning . '</td>
                        <td style="white-space: normal;">' . $question->synonyms . '</td>
                        <td style="white-space: normal;">' . $question->conjugation . '</td>
                        <td align="right"></td>
                        <td align="right"></td>
                        <td align="right"></td>
                        <td align="right"></td>
                        <td class="text-right">
                            <div class="dropdown">
                                <a class="btn btn-sm btn-icon-only text-light" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="fas fa-ellipsis-v"></i>
                                </a>
                                <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                <a class="dropdown-item" href="questions/edit/' . $question->id . '">Edit Question</a>
                                <a class="dropdown-item" href="questions/delete/' . $question->id . '" onclick="return confirm(\'Are you sure you want to delete: ' . $question->name . ' from the system? \nBe careful, this action can not be reversed.\')">Delete Question</a>
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
     * Display a listing of the questions
     *
     * @param  \App\Models\Question  $model
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $questions = Question::paginate(20);
        return view('questions.index', compact('questions'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Word $word)
    {
        $categories = Category::all();
        $levels = [
            1 => 'Level 1',
            2 => 'Level 2',
            3 => 'Level 3',
            4 => 'Level 4',
            5 => 'Level 5',
            6 => 'Level 6',
            7 => 'Level 7',
            8 => 'Level 8',
            9 => 'Level 9',
            10 => 'Level 10',
        ];
        return view('questions.create', compact('word', 'levels', 'categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $rq
     * @return \Illuminate\Http\Response
     */
    public function store(Request $rq)
    {
        try {
            $title = $rq['title1'];
            $answer = $rq['answer1'];

            if ($rq['format'] == 2) {
                $title = $rq['title2'];
                $answer = $rq['answer2'];
            }

            Question::create([
                'userid' => auth()->user()->id,
                'category' => $rq['category'],
                'level' => $rq['level'],
                'title' => $title,
                'answer' => $answer,
                'option1' => $rq['option1'],
                'option2' => $rq['option2'],
                'option3' => $rq['option3'],
                'option4' => $rq['option4'],
            ]);
            return redirect()->route('words.index')->with('success', 'Question created successfully.');
        } catch (\Exception $exception) {
            return redirect()->back()->withError('Error while creating Question');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function view(Question $question)
    {
        $categories = Category::all();
        return view('questions.view', compact('question', 'categories'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function edit(Question $question)
    {
        $categories = Category::all();
        $levels = [
            1 => 'Level 1',
            2 => 'Level 2',
            3 => 'Level 3',
            4 => 'Level 4',
            5 => 'Level 5',
            6 => 'Level 6',
            7 => 'Level 7',
            8 => 'Level 8',
            9 => 'Level 9',
            10 => 'Level 10',
        ];
    
        
        $answers = [$question->option1, $question->option2, $question->option3, $question->option4 ];
        return view('questions.edit', compact('question', 'answers', 'levels', 'categories'));
    }

    /**
     * Update the resource
     *
     * @param  \App\Http\Requests\Request  $rq
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $rq, Question $question)
    {
        try {
            $question->update($rq->all());
            return redirect()->route('questions.index')->with('success', 'Question updated successfully.');
        } catch (\Exception $exception) {
            return redirect()->back()->withError('Error while updating Question');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Apptime  $apptime
     * @return \Illuminate\Http\Response
     */
    public function destroy(Question $question)
    {
        $question->delete();
        return redirect()->route('questions.index')->with('success', 'Question deleted successfully');
    }
}