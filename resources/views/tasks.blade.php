@extends('layouts.app')

@section('content')
    <style>
        .tasks-wrapper {
            max-width: 500px;
            margin: 20px auto;
        }

        form.task-form {
            background: white;
            padding: 20px;
            border: 1px solid #e0e0e0;
            border-radius: 6px;
            margin-bottom: 30px;
            box-shadow: 0 0.15rem 1.75rem 0 rgba(58, 59, 69, 0.15);
        }

        label {
            font-weight: bold;
            color: #333;
            display: block;
            margin-top: 10px;
            margin-bottom: 5px;
        }

        input[type="text"], button.btn-block-task {
            width: 100%;
            padding: 10px;
            margin-top: 5px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
            font-size: 15px;
        }

        .btn-add {
            background-color: #28a745;
            color: white;
            border: none;
            cursor: pointer;
            font-weight: bold;
        }
        .btn-add:hover {
            background-color: #218838;
        }

        .btn-update {
            background-color: #007bff;
            color: white;
            border: none;
            cursor: pointer;
            font-weight: bold;
        }
        .btn-update:hover {
            background-color: #0056b3;
        }

        .user-table {
            width: 100%;
            border-collapse: collapse;
            background: white;
            border: 1px solid #e0e0e0;
            border-radius: 6px;
            overflow: hidden;
            box-shadow: 0 0.15rem 1.75rem 0 rgba(58, 59, 69, 0.15);
        }

        .user-table th, .user-table td {
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid #eee;
        }

        .user-table th {
            background-color: #f1f1f1;
            color: #333;
            font-weight: bold;
        }

        .table-title {
            font-size: 18px;
            font-weight: bold;
            color: #333;
            margin-bottom: 10px;
        }

        .action-container {
            display: flex;
            align-items: center;
        }

        .edit-link {
            color: #007bff;
            text-decoration: none;
            font-weight: bold;
            font-size: 13px;
            margin-right: 15px;
        }
        .edit-link:hover {
            text-decoration: underline;
        }

        .delete-btn {
            background-color: #dc3545;
            color: white;
            border: none;
            padding: 5px 12px;
            font-size: 13px;
            font-weight: bold;
            border-radius: 4px;
            cursor: pointer;
            width: auto;
            margin: 0;
        }
        .delete-btn:hover {
            background-color: #bd2130;
        }

        .cancel-link {
            display: block;
            text-align: center;
            margin-top: 5px;
            color: #6c757d;
            text-decoration: none;
            font-size: 14px;
        }
        .cancel-link:hover {
            text-decoration: underline;
        }

        /* تنسيق مخصص لرسالة الخطأ    */
        .error-message {
            display: block;
            color: #dc3545;
            font-size: 13px;
            margin-top: -10px;
            margin-bottom: 15px;
            font-weight: 500;
        }
    </style>

    <div class="container-fluid">
        <div class="tasks-wrapper">

            @if(isset($singleTask))
                <h2 style="color: #007bff; margin-top: 0; font-size: 20px;">Update Task</h2>
                <form action="/tasks/update" method="POST" class="task-form">
                    @csrf
                    <input type="hidden" name="id" value="{{ $singleTask->id }}">
                    <label>Task Name:</label>
                    <input type="text" name="task_name" value="{{ $singleTask->name }}" required>

                    {{--  إظهار خطأ التعديل   --}}
                    @error('task_name')
                        <span class="error-message">{{ $message }}</span>
                    @enderror

                    <button type="submit" class="btn-block-task btn-update">Update Task</button>
                    <a href="/tasks" class="cancel-link">Cancel Edit</a>
                </form>
            @else
                <h2 style="margin-top: 0; font-size: 20px;">Add New Task</h2>
                <form action="/tasks/store" method="POST" class="task-form">
                    @csrf
                    <label>Task Name:</label>
                    <input type="text" name="task_name" placeholder="Enter task name..." required>

                    {{--  إظهار خطأ الإضافة   --}}
                    @error('task_name')
                        <span class="error-message">{{ $message }}</span>
                    @enderror

                    <button type="submit" class="btn-block-task btn-add">Add Task</button>
                </form>
            @endif

            <div class="table-title">Tasks List</div>
            <table class="user-table">
                <thead>
                    <tr>
                        <th>Task Name</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($tasks as $task)
                        <tr>
                            <td>{{ $task->name }}</td>
                            <td>
                                <div class="action-container">
                                    <a href="/tasks/edit/{{ $task->id }}" class="edit-link">Edit</a>

                                    <form action="/tasks/delete/{{ $task->id }}" method="POST" style="display:inline; margin:0; padding:0; border:none; background:none;">
                                        @csrf
                                        <button type="submit" class="delete-btn">Delete</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

        </div>
    </div>
@endsection
