<?php

namespace NasuhTurkmen\Admin\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use NasuhTurkmen\Admin\Facades\Admin;
use NasuhTurkmen\Admin\Form;
use NasuhTurkmen\Admin\Layout\Content;
use Log;


class AuthController extends Controller
{

    public function handleSSO(Request $request)
    {
        $accessToken = $request->query('access_token');
        $csrfToken = $request->query('csrf_token');
        $rate_limit_key = 'login-tries-'.Admin::guardName();

        if (!$accessToken || !$csrfToken) {
            return redirect('/')->with('error', 'Eksik veya geçersiz token');
        }

        try {
            $decodedToken = $this->decodeJWT($accessToken);
            $decodedToken = json_decode(json_encode($decodedToken));

            $uuid = $decodedToken->user_id ?? null;
            if (!$uuid) {
                return redirect('/')->with('error', 'Token içinde UUID bulunamadı');
            }

            $userInfo = $this->fetchUserFromAPI($uuid);
            if (!$userInfo || !$userInfo['success']) {
                return redirect('/')->with('error', 'Kullanıcı bilgileri alınamadı');
            }

            // Kullanıcı bilgileri ile giriş yaptır
            $userData = (array) $userInfo['data'];

            Log::info('User Data:', $userData);

            // Kullanıcıyı oluştur veya güncelle
            $user = User::updateOrCreate(
                ['ntauth_id' => $userData['id']], // Arama kriteri
                [
                    'ntauth_access_token' => $accessToken,
                    'ntauth_refresh_token' => null,
                    'password' => $userData['password'] ?? null,
                ]
            );

            if($this->guard()->attempt($user->toArray())) {
                RateLimiter::clear($rate_limit_key);

                return $this->sendLoginResponse($request);
            }

            if (config('sso.auth.throttle_logins')) {
                $throttle_timeout = config('sso.auth.throttle_timeout', 600);
                RateLimiter::hit($rate_limit_key, $throttle_timeout);
            }
    
            return back()->withInput()->withErrors([
                $this->username() => $this->getFailedLoginMessage(),
            ]);

        } catch (\Exception $e) {
            Log::error('SSO Hatası: ' . $e->getMessage());
            return redirect('/')->with('error', 'Bir hata oluştu.');
        }
    }


    /**
     * @return string|\Symfony\Component\Translation\TranslatorInterface
     */
    protected function getFailedLoginMessage()
    {
        return Lang::has('auth.failed')
            ? trans('auth.failed')
            : 'These credentials do not match our records.';
    }

    /**
     * Get the post login redirect path.
     *
     * @return string
     */
    protected function redirectPath()
    {
        if (method_exists($this, 'redirectTo')) {
            return $this->redirectTo();
        }

        return property_exists($this, 'redirectTo') ? $this->redirectTo : config('sso.route.prefix');
    }

    /**
     * Send the response after the user was authenticated.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\Response
     */
    protected function sendLoginResponse(Request $request)
    {
        admin_toastr(trans('admin.login_successful'));

        $request->session()->regenerate();

        return redirect()->intended($this->redirectPath());
    }

    /**
     * Get the login username to be used by the controller.
     *
     * @return string
     */
    protected function username()
    {
        return 'username';
    }

    /**
     * Get the guard to be used during authentication.
     *
     * @return \Illuminate\Contracts\Auth\StatefulGuard
     */
    protected function guard()
    {
        return Admin::guard();
    }
}
