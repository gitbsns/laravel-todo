<?php

namespace App\Http\Controllers;

use App\Models\Todo;
use Illuminate\Http\Request;

class TodoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json(Todo::all());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
       $data =  $request->validate([
            'name' => 'required|string',
            'about' => 'required|string',
        ]);

        $todo = Todo::create($data);
        return response()->json($todo);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        return response()->json(Todo::findOrFail($id));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $data =  $request->validate([
            'name' => 'sometimes|string',
            'about' => 'sometimes|string',
        ]);

        $todo = Todo::findOrFail($id);
        $todo->update($data);
        return response()->json($todo->refresh());
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy( $id)
    {
        $todo = Todo::findOrFail($id);
        $todo->delete();
        return response()->json('Successfully deleted');
    }
}
