<?php
    /**
     * Created by PhpStorm.
     * User: Mas4erLomas4er
     * Date: 10.12.2020
     * Time: 20:24
     */

    namespace App\Http\Controllers;


    use App\Models\User;
    use Cloudinary\Uploader;
    use Illuminate\Support\Facades\Cache;
    use Intervention\Image\Facades\Image;

    class ProfilesController extends Controller
    {
        public function show (User $user)
        {
            $follows = (auth()->user()) ? auth()->user()->followees->contains($user->id) : false;
            $stats = [
                'posts_count' => Cache::remember(
                    'count.posts.' . $user->id,
                    now()->addSeconds(60),
                    function () use ($user) { return $user->posts->count(); }),
                'followers_count' => Cache::remember(
                    'count.followers.' . $user->id,
                    now()->addSeconds(60),
                    function () use ($user) { return $user->followers->count(); }),
                'followees_count' => Cache::remember(
                    'count.followees.' . $user->id,
                    now()->addSeconds(60),
                    function () use ($user) { return $user->followees->count(); }),
            ];
            return view('profiles.show', compact('user', 'follows', 'stats'));
        }

        public function edit (User $user)
        {
            $this->authorize('update', $user->profile);

            return view('profiles.edit', compact('user'));
        }

        public function update (User $user)
        {
            $data = request()->validate([
                'username' => ['required', 'unique:users', 'string', 'max:25'],
                'name' => ['required', 'string', 'max:50'],
                'bio' => ['string', 'max:255'],
                'site' => ['string', 'max:50'],
                'image' => ['image'],
            ]);

            if (isset($data['image']))
            {
                $imagePath = Uploader::upload(
                    request('image'),
                    [
                        "width" => 500,
                        "height" => 500,
                        "gravity"=>"auto",
                        "crop"=>"lfill",
                        "quality"=>75
                    ])['url'];
            } else
                $imagePath = 'https://www.labom.com/files/images/mitarbeiter/kein-bild-vorhanden.png';


            $user->username = $data['username'];
            $user->name = $data['name'];
            $user->profile->bio = $data['bio'];
            $user->profile->site = $data['site'];
            $user->profile->image = $imagePath;

            $user->push();

            return redirect(route('profiles.show', $user->id));
        }
    }