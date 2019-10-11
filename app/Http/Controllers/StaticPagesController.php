<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Article;

class StaticPagesController extends Controller
{
    public function home()
    {
      $items = Article::orderByDesc('created_at');
      $articles = $items->paginate(14);
    	return view('static_pages/home',compact('articles'));
    }

    public function help()
    {
    	return view('static_pages/help');
    }

    public function about()
    {
    	return view('static_pages/about');
    }
}
