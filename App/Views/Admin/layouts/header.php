<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en-US" lang="en-US">

<head>
    <meta charset="utf-8">
    <title> Admin Dashboard </title>

    <meta name="author" content="themesflat.com">

    <!-- Mobile Specific Metas -->
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

    <!-- Theme Style -->
    <link rel="stylesheet" type="text/css" href="/Douong_Pony/Assets/Admin/css/animate.min.css">
    <link rel="stylesheet" type="text/css" href="/Douong_Pony/Assets/Admin/css/animation.css">
    <link rel="stylesheet" type="text/css" href="/Douong_Pony/Assets/Admin/css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="/Douong_Pony/Assets/Admin/css/bootstrap-select.min.css">
    <link rel="stylesheet" type="text/css" href="/Douong_Pony/Assets/Admin/css/styles.css">
    



    <!-- Font -->
    <link rel="stylesheet" href="/Douong_Pony/Assets/Admin/font/fonts.css">

    <!-- Icon -->
    <link rel="stylesheet" href="/Douong_Pony/Assets/Admin/icon/style.css">

    <!-- Favicon and Touch Icons  -->
    <link rel="shortcut icon" href="images/favicon.png">
    <link rel="apple-touch-icon-precomposed" href="images/favicon.png">

</head>

<body class="body">

    <!-- #wrapper -->
    <div id="wrapper">
        <!-- #page -->
        <div id="page" class="">
            <!-- layout-wrap -->
            <div class="layout-wrap loader-off">
                <!-- preload -->
                <div id="preload" class="preload-container">
                    <div class="preloading">
                        <span></span>
                    </div>
                </div>
                <!-- /preload -->
                <!-- section-menu-left -->
                <div class="section-menu-left">
                    <!-- <div class="box-logo">
                        <a href="index.html" id="site-logo-inner">
                            <img class="" id="logo_header" alt="" src="https://themesflat.co/html/ecomus/images/logo/logo.svg" data-light="../images/logo/logo.svg" data-dark="https://themesflat.co/html/ecomus/images/logo/logo-white.svg" >
                        </a>
                        <div class="button-show-hide">
                            <i class="icon-chevron-left"></i>
                        </div>
                    </div> -->
                    <div class="section-menu-left-wrap">
                        <div class="center">
                            <div class="center-item">
                                <ul class="">
                                <li class="menu-item has-children <?= ($_GET['act'] == 'all-product') ? 'active' : '' ?>">
                                    <a href="<?= BASE_URL_ADMIN ?>act=all-product" class="menu-item-button">
                                            <div class="icon"><i class="icon-file-plus"></i></div>
                                            <div class="text">Sản phẩm</div>
                                        </a>
                                    </li>
                                    <li class="menu-item has-children <?= ($_GET['act'] == 'category') ? 'active' : '' ?>">
                                        <a href="<?= BASE_URL_ADMIN  ?>act=category" class="menu-item-button">
                                            <div class="icon"><i class="icon-layers"></i></div>
                                            <div class="text">Danh mục</div>
                                        </a>
            
                                    </li>
        
                                    <li class="menu-item has-children <?= ($_GET['act'] == 'orders') ? 'active' : '' ?>">
                                        <a href="<?= BASE_URL_ADMIN  ?>act=orders" class="menu-item-button">
                                            <div class="icon">
                                                <svg width="24" height="22" viewBox="0 0 20 22" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M10.0001 2C8.34322 2 7.00008 3.34315 7.00008 5V5.75H13.0001V5C13.0001 3.34315 11.6569 2 10.0001 2ZM14.5001 5.75V5C14.5001 2.51472 12.4854 0.5 10.0001 0.5C7.51479 0.5 5.50008 2.51472 5.50008 5V5.75H3.51287C2.55332 5.75 1.74862 6.47444 1.64817 7.42872L0.385015 19.4287C0.268481 20.5358 1.13652 21.5 2.24971 21.5H17.7504C18.8636 21.5 19.7317 20.5358 19.6151 19.4287L18.352 7.42872C18.2515 6.47444 17.4468 5.75 16.4873 5.75H14.5001ZM13.0001 7.25H7.00008V8.66146C7.23023 8.86745 7.37508 9.16681 7.37508 9.5C7.37508 10.1213 6.8714 10.625 6.25008 10.625C5.62876 10.625 5.12508 10.1213 5.12508 9.5C5.12508 9.16681 5.26992 8.86745 5.50008 8.66146V7.25H3.51287C3.32096 7.25 3.16002 7.39489 3.13993 7.58574L1.87677 19.5857C1.85347 19.8072 2.02707 20 2.24971 20H17.7504C17.9731 20 18.1467 19.8072 18.1234 19.5857L16.8602 7.58574C16.8401 7.39489 16.6792 7.25 16.4873 7.25H14.5001V8.66146C14.7302 8.86746 14.8751 9.16681 14.8751 9.5C14.8751 10.1213 14.3714 10.625 13.7501 10.625C13.1288 10.625 12.6251 10.1213 12.6251 9.5C12.6251 9.16681 12.7699 8.86745 13.0001 8.66146V7.25Z" fill="#111111" />
                                                </svg>
                                            </div>
                                            <div class="text">Đơn hàng</div>
                                        </a>
                                    </li>
                                    <li class="menu-item has-children <?= ($_GET['act'] == 'user-all') ? 'active' : '' ?>">

                                        <a href="<?= BASE_URL_ADMIN  ?>act=user-all" class="menu-item-button">
                                            <div class="icon"><i class="icon-user"></i></div>
                                            <div class="text">Người dùng</div>
                                        </a>
                                    </li>
                                    <li class="menu-item has-children">
                                        <a href="<?= BASE_URL ?>" class="menu-item-button">
                                            <div class="icon">
                                                <svg width="24" height="22" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M5.1392 7.41658C5.73654 7.87694 6.38132 8.27855 7.06498 8.61284C7.30482 7.3722 7.67417 6.24668 8.1472 5.30063C8.29118 5.01266 8.44837 4.7351 8.61825 4.47262C7.20101 5.11026 5.99608 6.13656 5.1392 7.41658ZM12 2.25C8.3534 2.25 5.17543 4.25226 3.50379 7.21378C2.70535 8.62832 2.25 10.2621 2.25 12C2.25 12.8417 2.35682 13.6595 2.55803 14.4401C3.64146 18.6436 7.45701 21.75 12 21.75C16.543 21.75 20.3585 18.6436 21.442 14.4401C21.6432 13.6595 21.75 12.8417 21.75 12C21.75 10.2621 21.2947 8.62832 20.4962 7.21378C18.8246 4.25226 15.6466 2.25 12 2.25ZM12 3.75C11.1945 3.75 10.2633 4.4225 9.48884 5.97145C9.0479 6.85334 8.69814 7.95052 8.48423 9.18993C9.5902 9.55342 10.772 9.75 12 9.75C13.228 9.75 14.4098 9.55342 15.5158 9.18993C15.3019 7.95052 14.9521 6.85334 14.5112 5.97145C13.7367 4.4225 12.8055 3.75 12 3.75ZM16.935 8.61284C16.6952 7.3722 16.3258 6.24668 15.8528 5.30063C15.7088 5.01266 15.5516 4.7351 15.3817 4.47262C16.799 5.11026 18.0039 6.13656 18.8608 7.41657C18.2635 7.87693 17.6187 8.27855 16.935 8.61284ZM15.7017 10.7042C14.53 11.0591 13.2872 11.25 12 11.25C10.7128 11.25 9.46996 11.0591 8.29832 10.7042C8.26657 11.1256 8.25 11.5583 8.25 12C8.25 13.2235 8.37714 14.3782 8.60185 15.4155C9.70027 15.6349 10.8365 15.75 12 15.75C13.1635 15.75 14.2997 15.6349 15.3981 15.4155C15.6229 14.3782 15.75 13.2235 15.75 12C15.75 11.5583 15.7334 11.1256 15.7017 10.7042ZM17.0027 15.0136C17.1639 14.0617 17.25 13.0479 17.25 12C17.25 11.3733 17.2192 10.7588 17.16 10.1625C18.023 9.7801 18.8356 9.30479 19.5851 8.7493C20.0129 9.74621 20.25 10.8447 20.25 12C20.25 12.6024 20.1856 13.189 20.0634 13.7535C19.0944 14.2668 18.0705 14.6906 17.0027 15.0136ZM14.9409 17.0206C13.9826 17.1716 13.0004 17.25 12 17.25C10.9996 17.25 10.0174 17.1716 9.0591 17.0206C9.18976 17.3811 9.33365 17.7182 9.48884 18.0286C10.2633 19.5775 11.1945 20.25 12 20.25C12.8055 20.25 13.7367 19.5775 14.5112 18.0286C14.6664 17.7182 14.8102 17.3811 14.9409 17.0206ZM15.3819 19.5272C15.5517 19.2648 15.7089 18.9873 15.8528 18.6994C16.1562 18.0925 16.417 17.4118 16.6283 16.6742C17.5649 16.4364 18.4735 16.1281 19.348 15.7552C18.4955 17.42 17.0936 18.757 15.3819 19.5272ZM8.61812 19.5272C8.44828 19.2648 8.29114 18.9873 8.1472 18.6994C7.84377 18.0925 7.583 17.4118 7.37171 16.6742C6.4351 16.4364 5.52652 16.1281 4.65199 15.7552C5.50454 17.42 6.9064 18.757 8.61812 19.5272ZM3.93656 13.7535C4.90563 14.2668 5.92951 14.6906 6.99729 15.0136C6.83612 14.0617 6.75 13.0479 6.75 12C6.75 11.3733 6.7808 10.7588 6.84003 10.1625C5.97701 9.7801 5.16437 9.30479 4.41491 8.7493C3.98705 9.74621 3.75 10.8447 3.75 12C3.75 12.6024 3.81444 13.189 3.93656 13.7535Z" fill="#0A0A0C" />
                                                </svg>
                                            </div>
                                            <div class="text">Cửa hàng trực tuyến</div>
                                        </a>
                                    </li>
                                    <li class="menu-item">
                                        <a href="<?= BASE_URL_ADMIN  ?>act=comment-all" class="">
                                            <div class="icon"><i class="icon-pie-chart"></i></div>
                                            <div class="text">Bình Luận</div>
                                        </a>
                                    </li>
                                    <li class="menu-item">
                                        <a href="<?= BASE_URL ?>?role=admin&act=logout" class="">
                                            <div class="icon">
                                                <svg width="24" height="22" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <path d="M8.125 18.6875C8.125 18.903 8.0394 19.1097 7.88702 19.262C7.73465 19.4144 7.52799 19.5 7.3125 19.5H1.625C1.19402 19.5 0.780698 19.3288 0.475951 19.024C0.171205 18.7193 0 18.306 0 17.875V1.625C0 1.19402 0.171205 0.780698 0.475951 0.475951C0.780698 0.171205 1.19402 0 1.625 0H7.3125C7.52799 0 7.73465 0.0856026 7.88702 0.237976C8.0394 0.390349 8.125 0.597012 8.125 0.8125C8.125 1.02799 8.0394 1.23465 7.88702 1.38702C7.73465 1.5394 7.52799 1.625 7.3125 1.625H1.625V17.875H7.3125C7.52799 17.875 7.73465 17.9606 7.88702 18.113C8.0394 18.2653 8.125 18.472 8.125 18.6875ZM19.2623 9.17516L15.1998 5.11266C15.0474 4.9602 14.8406 4.87455 14.625 4.87455C14.4094 4.87455 14.2026 4.9602 14.0502 5.11266C13.8977 5.26511 13.812 5.47189 13.812 5.6875C13.812 5.90311 13.8977 6.10989 14.0502 6.26234L16.7263 8.9375H7.3125C7.09701 8.9375 6.89035 9.0231 6.73798 9.17548C6.5856 9.32785 6.5 9.53451 6.5 9.75C6.5 9.96549 6.5856 10.1722 6.73798 10.3245C6.89035 10.4769 7.09701 10.5625 7.3125 10.5625H16.7263L14.0502 13.2377C13.8977 13.3901 13.812 13.5969 13.812 13.8125C13.812 14.0281 13.8977 14.2349 14.0502 14.3873C14.2026 14.5398 14.4094 14.6255 14.625 14.6255C14.8406 14.6255 15.0474 14.5398 15.1998 14.3873L19.2623 10.3248C19.3379 10.2494 19.3978 10.1598 19.4387 10.0611C19.4796 9.9625 19.5006 9.85678 19.5006 9.75C19.5006 9.64322 19.4796 9.5375 19.4387 9.43886C19.3978 9.34023 19.3379 9.25062 19.2623 9.17516Z" fill="#111111" />
                                                </svg>
                                            </div>
                                            <div class="text">Đăng xuất</div>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>>
                </div>
                <!-- /section-menu-left -->
                <!-- section-content-right -->
                <div class="section-content-right">
                    <!-- header-dashboard -->
                    