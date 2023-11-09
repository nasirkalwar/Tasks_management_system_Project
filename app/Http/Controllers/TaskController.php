<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\task;

class TaskController extends Controller
{
    public function index()
    {
        $tasks = task::all();
        return view('task.index',compact('tasks'));
    }
    public function create()
    {
        if(Auth::id())
        {
        return view('task.create');
        }
        else
        {
            return redirect('/login');
        }
    }
    public function store(Request $request)
    {
        if(Auth::id())
        {
            $request->validate([
                'title'=> 'required|max:255',
                'description'=> 'nullable',
                'priority'=> 'required|max:255',
                'due_date'=> 'nullable|max:255',
            ]);
            task::create([
                'title'=> $request->input('title'),
                'description'=>$request->input('description'),
                'priority'=> $request->input('priority'),
                'due_date'=> $request->input('due_date'),
                'status'=> ('uncomplete'),
            ]);
            return redirect()->route('task.index')->with('success','Task Created Successfully');
        }
        else
        {
            return redirect('/login');
        }
    }
    public function edit(task $task)
    {
        if(Auth::id())
        {
        return view('task.edit',compact('task'));
        }
        else
        {
            return redirect('/login');
        }
    }
    public function update(Request $request,task $task)
    {
    if(Auth::id())
    {
        $request->validate([
            'title'=> 'required|max:255',
            'description'=> 'nullable',
            'priority'=> 'required|max:255',
            'due_date'=> 'nullable|max:255',
        ]);
        $task->update([
            'title'=> $request->input('title'),
            'description'=>$request->input('description'),
            'priority'=> $request->input('priority'),
            'due_date'=> $request->input('due_date'),
            'status'=> ('uncomplete'),
        ]);
        return redirect()->route('task.index')->with('success','Task Updated Successfully');
    }
    else
    {
        return redirect('/login');
    }
    }
    public function destroy(task $task)
    {
        if(Auth::id())
        {
            $task->delete();
            return redirect()->route('task.index')->with('success','Task Deleted Successfully');
        }
        else
        {
            return redirect('/login');
        }
    }
    public function complate(task $task)
    {
    if(Auth::id())
    {
        $task->update([
            'status'=>true,
        ]);
        return redirect()->route('task.index')->with('success','Task Completed Successfully');
    }
    else
    {
        return redirect('/login');
    }
    }
    public function showComplated()
    {
        $completedTasks = task::where('status',true)->get();
        
        return view('task.showtask',compact('completedTasks'));
    }
    public function filter(Request $request)
    {
        $filter_status=$request->filter_status;
        $tasks = task::where('status','LIKE',"$filter_status%")->get();
        return view('task.index',compact('tasks'));
    }
}
