<?php

namespace App\Http\Controllers;

use App\Models\Schedule;
use Illuminate\Http\Request;

class ScheduleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json(Schedule::with('todo')->get());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data =  $request->validate([
            'todo_id' => 'required|exists:todos,id',
            'type' => 'required|string',
            'time' => 'required|string',
            'description' => 'nullable|string',
            'tags' => 'nullable|string',
        ]);

        $schedule = Schedule::create($data);
        return response()->json($schedule);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        return response()->json(Schedule::with('todo')->findOrFail($id));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $data =  $request->validate([
            'todo_id' => 'sometimes|exists:todos,id',
            'type' => 'sometimes|string',
            'time' => 'sometimes|string',
            'description' => 'nullable|string',
            'tags' => 'nullable|string',
        ]);

        $schedule = Schedule::findOrFail($id);
        $schedule->update($data);
        return response()->json($schedule->refresh());
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $schedule = Schedule::findOrFail($id);
        $schedule->delete();
        return response()->json('Successfully deleted');
    }
}
