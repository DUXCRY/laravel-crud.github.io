<?php

namespace App\Http\Controllers;

use App\Product;
use App\Helpers\DecryptTime;
use App\Models\ProductModel;
use Illuminate\Http\Request;
use App\Helpers\KeyGenerator;
use Ramsey\Uuid\Uuid as Generator;
use App\Http\Controllers\Controller;

class ProductController extends Controller
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
        $products = ProductModel::all();

        $pd = [];
        foreach ($products as $product) {
            $time_start = LARAVEL_START;
            $prepare = $this->KG->DekripUUID($product->uuid);
            $data = $this->KG->prepare_data($prepare);

            $pd[] = array(
                'pd_id'         => $product->pd_id,
                'pd_kategori'   => $data->decrypt($product['pd_kategori']),
                'pd_brand'      => $data->decrypt($product['pd_brand']),
                'pd_nama'       => $data->decrypt($product['pd_nama']),
                'pd_tipe'       => $data->decrypt($product['pd_tipe']),
                'pd_design'     => $data->decrypt($product['pd_design']),
                'pd_material'   => $data->decrypt($product['pd_material']),
                'pd_harga'      => $data->decrypt($product['pd_harga']),
            );
            $time_end = microtime(true);
            $dt = new DecryptTime($time_end, $time_start);
            $st = $dt->decryptTime($product->pd_id);
        }

        $prepare = json_encode($pd);
        $data = json_decode($prepare);

        return view('/product/index', compact('data'));
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
            'pd_nama' => 'required',
            'pd_kategori' => 'required',
            'pd_brand' => 'required',
            'pd_tipe' => 'required',
            'pd_design' => 'required',
            'pd_material' => 'required',
            'pd_harga' => 'required',
        ]);

        ProductModel::create([
            $time_start     = LARAVEL_START,
            'pd_nama'       => $this->KG->Enkrip($request->pd_nama),
            'pd_kategori'   => $this->KG->Enkrip($request->pd_kategori),
            'pd_brand'      => $this->KG->Enkrip($request->pd_brand),
            'pd_tipe'       => $this->KG->Enkrip($request->pd_tipe),
            'pd_design'     => $this->KG->Enkrip($request->pd_design),
            'pd_material'   => $this->KG->Enkrip($request->pd_material),
            'pd_harga'      => $this->KG->Enkrip(str_replace(['Rp. ', ',', '.'], '', $request->pd_harga)),
            'uuid'          => $this->euuid,
            $time_end       = microtime(true),
            'encrypt_time'  => number_format(($time_end - $time_start), 2)
        ]);

        return redirect('product')->with('status', 'Data Berhasil Ditambah.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(ProductModel $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(ProductModel $product)
    {
        return view('product/edit');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ProductModel $product)
    {
        $this->validate($request, [
            'pd_nama' => 'required',
            'pd_kategori' => 'required',
            'pd_brand' => 'required',
            'pd_tipe' => 'required',
            'pd_design' => 'required',
            'pd_material' => 'required',
            'pd_harga' => 'required',
        ]);

        $this->duuid = $this->KG->DekripUUID($product->uuid);
        $this->puuid = $this->KG->CUUID($this->duuid);

        $time_start             = LARAVEL_START;
        $product->pd_nama       = $this->KG->EnkripUpdate($request->pd_nama);
        $product->pd_kategori   = $this->KG->EnkripUpdate($request->pd_kategori);
        $product->pd_brand      = $this->KG->EnkripUpdate($request->pd_brand);
        $product->pd_tipe       = $this->KG->EnkripUpdate($request->pd_tipe);
        $product->pd_design     = $this->KG->EnkripUpdate($request->pd_design);
        $product->pd_material   = $this->KG->EnkripUpdate($request->pd_material);
        $product->pd_harga      = $this->KG->EnkripUpdate(str_replace(['Rp. ', ',', '.'], '', $request->pd_harga));
        $time_end               = microtime(true);
        $product->encrypt_time  = number_format(($time_end - $time_start), 9);
        $product->save();

        return redirect('product')->with('status', 'Data Berhasil Diubah.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(ProductModel $product)
    {
        $product->delete();
        return redirect('product')->with('status', 'Data Berhasil Dihapus.');
    }
}
