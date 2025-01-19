<?php

namespace App\Http\Controllers;

use App\Models\Task22;
use Illuminate\Http\Request;



class TaskController22 extends Controller
{
    // عرض المهام get
    public function index()
    {
        $tasks = Task22::all();
        return view('tasks.index', compact('tasks'));
    }

    // إضافة مهمة جديدة
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
        ]);

        Task22::create([
            'title' => $request->title,
        ]);

        return redirect()->back()->with('success', 'Task added successfully.');
    }

    // تحديث حالة المهمة (مكتملة أم لا)
    public function update(Request $request, Task22 $task)
    {
        $task->update([
            // 'completed' => $request->has('completed'),
            'completed' => !$task->completed, //0,1 عشان يرجعلى 
        ]);

        return redirect()->back()->with('success', 'Task updated successfully.');
    }

    // حذف المهمة
    public function destroy(Task22 $task)
    {
        $task->delete();

        return redirect()->back()->with('success', 'Task deleted successfully.');
    }
}
