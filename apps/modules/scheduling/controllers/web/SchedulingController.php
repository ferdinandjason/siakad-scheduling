<?php

namespace Siakad\Scheduling\Controllers\Web;

use Phalcon\Mvc\Controller;
use Siakad\Scheduling\Application\MelihatJadwalKuliahProdiRequest;
use Siakad\Scheduling\Application\MelihatJadwalKuliahProdiService;
use Siakad\Scheduling\Application\MelihatPeriodeKuliahRequest;
use Siakad\Scheduling\Application\MelihatPeriodeKuliahService;
use Siakad\Scheduling\Application\MelihatPeriodeSemesterRequest;
use Siakad\Scheduling\Application\MelihatPeriodeSemesterService;

class SchedulingController extends Controller
{
    public function indexAction()
    {

    }

    public function prodiAction()
    {
        $periodeKuliahTipe = $this->dispatcher->getParam('tipe');
        $periodeKuliahTahun = $this->dispatcher->getParam('tahun');

        $jadwalKuliahRepository = $this->di->getShared('sql_jadwal_kelas_repository');
        $service = new MelihatJadwalKuliahProdiService($jadwalKuliahRepository);
        $response = $service->execute(
            new MelihatJadwalKuliahProdiRequest(
                $periodeKuliahTipe,
                $periodeKuliahTahun
            )
        );

        $this->view->setVar('jadwalKuliah', $response->data);
        return $this->view->pick('jadwal/prodi');
    }

    public function periodeSemesterAction()
    {
        $semesterRepository = $this->di->getShared('sql_semester_repository');
        $service = new MelihatPeriodeSemesterService($semesterRepository);
        $response = $service->execute(
            new MelihatPeriodeSemesterRequest()
        );

        $this->view->setVar('periodeSemester', $response->data);
        return $this->view->pick('jadwal/periode-semester');
    }

    public function periodeKuliahAction()
    {
        $periodeKuliahRepository = $this->di->getShared('sql_periode_kuliah_repository');
        $service = new MelihatPeriodeKuliahService($periodeKuliahRepository);
        $response = $service->execute(
            new MelihatPeriodeKuliahRequest()
        );

        $this->view->setVar('periodeKuliah', $response->data);
        return $this->view->pick('jadwal/periode-kuliah');
    }

}