<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\LoginCredentialsRequest;
use App\Http\Requests\RegisterRequest;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Siswa;

class AuthController extends Controller
{
    public function login() {
        return view("auth.login");
    }

    public function register() {
        return view("auth.register");
    }

    public function registerProcess(RegisterRequest $request) {
        $data = $request->validated();
        DB::beginTransaction();
        try {
            $password = Hash::make($data["password"]);
            $data["password"] = $password;
            $user = User::create($data);
            $data["id_user"] = $user->id;
            Siswa::create($data);
            DB::commit();
            return redirect()->route('auth.login')->with("success", "registrasi berhasil, silahkan login");
        }catch (\Throwable $th) {
            DB::rollback();
            return back()->with("error", "registrasi gagal karena terjadi kesalahan !");
        }
    }

    public function authenticate(LoginCredentialsRequest $request) {
        $credentials = $request->validated();
        if (Auth::attempt($credentials, $request->get('remember'))) {
            $request->session()->regenerate();
            return redirect()->intended(route('dashboard'));
        }
        return back()->withErrors([
            'email' => 'Incorrect credentials',
        ])->onlyInput('email');
    }

    public function logout(Request $request) {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('auth.login');
    }
}
