<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Register Page</title>
    <style>

        body {
            font-family: Arial, sans-serif;
            background-color: #f9f9f9;
            margin: 50px auto;
            max-width: 350px; /* Neat small box width */
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
    </style>
</head>
<body>

    @if($name)
        <div class="welcome-msg">
            Welcome: {{ $name }}
        </div>
    @endif

    <form action="/register" method="POST">
        @csrf

        <label>Name:</label>
        <input type="text" name="name" placeholder="Enter name..." required>

        <label>Department:</label>
        <select name="department" required>
            @foreach($departments as $key => $value)
                <option value="{{ $key }}">{{ $value }}</option>
            @endforeach
        </select>

        <button type="submit">Submit</button>
    </form>

</body>
</html>
