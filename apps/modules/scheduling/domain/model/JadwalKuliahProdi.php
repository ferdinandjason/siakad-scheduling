<?php

namespace Siakad\Scheduling\Domain\Model;

class JadwalKuliahProdi
{
    private $hari;
    private $jadwalKelasArray;

    public function __construct($hari, $jadwalKelasArray)
    {
        $this->hari = $hari;
        $this->jadwalKelasArray = $jadwalKelasArray;
    }

    public function addJadwalKelas(JadwalKelas $jadwalKelas)
    {
        array_push($this->jadwalKelasArray, $jadwalKelas);

        return $jadwalKelas;
    }

    public function validasi()
    {
        for($i=0; $i<count($this->jadwalKelasArray); $i++)
        {
            for($j=$i+1; $j<count($this->jadwalKelasArray); $j++)
            {
                $jadwalKelas = $this->jadwalKelasArray[$i];
                $jadwalKelas2 = $this->jadwalKelasArray[$j];

                if($jadwalKelas->getDosen()->getId() == $jadwalKelas2->getDosen()->getId() &&
                    $jadwalKelas->getPeriodeKuliah()->getId() == $jadwalKelas2->getPeriodeKuliah()->getId())
                    {
                        $jadwalKelas->setValid(0);
                        $jadwalKelas2->setValid(0);
                    }
            }
        }
    }

    public function getJadwalKelas()
    {
        return $this->jadwalKelasArray;
    }
}