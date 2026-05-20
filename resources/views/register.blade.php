<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register Page</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f9f9f9;
            margin: 50px auto;
            max-width: 450px;
            padding: 20px;
        }

        /* Success message  */
        .welcome-msg {
            background-color: #d4edda;
            color: #155724;
            padding: 10px;
            border-radius: 5px;
            text-align: center;
            margin-bottom: 15px;
            font-size: 18px;
        }

        form {
            background: white;
            padding: 20px;
            border: 1px solid #e0e0e0;
            border-radius: 8px;
            margin-bottom: 30px; /*مسافة بين الفورم والجدول*/
        }

        label {
            font-weight: bold;
            color: #333;
            display: block;
            margin-top: 10px;
        }

        /* Inputs, Select, and Button styling */
        input, select, button {
            width: 100%;
            padding: 10px;
            margin-top: 5px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }

        /* Submit Button */
        button {
            background-color: #007bff;
            color: white;
            border: none;
            cursor: pointer;
            font-size: 16px;
            font-weight: bold;
            margin-bottom: 0;
        }

        button:hover {
            background-color: #0056b3;
        }

        /* تنسيق الجدول الجديد المضاف   */
        .user-table {
            width: 100%;
            border-collapse: collapse;
            background: white;
            border: 1px solid #e0e0e0;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 2px 4px rgba(0,0,0,0.02);
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

        .user-table tr:hover {
            background-color: #fafdff;
        }

        .table-title {
            font-size: 18px;
            font-weight: bold;
            color: #333;
            margin-bottom: 10px;
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

        /*   تنسيق رابط التعديل ورابط الإلغاء   */
        .edit-link {
            color: #007bff;
            text-decoration: none;
            font-weight: bold;
            font-size: 13px;
            margin-right: 12px;
        }

        .edit-link:hover {
            text-decoration: underline;
            color: #0056b3;
        }

        .cancel-link {
            display: block;
            text-align: center;
            margin-top: 10px;
            color: #6c757d;
            text-decoration: none;
            font-size: 14px;
        }

        .cancel-link:hover {
            text-decoration: underline;
        }

    </style>
</head>
<body>

    @if($name)
        <div class="welcome-msg">
            Welcome: {{ $name }}
        </div>
    @endif

     {{--    الفورم     @if / @else  --}}
    @if(isset($user))
        <h2 style="color: #007bff; margin-top: 0; font-size: 20px;">Update User Information</h2>

        <form action="/user/update" method="POST">
            @csrf

            <input type="hidden" name="id" value="{{ $user->id }}">

            <label>Name:</label>
            <input type="text" name="name" value="{{ $user->name }}" required>

            <label>Department:</label>
            <select name="department" required>
                @foreach($departments as $key => $value)
                    <option value="{{ $key }}" {{ $user->department == $value ? 'selected' : '' }}>{{ $value }}</option>
                @endforeach
            </select>

            <button type="submit" style="background-color: #007bff;">Update User</button>

            {{--   رابط يسمح للمستخدم بإلغاء عملية التعديل  --}}
            <a href="/register" class="cancel-link">Cancel Edit</a>
        </form>
    @else
        <h2 style="margin-top: 0; font-size: 20px;">Register New User</h2>

        <form action="/register" method="POST">
            @csrf

            <label>Name:</label>
            <input type="text" name="name" placeholder="Enter name..." required>

            <label>Department:</label>
            <select name="department" required>
                <option value="" disabled selected>Select Department</option>
                @foreach($departments as $key => $value)
                    <option value="{{ $key }}">{{ $value }}</option>
                @endforeach
            </select>

            <button type="submit">Submit</button>
        </form>
    @endif

    <div class="table-title">Registered Users</div>
    <table class="user-table">
        <thead>
            <tr>
                <th>Name</th>
                <th>Department</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($users as $user)
                <tr>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->department }}</td>
                    <td>
                        {{--    إضافة رابط التعديل (Edit)    --}}
                        <a href="/user/edit/{{ $user->id }}" class="edit-link">Edit</a>

                        <form action="/user/delete/{{ $user->id }}" method="POST" style="display:inline; margin:0; padding:0; border:none; background:none;">
                            @csrf
                            <button type="submit" class="delete-btn">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

</body>
</html>
