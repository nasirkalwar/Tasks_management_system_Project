<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\task;

class ApiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json([
            'task'=>task::get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $task = new task;
        $task->title =$request->title;
        $task->description =$request->description;
        $task->priority =$request->priority;
        $task->due_date =$request->due_date;
        $task->status='uncomplate';

        $task->save();
        return response()->json([
            'message' => 'Task Created',
            'status' => 'success',
            'data' => $task
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(task $task)
    {
        return response()->json([
            'task' => $task
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(task $task)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, task $task)
    {
        $task->title =$request->title;
        $task->description =$request->description;
        $task->priority =$request->priority;
        $task->due_date =$request->due_date;
        $task->status='uncomplate';

        $task->save();
        return response()->json([
            'message' => 'Task Updated',
            'status' => 'success',
            'data' => $task
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(task $task)
    {
        $task->delete();
        return response()->json([
            'message' => 'Task daleted',
            'status' => 'success',
            'data' => $task
        ]);
    }
}
