<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    public function index()
    {
        return view('index');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required', 'min:6'],
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            return redirect()->route('toppage');
        }

        return back()->with('login_error', 'メールアドレスまたはパスワードが正しくありません。');
    }

    public function register()
    {
        return view('register');
    }

    public function store(Request $request)
    {
        $userData = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'unique:users,email'],
            'password' => ['required', 'min:6', 'confirmed'],
        ]);

        $user = User::create([
            'name' => $userData['name'],
            'email' => $userData['email'],
            'password' => Hash::make($userData['password']),
        ]);

        Auth::login($user);
        $request->session()->regenerate();

        return redirect()->route('toppage');
    }

    public function toppage()
    {
        return view('toppage');
    }

    public function diaryCreate()
    {
        return view('diary_create');
    }

    public function diaryLookback()
    {
        return view('diary_lookback');
    }

    public function diaryRead()
    {
        return view('diary_read');
    }

    public function settings()
    {
        return view('settings');
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}
