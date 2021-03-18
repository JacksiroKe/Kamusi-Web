<?php

namespace App\Http\Controllers\Api\Trivia;

use App\Http\Controllers\Controller;
use App\Models\Trivia\Trivia;
use App\Http\Resources\TriviaResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TriviaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $trivias = Trivia::all();
        return response([ 'trivias' => TriviaResource::collection($trivias), 'message' => 'Retrieved successfully'], 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->all();

        $validator = Validator::make($data, [
            'name' => 'required|max:255',
            'year' => 'required|max:255',
            'company_headquarters' => 'required|max:255',
            'what_company_does' => 'required'
        ]);

        if($validator->fails()){
            return response(['error' => $validator->errors(), 'Validation Error']);
        }

        $trivia = Trivia::create($data);

        return response([ 'trivia' => new TriviaResource($trivia), 'message' => 'Created successfully'], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Model\Trivia  $trivia
     * @return \Illuminate\Http\Response
     */
    public function show(Trivia $trivia)
    {
        return response([ 'trivia' => new TriviaResource($trivia), 'message' => 'Retrieved successfully'], 200);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Model\Trivia  $trivia
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Trivia $trivia)
    {

        $trivia->update($request->all());

        return response([ 'trivia' => new TriviaResource($trivia), 'message' => 'Retrieved successfully'], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Model\Trivia $trivia
     * @return \Illuminate\Http\Response
     * @throws \Exception
     */
    public function destroy(Trivia $trivia)
    {
        $trivia->delete();

        return response(['message' => 'Deleted']);
    }
}