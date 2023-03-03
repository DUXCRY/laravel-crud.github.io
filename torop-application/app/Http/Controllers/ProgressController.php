<?php

namespace App\Http\Controllers;

use App\Project;
use App\Customer;
use App\Progress;
use Illuminate\Support\Str;
use App\Helpers\DecryptTime;
use App\Models\ProjectModel;
use Illuminate\Http\Request;
use App\Helpers\KeyGenerator;
use App\Models\ProgressModel;
use Illuminate\Support\Facades\DB;
use Ramsey\Uuid\Uuid as Generator;
use App\Http\Controllers\Controller;

class progressController extends Controller
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
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //$progress = progress::orderBy('id', 'desc')->get()
        //return Progress::find($pg_id);
        $projects = ProjectModel::all();
        $progrest = ProgressModel::all();

        $kd_project = request('kd_project');
        $results = DB::select(
            DB::raw("SELECT * FROM progress WHERE kd_project = :kd_project"),
            array('kd_project' => $kd_project)
        );

        $rs = DB::select(
            DB::raw("SELECT * FROM projects WHERE kd_project = :kd_project"),
            array('kd_project' => $kd_project)
        );

        $pg = [];
        $pj = [];

        foreach ($results as $key => $progres) {
            $time_start = LARAVEL_START;
            $prepare = $this->KG->DekripUUID($progres->uuid);
            $data = $this->KG->prepare_data($prepare);

            $pg[] = array(
                'pg_id' => $progres->pg_id,
                'kd_project' => $progres->kd_project,
                'pg_periode' => $data->decrypt($progres->pg_periode),
                'pg_progres' => $data->decrypt($progres->pg_progres),
                'pg_act_cost' => $data->decrypt($progres->pg_act_cost),
                'pg_outstanding_issues' => $data->decrypt($progres->pg_outstanding_issues),
            );
            $time_end = microtime(true);
            $dt = new DecryptTime($time_end, $time_start);
            $st = $dt->decryptTime($progres->pg_id);
        }

        foreach ($rs as $key => $project) {
            $prepare = $this->KG->DekripUUID($project->uuid);
            $data = $this->KG->prepare_data($prepare);

            $pj[] = array(
                'pj_nilai_kontrak' => $data->decrypt($project->pj_nilai_kontrak),
            );
        }

        $prepare_pj = json_encode($pj);
        $data_pj = json_decode($prepare_pj);
        $prepare = json_encode($pg);
        $data = json_decode($prepare);

        //var_dump($pg);

        return view('progress/index', compact('data', 'data_pj'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $projects = ProjectModel::all();
        return view('progress/create', compact('projects'));
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
            'kd_project'            => 'required',
            'pg_periode'            => 'required',
            'pg_progres'            => 'required',
            'pg_act_cost'           => 'required',
            'pg_outstanding_issues' => 'required'
        ]);

        ProgressModel::create([
            $time_start = LARAVEL_START,
            'kd_project'            => $request->kd_project,
            'pg_periode'            => $this->KG->Enkrip($request->pg_periode),
            'pg_progres'            => $this->KG->Enkrip($request->pg_progres),
            'pg_act_cost'           => $this->KG->Enkrip(str_replace(['Rp. ', ',', '.'], '', $request->pg_act_cost)),
            'pg_outstanding_issues' => $this->KG->Enkrip($request->pg_outstanding_issues),
            'uuid'                  => $this->euuid,
            $time_end = microtime(true),
            'encrypt_time'  => number_format(($time_end - $time_start), 9)
        ]);
        return redirect()->back()->with('status', 'Progress berhasil ditambah.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\progress  $progress
     * @return \Illuminate\Http\Response
     */
    public function show(ProjectModel $progress)
    {
        // $projects = Project::all();
        // $progrest = Progress::where('kd_project', $progress->kd_project)->get();
        //return view('progress/show', compact('projects', 'progrest'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\progress  $progress
     * @return \Illuminate\Http\Response
     */
    public function edit(ProgressModel $progress)
    {
        $projects = ProjectModel::all();
        return view('progress/edit', compact('progress', 'projects'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\progress  $progress
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ProgressModel $progress)
    {

        $this->validate($request, [
            'kd_project'            => 'required',
            'pg_periode'            => 'required',
            'pg_progres'            => 'required',
            'pg_act_cost'           => 'required',
            'pg_outstanding_issues' => 'required'
        ]);

        $this->duuid = $this->KG->DekripUUID($progress->uuid);
        $this->puuid = $this->KG->CUUID($this->duuid);

        $time_start                         = LARAVEL_START;
        $progress->kd_project               = $request->kd_project;
        $progress->pg_periode               = $this->KG->EnkripUpdate($request->pg_periode);
        $progress->pg_progres               = $this->KG->EnkripUpdate($request->pg_progres);
        $progress->pg_act_cost              = $this->KG->EnkripUpdate(str_replace(['Rp. ', ',', '.'], '', $request->pg_act_cost));
        $progress->pg_outstanding_issues    = $this->KG->EnkripUpdate($request->pg_outstanding_issues);
        $time_end                           = microtime(true);
        $progress->encrypt_time             = number_format(($time_end - $time_start), 9);
        $progress->save();

        return redirect()->back()->with('status', 'Data Berhasil Diubah.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\progress  $progress
     * @return \Illuminate\Http\Response
     */
    public function destroy(ProgressModel $progress)
    {
        $progress->delete();
        return redirect()->back()->with('status', 'Data Berhasil Dihapus.');
    }
}
