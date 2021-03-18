<?php

namespace App\Http\Controllers\Api\Trivia;

use App\Models\Trivia\Category;
use App\Http\Controllers\Controller;
use App\Http\Resources\CategoryResource;
use Symfony\Component\HttpFoundation\Response;

class CategoryController extends Controller
{
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $results = Category::where('active', '=', 1)->get();

        if (!$results)
            return response([
                'status' => 0,
                'message' => 'Retrieval unsuccessful',
            ], Response::HTTP_BAD_REQUEST);
        else
            return response([
                'status' => 1,
                'message' => 'Retrieval successful',
                'results' => CategoryResource::collection($results),
            ], Response::HTTP_OK);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        return response([ 'category' => new CategoryResource($category), 'message' => 'Retrieved successfully'], 200);
    }

}
