<tr class="data-row">
                        @php
                        $KG = new KeyGenerator();
                        $prepare_p = $KG->DekripUUID($project->uuid);
                        $prepare_v = $KG->DekripUUID($project->vendors->uuid);
                        $data_p = $KG->prepare_data($prepare_p);
                        $data_v = $KG->prepare_data($prepare_v);
                        @endphp
                        <td class="kd_project">{{$project->kd_project}}</td>
                        <td class="pj_nama">{{$data_p->decrypt($project->pj_nama)}}</td>
                        <td class="pj_cs" hidden>{{ $project->vendors->cs_id }}</td>
                        <td class="">{{$data_v->decrypt($project->vendors->cs_nama)}}</td>
                        <td class="pj_pic">{{$data_p->decrypt($project->pj_pic)}}</td>
                        <td class="pj_nilai_kontrak">{{number_format($data_p->decrypt($project->pj_nilai_kontrak), 0 , ',', '.')}}</td>
                        <td class="pj_tgl_mulai">{{$data_p->decrypt($project->pj_tgl_mulai)}}</td>
                        <td class="pj_tgl_selesai">{{$data_p->decrypt($project->pj_tgl_selesai)}}</td>
                        <td>
                            <a role="button" class="btn btn-default btn-sm btn-flat"
                                href='progress?kd_project={{$project->kd_project }}'
                                onclick="Progress('{{ $project->kd_project }}')">Progress</a>
                        </td>
                        <td>
                            <a role="button" class="btn btn-default btn-sm btn-flat"
                            href='order?kd_project={{ $project->kd_project }}'
                            onclick="Order('{{ $project->kd_project }}')">Orders</a>
                        </td>
                        @php
                        $time_end = microtime(true) * 1000;
                        $dt = new DecryptTime($time_end, $time_start);
                        $st = $dt->decryptTime($project->kd_project);
                        @endphp
                        @if ($data_p->decrypt($project->pj_status) == "Open")
                            <td class="pj_status"><span class="label label-warning" style="font-weight: normal !important;">Open</span></td>
                            <td>
                                <a href="javascript:void(0)" id="edit-item-project"
                                data-item-id="{{ $project->kd_project }}"
                                data-url-edit="{{ url('project', $project->kd_project) }}">
                                <i class="fa fa-edit" style="margin-right: 20px; color: #2196f3; font-size: 16px;"></i>
                                </a>
                                <a href="javascript:void(0)" data-toggle="modal" data-target="#cant-delete-project"
                                data-backdrop="false">
                                <i class="fa fa-trash" style="color: #f44336; font-size: 16px;"></i>
                                </a>
                            </td>
                        @elseif($data_p->decrypt($project->pj_status) == "Close")
                            <td class="pj_status"><span class="label label-success" style="font-weight: normal !important;" id="pj_status">Close</span></td>
                            <td>
                                <a href="javascript:void(0)" id="edit-item-project"
                                data-item-id="{{ $project->kd_project }}"
                                data-url-edit="{{ url('project', $project->kd_project) }}">
                                <i class="fa fa-edit" style="margin-right: 20px; color: #2196f3; font-size: 16px;"></i>
                                </a>
                                <a href="javascript:void(0)" id="delete-item-project"
                                data-item-id="{{ $project->kd_project }}"
                                data-nama="{{ $data_p->decrypt($project->pj_nama) }}"
                                data-url-delete="{{ url('project', $project->kd_project) }}">
                                <i class="fa fa-trash" style="color: #f44336; font-size: 16px;"></i>
                            </a>
                            </td>
                        @endif
                    </tr>
