<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Data\Proverb;
use App\Http\Resources\ProverbResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProverbController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $proverbs = Proverb::all();
        return response([ 'proverbs' => ProverbResource::collection($proverbs), 'message' => 'Retrieved successfully'], 200);
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

        $proverb = Proverb::create($data);

        return response([ 'proverb' => new ProverbResource($proverb), 'message' => 'Created successfully'], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Model\Proverb  $proverb
     * @return \Illuminate\Http\Response
     */
    public function show(Proverb $proverb)
    {
        return response([ 'proverb' => new ProverbResource($proverb), 'message' => 'Retrieved successfully'], 200);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Model\Proverb  $proverb
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Proverb $proverb)
    {

        $proverb->update($request->all());

        return response([ 'proverb' => new ProverbResource($proverb), 'message' => 'Retrieved successfully'], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Model\Proverb $proverb
     * @return \Illuminate\Http\Response
     * @throws \Exception
     */
    public function destroy(Proverb $proverb)
    {
        $proverb->delete();

        return response(['message' => 'Deleted']);
    }
}