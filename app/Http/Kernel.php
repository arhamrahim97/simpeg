<?php

namespace App\Http;

use Illuminate\Foundation\Http\Kernel as HttpKernel;

class Kernel extends HttpKernel
{
    /**
     * The application's global HTTP middleware stack.
     *
     * These middleware are run during every request to your application.
     *
     * @var array
     */
    protected $middleware = [
        // \App\Http\Middleware\TrustHosts::class,
        \App\Http\Middleware\TrustProxies::class,
        \Fruitcake\Cors\HandleCors::class,
        \App\Http\Middleware\PreventRequestsDuringMaintenance::class,
        \Illuminate\Foundation\Http\Middleware\ValidatePostSize::class,
        \App\Http\Middleware\TrimStrings::class,
        \Illuminate\Foundation\Http\Middleware\ConvertEmptyStringsToNull::class,
    ];

    /**
     * The application's route middleware groups.
     *
     * @var array
     */
    protected $middlewareGroups = [
        'web' => [
            \App\Http\Middleware\EncryptCookies::class,
            \Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse::class,
            \Illuminate\Session\Middleware\StartSession::class,
            // \Illuminate\Session\Middleware\AuthenticateSession::class,
            \Illuminate\View\Middleware\ShareErrorsFromSession::class,
            \App\Http\Middleware\VerifyCsrfToken::class,
            \Illuminate\Routing\Middleware\SubstituteBindings::class,
        ],

        'api' => [
            // \Laravel\Sanctum\Http\Middleware\EnsureFrontendRequestsAreStateful::class,
            'throttle:api',
            \Illuminate\Routing\Middleware\SubstituteBindings::class,
        ],
    ];

    /**
     * The application's route middleware.
     *
     * These middleware may be assigned to groups or used individually.
     *
     * @var array
     */
    protected $routeMiddleware = [
        'auth' => \App\Http\Middleware\Authenticate::class,
        'auth.basic' => \Illuminate\Auth\Middleware\AuthenticateWithBasicAuth::class,
        'cache.headers' => \Illuminate\Http\Middleware\SetCacheHeaders::class,
        'can' => \Illuminate\Auth\Middleware\Authorize::class,
        'guest' => \App\Http\Middleware\RedirectIfAuthenticated::class,
        'password.confirm' => \Illuminate\Auth\Middleware\RequirePassword::class,
        'signed' => \Illuminate\Routing\Middleware\ValidateSignature::class,
        'throttle' => \Illuminate\Routing\Middleware\ThrottleRequests::class,
        'verified' => \Illuminate\Auth\Middleware\EnsureEmailIsVerified::class,

        // Custom Middleware
        'guru' => \App\Http\Middleware\Guru::class,
        'admin' => \App\Http\Middleware\Admin::class,
        'pegawai' => \App\Http\Middleware\Pegawai::class,
        'pejabat' => \App\Http\Middleware\Pejabat::class,
        'timpenilai' => \App\Http\Middleware\TimPenilai::class,
        'kasubag' => \App\Http\Middleware\Kasubag::class,
        'sekretaris' => \App\Http\Middleware\Sekretaris::class,
        'kepaladinas' => \App\Http\Middleware\KepalaDinas::class,
        'gurudanpegawai' => \App\Http\Middleware\GuruDanPegawai::class,
        'adminkepegawaian' => \App\Http\Middleware\AdminKepegawaian::class,
        'admindanadminkepegawaian' => \App\Http\Middleware\AdminDanAdminKepegawaian::class,
        'admindantimpenilai' => \App\Http\Middleware\AdminDanTimPenilai::class,
        'admindankasubag' => \App\Http\Middleware\AdminDanKasubag::class,
        'admindansekretaris' => \App\Http\Middleware\AdminDanSekretaris::class,
        'admindankepaladinas' => \App\Http\Middleware\AdminDanKepalaDinas::class,
    ];
}
