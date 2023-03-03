<?php

namespace App\Http\Controllers;

use PDF;
use App\Models\ItemModel;
use App\Models\OrderModel;
use App\Helpers\DecryptTime;
use App\Models\ProductModel;
use App\Models\ProjectModel;
use Illuminate\Http\Request;
use App\Helpers\KeyGenerator;
use Ramsey\Uuid\Uuid as Generator;
use App\Http\Controllers\Controller;

class OrderController extends Controller
{
    private $KG;
    private $uuid;
    private $puuid;
    private $duuid;
    private $euuid;

    public function __construct()
    {
        $this->middleware('auth');
        $this->KG = new KeyGenerator();
        $this->uuid = $this->KG->UUID(Generator::uuid4()->toString());
        $this->euuid = $this->KG->EnkripUUID($this->uuid);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(OrderModel $order)
    {
        return redirect('order/all');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function all()
    {
        $orders = OrderModel::all();
        $projects = ProjectModel::all('kd_project', 'pj_nama', 'uuid');

        $ord = [];
        $pj = [];
        $pj_nama = [];

        foreach ($orders as $key => $order) {

            foreach ($projects as $key => $project) {
                $prepare = $this->KG->DekripUUID($project->uuid);
                $data = $this->KG->prepare_data($prepare);

                if ($order->kd_project == $project->kd_project) {
                    $pj_nama = $data->decrypt($project->pj_nama);
                }
            }

            $ord[] = array(
                'order_id'      => $order->order_id,
                'kd_project'    => $order->kd_project,
                'pj_nama'       => $pj_nama
            );
        }

        foreach ($projects as $key => $project) {
            $prepare = $this->KG->DekripUUID($project->uuid);
            $data = $this->KG->prepare_data($prepare);

            $pj[] = array(
                'kd_project' => $project->kd_project,
                'pj_nama' => $data->decrypt($project->pj_nama)
            );
        }


        $prepare_pj = json_encode($pj);
        $data_pj = json_decode($prepare_pj);
        $prepare = json_encode($ord);
        $data = json_decode($prepare);

        return view('/order/all', compact('data', 'data_pj'));
        //  }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // $orders = Order::all();
        $projects = ProjectModel::select('kd_project', 'pj_nama', 'uuid')->orderBy('created_at', 'DESC')->get();
        $products = ProductModel::select('pd_id', 'pd_nama', 'pd_harga', 'uuid')->get();

        $pj = [];
        $pd = [];

        foreach ($projects as $key => $project) {
            $prepare = $this->KG->EnkripUUID($project->uuid);
            $data = $this->KG->prepare_data($prepare);

            $pj[] = array(
                'kd_project' => $project->kd_project,
                'pj_nama'    => $data->decrypt($project->pj_nama)
            );
        }

        foreach ($products as $key => $product) {
            $prepare = $this->KG->EnkripUUID($product->uuid);
            $data = $this->KG->prepare_data($prepare);

            $pd[] = array(
                'pd_id' => $product->pd_id,
                'pd_harga' => $data->decrypt($product->pd_harga),
            );
        }

        $prepare_pj = json_encode($pj);
        $data_pj = json_decode($prepare_pj);
        $prepare_pd = json_encode($pd);
        $data_pd = json_decode($prepare_pd);

        return view('/order/create', compact('projects', 'products'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'kd_project' => 'required|exists:projects,kd_project'
        ]);

        try {
            $orders = OrderModel::create([
                'kd_project' => $request->kd_project,
                'total' => $this->KG->Enkrip(0),
                'uuid'  => $this->euuid
            ]);

            return redirect(route('order.edit', ['order_id' => $orders->order_id]));
        } catch (\Exception $e) {
            return redirect()->back()->with(['error' => $e->getMessage()]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        //return view('order/show');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function edit($order_id)
    {
        $orderz = OrderModel::find($order_id);
        $orders = OrderModel::with(['projects', 'items', 'items.products', 'projects.vendors'])->find($order_id);
        $products = ProductModel::select('pd_id', 'pd_nama', 'uuid')->orderBy('pd_nama', 'asc')->get();

        $it = [];
        $pj = [];
        $pd = [];
        // $od = [];

        $prepare = $this->KG->EnkripUUID($orders->uuid);
        $data = $this->KG->prepare_data($prepare);

        $od[] = array(
            'order_id'      => $orders->order_id,
            'kd_project'    => $orders->kd_project,
            'total'         => $data->decrypt($orders->total),
            'tax'           => (10 / 100) * $data->decrypt($orders->total),
            'total_harga'   => ($data->decrypt($orders->total) + (($data->decrypt($orders->total) * 10) / 100))
        );

        foreach ($orders->items as $item) {
            $time_start = LARAVEL_START;
            $prepare_it = $this->KG->EnkripUUID($item->uuid);
            $data_it = $this->KG->prepare_data($prepare_it);
            $prepare_pd = $this->KG->EnkripUUID($item->products->uuid);
            $data_pd = $this->KG->prepare_data($prepare_pd);

            $it[] = array(
                'id'            => $item->id,
                'pd_id'         => $item->products->pd_id,
                'pd_nama'       => $data_pd->decrypt($item->products->pd_nama),
                'pd_harga'      => $data_pd->decrypt($item->products->pd_harga),
                'qty'           => $data_it->decrypt($item->qty),
                'unit'          => $data_it->decrypt($item->unit),
                'total_harga'   => $data_it->decrypt($item->total_harga),
                'keterangan'    => $data_it->decrypt($item->keterangan),
            );
            $time_end = microtime(true);
            $dt = new DecryptTime($time_end, $time_start);
            $st = $dt->decryptTime($item->id);
        }

        foreach ($orders->projects as $project) {
            $prepare_pj = $this->KG->EnkripUUID($project->uuid);
            $data_pj = $this->KG->prepare_data($prepare_pj);
            $prepare_cs = $this->KG->EnkripUUID($project->vendors->uuid);
            $data_cs = $this->KG->prepare_data($prepare_cs);

            $pj[] = array(
                'pj_nama'   => $data_pj->decrypt($project->pj_nama),
                'cs_id'     => $project->vendors->cs_id,
                'cs_nama'   => $data_cs->decrypt($project->vendors->cs_nama),
                'cs_alamat' => $data_cs->decrypt($project->vendors->cs_alamat),
                'cs_email'  => $data_cs->decrypt($project->vendors->cs_email),
                'cs_notelp' => $data_cs->decrypt($project->vendors->cs_notelp),
            );
        }

        foreach ($products as $product) {
            $prepare = $this->KG->EnkripUUID($product->uuid);
            $data = $this->KG->prepare_data($prepare);

            $pd[] = array(
                'pd_id'     => $product->pd_id,
                'pd_nama'   => $data->decrypt($product->pd_nama),
            );
        }

        //dd($od);
        $prepare_pj = json_encode($pj);
        $data_pj = json_decode($prepare_pj);
        $prepare_it = json_encode($it);
        $data_it = json_decode($prepare_it);
        $prepare_pd = json_encode($pd);
        $data_pd = json_decode($prepare_pd);
        $prepare_od = json_encode($od);
        $data_od = json_decode($prepare_od);

        return view('order/edit', compact('orders', 'data_od', 'data_pj', 'data_it', 'data_pd'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $order_id)
    {
        //$this->validate($request, [
        //    'pd_id' => 'required|exists:products,pd_id',
        //    'qty' => 'required',
        //    'unit' => 'required'
        //]);

        try {
            $orders = OrderModel::find($order_id);
            $products = ProductModel::find($request->pd_id);
            $prepare = $this->KG->DekripUUID($products->uuid);
            $data = $this->KG->prepare_data($prepare);
            $pd_harga = $data->decrypt($products->pd_harga);

            $item = $orders->items()->where('pd_id', $products->pd_id)->first();

            if ($item) {
                $item_update = $orders->items('qty', 'unit', 'harga', 'uuid', 'encrypt_time')->where('pd_id', $products->pd_id)->first();
                // dd($item_uuid);
                // $item_qty = $orders->items('qty')->where('pd_id', $products->pd_id)->first();
                $prepare_it = $this->KG->DekripUUID($item_update->uuid);

                $data_it = $this->KG->prepare_data($prepare_it);
                $qty = $data_it->decrypt($item_update->qty);
                $unit = $data_it->decrypt($item_update->unit);
                // $harga = $data_it->decrypt($item_update->harga);
                $item->update([
                    $time_start = LARAVEL_START,
                    'qty'           => $this->KG->Enkrip($qty + $request->qty),
                    'unit'          => $this->KG->Enkrip($unit),
                    'harga'         => $this->KG->Enkrip($pd_harga),
                    'uuid'          => $this->euuid,
                    $time_end = microtime(true),
                    'encrypt_time'  => number_format(($time_end - $time_start), 9)
                ]);
            } else {
                ItemModel::create([
                    $time_start = LARAVEL_START,
                    'order_id'      => $orders->order_id,
                    'pd_id'         => $request->pd_id,
                    'harga'         => $this->KG->Enkrip($pd_harga),
                    'qty'           => $this->KG->Enkrip($request->qty),
                    'unit'          => $this->KG->Enkrip($request->unit),
                    'keterangan'    => $this->KG->Enkrip($request->keterangan),
                    'uuid'          => $this->euuid,
                    $time_end = microtime(true),
                    'encrypt_time'  => number_format(($time_end - $time_start), 9)
                ]);
            }
            return redirect()->back()->with(['success' => 'Product Telah Ditambahkan']);
        } catch (\Exception $e) {
            //dd($qty);
            return redirect()->back()->with(['error' => $e->getMessage()]);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function updateItem(Request $request, ItemModel $item)
    {
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function destroy(OrderMOdel $order)
    {
        $order->delete();
        return redirect('order/all')->with('status', 'Data Berhasil Dihapus.');
    }

    public function deleteProduct(ItemModel $id)
    {
        $id->delete();
        return redirect()->back()->with(['success' => 'Product Telah Dihapus.']);
    }

    public function generateInvoice($order)
    {
        //$orderz = Order::find($order);
        $orders = OrderModel::with(['projects', 'items', 'items.products', 'projects.vendors'])->find($order);
        // dd($orders);
        $products = ProductModel::select('pd_id', 'pd_nama', 'uuid')->get();

        $it = [];
        $pj = [];
        $pd = [];

        $prepare = $this->KG->EnkripUUID($orders->uuid);
        $data = $this->KG->prepare_data($prepare);

        $od[] = array(
            'order_id'      => $orders->order_id,
            'kd_project'    => $orders->kd_project,
            'total'         => $data->decrypt($orders->total),
            'tax'           => (2 / 100) * $data->decrypt($orders->total),
            'total_harga'   => ($data->decrypt($orders->total) + (($data->decrypt($orders->total) * 2) / 100))
        );


        foreach ($orders->items as $item) {
            $prepare_it = $this->KG->EnkripUUID($item->uuid);
            $data_it = $this->KG->prepare_data($prepare_it);
            $prepare_pd = $this->KG->EnkripUUID($item->products->uuid);
            $data_pd = $this->KG->prepare_data($prepare_pd);

            $it[] = array(
                'id'            => $item->id,
                'pd_id'         => $item->products->pd_id,
                'pd_nama'       => $data_pd->decrypt($item->products->pd_nama),
                'pd_harga'      => $data_pd->decrypt($item->products->pd_harga),
                'qty'           => $data_it->decrypt($item->qty),
                'unit'          => $data_it->decrypt($item->unit),
                'total_harga'   => $data_it->decrypt($item->total_harga),
                'keterangan'    => $data_it->decrypt($item->keterangan),
            );
        }

        foreach ($orders->projects as $project) {
            $prepare_pj = $this->KG->EnkripUUID($project->uuid);
            $data_pj = $this->KG->prepare_data($prepare_pj);
            $prepare_cs = $this->KG->EnkripUUID($project->vendors->uuid);
            $data_cs = $this->KG->prepare_data($prepare_cs);

            $pj[] = array(
                'pj_nama'   => $data_pj->decrypt($project->pj_nama),
                'pj_pic'     => $data_pj->decrypt($project->pj_pic),
                'pj_tgl_mulai'     => $data_pj->decrypt($project->pj_tgl_mulai),
                'cs_id'     => $project->vendors->cs_id,
                'cs_nama'   => $data_cs->decrypt($project->vendors->cs_nama),
                'cs_alamat' => $data_cs->decrypt($project->vendors->cs_alamat),
                'cs_email'  => $data_cs->decrypt($project->vendors->cs_email),
                'cs_notelp' => $data_cs->decrypt($project->vendors->cs_notelp),
            );
        }

        foreach ($products as $product) {
            $prepare = $this->KG->EnkripUUID($product->uuid);
            $data = $this->KG->prepare_data($prepare);

            $pd[] = array(
                'pd_id'     => $product->pd_id,
                'pd_nama'   => $data->decrypt($product->pd_nama),
            );
        }

        $prepare_pj = json_encode($pj);
        $data_pj = json_decode($prepare_pj);
        $prepare_it = json_encode($it);
        $data_it = json_decode($prepare_it);
        $prepare_pd = json_encode($pd);
        $data_pd = json_decode($prepare_pd);
        $prepare_od = json_encode($od);
        $data_od = json_decode($prepare_od);
        // dd($pd);

        $pdf = PDF::loadView('order.print', compact('orders', 'data_od', 'data_pj', 'data_it', 'data_pd'))->setPaper('a4', 'landscape');
        return $pdf->stream();
    }
}
