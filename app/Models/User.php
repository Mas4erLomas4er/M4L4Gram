<?php

    namespace App\Models;

    use App\Mail\NewUser;
    use Illuminate\Contracts\Auth\MustVerifyEmail;
    use Illuminate\Database\Eloquent\Factories\HasFactory;
    use Illuminate\Foundation\Auth\User as Authenticatable;
    use Illuminate\Notifications\Notifiable;
    use Illuminate\Support\Facades\Mail;

    /**
     * @property mixed id
     * @property mixed username
     * @property mixed name
     * @property mixed email
     * @property mixed password
     */
    class User extends Authenticatable implements MustVerifyEmail
    {
        use HasFactory, Notifiable;

        /**
         * The attributes that are mass assignable.
         *
         * @var array
         */
        protected $fillable = [
            'name',
            'username',
            'email',
            'password',
        ];

        /**
         * The attributes that should be hidden for arrays.
         *
         * @var array
         */
        protected $hidden = [
            'password',
            'remember_token',
        ];

        /**
         * The attributes that should be cast to native types.
         *
         * @var array
         */
        protected $casts = [
            'email_verified_at' => 'datetime',
        ];

        public function profile()
        {
            return $this->hasOne(Profile::class);
        }

        public function posts()
        {
            return $this->hasMany(Post::class)->orderBy('created_at','DESC');
        }

        public function followers()
        {
            return $this->belongsToMany(
                self::class,
                'follows',
                'followee_id',
                'follower_id'
            );
        }
        public function followees()
        {
            return $this->belongsToMany(
                self::class,
                'follows',
                'follower_id',
                'followee_id'
            );
        }

        protected static function boot()
        {
            parent::boot();
            static::created(function ($user)
            {
                $profile = new Profile();
                $profile->user_id = $user->id;
                $profile->save();

                Mail::to($user->email)->send(new NewUser($user));
            });
        }
    }
