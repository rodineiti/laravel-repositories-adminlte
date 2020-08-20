<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Page;
use App\Models\User;
use App\Models\Visitor;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    protected $user;
    protected $page;
    protected $visitor;

    public function __construct(User $user, Page $page, Visitor $visitor)
    {
        $this->user = $user;
        $this->page = $page;
        $this->visitor = $visitor;
    }

    public function index(Request $request)
    {
        $dateLimit = date("Y-m-d H:i:s", strtotime("-5 minutes"));
        $lastDays = ($request->has("lastDays") ? $request->lastDays : "30");

        $countVisits = $this->visitor
            ->whereBetween("date_access", [
                date("Y-m-d H:i:s", strtotime("-{$lastDays} days")),
                date("Y-m-d H:i:s")
            ])->count();
        $countOnline = $this->visitor->select("ip")->where("date_access", ">=", $dateLimit)->groupBy("ip")->count();
        $countPages = $this->page->count();
        $countUsers = $this->user->count();

        $pagePie =[];

        $visits = $this->visitor
            ->selectRaw("page, count(page) as total")
            ->whereBetween("date_access", [
                date("Y-m-d H:i:s", strtotime("-{$lastDays} days")),
                date("Y-m-d H:i:s")
            ])
            ->groupBy("page")->get();

        foreach ($visits as $visit) {
            $pagePie[$visit->page] = intval($visit->total);
        }

        return view('admin/home', compact('countVisits','countOnline', 'countPages', 'countUsers', 'pagePie', 'lastDays'));
    }
}
