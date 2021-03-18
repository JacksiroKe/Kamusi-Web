<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Data\Idiom;
use App\Http\Resources\IdiomResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class IdiomController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $idioms = Idiom::all();
        return response([ 'idioms' => IdiomResource::collection($idioms), 'message' => 'Retrieved successfully'], 200);
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

        $idiom = Idiom::create($data);

        return response([ 'idiom' => new IdiomResource($idiom), 'message' => 'Created successfully'], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Model\Idiom  $idiom
     * @return \Illuminate\Http\Response
     */
    public function show(Idiom $idiom)
    {
        return response([ 'idiom' => new IdiomResource($idiom), 'message' => 'Retrieved successfully'], 200);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Model\Idiom  $idiom
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Idiom $idiom)
    {

        $idiom->update($request->all());

        return response([ 'idiom' => new IdiomResource($idiom), 'message' => 'Retrieved successfully'], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Model\Idiom $idiom
     * @return \Illuminate\Http\Response
     * @throws \Exception
     */
    public function destroy(Idiom $idiom)
    {
        $idiom->delete();

        return response(['message' => 'Deleted']);
    }
}