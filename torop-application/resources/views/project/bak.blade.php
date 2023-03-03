<th scope="col">Nila Kontrak (Rp)</th>
<th scope="col">Tgl Mulai</th>
<th scope="col">Tgl Selesai</th>
<th scope="col">Rencana (%)</th>
<th scope="col">Aktual (%)</th>
<th scope="col">Deviasi (%)</th>
<th scope="col">Progress</th>

<td>{{$data_p->decrypt($project->pj_nilai_kontrak)}}</td>
<td>{{$data_p->decrypt($project->pj_tgl_mulai)}}</td>
<td>{{$data_p->decrypt($project->pj_tgl_selesai)}}</td>
<td>{{$data_p->decrypt($project->pj_rencana)}}</td>

@foreach($project->progress as $progress)
    @php
        $prepare_g = $KG->DekripUUID($progress->uuid);
        $data_g = $KG->prepare_data($prepare_g);
        $pg = 0;
        $d = 0;
    @endphp
    @if ($project->kd_project == $progress->kd_project)
        @php
            $pg = $data_g->decrypt($progress->pg_progres);
            $dv = $data_p->decrypt($project->pj_rencana) - $data_g->decrypt($progress->pg_progres);
        @endphp
        <td>{{ $pg }}</td>
        <td>{{ $dv }}</td>
    @elseif ($progress->kd_project == NULL)
    <td>{{ $pg}}</td>
    <td>{{ $dv == 0 }}</td>
    @endif
@endforeach
