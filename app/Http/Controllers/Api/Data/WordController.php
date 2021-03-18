<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Word;
use App\Http\Resources\WordResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class WordController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $words = Word::all();
        return response([ 'words' => WordResource::collection($words), 'message' => 'Retrieved successfully'], 200);
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

        $word = Word::create($data);

        return response([ 'word' => new WordResource($word), 'message' => 'Created successfully'], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Model\Word  $word
     * @return \Illuminate\Http\Response
     */
    public function show(Word $word)
    {
        return response([ 'word' => new WordResource($word), 'message' => 'Retrieved successfully'], 200);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Model\Word  $word
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Word $word)
    {

        $word->update($request->all());

        return response([ 'word' => new WordResource($word), 'message' => 'Retrieved successfully'], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Model\Word $word
     * @return \Illuminate\Http\Response
     * @throws \Exception
     */
    public function destroy(Word $word)
    {
        $word->delete();

        return response(['message' => 'Deleted']);
    }
}