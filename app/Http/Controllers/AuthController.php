<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\LoginTracker;
use Carbon\CarbonImmutable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class AuthController extends Controller
{
    // Show student login form
    public function showLogin()
    {
        return view('auth.login');
    }

    // Handle student login
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email', 'regex:/^[a-zA-Z0-9._%+-]+@umindanao\.edu\.ph$/'],
            'password' => ['required'],
        ]);

        // Check if user exists and is a student
        $user = User::where('email', $credentials['email'])->first();
        if (!$user || $user->role !== 'student') {
            return back()->withErrors(['email' => 'Invalid credentials or not a student account.']);
        }

        // Capture timestamps before any DB/session mutation
        $loginTimestamp = CarbonImmutable::now(config('app.timezone'));

        $userId = DB::transaction(function () use ($credentials, $loginTimestamp) {
            // Confirm credentials inside the transaction
            if (!Auth::attempt(['email' => $credentials['email'], 'password' => $credentials['password']])) {
                DB::rollBack();
                return null;
            }
            $uid = Auth::id();
            \App\Models\LoginTracker::create([
                'user_id'    => $uid,
                'login_time' => $loginTimestamp,   // exact server time captured before anything ran
            ]);
            return $uid;
        });

        if (!$userId) {
            return back()->withErrors(['email' => 'Invalid credentials.']);
        }

        $request->session()->regenerate();
        return redirect()->intended('/dashboard');
    }

    // Show admin login form
    public function showAdminLogin()
    {
        return view('auth.admin-login');
    }

    // Handle admin login
    public function adminLogin(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        $user = User::where('email', $credentials['email'])->first();
        if (!$user || $user->role !== 'admin') {
            return back()->withErrors(['email' => 'Invalid credentials or not an admin account.']);
        }

        $loginTimestamp = CarbonImmutable::now(config('app.timezone'));

        $userId = DB::transaction(function () use ($credentials, $loginTimestamp) {
            if (!Auth::attempt(['email' => $credentials['email'], 'password' => $credentials['password']])) {
                DB::rollBack();
                return null;
            }
            $uid = Auth::id();
            \App\Models\LoginTracker::create([
                'user_id'    => $uid,
                'login_time' => $loginTimestamp,
            ]);
            return $uid;
        });

        if (!$userId) {
            return back()->withErrors(['email' => 'Invalid credentials.']);
        }

        $request->session()->regenerate();
        return redirect()->intended(route('admin.home'));
    }

    // Show registration form
    public function showRegister()
    {
        return view('auth.register');
    }

    // Handle registration
    public function register(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users', 'regex:/^[a-zA-Z0-9._%+-]+@umindanao\.edu\.ph$/'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'role' => 'student',
        ]);

        $loginTimestamp = CarbonImmutable::now(config('app.timezone'));

        DB::transaction(function () use ($user, $loginTimestamp) {
            Auth::login($user);
            \App\Models\LoginTracker::create([
                'user_id'    => $user->id,
                'login_time' => $loginTimestamp,
            ]);
        });

        $request->session()->regenerate();

        return redirect('/dashboard');
    }

    // Logout – record the time the logout handler is actually *invoked*
    public function logout(Request $request)
    {
        $logoutTimestamp = CarbonImmutable::now(config('app.timezone'));

        // Capture userId while the session is still alive
        // (before logout destroys it in the lines below)
        $userId = Auth::id();

        if ($userId) {
            \App\Models\LoginTracker::where('user_id', $userId)
                ->orderBy('login_time', 'desc')
                ->whereNull('logout_time')
                ->first()
                ?->update(['logout_time' => $logoutTimestamp]);
        }

        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login');
    }
}
