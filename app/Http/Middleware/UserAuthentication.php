<?php

namespace App\Http\Middleware;

use App\Http\Repositories\UserAuthRepository;
use Closure;
use Illuminate\Http\Request;

class UserAuthentication
{
    private $userAuthRepository;

    public function __construct(UserAuthRepository $userAuthRepository)
    {
        $this->userAuthRepository = $userAuthRepository;
    }
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $user = $this->userAuthRepository->getUserAuthData(explode(' ', request()->header('Authorization'))[1]);

        if ($user) {
            return $next($request);
        }

        return response()->json([
            'success' => false,
            'message' => 'Unauthenticated.',
            'code' => \Illuminate\Http\Response::HTTP_UNAUTHORIZED,
            'data' => (object) []], 401);
    }
}