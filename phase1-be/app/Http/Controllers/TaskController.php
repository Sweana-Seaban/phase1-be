<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        //added code
        return Task::all();
        //added code
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //added code
        $request->validate([
            'name' => 'required',
            'description' => 'required'
        ]);

        return Task::create($request->all());
        //added code
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //added code
        $task=Task::find($id);
        $task->update($request->all());
        return $task;
        //added code
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //added code
        return Task::destroy($id);
        //added code
    }
}
