<?php

class DashboardModel
{
    private $db;

    public function __construct()
    {
        $this->db = new Database;
    }

    public function getStatisticTitle()
    {
        // select data tb category, untuk mendapatkan dropdown
        $query = 'SELECT * FROM tb_master_category';
        $this->db->query_app($query);
        $master_category = $this->db->fetch_all_app();
        // var_dump($master_category);

        return $master_category;
    }

    public function getStatisticDropdown($master_category)
    {
        $name_master_category = array();
        $category = array();
        // looping seluruh isi tb master category dan dapatkan id nya
        foreach ($master_category as $key => $value) {
            $name_master_category[] = $value['unit'];
            $id_master_category = $value['id_master_category'];

            // select isi tb category berdasarkan id category
            $query_category = 'SELECT * FROM tb_category WHERE id_master_category=:id';
            $this->db->query_app($query_category);
            $this->db->bind_data_app('id', $id_master_category);
            $data = $this->db->fetch_all_app();

            // looping isi dari tb category
            foreach ($data as $value) {
                $category[] = $value;
            }
        }
        // var_dump($category);
        return $category;
    }

    // mengambil data chart berdasarkan category id
    public function getDataChartByCategory($id_category = 0, $wktu = '1hr')
    {
        date_default_timezone_set('asia/jakarta');

        if ($wktu == '1hr') {
            $date_4 = date('Y-m-d H:i:s', strtotime('-24 hour'));
            $date_3 = date('Y-m-d H:i:s', strtotime('-18 hour'));
            $date_2 = date('Y-m-d H:i:s', strtotime('-12 hour'));
            $date_1 = date('Y-m-d H:i:s', strtotime('-6 hour'));
            $date_0 = date('Y-m-d H:i:s');
        } else if ($wktu == '7hr') {
            $date_4 = date('Y-m-d H:i:s', strtotime('-144 hour'));
            $date_3 = date('Y-m-d H:i:s', strtotime('-108 hour'));
            $date_2 = date('Y-m-d H:i:s', strtotime('-72 hour'));
            $date_1 = date('Y-m-d H:i:s', strtotime('-36 hour'));
            $date_0 = date('Y-m-d H:i:s');
        } else if ($wktu == '30hr') {
            $date_4 = date('Y-m-d H:i:s', strtotime('-720 hour'));
            $date_3 = date('Y-m-d H:i:s', strtotime('-540 hour'));
            $date_2 = date('Y-m-d H:i:s', strtotime('-360 hour'));
            $date_1 = date('Y-m-d H:i:s', strtotime('-180 hour'));
            $date_0 = date('Y-m-d H:i:s');
        } else if ($wktu == '12bln') {
            $date_4 = date('Y-m-d H:i:s', strtotime('-8760 hour'));
            $date_3 = date('Y-m-d H:i:s', strtotime('-6570 hour'));
            $date_2 = date('Y-m-d H:i:s', strtotime('-4380 hour'));
            $date_1 = date('Y-m-d H:i:s', strtotime('-2190 hour'));
            $date_0 = date('Y-m-d H:i:s');
        }

        $jam_skrg = $this->getDataChartByHour($id_category, $date_1, $date_0);
        $jam_skrg_2 = $this->getDataChartByHour($id_category, $date_2, $date_1);
        $jam_skrg_3 = $this->getDataChartByHour($id_category, $date_3, $date_2);
        $jam_skrg_4 = $this->getDataChartByHour($id_category, $date_4, $date_3);

        $total = $jam_skrg['total'] + $jam_skrg_2['total'] + $jam_skrg_3['total'] + $jam_skrg_4['total'];

        // cek kategory 
        $query_kategory = 'SELECT category FROM tb_category WHERE id_category = :id_category';
        $this->db->query_app($query_kategory);
        $this->db->bind_data_app('id_category', $id_category);
        $nama_category = $this->db->single_app();

        // ambil nama kontraktor
        $query_kontraktor = 'SELECT c.name_contractor FROM tb_contractor_job AS cj INNER JOIN tb_contractor AS c ON cj.id_contractor = c.id_contractor WHERE cj.id_category = :id_category';
        $this->db->query_app($query_kontraktor);
        $this->db->bind_data_app('id_category', $id_category);
        $nama_kontraktor = $this->db->single_app();

        // panggil method hitung persentase hri target dibandingkan dgn hari ini
        $persentaseTarget = $this->getPersentase($id_category, $wktu);

        return $data_balik = [
            'jam_sekarang_1' => $jam_skrg['total'],
            'jam_sekarang_2' => $jam_skrg_2['total'],
            'jam_sekarang_3' => $jam_skrg_3['total'],
            'jam_sekarang_4' => $jam_skrg_4['total'],
            'total' => $total,
            'nama_kategori'  => $nama_category['category'],
            'nama_kontraktor' => $nama_kontraktor['name_contractor'],
            'persentase' => $persentaseTarget
        ];
    }

    private function getPersentase($id_category, $wktu = '1hr')
    {
        // date_default_timezone_set('asia/jakarta');
        // satu hari bulan ini
        if ($wktu == '1hr') {
            $hr_awal = date('Y-m-d H:i:s');
            $hr_akhir = date('Y-m-d H:i:s', strtotime('-1 days'));
            $hri_target_pembanding = date('Y-m-d H:i:s', strtotime('-2 days'));
            $hr_pembanding = date('Y-m-d H:i:s', strtotime('-1 days -1 minutes'));
        }
        // satu minggu bulan ini
        else if ($wktu == '7hr') {
            $hr_awal = date('Y-m-d H:i:s');
            $hr_akhir = date('Y-m-d H:i:s', strtotime('-7 days'));
            $hri_target_pembanding = date('Y-m-d H:i:s', strtotime('-15 days'));
            $hr_pembanding = date('Y-m-d H:i:s', strtotime('-7 days -1 minutes'));
        }
        // satu bulan bulan ini
        else if ($wktu == '30hr') {
            $hr_awal = date('Y-m-d H:i:s');
            $hr_akhir = date('Y-m-d H:i:s', strtotime('-30 days'));
            $hri_target_pembanding = date('Y-m-d H:i:s', strtotime('-32 days'));
            $hr_pembanding = date('Y-m-d H:i:s', strtotime('-30 days -1 minutes'));
        } else {
            $hr_awal = date('Y-m-d H:i:s');
            $hr_akhir = date('Y-m-d H:i:s', strtotime('-365 days'));
            $hri_target_pembanding = date('Y-m-d H:i:s', strtotime('-366 days'));
            $hr_pembanding = date('Y-m-d H:i:s', strtotime('-365 days -1 minutes'));
        }

        // query awal
        $queryHrIni = "SELECT COUNT(id_report) AS total FROM tb_report WHERE CONCAT(date_post, ' ', time_post) > :date1 AND CONCAT(date_post, ' ', time_post) < :date2 AND id_category = :id_category";
        $this->db->query_app($queryHrIni);
        $this->db->bind_data_app('date1', $hr_akhir);
        $this->db->bind_data_app('date2', $hr_awal);
        $this->db->bind_data_app('id_category', $id_category);
        $resultHrIni =  $this->db->single_app()['total'];


        // query pembanding
        $queryTarget = "SELECT COUNT(id_report) AS total FROM tb_report WHERE CONCAT(date_post, ' ', time_post) > :date1 AND CONCAT(date_post, ' ', time_post) < :date2 AND id_category = :id_category";
        $this->db->query_app($queryTarget);
        $this->db->bind_data_app('date1', $hri_target_pembanding);
        $this->db->bind_data_app('date2', $hr_pembanding);
        $this->db->bind_data_app('id_category', $id_category);
        $resultTarget =  $this->db->single_app()['total'];

        // hitung persentase laporan hr kemarin, 7hr yg lalu, 30 hr yang lalu, sampai 1 tahun yg lalu
        if ($wktu == '1hr') {
            $resultPersentaseTarget = 100 - $resultTarget;
            $resultPersentaseHrIni = 100 - $resultHrIni;
            $resultPersentaseHrIni -= $resultPersentaseTarget;
        } else if ($wktu == '7hr') {
            $resultPersentaseTarget = 700 - $resultTarget;
            $resultPersentaseTarget /=  7;
            $resultPersentaseTarget = round($resultPersentaseTarget);

            $resultPersentaseHrIni = 700 - $resultHrIni;
            $resultPersentaseHrIni /= 7;
            $resultPersentaseHrIni = round($resultPersentaseHrIni);

            $resultPersentaseHrIni -= $resultPersentaseTarget;
        } else if ($wktu == '30hr') {
            $resultPersentaseTarget = 3000 - $resultTarget;
            $resultPersentaseTarget /=  30;
            $resultPersentaseTarget = round($resultPersentaseTarget);

            $resultPersentaseHrIni = 3000 - $resultHrIni;
            $resultPersentaseHrIni /= 30;
            $resultPersentaseHrIni = round($resultPersentaseHrIni);

            $resultPersentaseHrIni -= $resultPersentaseTarget;
            // var_dump($resultPersentaseHrIni);
        } else {
            $resultPersentaseTarget = 36500 - $resultTarget;
            $resultPersentaseTarget /=  365;
            $resultPersentaseTarget = round($resultPersentaseTarget);

            $resultPersentaseHrIni = 36500 - $resultHrIni;
            $resultPersentaseHrIni /= 365;
            $resultPersentaseHrIni = round($resultPersentaseHrIni);

            $resultPersentaseHrIni -= $resultPersentaseTarget;
        }
        return $resultPersentaseHrIni;
    }

    private function getDataChartByHour($id_category, $date1, $date2)
    {
        // query jam sekarang dikurangi -3 jam
        $query3 = "SELECT COUNT(id_report) AS total FROM tb_report WHERE CONCAT(date_post, ' ', time_post) > :date1 AND CONCAT(date_post, ' ', time_post) < :date2 AND id_category = :id_category";
        $this->db->query_app($query3);
        $this->db->bind_data_app('date1', $date1);
        $this->db->bind_data_app('date2', $date2);
        $this->db->bind_data_app('id_category', $id_category);
        return $this->db->single_app();
    }
}
