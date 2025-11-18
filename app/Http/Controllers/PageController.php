<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class PageController extends Controller
{
//     public function __construct()
// {
//     $this->middleware('auth');
// }

    public function welcome()
    {
        return view('welcome');
    }

    public function team()
    {
        return view('team');
    }


    public function downloadApp()
    {
        $file = public_path('downloads/app-release.apk');

        if (file_exists($file)) {
            return response()->download($file, 'Zengfy-App.apk', [
                'Content-Type' => 'application/vnd.android.package-archive',
                'Content-Length' => filesize($file)
            ]);
        } else {
            abort(404, 'APK file not found. Please contact support.');
        }
    }
    public function signup(){
        return view('signup');
    }

    public function login(){
        return view('login');
    }

    public function dashboard()
    {
        // $videos = $this->getDashboardVideos();
        // return view('dashboard', compact('videos'));
        return view('dashboard');
    }

//     public function getDashboardVideos()
// {
//     $files = Storage::files('public/videos');

//     return collect($files)->take(10)->map(function ($file) {
//         return [
//             'name' => basename($file),
//             'url' => asset(str_replace('public/', 'storage/', $file)),
//         ];
//     });
// }

}
