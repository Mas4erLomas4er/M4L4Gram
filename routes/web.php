<?php

    use App\Http\Controllers\
    {FollowsController, HomeController, PostsController, ProfilesController};
    use Illuminate\Foundation\Auth\EmailVerificationRequest;
    use Illuminate\Support\Facades\
    {Auth, Route};

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
        ->middleware('auth', 'verify');

    Route::get('/p/create', [PostsController::class, 'create'])
        ->name('posts.create')
        ->middleware('auth', 'verify');

    Route::post('/p', [PostsController::class, 'store'])
        ->name('posts.store')
        ->middleware('auth', 'verify');

    Route::get('/p/{post}', [PostsController::class, 'show'])
        ->name('posts.show');

    //    Follow / Unfollow
    Route::post('/follow/{user}', [FollowsController::class, 'store'])
        ->name('follow')
        ->middleware('auth', 'verify');

    //    Email Verification
    Route::get('/email/verify',
        function () { return view('auth.verify'); })
        ->middleware('auth')
        ->name('verification.notice');

    Route::get('/email/verify/{id}/{hash}',
        function (EmailVerificationRequest $request)
        {
            $request->fulfill();
            return redirect(\route('posts.index'));
        })
        ->middleware(['auth', 'signed'])
        ->name('verification.verify');

    Route::post('/email/verification-notification',
        function (Request $request)
        {
            $request->user()->sendEmailVerificationNotification();
            return back()->with('message', 'Verification link sent!');
        })
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