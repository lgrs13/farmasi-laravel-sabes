<?php

namespace App\Http\Controllers\auth;


use App\Models\User;
use App\Models\Pegawai;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;

class LoginController extends Controller
{
    public function index()
    {
        return view('auth/auth-login');
    }

    public function loginAction(Request $request)
    {
        // echo $request->input('emailInLogin');
        $data = User::where('username', $request->input('emailInLogin'))
            ->where('password', MD5($request->input('passwordInLogin')))
            ->where('is_active', '=',1);
        if ($data->count() > 0) {
            $result = $data->first();
            $user = Pegawai::where('nik', $result->id_user)->first();            
            $ppa = DB::table('data_level_user_erm as a')
            ->join('data_level_erm as b', 'a.level', '=', 'b.level')
            ->where('a.id_user', '=', $result->id_user)
            ->first();
            $request->session()->put(
                'user',
                [
                    'id_user' => $result->id_user,
                    'id_level' => $result->id_level,
                    'nama_user' => $user->nama,
                    'ppa_level' => $ppa->level,
                    'ppa_nama' => $ppa->keterangan,
                ]
            );

            $request->session()->put(
                'perawatan',
                [
                    'type' => '0'
                ]
            ); 

            // dd($request->session('user'));

            if (!session()->has('url.intended')) {
                return Redirect('/main');
            } else {
                return Redirect(session()->get('url.intended'));
            }

        } else {
            // $request->session()->now('status', 'Login gagal Silahkan Coba Lagi');
            return Redirect("/")->with(
                ['error' => 'User dan password yang anda masukan salah']
            );
        }
    }

    public function logOutAction(Request $request)
    {
        $request->session()->flush();
        return  redirect('/');
    }
}
