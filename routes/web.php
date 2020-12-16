<?php

    use App\Http\Controllers\
    {FollowsController, HomeController, PostsController, ProfilesController, VerificationController};
    use App\Mail\NewUser;
    use Illuminate\Foundation\Auth\EmailVerificationRequest;
    use Illuminate\Support\Facades\
    {Auth, Mail, Route};

    /*
    |--------------------------------------------------------------------------
    | Web Routes
    |--------------------------------------------------------------------------
    |
    | Here is where you can register web routes for your application. These
    | routes are loaded by the RouteServiceProvider within a group which
    | contains the "web" middleware group. Now create something great!
    |
    */


    Auth::routes();

    //    Posts
    Route::get('/', [PostsController::class, 'index'])
        ->name('posts.index')
        ->middleware('auth', 'verified');

    Route::get('/p/create', [PostsController::class, 'create'])
        ->name('posts.create')
        ->middleware('auth', 'verified');

    Route::post('/p', [PostsController::class, 'store'])
        ->name('posts.store')
        ->middleware('auth', 'verified');

    Route::get('/p/{post}', [PostsController::class, 'show'])
        ->name('posts.show');

    //    Follow / Unfollow
    Route::post('/follow/{user}', [FollowsController::class, 'store'])
        ->name('follow')
        ->middleware('auth', 'verified');

    //    Email Verification
    Route::get('/email/verify', [VerificationController::class, 'notice'])
        ->middleware('auth')
        ->name('verification.notice');

    Route::get('/email/verify/{id}/{hash}', [VerificationController::class, 'verify'])
        ->middleware(['auth', 'signed'])
        ->name('verification.verify');

    Route::post('/email/verification-notification', [VerificationController::class, 'send'])
        ->middleware(['auth', 'throttle:6,1'])
        ->name('verification.send');

    //    Profiles
    Route::get('/{user}', [ProfilesController::class, 'show'])
        ->name('profiles.show');

    Route::get('/{user}/edit', [ProfilesController::class, 'edit'])
        ->name('profiles.edit')
        ->middleware('auth');

    Route::patch('/{user}', [ProfilesController::class, 'update'])
        ->name('profiles.update');