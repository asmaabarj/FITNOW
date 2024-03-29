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
        ]);

        $user = Auth::user();

        $progress = Progress::create([
            'user_id' => $user->id,
            'weight' => $request->weight,
            'measurements' => $request->measurements,
            'performance' => $request->performance,
        ]);

        return response()->json(['message' => 'Progress saved successfully', 'progress' => $progress], 201);
    }

    public function show()
    {
        $user = Auth::user();

        $progress = Progress::where('user_id', $user->id)->get();

        return response()->json([
            'statut' => 'success',
            'message' => 'Progress data retrieved successfully',
            'progress' => $progress
        ], 200);
    }

    public function destroy($id)
    {
        $progress = Progress::findOrFail($id);
        if ($progress->user_id !== Auth::id()) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        $progress->delete();
        return response()->json(['message' => 'Progress deleted successfully'], 200);
    }
    public function update(Request $request, $id)
    {
        $request->validate([
            'weight' => 'required',
            'measurements' => 'required',
            'performance' => 'required',
        ]);

        $progress = Progress::findOrFail($id);

        if ($progress->user_id !== Auth::id()) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        $progress->update([
            'weight' => $request->weight,
            'measurements' => $request->measurements,
            'performance' => $request->performance,
        ]);

        return response()->json(['message' => 'Progress updated successfully', 'progress' => $progress], 200);
    }

    public function complete($id)
{
    $progress = Progress::findOrFail($id);

    if ($progress->user_id !== Auth::id()) {
        return response()->json(['message' => 'Unauthorized'], 403);
    }
    $progress->update(['status' => 'Completed']);
    return response()->json(['message' => 'Progress status updated to Completed', 'progress' => $progress], 200);
}

public function history()
{
    $user = Auth::user();
    $progressHistory = Progress::where('user_id', $user->id)->orderBy('created_at', 'desc')->get();
    return response()->json(['message' => 'Progress history retrieved successfully', 'progressHistory' => $progressHistory], 200);
}

}
