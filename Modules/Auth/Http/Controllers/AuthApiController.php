<?php

namespace Modules\Auth\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Sanctum\HasApiTokens;
use Modules\Seller\Entities\Seller;
use Modules\Seller\Http\Requests\SellerApiRequest;
use Modules\Shared\Helpers\Slug;
use Modules\Shared\Http\Responses\ApiResponse;
use Modules\User\Entities\User;
use Modules\User\Http\Requests\UserApiRequest;
use Symfony\Component\HttpFoundation\Response;

class AuthApiController extends Controller
{
    use HasApiTokens;

    public function loginUser(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'string', 'email', 'exists:users,email'],
            'password' => ['required', 'string', 'min:6', 'max:255']
        ], attributes: [
            'email' => 'البريد الإلكتروني'
        ]);
        return $this->login($credentials, $request->userAgent());
    }

    public function loginSeller(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'string', 'email', 'exists:sellers,email'],
            'password' => ['required', 'string', 'min:6', 'max:255']
        ], attributes: [
            'email' => 'البريد الإلكتروني'
        ]);
        return $this->login($credentials, $request->userAgent(), 'seller');
    }

    public function login($credentials, $userAgent, $guard = 'user')
    {
        if (Auth::guard($guard)->attempt($credentials)) {
            $seller = Auth::guard($guard)->user();
            $token = $seller->createToken($userAgent . ':' . $guard)->plainTextToken;
            $seller->update(['last_active_at' => now()]);
            return response()->json(['data' => ['status' => 'success', 'token' => $token]], Response::HTTP_OK);
        }

        return response()->json(['data' => ['status' => 'failed', 'error' => 'Unauthorized']], Response::HTTP_UNAUTHORIZED);
    }

    public function registerUser(UserApiRequest $request)
    {
        try {
            \DB::beginTransaction();
            $user = User::create($request->validated());
            if ($request->hasFile('avatar')) {
                $file = $request->file('avatar');
                $path = $user->uploadOnDisk($file, str_replace(' ', '_', $user->name));
                $user->storeImage($path, Slug::ar(pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME)), 'avatar');
            }
            \DB::commit();
        } catch (\Throwable $th) {
            \DB::rollBack();
        }

        event(new Registered($user));
        return ApiResponse::success($user, 'Create New Account Successfully. Please Verify Your Email!');
    }

    public function registerSeller(SellerApiRequest $request)
    {
        try {
            \DB::beginTransaction();
            $seller = Seller::create($request->validated());
            if ($request->hasFile('avatar')) {
                $file = $request->file('avatar');
                $path = $seller->uploadOnDisk($file, str_replace(' ', '_', $seller->name));
                $seller->storeImage($path, Slug::ar(pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME)), 'avatar');
            }
            \DB::commit();
        } catch (\Throwable $th) {
            \DB::rollBack();
        }

        event(new Registered($seller));
        return ApiResponse::success($seller, 'Create New Account Successfully. Please Verify Your Email!');
    }

    public function verify($id, $hash)
    {
        $user = Seller::where('id', $id)->first();
        if (!$user) {
            $user = User::where('id', $id)->firstOrFail();
        }

        if ($hash != sha1($user->email)) {
            abort('404');
        }

        if ($user->hasVerifiedEmail()) {
            return to_route('home');
        }

        $user->markEmailAsVerified();

        return to_route('home');
    }

    public function logout(Request $request)
    {
        $user = $request->user();
        if ($user) {
            $user->tokens()->delete();
        }
        return response()->json(['status' => 'success', 'message' => "Logout Opertion Done Successfully"]);
    }
}
