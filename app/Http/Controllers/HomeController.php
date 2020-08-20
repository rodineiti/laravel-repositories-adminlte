<?php

namespace App\Http\Controllers;

use App\Models\Page;

class HomeController extends Controller
{
    protected $page;

    public function __construct(Page $page)
    {
        $this->page = $page;
    }

    public function index()
    {
        return view('home');
    }
}
