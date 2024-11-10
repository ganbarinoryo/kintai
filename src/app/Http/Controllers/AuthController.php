<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Auth\Events\Registered;

class AuthController extends Controller
{
    public function stamp()
    {
        return view('stamp');
    }

    // ユーザー登録処理
    public function register(Request $request)
    {
        // バリデーション
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);

        // バリデーションエラーがあればリダイレクト
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // ユーザー作成
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password), // パスワードをハッシュ化して保存
        ]);

         // ユーザー作成後、確認メールを送信
        event(new Registered($user));

        // サンクスページにリダイレクト
        return redirect()->route('thanks');
    }
}
