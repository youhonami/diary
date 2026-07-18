<?php

namespace App\Http\Controllers;

use App\Models\Diary;
use App\Models\User;
use Carbon\Carbon;
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

    public function diaryStore(Request $request)
    {
        if (! Auth::check()) {
            return redirect()->route('login.index');
        }

        $diaryData = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'diary_date' => ['required', 'date'],
            'place' => ['nullable', 'string', 'max:255'],
            'event' => ['required', 'string'],
            'good_thing' => ['required', 'string'],
            'visibility' => ['required', 'in:private,public'],
        ]);

        Diary::create([
            'user_id' => Auth::id(),
            'title' => $diaryData['title'],
            'diary_date' => $diaryData['diary_date'],
            'place' => $diaryData['place'] ?? null,
            'event' => $diaryData['event'],
            'good_thing' => $diaryData['good_thing'],
            'visibility' => $diaryData['visibility'],
        ]);

        return redirect()->route('diary.lookback')->with('message', '日記を保存しました。');
    }

    public function diaryLookback(Request $request)
    {
        $month = $request->input('month', now()->format('Y-m'));

        if (! preg_match('/^\d{4}-\d{2}$/', $month)) {
            $month = now()->format('Y-m');
        }

        $currentMonth = Carbon::createFromFormat('Y-m', $month)->startOfMonth();
        $calendarStart = $currentMonth->copy()->startOfWeek(Carbon::SUNDAY);
        $calendarEnd = $currentMonth->copy()->endOfMonth()->endOfWeek(Carbon::SATURDAY);

        $diaries = Diary::where('user_id', Auth::id())
            ->whereBetween('diary_date', [
                $currentMonth->copy()->startOfMonth(),
                $currentMonth->copy()->endOfMonth(),
            ])
            ->orderBy('diary_date')
            ->orderBy('created_at')
            ->get()
            ->groupBy(fn (Diary $diary) => $diary->diary_date->format('Y-m-d'));

        $weeks = [];
        $date = $calendarStart->copy();

        while ($date <= $calendarEnd) {
            $week = [];

            for ($i = 0; $i < 7; $i++) {
                $week[] = $date->copy();
                $date->addDay();
            }

            $weeks[] = $week;
        }

        return view('diary_lookback', [
            'currentMonth' => $currentMonth,
            'diaries' => $diaries,
            'nextMonth' => $currentMonth->copy()->addMonth()->format('Y-m'),
            'previousMonth' => $currentMonth->copy()->subMonth()->format('Y-m'),
            'weeks' => $weeks,
        ]);
    }

    public function diaryShow(string $date)
    {
        $diaries = Diary::where('user_id', Auth::id())
            ->whereDate('diary_date', $date)
            ->orderBy('created_at')
            ->get();

        if ($diaries->isEmpty()) {
            abort(404);
        }

        return view('diary_show', [
            'date' => Carbon::parse($date),
            'diaries' => $diaries,
        ]);
    }

    public function diaryRead()
    {
        $diaries = Diary::with('user')
            ->where('visibility', 'public')
            ->where('user_id', '!=', Auth::id())
            ->orderByDesc('diary_date')
            ->orderByDesc('created_at')
            ->get();

        return view('diary_read', [
            'diaries' => $diaries,
        ]);
    }

    public function diaryPublicShow(Diary $diary)
    {
        if ($diary->visibility !== 'public' || $diary->user_id === Auth::id()) {
            abort(404);
        }

        $diary->load('user');

        return view('diary_public_show', [
            'diary' => $diary,
        ]);
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

        return redirect()->route('login.index');
    }
}
