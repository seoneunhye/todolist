<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// 모든 요청을 welcome 뷰로 리디렉션 한다.
Route::get('/{any}', function () {
    return view('welcome');
})->where('any','.*'); // 모든 URL 패턴을 해당 라우트로 리디렉션
