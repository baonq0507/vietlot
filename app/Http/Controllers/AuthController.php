<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function login()
    {
        return view('auth.login');
    }

    public function register()
    {
        return view('auth.register');
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('login');
    }

    public function loginPost(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'username' => 'required',
            'password' => 'required',
        ], [
            'username.required' => 'Tên tài khoản không được để trống',
            'password.required' => 'Mật khẩu không được để trống',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()->first()], 422);
        }

        if (Auth::attempt($request->only('username', 'password'))) {
            return response()->json(['message' => 'Đăng nhập thành công'], 200);
        }

        return response()->json(['error' => 'Tên tài khoản hoặc mật khẩu không chính xác'], 401);
    }

    public function registerPost(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'username' => 'required|unique:users',
            'password' => 'required|min:8',
            'password_confirmation' => 'required|same:password',
            'phone' => 'required|numeric|digits:10|unique:users',
        ], [
            'username.required' => 'Tên tài khoản không được để trống',
            'username.unique' => 'Tên tài khoản đã tồn tại',
            'password.required' => 'Mật khẩu không được để trống',
            'password.min' => 'Mật khẩu phải có ít nhất 8 ký tự',
            'password_confirmation.required' => 'Nhập lại mật khẩu không được để trống',
            'password_confirmation.same' => 'Nhập lại mật khẩu không khớp',
            'phone.required' => 'Số điện thoại không được để trống',
            'phone.numeric' => 'Số điện thoại phải là số',
            'phone.digits' => 'Số điện thoại phải có 10 số',
            'phone.unique' => 'Số điện thoại đã tồn tại',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()->first()], 422);
        }

        $user = User::create([
            'username' => $request->username,
            'password' => Hash::make($request->password),
            'phone' => $request->phone,
        ]);

        if ($user) {
            Auth::login($user);
            return response()->json(['message' => 'Đăng ký thành công'], 200);
        }

        return response()->json(['error' => 'Đăng ký thất bại'], 401);
    }
}
