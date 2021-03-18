<?php

namespace App\Http\Controllers\Api\Trivia;

use App\Models\Trivia\Question;
use App\Http\Controllers\Controller;
use App\Http\Resources\QuestionResource;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class QuestionController extends Controller
{
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $results = Question::where('category', $request->category)->where('level', $request->level)->take($request->limit + 1)->get();

        if (!$results) 
            return response()->json([
                'status' => 0,
                'message' => 'Retrieval unsuccessful',
            ], Response::HTTP_BAD_REQUEST);
        else 
            return response()->json([
                'status' => 1,
                'message' => 'Retrieval successful',
                'results' => $results
            ], Response::HTTP_OK);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function show(Question $question)
    {
        if (!$question)
            return response([
                'status' => 0,
                'message' => 'Retrieval unsuccessful'
            ], Response::HTTP_BAD_REQUEST);
        else
            return response([
                'status' => 1,
                'message' => 'Retrieval successful',
                'question' => new QuestionResource($question), 
            ], Response::HTTP_OK);
    }

}
