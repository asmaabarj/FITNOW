<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Progress;
use Illuminate\Support\Facades\Auth; 
class ProgressController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'weight' => 'required',
            'measurements' => 'required',
            'performance' => 'required',
            'user_id' => 'required',
        ]);
 
            $user = Auth::user(); 
            dd($user);
            $userId = $user->id;
           
            $user = Auth::user();
            $progress = Progress::create([
    
                'user_id' => $user->id,
                'weight' => $request->weight,
                'measurements' => $request->measurements,
                'performance' => $request->performance,
            ]);
            return response()->json(['message' => 'Progress saved successfully', 'progress' => $progress], 201);
  
    }
    
}
