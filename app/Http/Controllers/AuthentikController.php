<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Laravel\Socialite\Facades\Socialite;

class AuthentikController extends Controller
{
    public function login()
    {
        return Socialite::driver('authentik')->redirect();
    }

    public function loginCallback()
    {
        $user = Socialite::driver('authentik')->user();
        $local_user = User::where('ex_id', $user['sub'])->first();

        $ex_email_verified = $user['email_verified'];

        if ($ex_email_verified == true) {
            $ex_email_verified = Carbon::now();
        } else {
            $ex_email_verified = null;
        }

        if ($local_user) {
            $old_email = $local_user['email'];

            /*
            if ($old_email != $user['email']) {
                Whitelist::where('email', $old_email)->update([
                    'email' => $user['email']
                ]);
            }
            */
        }

        /*
        if (app(LoginSettings::class)->whitelist_active) {
            if (!Whitelist::where('email', $user['email'])->exists()) {
                return abort(403, __('middleware.not_on_whitelist'));
            }
        }
        */

        $update_array = [
            'ex_groups' => $user['groups'],
            'email' => $user['email'],
            //'avatar' => $user['avatar'],
            'name' => $user['nickname'],
            //'last_login' => Carbon::now(),
            'email_verified_at' => $ex_email_verified,
        ];

        $f_user_id = null;

        $updated = User::where('ex_id', $user['sub'])->update(
            $update_array
        );

        if (!$updated) {
            if (User::where('ex_id', $user['sub'])->exists()) {
                abort(403, __('middleware.account_deleted'));
            }

            $user = User::create([
                'ex_id' => $user['sub'],
                'ex_groups' => $user['groups'],
                'email' => $user['email'],
                //'avatar' => $user['avatar'],
                'name' => $user['nickname'],
                //'last_login' => Carbon::now(),
                'email_verified_at' => $ex_email_verified,
                'password' => Hash::make(bin2hex(random_bytes(16))),
            ]);

            $updated = true;
            $f_user_id = $user->id;
        }

        if (!$f_user_id) {
            $f_user_id = User::where('ex_id', $user['sub'])->first('id')->id;
        }

        if ($updated == true && ($user != null)) {
            Auth::loginUsingId($f_user_id);
            $auth_user = Auth::user();

            return redirect()->route('filament.admin.pages.dashboard');
        }

        return abort(500, 'Error while login, please contact administrator');
    }


    // Frontchannel Logout
    public function logoutCallback()
    {
        Auth::logout();
        Session::flush();

        return redirect('https://auth.furciety.de/');
    }
}
