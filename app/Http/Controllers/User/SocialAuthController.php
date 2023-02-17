<?php

namespace App\Http\Controllers\User;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\Validator;

class SocialAuthController extends Controller
{
  public function redirectGoogle()
  {
    return Socialite::driver('google')->redirect();
  }

  public function redirectFacebook()
  {
    return Socialite::driver('facebook')->redirect();
  }

  public function callBackGoogle()
  {
    $google_user = Socialite::driver('google')->user();

    $existUser = User::where('google_id', $google_user->getId())->first();
    if ($existUser && !Auth::user()) {
      Auth::login($existUser);
      Session::flash('flashy__info', 'Hey Bro!! Welcome');
      return redirect()->route('user_dashboard');
    }
    if (!$existUser && !Auth::user()) {
      Session::flash('flashy__info', __('Please login manually & Sync your account!'));
      return redirect()->route('user_login');
    }
    if ($existUser && $existUser->id == Auth::user()->id) {
      Session::flash('flashy__success', __('Already Synced with this gmail!'));
      return redirect()->route('myProfile', $existUser->id);
    }
    $user = User::find(Auth::user()->id);
    $user->google_id = $google_user->getId();
    $user->email = $google_user->email;
    $user->save();
    Session::flash('flashy__success', __('Sync Done! You can login with Google'));
    return redirect()->route('myProfile', $user->id);
  }

  public function callBackFacebook()
  {
    $facebook_user = Socialite::driver('facebook')->user();
    $roles = Role::whereNotIn('name', ['super_admin', 'admin'])->get();
    $userWithEmail = User::where('email', $facebook_user->email)->first();
    if ($userWithEmail) {
      $facebookUser = User::where('facebook_id', $facebook_user->id)->first();
      if ($facebookUser) {
        if ($facebookUser && !$facebookUser->is_active) {
          Alert::error('Login Failed!', 'Your account has been suspended!');
          return Redirect::to('/');
        }
        if ($facebookUser && !$facebookUser->is_approved) {
          Alert::error('Login Failed!', 'Your account is not approved!');
          return Redirect::to('/');
        }
        Auth::login($facebookUser);
        return Redirect::route('frontend.profile');
      } else {
        $userWithEmail->facebook_id = $facebook_user->id;
        $userWithEmail->save();
        if ($userWithEmail && !$userWithEmail->is_active) {
          Alert::error('Login Failed!', 'Your account has been suspended!');
          return Redirect::to('/');
        }
        if ($userWithEmail && !$userWithEmail->is_approved) {
          Alert::error('Login Failed!', 'Your account is not approved!');
          return Redirect::to('/');
        }
        Auth::login($userWithEmail);
        return Redirect::route('frontend.profile');
      }
    } else {
      $facebookUser = User::where('facebook_id', $facebook_user->id)->first();
      if ($facebookUser) {
        if ($facebookUser && !$facebookUser->is_active) {
          Alert::error('Login Failed!', 'Your account has been suspended!');
          return Redirect::to('/');
        }
        if ($facebookUser && !$facebookUser->is_approved) {
          Alert::error('Login Failed!', 'Your account is not approved!');
          return Redirect::to('/');
        }
        Auth::login($facebookUser);
        return Redirect::route('frontend.profile');
      }
      return view('frontend.sociallogin.facebook-registration', compact('facebook_user', 'roles'));
    }
  }


  public function store(Request $request)
  {
    try {
      $validator = Validator::make($request->all(), [
        // 'email' => 'required|email|unique:users,email',
        'roles' => 'required'
      ]);

      $validator->sometimes('master_brand_id', 'required', function ($input) {
        return $input->roles == 3;
      });
      if ($request->roles == 3 || $request->roles == 6) {
        $isApproved = 0;
      } else {
        $isApproved = 1;
      }
      $user = User::create([
        'email' => $request->email,
        'google_id' => $request->google_id ?? '',
        'facebook_id' => $request->facebook_id ?? '',
        'name' => $request->name,
        'department' => $request->department,
        'designation' => $request->designation,
        'master_brand_id' => $request->master_brand_id,
        'password' => bcrypt('12345678'),
        'is_active' => 1,
        'is_approved' => $isApproved,
        'is_otp_verified' => 1,
      ]);
      if ($user) {
        $user->assignRole([$request->roles]);
        if (($request->roles == 3 || $request->roles == 6) && $user->is_approved == 0) {
          Alert::success('Congrats', 'Your account has been successfully created. You will be notified once it has been approved');
          return Redirect::to('/');
        }
        $user->notify(new ProfileCompletionNotification("Please Complete Your Profile"));
        Auth::loginUsingId($user->id);
        Auth::login($user);
        return Redirect::route('frontend.profile');
      }
    } catch (\Throwable $th) {
      Alert::error('Sorry!', $th->getMessage());
      return Redirect::to('/');
    }
  }
}
