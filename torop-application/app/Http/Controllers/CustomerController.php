<?php

namespace App\Http\Controllers;

use App\Models\CaesarModel;
use App\Models\CustomerModel;
use App\Models\VigenereModel;
use App\Helpers\DecryptTime;
use Illuminate\Http\Request;
use App\Helpers\CaesarCipher;
use App\Helpers\KeyGenerator;
use App\Helpers\VigenereCipher;
use Ramsey\Uuid\Uuid as Generator;
use App\Http\Controllers\Controller;


class CustomerController extends Controller
{

    private $KG;
    private $CS;
    private $VG;
    private $uuid;
    private $puuid;
    private $duuid;
    private $euuid;

    public function __construct()
    {
        $this->middleware('auth');
        $this->KG = new KeyGenerator();
        $this->CS = new CaesarCipher('22');
        $this->VG = new VigenereCipher();
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
        //$customers = Customer::orderBy('id', 'desc')->get();
        $customers = CustomerModel::all();

        $cs = [];
        $pcs = [];
        foreach ($customers as $customer) {
            $time_start = LARAVEL_START;

            $prepare = $this->KG->DekripUUID($customer->uuid);
            $data = $this->KG->prepare_data($prepare);
            foreach ($customer->projects as $item) {
                $pcs = $item['cs_id'];
            }

            //  $time_start = microtime(true) * 1000;

            $cs[] = array(
                'cs_id'     => $customer->cs_id,
                'cs_nama'   => $data->decrypt($customer['cs_nama']),
                'cs_email'  => $data->decrypt($customer['cs_email']),
                'cs_alamat' => $data->decrypt($customer['cs_alamat']),
                'cs_notelp' => $data->decrypt($customer['cs_notelp']),
                'pcs'       => $pcs,
            );
            $time_end = microtime(true);
            $dt = new DecryptTime($time_end, $time_start);
            $st = $dt->decryptTime($customer->cs_id);
        }

        $prepare = json_encode($cs);
        $data = json_decode($prepare);
        //var_dump($data);

        // dd(microtime(true) - LARAVEL_START);

        return view('customer/index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('customer/create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $this->validate(
            $request,
            [
                'cs_nama'       => 'required',
                'cs_email'      => 'required',
                'cs_notelp'     => 'required',
                'cs_alamat'     => 'required',

            ]
        );

        CustomerModel::create([
            $time_start     = LARAVEL_START,
            'cs_nama'       => $this->KG->Enkrip($request->cs_nama),
            'cs_email'      => $this->KG->Enkrip($request->cs_email),
            'cs_notelp'     => $this->KG->Enkrip($request->cs_notelp),
            'cs_alamat'     => $this->KG->Enkrip($request->cs_alamat),
            'uuid'          => $this->euuid,
            $time_end       = microtime(true),
            'encrypt_time'  => number_format(($time_end - $time_start), 9)
        ]);

        return redirect('customer')->with('status', 'Data Berhasil Ditambah.');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function storeCaesar(Request $request)
    {

        $this->validate(
            $request,
            [
                'cs_nama'       => 'required',
                'cs_email'      => 'required',
                'cs_notelp'     => 'required',
                'cs_alamat'     => 'required',

            ]
        );

        CaesarModel::create([
            $time_start     = LARAVEL_START,
            'cs_nama'       => $this->CS->encrypt($request->cs_nama),
            'cs_email'      => $this->CS->encrypt($request->cs_email),
            'cs_notelp'     => $this->CS->encrypt($request->cs_notelp),
            'cs_alamat'     => $this->CS->encrypt($request->cs_alamat),
            $time_end       = microtime(true),
            'encrypt_time'  => number_format(($time_end - $time_start), 2)
        ]);

        return redirect('customer/caesar')->with('status', 'Data Berhasil Ditambah.');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function storeVigenere(Request $request)
    {

        $this->validate(
            $request,
            [
                'cs_nama'       => 'required',
                'cs_email'      => 'required',
                'cs_notelp'     => 'required',
                'cs_alamat'     => 'required',

            ]
        );

        VigenereModel::create([
            $time_start     = LARAVEL_START,
            'cs_nama'       => $this->VG->encrypt($request->cs_nama),
            'cs_email'      => $this->VG->encrypt($request->cs_email),
            'cs_notelp'     => $this->VG->encrypt($request->cs_notelp),
            'cs_alamat'     => $this->VG->encrypt($request->cs_alamat),
            $time_end       = microtime(true),
            'encrypt_time'  => number_format(($time_end - $time_start), 2)
        ]);

        return redirect('customer/vigenere')->with('status', 'Data Berhasil Ditambah.');
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function show(CustomerModel $customer)
    {
        return view('customer/show', ['customer' => $customer]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function edit(CustomerModel $customer)
    {
        return view('customer/edit', compact('customer'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, CustomerModel $customer)
    {

        $this->validate($request, [
            'cs_nama'       => 'required',
            'cs_email'      => 'required',
            'cs_notelp'     => 'required',
            'cs_alamat'     => 'required'
        ]);

        $this->duuid = $this->KG->DekripUUID($customer->uuid);
        $this->puuid = $this->KG->CUUID($this->duuid);

        $time_start                 = LARAVEL_START;
        $customer->cs_nama          = $this->KG->EnkripUpdate($request->cs_nama);
        $customer->cs_email         = $this->KG->EnkripUpdate($request->cs_email);
        $customer->cs_notelp        = $this->KG->EnkripUpdate($request->cs_notelp);
        $customer->cs_alamat        = $this->KG->EnkripUpdate($request->cs_alamat);
        $time_end                   = microtime(true);
        $customer->encrypt_time     = number_format(($time_end - $time_start), 9);
        $customer->save();

        return redirect('customer')->with('status', 'Data Berhasil Diubah.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function destroy(CustomerModel $customer)
    {
        $customer->delete();
        return redirect('customer')->with('status', 'Data Berhasil Dihapus.');
    }


    public function caesar()
    {
        $customers = CaesarModel::all();

        $cs = [];
        $pcs = [];
        foreach ($customers as $customer) {
            $time_start = LARAVEL_START;

            $cs[] = array(
                'cs_id'     => $customer->cs_id,
                'cs_nama'   => $this->CS->decrypt($customer['cs_nama']),
                'cs_email'  => $this->CS->decrypt($customer['cs_email']),
                'cs_alamat' => $this->CS->decrypt($customer['cs_alamat']),
                'cs_notelp' => $this->CS->decrypt($customer['cs_notelp']),
            );
            $time_end = microtime(true);
            $dt = new DecryptTime($time_end, $time_start);
            $st = $dt->decryptTime($customer->cs_id);
        }

        $prepare = json_encode($cs);
        $data = json_decode($prepare);


        return view('customer/caesar', compact('data'));
    }

    public function vigenere()
    {
        $customers = VigenereModel::all();

        $cs = [];
        $pcs = [];
        foreach ($customers as $customer) {
            $time_start = LARAVEL_START;

            //  $time_start = microtime(true) * 1000;

            $cs[] = array(
                'cs_id'     => $customer->cs_id,
                'cs_nama'   => $this->VG->decrypt($customer['cs_nama']),
                'cs_email'  => $this->VG->decrypt($customer['cs_email']),
                'cs_alamat' => $this->VG->decrypt($customer['cs_alamat']),
                'cs_notelp' => $this->VG->decrypt($customer['cs_notelp']),
                'pcs'       => $pcs,
            );
            $time_end = microtime(true);
            $dt = new DecryptTime($time_end, $time_start);
            $st = $dt->decryptTime($customer->cs_id);
        }

        $prepare = json_encode($cs);
        $data = json_decode($prepare);
        //var_dump($data);

        // dd(microtime(true) - LARAVEL_START);

        return view('customer/vigenere', compact('data'));
    }
}
