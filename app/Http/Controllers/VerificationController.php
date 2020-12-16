<?php

    namespace App\Http\Controllers;

    use App\Mail\NewUser;
    use Illuminate\Foundation\Auth\EmailVerificationRequest;
    use Illuminate\Http\Request;
    use Illuminate\Support\Facades\Mail;

    class VerificationController extends Controller
    {
        public function notice ()
        {
            return view('auth.verify');
        }

        public function verify (EmailVerificationRequest $request)
        {
            $request->fulfill();
            $user = \auth()->user();
            Mail::to($user->email)->send(new NewUser($user));
            return redirect(\route('posts.index'));
        }

        function send (Request $request)
        {
            $request->user()->sendEmailVerificationNotification();
            return back()->with('message', 'Verification link sent!');
        }
    }
