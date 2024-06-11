<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class WelcomeController extends Controller
{
    public function index()
    {
        $categories = Category::all();
      

        return view('welcome', compact('categories'));
    }
    
    public function thankyou()
    {
        return view('thankyou');
    }
}
