<?php

class Dashboard extends Controller
{
    public function index()
    {
        $data['judul'] = 'Dashboard ';
        $obj_dashboard = $this->model('dashboardmodel');
        $card['title'] = $obj_dashboard->getStatisticTitle();
        $card['dropdown'] = $obj_dashboard
            ->getStatisticDropdown($card['title']);
        $card['pie_total_laporan'] = $obj_dashboard->getDataChartPie();
        // $w = 1;
        // for($i = 1; $i <= 200; $i++) {
        //     $w++;
        //     echo str_pad($w,4,"0",STR_PAD_LEFT); 
        // }
        $this->view('templates/header', $data);
        $this->view('dashboard/index', $card);
        $this->view('templates/footer');
    }

    public function updateChart()
    {
        if (isset($_POST['id_category'])) {
            $id_category = $_POST['id_category'];
            $wktu = $_POST['wktu'];
            // echo json_encode($this->model('dashboardmodel')->getDataChartByCategory($id_category, $wktu));
        }
    }
}
