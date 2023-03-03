<?php

namespace App\Http\Controllers;


use App\Models\ProjectModel;
use App\Models\ItemModel;
use App\Models\OrderModel;
use App\Helpers\DecryptTime;
use App\Models\ProductModel;
use Illuminate\Http\Request;
use App\Helpers\KeyGenerator;
use Illuminate\Support\Facades\DB;
use Ramsey\Uuid\Uuid as Generator;
use App\Http\Controllers\Controller;

class ItemController extends Controller
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
    public function index()
    {
        $orders = OrderModel::all();
        $products = ProductModel::select('pd_id', 'pd_nama', 'pd_harga', 'uuid')->get();

        $order_id = request('order_id');
        $results = DB::select(
            DB::raw("SELECT * FROM order_items WHERE order_id = :order_id"),
            array('order_id' => $order_id)
        );
        // $items = Product::where('pd_id', $item->pd_id)->get();
        //$items = Item::all();

        $itm = [];
        $pd = [];
        $pd_nama = [];
        $pd_harga = [];

        foreach ($results as $key => $item) {
            $time_start = LARAVEL_START;
            $prepare = $this->KG->EnkripUUID($item->uuid);
            $data = $this->KG->prepare_data($prepare);

            foreach ($products as $key => $product) {
                $prepare2 = $this->KG->EnkripUUID($product->uuid);
                $data2 = $this->KG->prepare_data($prepare2);

                if ($item->pd_id == $product->pd_id) {
                    $pd_nama = $data2->decrypt($product->pd_nama);
                    $pd_harga = $data2->decrypt($product->pd_harga);
                }
            }

            //$time_start = microtime(true) * 1000;

            $itm[] = array(
                'id' => $item->id,
                'order_id' => $item->order_id,
                'pd_id' => $item->pd_id,
                'pd_nama' => $pd_nama,
                'pd_harga' => $pd_harga,
                'qty' => $data->decrypt($item->qty),
                'unit' => $data->decrypt($item->unit),
                'total_harga' => $data->decrypt($item->total_harga),
                'keterangan' => $data->decrypt($item->keterangan),
            );
            $time_end = microtime(true);
            $dt = new DecryptTime($time_end, $time_start);
            $st = $dt->decryptTime($item->id);
        }

        foreach ($products as $key => $value) {
            $prepare = $this->KG->EnkripUUID($value->uuid);
            $data = $this->KG->prepare_data($prepare);

            $pd[] = array(
                'pd_id'     => $value->pd_id,
                'pd_nama'   => $data->decrypt($value->pd_nama),
                'pd_harga'  => $data->decrypt($value->pd_harga),
            );
        }
        $prepare_pd = json_encode($pd);
        $data_pd = json_decode($prepare_pd);
        $prepare = json_encode($itm);
        $data = json_decode($prepare);

        // var_dump($itm);
        return view('item/index', compact('data', 'data_pd'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
            'order_id' => 'required',
            'pd_id' => 'required',
            'qty' => 'required',
            'unit' => 'required',
            'total_harga' => 'required',
        ]);

        ItemModel::create([
            $time_start = LARAVEL_START,
            'order_id'          => $request->order_id,
            'pd_id'             => $request->pd_id,
            'qty'               => $this->KG->Enkrip($request->qty),
            'unit'              => $this->KG->Enkrip($request->unit),
            'total_harga'       => $this->KG->Enkrip(str_replace(['Rp. ', ',', '.'], '', $request->total_harga)),
            'keterangan'        => $this->KG->Enkrip($request->keterangan),
            'uuid'              => $this->euuid,
            $time_end = microtime(true),
            'encrypt_time'      => number_format(($time_end - $time_start), 2)
        ]);

        return redirect()->back()->with('status', 'Data Berhasil Ditambah.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(ItemModel $item)
    {
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ItemModel $item)
    {
        $this->validate($request, [
            'order_id'      => 'required',
            'pd_id'         => 'required',
            'qty'           => 'required',
            'unit'          => 'required',
            'total_harga'   => 'required',
        ]);

        $this->duuid = $this->KG->DekripUUID($item->uuid);
        $this->puuid = $this->KG->CUUID($this->duuid);

        $time_start          = LARAVEL_START;
        $item->order_id      = $request->order_id;
        $item->pd_id         = $request->pd_id;
        $item->qty           = $this->KG->EnkripUpdate($request->qty);
        $item->unit          = $this->KG->EnkripUpdate($request->unit);
        $item->total_harga   = $this->KG->EnkripUpdate(str_replace(['Rp. ', ',', '.'], '', $request->total_harga));
        $item->keterangan    = $this->KG->EnkripUpdate($request->keterangan);
        $time_end            = microtime(true);
        $item->encrypt_time  = number_format(($time_end - $time_start), 2);
        $item->save(); // returns false

        return redirect()->back()->with('status', 'Data Berhasil Diubah.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(ItemModel $item)
    {
        $item->delete();

        return redirect()->back();
    }
}
