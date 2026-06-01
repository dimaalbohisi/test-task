<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
class TaskController extends Controller
{
    public function index()
    {
        $tasks = DB::table('tasks')->get();
        return view('tasks', compact('tasks'));
    }


    public function store(Request $request)
    {
        $taskName = $request->input('task_name');

        DB::table('tasks')->insert([
            'name' => $taskName,
            'created_at' => now(),
            'updated_at' => now()
        ]);

        return redirect()->back();
    }


    public function destroy($id)
    {
        DB::table('tasks')->where('id', $id)->delete();
        return redirect()->back();
    }


    public function edit($id)
    {
        $singleTask = DB::table('tasks')->where('id', $id)->first();
        $tasks = DB::table('tasks')->get();
        return view('tasks', compact('singleTask', 'tasks'));
    }

    public function update(Request $request)
    {
        DB::table('tasks')->where('id', $request->id)->update([
            'name' => $request->task_name,
            'updated_at' => now()
        ]);
        return redirect('/tasks');
    }
}
