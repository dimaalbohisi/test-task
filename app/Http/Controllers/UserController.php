<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
//  استدعاء الموديل الخاص بالمستخدمين
use App\Models\User;

class UserController extends Controller
{

     // استعراض المستخدمين باستخدام Eloquent ORM

    public function index()
    {
        // استخدام User::all()
        $users = User::all();
        return view('users', compact('users'));
    }


     // حفظ مستخدم جديد مع الفاليديشن  ORM

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|email|unique:users,email', // منع تكرار الإيميل في قاعدة البيانات
            'password' => 'required'
        ]);

        //  الحفظ باستخدام الـ Eloquent ORM
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password); // تشفير كلمة المرور للحماية
        $user->save();
        return redirect('/users');
    }


     // جلب بيانات مستخدم محدد للتعديل باستخدام الـ ORM

    public function edit($id)
    {
        //    find() و User::all()
        $singleUser = User::find($id);
        $users = User::all();
        return view('users', compact('singleUser', 'users'));
    }


     // تحديث  ORM

    public function update(Request $request)
    {
        // تطبيق الفاليديشن
        $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|email'
        ]);

        $user = User::find($request->id);

        $user->name = $request->name;
        $user->email = $request->email;

        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }

        $user->save(); //حفظ   تلقائي

        return redirect('/users');
    }


     // حذف مستخدم باستخدام الـ ORM

    public function delete($id)
    {
        $user = User::find($id);
        $user->delete();

        return redirect('/users');
    }
}
