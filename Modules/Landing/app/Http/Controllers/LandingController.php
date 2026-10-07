<?php

namespace Modules\Landing\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Controllers\PageController;
use Illuminate\Http\Request;

class LandingController extends Controller
{
    /**
     * Display the Zengfy ecosystem landing page with glassmorphic layout.
     */
    public function index()
    {
        $services = PageController::getProductsData();

        return view('landing::index', compact('services'));
    }
}
