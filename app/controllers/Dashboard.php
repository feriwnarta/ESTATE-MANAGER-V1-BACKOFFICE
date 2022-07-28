<?php

class Dashboard extends Controller {
    public function index() {
        $data['judul'] = 'Dashboard ';
        $card['title'] = $this->model('dashboardmodel')->getStatisticTitle();
        $this->model('dashboardmodel')->getDataChartByCategory(2);
        $card['dropdown'] = $this->model('dashboardmodel')
        ->getStatisticDropdown($card['title']);
        $this->view('templates/header', $data);
        $this->view('dashboard/index', $card);
        $this->view('templates/footer');
    }

    public function updateChart() {
        if(isset($_POST['id_category'])) {
            $id_category = $_POST['id_category'];
            $wktu = $_POST['wktu'];
            echo json_encode($this->model('dashboardmodel')->getDataChartByCategory($id_category, $wktu));
        }
    }
}
