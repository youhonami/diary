<?php

namespace App\Http\Controllers;

use App\Models\Diary;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
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
        ], [
            'email.required' => 'メールアドレスを入力してください。',
            'email.email' => 'メールアドレスを正しく入力してください。',
            'password.required' => 'パスワードを入力してください。',
            'password.min' => 'パスワードは6文字以上で入力してください。',
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            return redirect()->route('toppage');
        }

        return back()
            ->withInput($request->only('email'))
            ->with('login_error', 'メールアドレスまたはパスワードが正しくありません。');
    }

    public function register()
    {
        return view('register');
    }

    public function withdrawal()
    {
        return view('withdrawal');
    }

    public function withdraw(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required', 'min:6'],
        ], [
            'email.required' => 'メールアドレスを入力してください。',
            'email.email' => 'メールアドレスを正しく入力してください。',
            'password.required' => 'パスワードを入力してください。',
            'password.min' => 'パスワードは6文字以上で入力してください。',
        ]);

        $user = User::where('email', $credentials['email'])->first();

        if (! $user || ! Hash::check($credentials['password'], $user->password)) {
            return back()
                ->withInput($request->only('email'))
                ->with('withdrawal_error', 'メールアドレスまたはパスワードが正しくありません。');
        }

        if (Auth::id() === $user->id) {
            Auth::logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();
        }

        if ($user->icon_path && file_exists(public_path($user->icon_path))) {
            unlink(public_path($user->icon_path));
        }

        $user->delete();

        return redirect()->route('login.index')->with('withdrawal_message', '退会が完了しました。');
    }

    public function store(Request $request)
    {
        $userData = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'unique:users,email'],
            'password' => ['required', 'min:6', 'confirmed'],
        ], [
            'name.required' => '名前を入力してください。',
            'email.required' => 'メールアドレスを入力してください。',
            'email.email' => 'メールアドレスを正しく入力してください。',
            'email.unique' => 'このメールアドレスは既に使用されています。',
            'password.required' => 'パスワードを入力してください。',
            'password.min' => 'パスワードは6文字以上で入力してください。',
            'password.confirmed' => 'パスワードが一致しません。',
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
        if (! Auth::check()) {
            return redirect()->route('login.index');
        }

        return view('toppage', [
            'user' => Auth::user(),
        ]);
    }

    public function diaryCreate()
    {
        if (! Auth::check()) {
            return redirect()->route('login.index');
        }

        return view('diary_create', [
            'user' => Auth::user(),
        ]);
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
            'good_thing' => ['nullable', 'string'],
            'visibility' => ['required', 'in:private,public'],
        ], [
            'title.required' => 'タイトルを入力してください。',
            'diary_date.required' => '日付を入力してください。',
            'diary_date.date' => '日付を正しく入力してください。',
            'event.required' => '出来事を入力してください。',
        ]);

        Diary::create([
            'user_id' => Auth::id(),
            'title' => $diaryData['title'],
            'diary_date' => $diaryData['diary_date'],
            'place' => $diaryData['place'] ?? null,
            'event' => $diaryData['event'],
            'good_thing' => $diaryData['good_thing'] ?? '',
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
            'user' => Auth::user(),
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
            'user' => Auth::user(),
            'date' => Carbon::parse($date),
            'diaries' => $diaries,
        ]);
    }

    public function diaryEdit(Diary $diary)
    {
        if (! Auth::check()) {
            return redirect()->route('login.index');
        }

        if ($diary->user_id !== Auth::id()) {
            abort(403);
        }

        return view('diary_edit', [
            'diary' => $diary,
        ]);
    }

    public function diaryUpdate(Request $request, Diary $diary)
    {
        if (! Auth::check()) {
            return redirect()->route('login.index');
        }

        if ($diary->user_id !== Auth::id()) {
            abort(403);
        }

        $diaryData = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'diary_date' => ['required', 'date'],
            'place' => ['nullable', 'string', 'max:255'],
            'event' => ['required', 'string'],
            'good_thing' => ['nullable', 'string'],
            'visibility' => ['required', 'in:private,public'],
        ], [
            'title.required' => 'タイトルを入力してください。',
            'diary_date.required' => '日付を入力してください。',
            'diary_date.date' => '日付を正しく入力してください。',
            'event.required' => '出来事を入力してください。',
        ]);

        $diary->update([
            'title' => $diaryData['title'],
            'diary_date' => $diaryData['diary_date'],
            'place' => $diaryData['place'] ?? null,
            'event' => $diaryData['event'],
            'good_thing' => $diaryData['good_thing'] ?? '',
            'visibility' => $diaryData['visibility'],
        ]);

        return redirect()
            ->route('diary.show', ['date' => $diary->diary_date->format('Y-m-d')])
            ->with('message', '日記を更新しました。');
    }

    public function diaryDestroy(Diary $diary)
    {
        if (! Auth::check()) {
            return redirect()->route('login.index');
        }

        if ($diary->user_id !== Auth::id()) {
            abort(403);
        }

        $date = $diary->diary_date->format('Y-m-d');
        $month = $diary->diary_date->format('Y-m');

        $diary->delete();

        $remainingCount = Diary::where('user_id', Auth::id())
            ->whereDate('diary_date', $date)
            ->count();

        if ($remainingCount === 0) {
            return redirect()
                ->route('diary.lookback', ['month' => $month])
                ->with('message', '日記を削除しました。');
        }

        return redirect()
            ->route('diary.show', ['date' => $date])
            ->with('message', '日記を削除しました。');
    }

    public function diaryRead()
    {
        if (! Auth::check()) {
            return redirect()->route('login.index');
        }

        $diaries = Diary::with('user')
            ->where('visibility', 'public')
            ->where('user_id', '!=', Auth::id())
            ->orderByDesc('diary_date')
            ->orderByDesc('created_at')
            ->get();

        return view('diary_read', [
            'user' => Auth::user()->fresh(),
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
            'user' => Auth::user(),
            'diary' => $diary,
        ]);
    }

    public function settings()
    {
        return view('settings');
    }

    public function userEdit()
    {
        if (! Auth::check()) {
            return redirect()->route('login.index');
        }

        return view('user_edit', [
            'user' => Auth::user(),
        ]);
    }

    public function userUpdate(Request $request)
    {
        if (! Auth::check()) {
            return redirect()->route('login.index');
        }

        $user = Auth::user();

        $userData = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', Rule::unique('users', 'email')->ignore($user->id)],
            'password' => ['nullable', 'min:6', 'confirmed'],
        ], [
            'name.required' => '名前を入力してください。',
            'email.required' => 'メールアドレスを入力してください。',
            'email.email' => 'メールアドレスを正しく入力してください。',
            'email.unique' => 'このメールアドレスは既に使用されています。',
            'password.min' => 'パスワードは6文字以上で入力してください。',
            'password.confirmed' => 'パスワードが一致しません。',
        ]);

        $user->name = $userData['name'];
        $user->email = $userData['email'];

        if (! empty($userData['password'])) {
            $user->password = Hash::make($userData['password']);
        }

        $user->save();

        return redirect()->route('user.edit')->with('message', 'ユーザー情報を更新しました。');
    }

    public function profileEdit()
    {
        if (! Auth::check()) {
            return redirect()->route('login.index');
        }

        return view('profile_edit', [
            'user' => Auth::user(),
        ]);
    }

    public function profileUpdate(Request $request)
    {
        if (! Auth::check()) {
            return redirect()->route('login.index');
        }

        $user = Auth::user();

        $profileData = $request->validate([
            'username' => ['nullable', 'string', 'max:255'],
            'birthday' => ['nullable', 'date'],
            'icon' => ['nullable', 'image', 'max:2048'],
            'bio' => ['nullable', 'string', 'max:1000'],
            'birthplace' => ['nullable', 'string', 'max:255'],
            'email' => ['nullable', 'email', Rule::unique('users', 'email')->ignore($user->id)],
            'phone_number' => ['nullable', 'string', 'max:20', 'regex:/^0\d{9,10}$|^0\d{1,4}-\d{1,4}-\d{3,4}$/'],
        ], [
            'username.max' => 'ユーザーネームは255文字以内で入力してください。',
            'birthday.date' => '生年月日を正しく入力してください。',
            'icon.image' => 'アイコンは画像ファイルを選択してください。',
            'icon.max' => 'アイコンは2MB以下の画像を選択してください。',
            'bio.max' => '自己紹介は1000文字以内で入力してください。',
            'birthplace.max' => '出身地は255文字以内で入力してください。',
            'email.email' => 'メールアドレスを正しく入力してください。',
            'email.unique' => 'このメールアドレスは既に使用されています。',
            'phone_number.max' => '電話番号は20文字以内で入力してください。',
            'phone_number.regex' => '電話番号を正しく入力してください。',
        ]);

        $user->username = $profileData['username'] ?? null;
        $user->birthday = $profileData['birthday'] ?? null;
        $user->bio = $profileData['bio'] ?? null;
        $user->birthplace = $profileData['birthplace'] ?? null;
        if (! empty($profileData['email'])) {
            $user->email = $profileData['email'];
        }
        $user->phone_number = $profileData['phone_number'] ?? null;

        if ($request->hasFile('icon')) {
            $icon = $request->file('icon');
            $directory = public_path('profile_icons');
            $filename = 'user_' . $user->id . '_' . time() . '.' . $icon->extension();

            if (! is_dir($directory)) {
                mkdir($directory, 0755, true);
            }

            $icon->move($directory, $filename);
            $user->icon_path = 'profile_icons/' . $filename;
        }

        $user->save();

        return redirect()->route('profile.edit')->with('message', 'プロフィールを更新しました。');
    }

    public function backgroundEdit()
    {
        if (! Auth::check()) {
            return redirect()->route('login.index');
        }

        return view('background_edit', [
            'user' => Auth::user(),
            'backgrounds' => [
                'sky' => '青空',
                'sunset' => '夕焼け',
                'night' => '夜空',
                'mint' => 'ミント',
            ],
        ]);
    }

    public function backgroundUpdate(Request $request)
    {
        if (! Auth::check()) {
            return redirect()->route('login.index');
        }

        $backgroundData = $request->validate([
            'toppage_background' => ['required', 'in:sky,sunset,night,mint'],
        ], [
            'toppage_background.required' => '背景を選択してください。',
            'toppage_background.in' => '背景を正しく選択してください。',
        ]);

        $user = Auth::user();
        $user->toppage_background = $backgroundData['toppage_background'];
        $user->save();

        return redirect()->route('background.edit')->with('message', '背景テーマを更新しました。');
    }

    public function mapsEdit()
    {
        if (! Auth::check()) {
            return redirect()->route('login.index');
        }

        return view('maps_edit');
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login.index');
    }
}
