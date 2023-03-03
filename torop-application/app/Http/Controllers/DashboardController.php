<?php

namespace App\Http\Controllers;

use App\Models\ProductModel;
use App\Models\ProjectModel;
use App\Models\OrderModel;
use App\Helpers\KeyGenerator;
use App\Models\CustomerModel;
use Illuminate\Routing\Controller;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $KG = new KeyGenerator();

        $t_cs = CustomerModel::all(['cs_id'])->count();
        $t_pj = ProjectModel::all(['kd_project']);
        $t_pd = ProductModel::all(['pd_id'])->count();
        $t_od = OrderModel::all(['order_id'])->count();

        return view('dashboard/index', compact('t_cs', 't_pj', 't_pd', 't_od'));
    }

    public function test()
    {
        return view('dashboard/test');
    }
}
