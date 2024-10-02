<?php

namespace App\Http\Controllers;

use App\Models\OauthProvider;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Laravel\Socialite\Facades\Socialite;
use Laravel\Socialite\Contracts\User as SocialiteUser;

class OauthProviderController extends Controller
{
    /**
     * Redirect ke halaman login Google.
     */
    public function redirectToProvider(string $provider)
    {
        $decoded_provider = base64_decode($provider);
        if (request('type') == 'admin') {
            session()->put('redirect_role', 'admin');
        } else {
            session()->put('redirect_role', 'user');
        }
        if (Hash::check('google', $decoded_provider)) {
            return Socialite::driver('google')->redirect();
        }
        
    }

    /**
     * Handle callback dari Google.
     */
    public function handleGoogleCallback()
    {
        $googleUser = Socialite::driver('google')->stateless()->user();

        if (session('redirect_role') == 'admin') {
            $admin = User::where('email', $googleUser->getEmail())->first();
            if ($admin->role == 'admin') {
                Auth::login($admin);
                session()->forget('redirect_role');
                return redirect()->route('admin.dashboard');
            } else {
                return "<script>alert('Anda tidak memiliki akses ke halaman admin, karena email Anda tidak terdaftar sebagai admin');window.location = '".route('admin.login')."';</script>";
            }
        }

        $user = $this->findOrCreateUser($googleUser, 'google');

        Auth::login($user);

        return redirect()->route('frontend.index');
    }

    /**
     * Mencari user berdasarkan provider atau membuat user baru.
     */
    protected function findOrCreateUser(SocialiteUser $socialiteUser, string $provider)
    {
        // Cek apakah sudah ada user dengan provider ini
        $oauthProvider = OauthProvider::where('provider', $provider)
                        ->where('oauth_id', $socialiteUser->getId())
                        ->first();

        if ($oauthProvider) {
            // Jika sudah ada, kembalikan user yang terkait
            return $oauthProvider->user;
        }

        // Jika user tidak ada, cari berdasarkan email
        $user = User::where('email', $socialiteUser->getEmail())->first();

        if (!$user) {
            $newUser = [
                'name' => $socialiteUser->getName(),
                'email' => $socialiteUser->getEmail(),
                'avatar' => $socialiteUser->getAvatar(), 
                'role' => 'user',
                'password' => Hash::make($socialiteUser->getId()),
                'email_verified_at' => now(),
            ];

            if ($socialiteUser->getAvatar()) {
                $avatarContents = file_get_contents($socialiteUser->getAvatar());
                $filename = 'uploads/users/' . $socialiteUser->getId() . '.jpg';
                Storage::disk('public')->put($filename, $avatarContents);
                $newUser['photo'] = $filename;
            }
            // Jika tidak ada user dengan email tersebut, buat user baru
            $user = User::create($newUser);
        }

        // Simpan OAuth provider info
        $user->oauthProviders()->create([
            'provider' => $provider,
            'oauth_id' => $socialiteUser->getId(),
        ]);

        return $user;
    }
}