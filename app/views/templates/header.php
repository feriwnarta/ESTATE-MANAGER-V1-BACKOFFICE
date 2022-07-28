<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $data['judul']; ?></title>
    <link rel="stylesheet" href="<?= BASE_URL; ?>/css/bootstrap.css">
    <link rel="stylesheet" href="<?= BASE_URL; ?>/css/style-web.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter&display=swap" rel="stylesheet">
    <script src="<?= BASE_URL; ?>/js/jquery-3.6.0.min.js"></script>
</head>

<body>

    <!-- sidebar -->
    <div class="container-fluid sidebar-menu">
        <div class="row">
            <div class="col-sm-auto sticky-top container-sidebar-shadow">
                <div class="d-flex flex-sm-column flex-row flex-nowrap bg-light align-items-center sticky-top container-sidebar">
                    <div class="sidebar-top"></div>
                    <ul class="nav nav-pills nav-flush flex-sm-column flex-row flex-nowrap mb-auto mx-auto text-center align-items-center">
                        <li class="nav-item">
                            <a href="#" class="nav-link py-3 px-2" title="" data-bs-toggle="tooltip" data-bs-placement="right" data-bs-original-title="Home">
                                <object data="<?= BASE_URL; ?>/img/icon/dashboard.svg" width="20" height="20"> </object>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link py-3 px-2" title="" data-bs-toggle="tooltip" data-bs-placement="right" data-bs-original-title="Dashboard">
                                <object data="<?= BASE_URL; ?>/img/icon/add.svg" width="20" height="20"> </object>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link py-3 px-2" title="" data-bs-toggle="tooltip" data-bs-placement="right" data-bs-original-title="Orders">
                                <object data="<?= BASE_URL; ?>/img/icon/security.svg" width="20" height="20"> </object>
                            </a>
                        </li>
                        <li class="nav-item bg">
                            <a href="#" class="nav-link py-3 px-2" title="" data-bs-toggle="tooltip" data-bs-placement="right" data-bs-original-title="Products">
                                <object data="<?= BASE_URL; ?>/img/icon/settings.svg" width="20" height="20"> </object>
                            </a>
                        </li>
                    </ul>
                    <div class="title-bgm-text">
                        <h3>BGM RW 05</h3>
                    </div>
                    <div class="logo-bgm">
                        <object data="<?= BASE_URL; ?>/img/logo-bgm.svg" width="30" height="30"> </object>
                    </div>
                    <div class="navbar togglemobile">
                        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                            <span class="navbar-toggler-icon"></span>
                        </button>
                    </div>
                </div>
            </div>
            <div class="pembungkus col-sm p-3 min-vh-100">