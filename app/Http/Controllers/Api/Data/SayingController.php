<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Data\Saying;
use App\Http\Resources\SayingResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SayingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sayings = Saying::all();
        return response([ 'sayings' => SayingResource::collection($sayings), 'message' => 'Retrieved successfully'], 200);
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

        $saying = Saying::create($data);

        return response([ 'saying' => new SayingResource($saying), 'message' => 'Created successfully'], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Model\Saying  $saying
     * @return \Illuminate\Http\Response
     */
    public function show(Saying $saying)
    {
        return response([ 'saying' => new SayingResource($saying), 'message' => 'Retrieved successfully'], 200);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Model\Saying  $saying
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Saying $saying)
    {

        $saying->update($request->all());

        return response([ 'saying' => new SayingResource($saying), 'message' => 'Retrieved successfully'], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Model\Saying $saying
     * @return \Illuminate\Http\Response
     * @throws \Exception
     */
    public function destroy(Saying $saying)
    {
        $saying->delete();

        return response(['message' => 'Deleted']);
    }
}