<?php

namespace App\Http\Controllers;

use App\Models\Page;
use App\Models\SubPage;

class PagesController extends Controller
{
    private $model;
    private $subpage;

    public function __construct(Page $model, SubPage $subpage)
    {
        $this->model = $model;
        $this->subpage = $subpage;
    }

    /**
     * Display a listing of the resource.
     * @param $slug
     * @return \Illuminate\Http\Response
     */
    public function index($slug)
    {
        $param = explode("/", $slug);
        $page = null;

        if (count($param) > 1) {
            $page = $this->model->where('slug', $param[0])->first();
            if (!$page) {
                abort(404);
            }
            $page = $page->subpages->where('slug', $param[1])->first();
        } else {
            $page = $this->model->where('slug', $param[0])->first();
        }

        if (!$page) {
            abort(404);
        }

        return view('page', compact('page'));
    }
}
