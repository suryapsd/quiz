<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\UpdateUserProfileRequest;
use App\Models\User;
use App\Models\Instansi;
use App\Models\Sekolah;
use App\Models\Siswa;
use App\Models\JenisSoal;

class AdminDashboardController extends Controller
{
    private  $active = 'Admin';
    private  $title = 'Dashboard';

    public function dashboard()
    {
        return view('admin.dashboard', [
            "active" => $this->active,
            "title" => $this->title,
            "instansi" => Instansi::all()->count(),
            "sekolah" => Sekolah::all()->count(),  
            "siswa" => Siswa::all()->count(),  
            "jenis_soal" => JenisSoal::all()->count(),  
        ]);
    }

    public function profile(Request $request) {
        $user = $request->user();
        $profile = $user->profile;
        return view("admin.profile")->with([
            "user" => $user,
            "profile" => $profile
        ]);
    }

    public function profileSave(UpdateUserProfileRequest $request, User $user) {
        $data = $request->validated();
        DB::beginTransaction();
        try {
            if(empty($data["password"])) {
                unset($data['password']);
            }
            $user->update($data);
            $profile = $user->profile;
            $profile->update($data);
            DB::commit();
            return redirect()->back()->with("success", "berhasil update profile");
        }catch(\Throwable $th) {
            DB::rollback();
            return redirect()->back()->with("error", "terjadi kesalahan !");
        }
    }
}
