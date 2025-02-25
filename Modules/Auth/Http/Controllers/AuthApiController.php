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
use Symfony\Component\HttpFoundation\Response;

class AuthApiController extends Controller
{
    use HasApiTokens;

    public function loginUser(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'string', 'email', 'exists:users,email'],
            'password' => ['required', 'string', 'min:6', 'max:255']
        ],attributes: [
            'email' => 'البريد الإلكتروني'
        ]);
        return $this->login($credentials, $request->userAgent());
    }

    public function loginSeller(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'string', 'email', 'exists:sellers,email'],
            'password' => ['required', 'string', 'min:6', 'max:255']
        ], attributes:[
            'email' => 'البريد الإلكتروني'
        ]);
        return $this->login($credentials, $request->userAgent(), 'seller');
    }

    public function login($credentials, $userAgent, $guard = 'user')
    {
        if (Auth::guard($guard)->attempt($credentials)) {
            $seller = Auth::guard($guard)->user();
            $token = $seller->createToken($userAgent . ':' . $guard)->plainTextToken;

            return response()->json(['data'=>['status' => 'success', 'token' => $token]], Response::HTTP_OK);
        }

        return response()->json(['data'=>['status' => 'failed', 'error' => 'Unauthorized']], Response::HTTP_UNAUTHORIZED);
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
        return ApiResponse::success($seller, 'Create New Seller Account Successfully. Please Verify Your Email!');
    }

    public function verify($id, $hash)
    {
        $user = Seller::findOrFail($id);

        if ($hash != sha1($user->email)) {
            abort('404');
        }

        if ($user->hasVerifiedEmail()) {
            return to_route('home');
        }

        $user->markEmailAsVerified();

        return to_route('home');
    }
}
