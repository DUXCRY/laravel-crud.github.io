<?php

namespace App\Http\Controllers;

use App\Project;
use App\Customer;
use App\Progress;
use App\Helpers\DecryptTime;
use App\Models\ProjectModel;
use Illuminate\Http\Request;
use App\Helpers\KeyGenerator;
use App\Models\CustomerModel;
use App\Helpers\KodeGenerator;
use Ramsey\Uuid\Uuid as Generator;
use App\Http\Controllers\Controller;

class ProjectController extends Controller
{

    private $KG;
    private $uuid;
    private $puuid;
    private $duuid;
    private $euuid;
    private $kdproject;

    public function __construct()
    {
        $this->middleware('auth');
        $this->KG = new KeyGenerator();
        $this->KP = new KodeGenerator();
        $this->uuid = $this->KG->UUID(Generator::uuid4()->toString());
        $this->euuid = $this->KG->EnkripUUID($this->uuid);
        $this->kdproject = $this->KP->KdProject();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //$projects = Project::orderBy('id', 'desc')->get();
        $projects = ProjectModel::all();
        $vendors = CustomerModel::all();
        // $progrest = Progress::all();
        $max = $this->kdproject;

        $pj = [];
        $cs = [];

        foreach ($projects as $key => $project) {
            $time_start  = LARAVEL_START;
            $prepare    =  $this->KG->DekripUUID($project->uuid);
            $prepare2    =  $this->KG->DekripUUID($project->vendors->uuid);
            $data   = $this->KG->prepare_data($prepare);
            $data2   = $this->KG->prepare_data($prepare2);

            $pj[] = array(
                'kd_project'        => $project->kd_project,
                'cs_id'             => $project->cs_id,
                'cs_nama'           => $data2->decrypt($project->vendors->cs_nama),
                'pj_nama'           => $data->decrypt($project->pj_nama),
                'pj_pic'            => $data->decrypt($project->pj_pic),
                'pj_nilai_kontrak'  => $data->decrypt($project->pj_nilai_kontrak),
                'pj_tgl_mulai'      => $data->decrypt($project->pj_tgl_mulai),
                'pj_tgl_selesai'    => $data->decrypt($project->pj_tgl_selesai),
                'pj_status'         => $data->decrypt($project->pj_status),
            );
            $time_end = microtime(true);
            $dt = new DecryptTime($time_end, $time_start);
            $st = $dt->decryptTime($project->kd_project);
        }

        foreach ($vendors as $key => $cus) {
            $prepare    =  $this->KG->DekripUUID($cus->uuid);
            $data   = $this->KG->prepare_data($prepare);

            $cs[] = array(
                'cs_id'     => $cus->cs_id,
                'cs_nama'   => $data->decrypt($cus->cs_nama),
            );
        }

        $prepare_cs = json_encode($cs);
        $data_cs = json_decode($prepare_cs);

        $prepare = json_encode($pj);
        $data = json_decode($prepare);
        //var_dump($data_cs);
        return view('project/index', compact('data', 'data_cs', 'max'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $vendors = CustomerModel::all();
        return view('project/create', compact('vendors'));
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
            'cs_id'             => 'required',
            'pj_nama'           => 'required',
            'pj_pic'            => 'required',
            'pj_nilai_kontrak'  => 'required',
            'pj_tgl_mulai'      => 'required',
            'pj_tgl_selesai'    => 'required',
            'pj_status'         => 'required'
        ]);

        ProjectModel::create([
            $time_start = LARAVEL_START,
            'kd_project'        => $this->kdproject,
            'cs_id'             => $request->cs_id,
            'pj_nama'           => $this->KG->Enkrip($request->pj_nama),
            'pj_pic'            => $this->KG->Enkrip($request->pj_pic),
            'pj_nilai_kontrak'  => $this->KG->Enkrip(str_replace(['Rp. ', ',', '.'], '', $request->pj_nilai_kontrak)),
            'pj_tgl_mulai'      => $this->KG->Enkrip($request->pj_tgl_mulai),
            'pj_tgl_selesai'    => $this->KG->Enkrip($request->pj_tgl_selesai),
            'pj_status'         => $this->KG->Enkrip($request->pj_status),
            'uuid'              => $this->euuid,
            $time_end = microtime(true),
            'encrypt_time'      => number_format(($time_end - $time_start), 9)
        ]);

        return redirect('project')->with('status', 'Data Berhasil Ditambah.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        $project = ProjectModel::all();
        return view('project.show', compact('project'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function edit(ProjectModel $project)
    {
        $vendors = CustomerModel::all();
        return view('project/edit', compact('project', 'vendors'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ProjectModel $project)
    {

        $this->validate($request, [
            'cs_id'             => 'required',
            'pj_nama'           => 'required',
            'pj_pic'            => 'required',
            'pj_nilai_kontrak'  => 'required',
            'pj_tgl_mulai'      => 'required',
            'pj_tgl_selesai'    => 'required',
            'pj_status'        => 'required',
        ]);

        $this->duuid = $this->KG->DekripUUID($project->uuid);
        $this->puuid = $this->KG->CUUID($this->duuid);

        $time_start                 = LARAVEL_START;
        $project->cs_id             = $request->cs_id;
        $project->pj_nama           = $this->KG->EnkripUpdate($request->pj_nama);
        $project->pj_pic            = $this->KG->EnkripUpdate($request->pj_pic);
        $project->pj_nilai_kontrak  = $this->KG->EnkripUpdate(str_replace(['Rp. ', ',', '.'], '', $request->pj_nilai_kontrak));
        $project->pj_tgl_mulai      = $this->KG->EnkripUpdate($request->pj_tgl_mulai);
        $project->pj_tgl_selesai    = $this->KG->EnkripUpdate($request->pj_tgl_selesai);
        $project->pj_status        = $this->KG->EnkripUpdate($request->pj_status);
        $time_end                   = microtime(true);
        $project->encrypt_time      = number_format(($time_end - $time_start), 9);
        $project->save();

        return redirect('project')->with('status', 'Data Berhasil Diubah.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function destroy(ProjectModel $project)
    {
        $project->delete();
        return redirect('project')->with('status', 'Data Berhasil Dihapus.');
    }
}
