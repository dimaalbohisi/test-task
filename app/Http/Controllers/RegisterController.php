<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RegisterController extends Controller
{
    public function index()
    {
        $departments = [
            '01' => 'Technical',
            '02' => 'Financial',
            '03' => 'Sales'
        ];

        return view('register', [
            'name' => null,
            'departments' => $departments
        ]);
    }

    public function store(Request $request)
{

    $name = $request->input('name', 'Guest');
    $departmentId = $request->input('department');


    $departments = [
        '01' => 'Technical',
        '02' => 'Financial',
        '03' => 'Sales'
    ];
    $departmentName = $departments[$departmentId] ?? 'Unknown';


    DB::table('site_users')->insert([
        'name' => $name,
        'department' => $departmentName,
        'created_at' => now(),
        'updated_at' => now()
    ]);


    return view('register', compact('name', 'departments'));
}
}
