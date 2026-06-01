<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    //  استعراض المستخدمين
    public function index()
    {
        $users = DB::table('users')->get();
        return view('users', compact('users'));
    }

    //  حفظ مستخدم جديد
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required'
        ]);

        DB::table('users')->insert([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'created_at' => now(),
            'updated_at' => now()
        ]);

        return redirect('/users');
    }

    //  جلب بيانات للتعديل
    public function edit($id)
    {
        $singleUser = DB::table('users')->where('id', $id)->first();
        $users = DB::table('users')->get();
        return view('users', compact('singleUser', 'users'));
    }

    //تحديث
    public function update(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email'
        ]);

        $updateData = [
            'name' => $request->name,
            'email' => $request->email,
            'updated_at' => now()
        ];

        if ($request->filled('password')) {
            $updateData['password'] = Hash::make($request->password);
        }

        DB::table('users')->where('id', $request->id)->update($updateData);

        return redirect('/users');
    }

    //  حذف
    public function delete($id)
    {
        DB::table('users')->where('id', $id)->delete();
        return redirect('/users');
    }
}
