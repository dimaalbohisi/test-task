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

        // جلب البيانات الحقيقية من الجدول
        $users = DB::table('site_users')->get();

        // نمرر الاسم، الأقسام، والمستخدمين الجدد للـ view
        return view('register', [
            'name' => null,
            'departments' => $departments,
            'users' => $users // أرسلنا المتغير الجديد للجدول
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

        // لكي يعمل تحديث تلقائي للصفحة بعد الحفظ
        return redirect()->back();
    }

    //   id دالة حذف المستخدم بناءً على الـ
    public function destroy($id)
    {
        DB::table('site_users')->where('id', $id)->delete();

        //  لتحديث الجدول فوراً بعد الحذف
        return redirect()->back();
    }

    //  دالة جلب بيانات المستخدم المحددة لعرضها في فورم التعديل
    public function edit($id)
    {
        $name = null;

        $departments = [
            '01' => 'Technical',
            '02' => 'Financial',
            '03' => 'Sales'
        ];

        $user = DB::table('site_users')->where('id', $id)->first();

        $users = DB::table('site_users')->get();

        return view('register', compact('name', 'user', 'users', 'departments'));
    }

    //  دالة حفظ البيانات الجديدة بعد التعديل في قاعدة البيانات
    public function update(Request $request)
    {
        $departments = [
            '01' => 'Technical',
            '02' => 'Financial',
            '03' => 'Sales'
        ];
        $departmentName = $departments[$request->department] ?? 'Unknown';

        DB::table('site_users')->where('id', $request->id)->update([
            'name' => $request->name,
            'department' => $departmentName,
            'updated_at' => now()
        ]);

        return redirect('/register');
    }
}
