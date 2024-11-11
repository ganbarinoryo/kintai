<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class WorkerController extends Controller
{
    public function index()
    {
        // Userモデルからユーザー情報を5件ずつ取得
        $users = User::paginate(5);

        // 取得したユーザー情報をビューに渡す
        return view('worker', compact('users'));
    }
}
