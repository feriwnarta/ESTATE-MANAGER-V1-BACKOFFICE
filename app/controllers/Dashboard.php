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
        $this->view('templates/header', $data);
        $this->view('dashboard/index', $card);
        $this->view('templates/footer');
    }

    public function updateChart()
    {
        if (isset($_POST['id_category'])) {
            $id_category = $_POST['id_category'];
            $wktu = $_POST['wktu'];
            echo json_encode($this->model('dashboardmodel')->getDataChartByCategory($id_category, $wktu));
        }
    }
}
