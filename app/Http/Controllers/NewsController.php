<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\News;

class NewsController extends Controller
{
    protected $news;

    public function __construct(News $news)
    {
        $this->news = $news;
    }

    /**
     * show all Catalogs
     * @return view
     */
    public function index()
    {
        $listNews = $this->news->paginate(10);

        return view('news.index', compact('listNews'));
    }

    public function show($id)
    {
        $news = $this->news->findOrFail($id);

        return view('news.show', compact('news'));
    }
}
