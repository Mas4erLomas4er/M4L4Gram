<?php
    /**
     * Created by PhpStorm.
     * User: Mas4erLomas4er
     * Date: 12.12.2020
     * Time: 16:28
     */

    namespace App\Http\Controllers;


    use App\Models\Post;
    use Carbon\Carbon;
    use Cloudinary\Uploader;
    use Intervention\Image\Facades\Image;

    class PostsController extends Controller
    {
        public function index ()
        {
            $followees = auth()->user()->followees()->pluck('id');

//            Get posts created later than 4 day ago
            $dayToCheck = Carbon::now()->subDays(3);
            $posts = Post::whereIn('user_id', $followees)->whereDate("created_at", '>', $dayToCheck)->latest()->with('user', 'user.profile')->paginate(10);

            return view('posts.index', compact('posts'));
        }

        public function create ()
        {
            return view('posts.create');
        }

        public function store ()
        {
            $data = request()->validate([
                'caption' => 'required',
                'image' => ['required', 'image'],
            ]);

            $image = Uploader::upload(request('image'),
                [
                    "width" => 1000,
                    "crop"=>"limit",
                    "quality"=>75
                ]);

            $data['image'] = $image['url'];

            auth()->user()->posts()->create($data);

            return redirect(route('profiles.show', auth()->user()->id));
        }

        public function show (Post $post)
        {
            return view('posts.show', compact('post'));
        }
    }