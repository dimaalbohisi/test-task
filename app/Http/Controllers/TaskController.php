<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
//  استدعاء model
use App\Models\Task;

class TaskController extends Controller
{

     // استعراض المهام بالـ ORM

    public function index()
    {
        // جلب جميع المهام باستخدام model Task
        $tasks = Task::all();
        return view('tasks', compact('tasks'));
    }


     // حفظ مهمة  مع الفاليديشن

    public function store(Request $request)
    {
        $request->validate([
            'task_name' => 'required|max:255'
        ]);

        // الحفظ عبر الـ Eloquent ORM
        $task = new Task();
        $task->name = $request->task_name;
        $task->save();

        return redirect('/tasks');
    }


     // جلب بيانات المهمة للتعديل بالـ ORM

    public function edit($id)
    {
        $singleTask = Task::find($id);
        $tasks = Task::all();
        return view('tasks', compact('singleTask', 'tasks'));
    }


     // تحديث المهمة بالـ ORM والتحقق

    public function update(Request $request)
    {
        $request->validate([
            'task_name' => 'required|max:255'
        ]);

        // جلب المهمة وتعديلها
        $task = Task::find($request->id);
        $task->name = $request->task_name;
        $task->save();

        return redirect('/tasks');
    }


     // حذف المهمة بالـ ORM

    public function delete($id)
    {
        $task = Task::find($id);
        $task->delete();

        return redirect('/tasks');
    }
}
