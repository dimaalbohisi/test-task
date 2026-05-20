<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RegisterController;

Route::redirect('/', '/register');

Route::get('/register', [RegisterController::class, 'index']);

Route::post('/register', [RegisterController::class, 'store']);

// المتغير {id} يستقبل رقم المستخدم ويوجّه الطلب فوراً لدالة destroy
Route::post('/user/delete/{id}', [RegisterController::class, 'destroy']);

// مسار لجلب بيانات المستخدم للتعديل
Route::get('/user/edit/{id}', [RegisterController::class, 'edit']);

// مسار لاستقبال البيانات المحدثة والحفظ في قاعدة البيانات
Route::post('/user/update', [RegisterController::class, 'update']);
