<?php

namespace App\Helpers;

use App\Helpers\RC4;

class KeyGenerator
{

    private $UUID; //$uuid
    private $cUUID;
    private $eUUID;
    private $ctextCreate;
    private $ctextUpdate;
    private $ObjekData;
    private $ObjekUuid;

    public function UUID($data)
    {
        $this->UUID = $data;

        return $this->UUID;
    }

    public function prepare_uuid()
    {
        $this->ObjekUuid = new RC4('q3pF32Yp8AaJ2NFFvUCm8IYfBabRoZIWZ3LurTNB53yjtYlWYRdx5EIN9ZTG0WW');

        return $this->ObjekUuid;
    }

    public function prepare_data($data)
    {
        $this->ObjekData = new RC4($data);

        return $this->ObjekData;
    }

    public function CUUID($data)
    {
        $this->cUUID = $data;
    }

    public function Enkrip($plainteks)
    {

        $this->prepare_data($this->UUID);
        $this->ctextCreate =  $this->ObjekData->encrypt($plainteks);

        return $this->ctextCreate;
    }

    public function EnkripUpdate($plainteks)
    {
        $this->prepare_data($this->cUUID);
        $this->ctextUpdate = $this->ObjekData->encrypt($plainteks);

        return $this->ctextUpdate;
    }

    public function EnkripUUID($plainteks)
    {
        $this->prepare_uuid();
        $this->eUUID = $this->ObjekUuid->encrypt($plainteks);

        return $this->eUUID;
    }

    public function DekripUUID($cipherteks)
    {
        $this->prepare_uuid();
        $this->dUUID = $this->ObjekUuid->decrypt($cipherteks);

        return $this->dUUID;
    }
}
