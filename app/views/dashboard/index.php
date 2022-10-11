<!-- section header -->
<div class="dashboard">
    <section id="header">
        <div class="container-fluid title">
            <div class="row">
                <div class="col-sm text-left">
                    <h1>Selamat Datang, Danu</h1>
                    <p class="subtitle">Lacak, kelola dan perkirakan pegawai dan laporan yang ada.</p>
                </div>
                <div class="col-sm search-bar d-flex justify-content-end">
                    <div>
                        <form role="search">
                            <input type="text" placeholder="&#xF002; Search" style="font-family: 'Helvetica', FontAwesome, sans-serif;" class="search-box ps-3" />
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- end section header -->

    <!-- section filter -->
    <section id="filter">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-6 filter-tgl text-left filter-btn">
                    <div class="btn-group text-center" role="group" aria-label="Basic radio toggle button group">
                        <input value="1hr" type="radio" class="btn-check" name="btnradio" id="btnradio1" autocomplete="off" checked>
                        <label class="btn btn-outline-secondary" for="btnradio1">1 hari</label>

                        <input value="7hr" type="radio" class="btn-check" name="btnradio" id="btnradio2" autocomplete="off">
                        <label class="btn btn-outline-secondary" for="btnradio2">7 hari</label>

                        <input value="30hr" type="radio" class="btn-check" name="btnradio" id="btnradio3" autocomplete="off">
                        <label class="btn btn-outline-secondary" for="btnradio3">30 hari</label>

                        <input value="12bln" type="radio" class="btn-check" name="btnradio" id="btnradio4" autocomplete="off">
                        <label class="btn btn-width btn-outline-secondary" for="btnradio4">12 bulan</label>
                    </div>
                </div>

                <div class="col-lg-6 d-flex justify-content-lg-end filter-group-btn">
                    <div class="container-tanggal">
                        <button class="d-flex btn-tgl justify-content-around align-items-center btn-tanggal">
                            <object data="<?= BASE_URL; ?>/img/icon/tanggal.svg"> </object>
                            Pilih tanggal
                        </button>
                    </div>
                    <div style="width: 12px;"></div>
                    <div class="container-tanggal">
                        <button class="d-flex btn-tgl justify-content-around align-items-center btn-filter">
                            <object data="<?= BASE_URL; ?>/img/icon/tanggal.svg"> </object>
                            filter
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <!-- card chart section -->
    <section id="card-statistic-line" class="mt-4">
        <div class="container-fluid pembungkus-card">
            <div class="row">
                <?php foreach ($data['title'] as $key2 => $value_master) { ?>
                    <div id="card<?= $value_master['id_master_category']; ?>" class="card card-line col-lg-3 col-12">
                        <div class="card-body">
                            <h5 class="card-title">Penilaian <?= $value_master['unit']; ?> </h5>
                            <h6 class="card-subtitle mb-2 text-muted">
                                <!-- looping isi dropdown -->
                                <?php
                                $data_dropdown = array();
                                foreach ($data['dropdown'] as $key_dropdowns => $value_dropdown) {
                                    if ($value_dropdown['id_master_category'] == $value_master['id_master_category']) {
                                        $data_dropdown[] = array(
                                            "id_category" => $value_dropdown['id_category'],
                                            "category" => $value_dropdown['category'],
                                            "id_master" => $value_dropdown['id_master_category']
                                        );
                                    }
                                }
                                ?>


                                <div class="btn-group d-flex justify-content-between">
                                    <button id="card<?= $value_master['id_master_category']; ?>" value="<?= $data_dropdown[0]['id_category']; ?>" type="button" class="btn-secondary btn-dropdown-title"><?= $data_dropdown[0]['category']; ?></button>

                                    <button value="card<?= $value_master['id_master_category']; ?>" type="button" class="btn-click btn-danger dropdown-toggle dropdown-toggle-split btn-dropdown-menu" data-bs-toggle="dropdown" aria-expanded="false">
                                        <span class="visually-hidden">Toggle Dropdown</span>
                                    </button>

                                    <ul id="card<?= $value_master['id_master_category']; ?>" class="dropdown-menu">
                                        <?php foreach ($data_dropdown as $value) { ?>
                                            <li id="card<?= $value_master['id_master_category']; ?>" value="<?= $value['id_category']; ?>"><a class="dropdown-item" href="" onclick="return false;"><?= $value['category']; ?></a></li>
                                        <?php } ?>
                                    </ul>
                                </div>
                            </h6>

                            <div class="row">
                                <div class="col container-persentase">
                                    <h3 id="card<?= $value_master['id_master_category']; ?>" id="chartPersentase" class="col">75 %</h3>
                                    <div id="card<?= $value_master['id_master_category']; ?>">
                                        <p class="col text-kontraktor">PT Delcoin</p>
                                    </div>
                                </div>
                                <div class="col container-chart">
                                    <canvas id="chart<?= $value_master['id_master_category']; ?>" height="82px"></canvas>
                                    <br>
                                    <div class="arrow-down-chart">
                                        <object data="<?= BASE_URL; ?>/img/icon/arrow-down.svg"></object>
                                        <p id="card<?= $value_master['id_master_category']; ?>">25%</p>
                                        <!-- <div class="col-lg-5"></div> -->
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                <?php } ?>

            </div>
        </div>
    </section>
    <!-- End Section Card Chart -->

    <!-- Section pie chart -->
    <section id="piechart">
        <div class="container-fluid pembungkus-card">
            <div class="row">

                <div id="card" class="card card-line col-lg-3 col-12">
                    <div class="card-body">
                        <div class="card-title-pie">Total Laporan</div>

                        <div class="row card-body-pie">
                            <div class="col-6 container-pie">
                                <canvas id="pie"></canvas>
                            </div>
                            <div class="col-6 container-content-pie my-auto">
                                <div class="pie-body">12 Landscape</div>
                                <div class="pie-body">asdasd</div>
                                <div class="pie-body">asdasd</div>
                                <div class="pie-body">asdasd</div>
                                <div class="pie-body">asdasd</div>
                            </div>
                        </div>
                    </div>
                </div>



            </div>
        </div>
    </section>
    <!-- End Section pie chart -->