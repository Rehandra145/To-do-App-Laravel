<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;
use App\Models\Profile;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Profile $profile, Task $tasks, Auth $user)
    {
        $user = Auth::user();    
        if(Auth::check()){
            $profile = Profile::where('user_id', $user->id)->first();                          
        }         
        $tasks = Task::where('Done', false)->orderBy('Level', 'asc')->get();
        return view('index', compact('tasks', 'user', 'profile'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $user = Auth::user();
        $request->validate([
            'name'=>'required',
            'DueTo'=>'required'
        ]);

        Task::create([
            'name'=>$request->name,
            'DueTo'=>$request->DueTo,
            'level'=>$request->level,
            'user_id'=>Auth::check()? $user->id : 0
        ]);

        return Redirect::route('Index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Task $tasks, Auth $user)
    {
        $user = Auth::user();
        $tasks = Task::where('Done', true)->where('user_id', $user->id) ->get();
        return view('complete', compact('tasks', 'user'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Task $task)
    {
        $task->update(['Done'=>true]);
        return Redirect::route('Index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function delete(Task $task)
    {
        $task->delete();
        return Redirect::route('Index');
    }

    public function deleteAll(Auth $user){
        $user = Auth::user();
        Task::where('Done', true)->where('user_id', $user->id)->delete();
        return Redirect::route('Show');
    }
}