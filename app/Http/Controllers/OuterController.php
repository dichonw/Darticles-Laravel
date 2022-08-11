<?php

namespace App\Http\Controllers;

use App\Models\Articles;
use Illuminate\Http\Request;

class OuterController extends Controller
{
    public function index()
    {
        $articles = Articles::paginate(10);
        return view('home', [
            'title' => 'List Articles',
            'articles' => $articles
        ]);
    }

    public function article_detail($id)
    {
        return view('article', [
            'title' => 'Detail Article ' . $id,
            'article' => Articles::find($id)
        ]);
    }
}
