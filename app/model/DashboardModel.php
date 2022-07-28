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
    public function getDataChartByCategory($id_category = 0)
    {
        date_default_timezone_set('asia/jakarta');
        $date_4 = date('Y-m-d H:i:s', strtotime('-6 hour'));
        $date_3 = date('Y-m-d H:i:s', strtotime('-6 hour'));
        $date_2 = date('Y-m-d H:i:s', strtotime('-6 hour'));
        $date_1 = date('Y-m-d H:i:s', strtotime('-6 hour'));
        $date_0 = date('Y-m-d H:i:s');

        $jam_skrg = $this->getDataChartByHour($id_category, $date_1, $date_0);

        // query jam sekarang dikurangi -2 jam
        // $query2 = "SELECT COUNT(id_report) AS total FROM tb_report WHERE CONCAT(date_post, ' ', time_post) > :date2 AND CONCAT(date_post, ' ', time_post) < :date1 AND id_category = :id_category";
        // $this->db->query_app($query2);
        // $this->db->bind_data_app('date2', $date_2);
        // $this->db->bind_data_app('date1', $date_1);
        // $this->db->bind_data_app('id_category', $id_category);
        $jam_skrg_2 = $this->getDataChartByHour($id_category, $date_2, $date_1);

        // query jam sekarang dikurangi -3 jam
        // $query3 = "SELECT COUNT(id_report) AS total FROM tb_report WHERE CONCAT(date_post, ' ', time_post) > :date3 AND CONCAT(date_post, ' ', time_post) < :date2 AND id_category = :id_category";
        // $this->db->query_app($query3);
        // $this->db->bind_data_app('date3', $date_3);
        // $this->db->bind_data_app('date2', $date_2);
        // $this->db->bind_data_app('id_category', $id_category);
        $jam_skrg_3 = $this->getDataChartByHour($id_category, $date_3, $date_2);


        // query jam sekarang dikurangi -4 jam
        // $query4 = "SELECT COUNT(id_report) AS total FROM tb_report WHERE CONCAT(date_post, ' ', time_post) > :date4 AND CONCAT(date_post, ' ', time_post) < :date3 AND id_category = :id_category";
        // $this->db->query_app($query4);
        // $this->db->bind_data_app('date4', $date_4);
        // $this->db->bind_data_app('date3', $date_3);
        // $this->db->bind_data_app('id_category', $id_category);
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

        return $data_balik = [
            'jam_sekarang_1' => $jam_skrg['total'],
            'jam_sekarang_2' => $jam_skrg_2['total'],
            'jam_sekarang_3' => $jam_skrg_3['total'],
            'jam_sekarang_4' => $jam_skrg_4['total'],
            'total' => $total,
            'nama_kategori'  =>$nama_category['category'],
            'nama_kontraktor'=>$nama_kontraktor['name_contractor'],
        ];
    }

    private function getDataChartByHour($id_category, $date1, $date2) {
        // query jam sekarang dikurangi -3 jam
        $query3 = "SELECT COUNT(id_report) AS total FROM tb_report WHERE CONCAT(date_post, ' ', time_post) > :date1 AND CONCAT(date_post, ' ', time_post) < :date2 AND id_category = :id_category";
        $this->db->query_app($query3);
        $this->db->bind_data_app('date1', $date1);
        $this->db->bind_data_app('date2', $date2);
        $this->db->bind_data_app('id_category', $id_category);
       return $this->db->single_app();
    }
}
