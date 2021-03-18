<?php

namespace App\Http\Controllers;

use App\Models\Trivia;
use App\Models\Word;
use App\Models\Category;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ApiController extends Controller
{
    
    public function getWords()
    {
        $results = Word::select('')->get();

        if (!$results)
            return response()->json(['response' => Response::HTTP_BAD_REQUEST], Response::HTTP_BAD_REQUEST);
        else
            return response()->json(['response' => Response::HTTP_OK, 'results' => $results], Response::HTTP_OK);
    }

    public function getCategories()
    {
        $results = Category::select('id', 'number', 'title', 'description', 'icon')->get();

        if (!$results)
            return response()->json(['response' => Response::HTTP_BAD_REQUEST], Response::HTTP_BAD_REQUEST);
        else
            return response()->json(['response' => Response::HTTP_OK, 'results' => $results], Response::HTTP_OK);
    }

    public function getTrivia(Request $rq)
    {
        $time_stamp = "'" . time() . "'";
        $skip = $time_stamp[9] + $time_stamp[10];

        $results = Word::select('id')
        ->where('trivia_cart', $rq->category)
        ->where('trivia_level', $rq->level)
        ->skip($skip)
        ->take($rq->limit)
        ->inRandomOrder()
        ->get();

        if (!$results) 
            return response()->json(['response' => Response::HTTP_BAD_REQUEST], Response::HTTP_BAD_REQUEST);
        else 
            return response()->json(['response' => Response::HTTP_OK, 'results' => $results], Response::HTTP_OK);
    }

}
