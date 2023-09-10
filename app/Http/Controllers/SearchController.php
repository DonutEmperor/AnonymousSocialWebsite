<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\Topic;
use App\Models\Thread;
use App\Models\Comment;

class SearchController extends Controller
{
    public function index()
    {
        return view('search.search');
    }

    public function search(Request $request)
    {
        if($request->ajax())
        {
            $output="";
            
            // Search in the 'products' table
            $productResults = Topic::where('title', 'LIKE', '%' . $request->search . '%')->get();
            
            // Search in another table (e.g., 'orders')
            $orderResults = Thread::where('field_to_search', 'LIKE', '%' . $request->search . '%')->get();
            
            // Combine results from different tables/models
            $results = array_merge($productResults->toArray(), $orderResults->toArray());
    
            if(!empty($results))
            {
                foreach ($results as $result) {
                    $output.='<tr>'.
                    '<td>'.$result['id'].'</td>'.
                    '<td>'.$result['title'].'</td>'.
                    '<td>'.$result['description'].'</td>'.
                    '<td>'.$result['price'].'</td>'.
                    '</tr>';
                }
                return response()->json(['output' => $output]);
            }
        }
    }
    
}
