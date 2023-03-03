<?php

namespace App\Helpers;

use App\Models\ProjectModel;

class KodeGenerator
{

    private $awal = 'PJ';
    private $hasil;
    public function KdProject()
    {

        $pj = $this->awal;
        $noUrutAkhir = ProjectModel::count();

        if ($noUrutAkhir) {
            $this->hasil = $pj . sprintf('%04d', $noUrutAkhir + 1);
        } else {
            $this->hasil = $pj . sprintf('%04s', +1);
        }

        return $this->hasil;
    }
}
