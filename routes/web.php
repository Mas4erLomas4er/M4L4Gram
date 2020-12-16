<?php

    use App\Http\Controllers\
    {FollowsController, HomeController, PostsController, ProfilesController};
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
        ->middleware('auth');

    Route::get('/p/create', [PostsController::class, 'create'])
        ->name('posts.create')
        ->middleware('auth');

    Route::post('/p', [PostsController::class, 'store'])
        ->name('posts.store')
        ->middleware('auth');

    Route::get('/p/{post}', [PostsController::class, 'show'])
        ->name('posts.show');

    //    Follow / Unfollow
    Route::post('/follow/{user}', [FollowsController::class, 'store'])
        ->name('follow')
        ->middleware('auth');

    //    Email
    Route::get('/email', function () { return new \App\Mail\NewUser(); })
        ->name('posts.index')
        ->middleware('auth');

    //    Profiles
    Route::get('/{user}', [ProfilesController::class, 'show'])
        ->name('profiles.show');

    Route::get('/{user}/edit', [ProfilesController::class, 'edit'])
        ->name('profiles.edit')
        ->middleware('auth');

    Route::patch('/{user}', [ProfilesController::class, 'update'])
        ->name('profiles.update');