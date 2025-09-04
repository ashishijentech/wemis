<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Wemis-Manufacturer</title>
    <!-- base:css -->
    <link rel="stylesheet" href="{{ url('vendors/mdi/css/materialdesignicons.min.css') }}">
    {{--
    <link rel="stylesheet" href="{{ url('vendors/base/vendor.bundle.base.css') }}"> --}}
    <!-- endinject -->
    <!-- plugin css for this page -->
    <link rel="stylesheet" href="{{ url('multiselect/css/chosen.css') }}">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{ url('multiselect/css/bootstrap.min.css') }}">

    <!-- Style -->
    <link rel="stylesheet" href="{{ url('multiselect/css/style.css') }}">
    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <link rel="stylesheet" href="{{ url('css/style.css') }}">
    <!-- endinject -->
    <link rel="shortcut icon" href="{{ url('images/favicon.png') }}" />
    {{-- font-awsome --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css"
        integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    {{-- jquery --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    {{-- data tables --}}
    <script src="https://cdn.datatables.net/2.2.1/js/dataTables.js"></script>
    <link rel="stylesheet" href="https://cdn.datatables.net/2.2.1/css/dataTables.dataTables.css">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/choices.js/public/assets/styles/choices.min.css" />
    <script src="https://cdn.jsdelivr.net/npm/choices.js/public/assets/scripts/choices.min.js"></script>
    <style>
        .chosen-container {
            width: 100% !important;
        }

        .chosen-container-multi .chosen-choices {
            padding: 0 !important;
        }

        .chosen-container-multi .chosen-choices li.search-field input[type="text"] {
            padding-left: 10px !important;
        }

        .horizontal-menu .bottom-navbar .page-navigation>.nav-item.active>.nav-link:after {
            border-bottom: none;
        }

        .btn-theme {
            background-color: #260950;
            /* Dark purple background */
            color: #fff;
            /* White text */
            border: 1px solid #fff;
            /* White border */
            transition: background-color 0.3s ease-in-out, color 0.3s ease-in-out;
            /* Smooth transition on background color and text color */
        }

        .btn-theme:hover {
            background-color: #fff;
            color: #260950;
        }

        /* .bottom-navbar{
            background-color: #260950!important;
        } */
    </style>
    <style>
        /* Bottom Navigation Bar Styles */
        .bottom-navbar {
            background: linear-gradient(135deg, #260950 0%, #3a1b7a 100%);
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            padding: 0;
        }

        .bottom-navbar .navbar-nav {
            width: 100%;
            display: flex;
            justify-content: space-around;
        }

        .bottom-navbar .nav-item {
            position: relative;
        }

        .bottom-navbar .nav-link {
            color: rgba(9, 8, 13, 0.8);
            padding: 1rem 1.5rem;
            display: flex;
            flex-direction: column;
            align-items: center;
            text-align: center;
            transition: all 0.3s ease;
            position: relative;
        }

        .bottom-navbar .nav-icon {
            font-size: 1.25rem;
            margin-bottom: 0.25rem;
            transition: all 0.3s ease;
        }

        .bottom-navbar .nav-text {
            font-size: 0.85rem;
            font-weight: 500;
        }

        .bottom-navbar .dropdown-arrow {
            font-size: 0.7rem;
            margin-left: 0.25rem;
            transition: transform 0.3s ease;
        }

        .bottom-navbar .nav-link:hover,
        .bottom-navbar .nav-link:focus,
        .bottom-navbar .nav-link.active {
            color: #3a1b7a;
            background: rgba(255, 255, 255, 0.1);
        }

        .bottom-navbar .nav-link:hover .nav-icon,
        .bottom-navbar .nav-link:focus .nav-icon {
            transform: translateY(-3px);
        }

        .bottom-navbar .dropdown-menu {
            background: #3a1b7a;
            border: none;
            border-radius: 0 0 8px 8px;
            margin-top: 0;
            padding: 0.5rem 0;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
        }

        .bottom-navbar .dropdown-item {
            color: rgba(255, 255, 255, 0.8);
            padding: 0.5rem 1.5rem;
            transition: all 0.2s ease;
        }

        .bottom-navbar .dropdown-item:hover,
        .bottom-navbar .dropdown-item:focus {
            color: #fff;
            background: rgba(255, 255, 255, 0.1);
        }

        .bottom-navbar .dropdown-item i {
            width: 20px;
            text-align: center;
        }

        /* Mobile Responsiveness */
        @media (max-width: 992px) {
            .bottom-navbar .navbar-nav {
                flex-direction: column;
            }

            .bottom-navbar .nav-link {
                flex-direction: row;
                justify-content: flex-start;
                padding: 0.75rem 1.5rem;
            }

            .bottom-navbar .nav-icon {
                margin-bottom: 0;
                margin-right: 0.75rem;
                font-size: 1rem;
            }

            .bottom-navbar .nav-text {
                font-size: 0.9rem;
            }

            .bottom-navbar .dropdown-menu {
                position: static;
                float: none;
                width: 100%;
                box-shadow: none;
            }
        }

        /* Active state for dropdown */
        .bottom-navbar .dropdown-toggle[aria-expanded="true"] .dropdown-arrow {
            transform: rotate(180deg);
        }
    </style>

    <style>
        /* Position nested dropdowns properly */
        .dropdown-submenu {
            position: relative;
        }

        .dropdown-submenu>.dropdown-menu {
            top: 0;
            left: 100%;
            margin-left: 0.1rem;
            margin-right: 0.1rem;
        }
    </style>


</head>

<body>
    <div class="container-scroller">
        <div class="horizontal-menu">
            <nav class="top-navbar p-0 navbar col-lg-12 col-12">
                <div class="container-fluid">
                    <div class="d-flex align-items-center justify-content-between navbar-menu-wrapper">
                        <ul class="navbar-nav-left navbar-nav">
                            <li class="d-lg-flex ms-0 me-5 nav-item d-none">
                                <a href="#" class="horizontal-nav-left-menu nav-link"><i
                                        class="mdi-format-list-bulleted mdi"></i></a>
                            </li>
                            <li class="nav-item dropdown">
                                <a class="d-flex align-items-center justify-content-center nav-link count-indicator dropdown-toggle"
                                    id="notificationDropdown" href="#" data-bs-toggle="dropdown">
                                    <i class="mx-0 mdi mdi-bell"></i>
                                    <span class="bg-success count">2</span>
                                </a>
                                <div class="dropdown-menu-right dropdown-menu navbar-dropdown preview-list"
                                    aria-labelledby="notificationDropdown">
                                    <p class="float-left mb-0 font-weight-normal dropdown-header">Notifications</p>
                                    <a class="dropdown-item preview-item">
                                        <div class="preview-thumbnail">
                                            <div class="bg-success preview-icon">
                                                <i class="mx-0 mdi mdi-information"></i>
                                            </div>
                                        </div>
                                        <div class="preview-item-content">
                                            <h6 class="font-weight-normal preview-subject">Application Error</h6>
                                            <p class="mb-0 font-weight-light text-muted small-text">
                                                Just now
                                            </p>
                                        </div>
                                    </a>
                                    <a class="dropdown-item preview-item">
                                        <div class="preview-thumbnail">
                                            <div class="bg-warning preview-icon">
                                                <i class="mx-0 mdi mdi-settings"></i>
                                            </div>
                                        </div>
                                        <div class="preview-item-content">
                                            <h6 class="font-weight-normal preview-subject">Settings</h6>
                                            <p class="mb-0 font-weight-light text-muted small-text">
                                                Private message
                                            </p>
                                        </div>
                                    </a>
                                    <a class="dropdown-item preview-item">
                                        <div class="preview-thumbnail">
                                            <div class="bg-info preview-icon">
                                                <i class="mx-0 mdi mdi-account-box"></i>
                                            </div>
                                        </div>
                                        <div class="preview-item-content">
                                            <h6 class="font-weight-normal preview-subject">New user registration</h6>
                                            <p class="mb-0 font-weight-light text-muted small-text">
                                                2 days ago
                                            </p>
                                        </div>
                                    </a>
                                </div>
                            </li>
                            <li class="nav-item dropdown">
                                <a class="d-flex align-items-center justify-content-center nav-link count-indicator dropdown-toggle"
                                    id="messageDropdown" href="#" data-bs-toggle="dropdown">
                                    <i class="mx-0 mdi mdi-email"></i>
                                    <span class="bg-primary count">4</span>
                                </a>
                                <div class="dropdown-menu-right dropdown-menu navbar-dropdown preview-list"
                                    aria-labelledby="messageDropdown">
                                    <p class="float-left mb-0 font-weight-normal dropdown-header">Messages</p>
                                    <a class="dropdown-item preview-item">
                                        <div class="preview-thumbnail">
                                            <img src="images/faces/face4.jpg" alt="image" class="profile-pic">
                                        </div>
                                        <div class="flex-grow preview-item-content">
                                            <h6 class="font-weight-normal preview-subject ellipsis">David Grey
                                            </h6>
                                            <p class="mb-0 font-weight-light text-muted small-text">
                                                The meeting is cancelled
                                            </p>
                                        </div>
                                    </a>
                                    <a class="dropdown-item preview-item">
                                        <div class="preview-thumbnail">
                                            <img src="images/faces/face2.jpg" alt="image" class="profile-pic">
                                        </div>
                                        <div class="flex-grow preview-item-content">
                                            <h6 class="font-weight-normal preview-subject ellipsis">Tim Cook
                                            </h6>
                                            <p class="mb-0 font-weight-light text-muted small-text">
                                                New product launch
                                            </p>
                                        </div>
                                    </a>
                                    <a class="dropdown-item preview-item">
                                        <div class="preview-thumbnail">
                                            <img src="images/faces/face3.jpg" alt="image" class="profile-pic">
                                        </div>
                                        <div class="flex-grow preview-item-content">
                                            <h6 class="font-weight-normal preview-subject ellipsis"> Johnson
                                            </h6>
                                            <p class="mb-0 font-weight-light text-muted small-text">
                                                Upcoming board meeting
                                            </p>
                                        </div>
                                    </a>
                                </div>
                            </li>
                            <li class="nav-item dropdown">
                                <a href="#" class="nav-link count-indicator"><i
                                        class="mdi mdi-message-reply-text"></i></a>
                            </li>
                            <li class="d-lg-block ms-3 nav-item nav-search d-none">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="search">
                                            <i class="mdi mdi-magnify"></i>
                                        </span>
                                    </div>
                                    <input type="text" class="form-control" placeholder="search"
                                        aria-label="search" aria-describedby="search">
                                </div>
                            </li>
                        </ul>
                        <div class="d-flex align-items-center justify-content-center text-center navbar-brand-wrapper">
                            <a class="navbar-brand brand-logo" href="index.html"><img
                                    src="{{ url('images/wemis.png') }}" alt="logo" /></a>
                            <a class="navbar-brand brand-logo-mini" href="index.html"><img
                                    src="{{ url('images/wemis.png') }}" alt="logo" /></a>
                        </div>
                        <ul class="navbar-nav-right navbar-nav">
                            <li class="d-lg-flex nav-item dropdown d-none">
                                <button type="button" class="btn btn-inverse-primary btn-sm">Product </button>
                            </li>
                            <li class="d-lg-flex nav-item dropdown d-none">
                                <a class="dropdown-toggle show-dropdown-arrow btn btn-inverse-primary btn-sm"
                                    id="nreportDropdown" href="#" data-bs-toggle="dropdown">
                                    <i class="mdi mdi-wallet"></i> Wallet
                                </a>
                                <div class="dropdown-menu-right dropdown-menu navbar-dropdown preview-list"
                                    aria-labelledby="nreportDropdown">
                                    <p class="float-left mb-0 font-weight-medium dropdown-header">Wallet</p>
                                    <a class="dropdown-item">
                                        <i class="text-primary mdi mdi-file-pdf"></i>
                                        Wallet Dashboard
                                    </a>
                                    <a class="dropdown-item">
                                        <i class="text-primary mdi mdi-file-excel"></i>
                                        Tranxation List
                                    </a>
                                </div>
                            </li>
                            <li class="d-lg-flex nav-item dropdown d-none">
                                <a class="dropdown-item" href="#" data-bs-toggle="modal"
                                    data-bs-target="#settingsModalRto">
                                    <i class="text-primary mdi mdi-settings"></i>
                                    Settings
                                </a>
                            </li>
                            <li class="nav-item nav-profile dropdown">
                                <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown"
                                    id="profileDropdown">
                                    <span class="nav-profile-name">{{ auth('manufacturer')->user()->name }}</span>
                                    <span class="online-status"></span>
                                    <img src="{{ url('images/faces/face28.png') }}" alt="profile" />
                                </a>
                                <div class="dropdown-menu-right dropdown-menu navbar-dropdown"
                                    aria-labelledby="profileDropdown">
                                    <a class="dropdown-item" href="#" data-bs-toggle="modal"
                                        data-bs-target="#settingsModalRto">
                                        <i class="text-primary mdi mdi-settings"></i>
                                        Settings
                                    </a>
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                        onclick="event.preventDefault();
					                     document.getElementById('logout-form').submit();">
                                        <i class="me-2 text-primary mdi mdi-logout"></i> Signout </a>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                        class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        </ul>
                        <button class="navbar-toggler-right align-self-center navbar-toggler d-lg-none" type="button"
                            data-toggle="horizontal-menu-toggle">
                            <span class="mdi mdi-menu"></span>
                        </button>
                    </div>
                </div>
            </nav>
            <nav class="bottom-navbar navbar navbar-expand-lg">
                <div class="container-fluid">
                    <!-- Mobile Toggle Button -->
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                        data-bs-target="#bottomNavbar">
                        <i class="fas fa-bars"></i>
                    </button>

                    <!-- Navigation Menu -->
                    <div class="collapse navbar-collapse" id="bottomNavbar">
                        <ul class="navbar-nav">
                            <!-- Dashboard -->
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle d-flex align-items-center" href="#"
                                    role="button" id="dashboardDropdown" data-bs-toggle="dropdown"
                                    aria-expanded="false">
                                    <div class="nav-icon me-2">
                                        <i class="fas fa-gauge-high"></i>
                                    </div>
                                    <span class="nav-text">Dashboard</span>
                                </a>
                                <ul class="dropdown-menu shadow-lg border-0 rounded-2"
                                    aria-labelledby="dashboardDropdown">
                                    <li>
                                        <a class="dropdown-item d-flex align-items-center"
                                            href="{{ route('manufacturer.dashboard') }}">
                                            <i class="me-2 fas fa-check-circle"></i>
                                            <span>Status Dashboard</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a class="dropdown-item d-flex align-items-center" href="#">
                                            <i class="me-2 fas fa-exclamation-circle"></i>
                                            <span>CCC Dashboard</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a class="dropdown-item d-flex align-items-center" href="{{route('manufacturer.dashboard.monitoring')}}">
                                            <i class="me-2 fas fa-times-circle"></i>
                                            <span>Monitoring Dashboard</span>
                                        </a>
                                    </li>
                                </ul>
                            </li>

                            <style>
                                .dropdown-submenu {
                                    position: relative;
                                }

                                .dropdown-submenu>.dropdown-menu {
                                    left: 100%;
                                    top: 0;
                                    margin-top: -6px;
                                }

                                .dropdown-submenu:hover>.dropdown-menu,
                                .dropdown-submenu>a:focus+.dropdown-menu {
                                    display: block;
                                }
                            </style>

                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle d-flex align-items-center" id="reportsDropdown"
                                    role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    <div class="nav-icon me-2">
                                        <i class="fas fa-file-alt"></i>
                                    </div>
                                    <span class="nav-text">Reports</span>
                                </a>

                                <ul class="dropdown-menu" aria-labelledby="reportsDropdown">

                                    <!-- VLTD Report -->
                                    <li class="dropdown-submenu">
                                        <a href="#" class="dropdown-item">
                                            <i class="fas fa-satellite-dish me-2"></i> VLTD Report
                                        </a>
                                        <ul class="dropdown-menu">
                                            <li><a class="dropdown-item" href="#"><i
                                                        class="fas fa-broadcast-tower me-2"></i> Active Device</a></li>
                                            <li><a class="dropdown-item" href="#"><i
                                                        class="fas fa-power-off me-2"></i> Offline Device</a></li>
                                            <li><a class="dropdown-item" href="#"><i
                                                        class="fas fa-tools me-2"></i> Installation Device</a></li>
                                        </ul>
                                    </li>

                                    <!-- Alerts Report -->
                                    <li class="dropdown-submenu">
                                        <a href="#" class="dropdown-item">
                                            <i class="fas fa-bell me-2"></i> Alerts Report
                                        </a>
                                        <ul class="dropdown-menu">
                                            <li><a class="dropdown-item" href="#"><i
                                                        class="fas fa-tachometer-alt me-2"></i> Over Speed</a></li>
                                        </ul>
                                    </li>

                                    <!-- ELITE -->
                                    <li class="dropdown-submenu">
                                        <a href="#" class="dropdown-item">
                                            <i class="fas fa-shield-alt me-2"></i> ELITE
                                        </a>
                                        <ul class="dropdown-menu">
                                            <li><a class="dropdown-item" href="#"><i
                                                        class="fas fa-bug me-2"></i> Device Temper</a></li>
                                            <li><a class="dropdown-item" href="#"><i
                                                        class="fas fa-exclamation-triangle me-2"></i> Panic History</a>
                                            </li>
                                            <li><a class="dropdown-item" href="#"><i
                                                        class="fas fa-history me-2"></i> Cumulative Panic History
                                                    Reports</a></li>
                                            <li><a class="dropdown-item" href="#"><i
                                                        class="fas fa-ban me-2"></i> Non-working Device</a></li>
                                            <li><a class="dropdown-item" href="#"><i
                                                        class="fas fa-heartbeat me-2"></i> Device Health Reports</a>
                                            </li>
                                            <li><a class="dropdown-item" href="#"><i
                                                        class="fas fa-bell me-2"></i> Device Alert Report</a></li>
                                            <li><a class="dropdown-item" href="#"><i
                                                        class="fas fa-plug me-2"></i> Disconnect from Main Battery</a>
                                            </li>
                                            <li><a class="dropdown-item" href="#"><i
                                                        class="fas fa-battery-quarter me-2"></i> Low Internal
                                                    Battery</a></li>
                                            <li><a class="dropdown-item" href="#"><i
                                                        class="fas fa-battery-full me-2"></i> Internal Battery Charged
                                                    Again</a></li>
                                            <li><a class="dropdown-item" href="#"><i
                                                        class="fas fa-plug me-2"></i> Connect Back to Main Battery</a>
                                            </li>
                                            <li><a class="dropdown-item" href="#"><i
                                                        class="fas fa-car me-2"></i> Ignition ON</a></li>
                                            <li><a class="dropdown-item" href="#"><i
                                                        class="fas fa-box-open me-2"></i> GPS Box Opened</a></li>
                                            <li><a class="dropdown-item" href="#"><i
                                                        class="fas fa-bullhorn me-2"></i> Emergency ON</a></li>
                                            <li><a class="dropdown-item" href="#"><i
                                                        class="fas fa-volume-mute me-2"></i> Emergency OFF</a></li>
                                            <li><a class="dropdown-item" href="#"><i
                                                        class="fas fa-car-crash me-2"></i> Harsh Braking</a></li>
                                            <li><a class="dropdown-item" href="#"><i
                                                        class="fas fa-tachometer-alt me-2"></i> Harsh Acceleration</a>
                                            </li>
                                            <li><a class="dropdown-item" href="#"><i
                                                        class="fas fa-random me-2"></i> Rash Turning</a></li>
                                        </ul>
                                    </li>

                                    <!-- Fencing Alert Report -->
                                    <li class="dropdown-submenu">
                                        <a href="#" class="dropdown-item">
                                            <i class="fas fa-draw-polygon me-2"></i> Fencing Alert Report
                                        </a>
                                        <ul class="dropdown-menu">
                                            <li><a class="dropdown-item" href="#"><i
                                                        class="fas fa-sign-in-alt me-2"></i> Areafence In/Entry</a>
                                            </li>
                                            <li><a class="dropdown-item" href="#"><i
                                                        class="fas fa-sign-out-alt me-2"></i> Areafence Out/Exit</a>
                                            </li>
                                            <li><a class="dropdown-item" href="#"><i
                                                        class="fas fa-route me-2"></i> Route Fence Report</a></li>
                                        </ul>
                                    </li>

                                    <!-- ACC Report -->
                                    <li class="dropdown-submenu">
                                        <a href="#" class="dropdown-item">
                                            <i class="fas fa-car-battery me-2"></i> ACC Report
                                        </a>
                                        <ul class="dropdown-menu">
                                            <li><a class="dropdown-item" href="#"><i
                                                        class="fas fa-ban me-2"></i> Engine CUT by Air</a></li>
                                            <li><a class="dropdown-item" href="#"><i
                                                        class="fas fa-play me-2"></i> Engine ON by Air</a></li>
                                            <li><a class="dropdown-item" href="#"><i
                                                        class="fas fa-snowflake me-2"></i> AC CUT by Air</a></li>
                                            <li><a class="dropdown-item" href="#"><i
                                                        class="fas fa-fan me-2"></i> AC OFF by Air</a></li>
                                        </ul>
                                    </li>

                                    <!-- Engine Temperature -->
                                    <li class="dropdown-submenu">
                                        <a href="#" class="dropdown-item">
                                            <i class="fas fa-thermometer-half me-2"></i> Engine Temperature
                                        </a>
                                        <ul class="dropdown-menu">
                                            <li><a class="dropdown-item" href="#"><i
                                                        class="fas fa-tint me-2"></i> Coolant Temperature</a></li>
                                        </ul>
                                    </li>

                                    <!-- Tracking Report -->
                                    <li class="dropdown-submenu">
                                        <a href="#" class="dropdown-item">
                                            <i class="fas fa-map-marked-alt me-2"></i> Tracking Report
                                        </a>
                                        <ul class="dropdown-menu">
                                            <li><a class="dropdown-item" href="#"><i
                                                        class="fas fa-map-marker-alt me-2"></i> Live Tracking</a></li>
                                            <li><a class="dropdown-item" href="#"><i
                                                        class="fas fa-route me-2"></i> Route Playback</a></li>
                                            <li><a class="dropdown-item" href="#"><i
                                                        class="fas fa-th me-2"></i> Matrix View</a></li>
                                        </ul>
                                    </li>

                                </ul>
                            </li>



                            <!-- Barcode Dropdown -->
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" role="button"
                                    data-bs-toggle="dropdown">
                                    <div class="nav-icon">
                                        <i class="fas fa-barcode"></i>
                                    </div>
                                    <span class="nav-text">Barcode</span>
                                    {{-- <i class="dropdown-arrow fas fa-chevron-down"></i> --}}
                                </a>
                                <ul class="dropdown-menu">
                                    <li>
                                        <a class="dropdown-item" href="{{ route('manage.barcode') }}">
                                            <i class="me-2 fa-list-check fas"></i>Manage Barcode
                                        </a>
                                    </li>
                                    <li>
                                        <a class="dropdown-item" href="{{ route('barcode.allocate') }}">
                                            <i class="me-2 fas fa-share-nodes"></i>Allocate Barcode
                                        </a>
                                    </li>
                                    <li>
                                        <a class="dropdown-item" href="#">
                                            <i class="me-2 fa-rotate-left fas"></i>Rollback Barcode
                                        </a>
                                    </li>
                                    <li>
                                        <a class="dropdown-item" href="#">
                                            <i class="me-2 fas fa-arrows-rotate"></i>Renewal Allocation
                                        </a>
                                    </li>
                                    <li>
                                        <a class="dropdown-item" href="#">
                                            <i class="me-2 fas fa-box-open"></i>Manage Accessories
                                        </a>
                                    </li>
                                </ul>
                            </li>

                            <!-- Subscription Dropdown -->
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" role="button"
                                    data-bs-toggle="dropdown">
                                    <div class="nav-icon">
                                        <i class="fas fa-credit-card"></i>
                                    </div>
                                    <span class="nav-text">Subscription</span>
                                    {{-- <i class="dropdown-arrow fas fa-chevron-down"></i> --}}
                                </a>
                                <ul class="dropdown-menu">
                                    <li>
                                        <a class="dropdown-item" href="{{ route('subscriptions') }}">
                                            <i class="me-2 fas fa-file-invoice-dollar"></i>Subscription
                                        </a>
                                    </li>
                                </ul>
                            </li>

                            <!-- Members Dropdown -->
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" role="button"
                                    data-bs-toggle="dropdown">
                                    <div class="nav-icon">
                                        <i class="fas fa-id-badge"></i>
                                    </div>
                                    <span class="nav-text">Members</span>
                                    {{-- <i class="dropdown-arrow fas fa-chevron-down"></i> --}}
                                </a>
                                <ul class="dropdown-menu">
                                    <li>
                                        <a class="dropdown-item" href="{{ route('distributors') }}">
                                            <i class="me-2 fas fa-users"></i>Distributors
                                        </a>
                                    </li>
                                    <li>
                                        <a class="dropdown-item" href="{{ route('dealers') }}">
                                            <i class="me-2 fas fa-store"></i>Dealers
                                        </a>
                                    </li>
                                    <li>
                                        <a class="dropdown-item" href="{{ route('technicians') }}">
                                            <i class="me-2 fas fa-user-gear"></i>Technicians
                                        </a>
                                    </li>
                                </ul>
                            </li>

                            <!-- Manage Device Dropdown -->
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" role="button"
                                    data-bs-toggle="dropdown">
                                    <div class="nav-icon">
                                        <i class="fas fa-plug"></i>
                                    </div>
                                    <span class="nav-text">Manage Device</span>
                                    {{-- <i class="dropdown-arrow fas fa-chevron-down"></i> --}}
                                </a>
                                <ul class="dropdown-menu">
                                    <li>
                                        <a class="dropdown-item" href="{{ route('map.device') }}">
                                            <i class="me-2 fas fa-map-location-dot"></i>Map Device
                                        </a>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>
        </div>
        <!-- partial -->
        <div class="container-fluid page-body-wrapper">
            <div class="main-panel">
                <div class="content-wrapper">
                    @yield('content')
                </div>
                <!-- content-wrapper ends -->
                <!-- partial:partials/_footer.html -->
                <footer class="footer" style="background-color: #260950">
                    <div class="footer-wrap" style="background-color: #260950">
                        <div class="d-sm-flex justify-content-sm-between justify-content-center">
                            <span class="d-block d-sm-inline-block text-muted text-sm-left text-center">Copyright © <a
                                    href="" target="_blank">Wemis
                                </a> 2025</span>
                            {{-- <span class="d-block float-sm-right float-none mt-1 mt-sm-0 text-center">Only the best
                                <a href="https://www.bootstrapdash.com/" target="_blank"> Bootstrap dashboard </a>
                                templates</span> --}}
                        </div>
                    </div>
                </footer>
                <!-- partial -->
            </div>
            <!-- main-panel ends -->
        </div>
    </div>

    <div class="modal fade" id="settingsModalRto" tabindex="-1" aria-labelledby="settingsModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="settingsModalLabel">Settings</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <h5 class="mb-3">Settings Options</h5>
                    <div class="list-group">
                        <a href="{{ route('mgf.setting') }}"
                            class="list-group-item list-group-item-action d-flex align-items-center">
                            <i class="me-2 text-primary mdi mdi-car-settings"></i> RTO Setting
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        new DataTable('.dataTable', {
            pageLength: 10,
            language: {
                search: "Search:",
                lengthMenu: "Display _MENU_ records per page",
                info: "Showing _START_ to _END_ of _TOTAL_ entries",
                paginate: {
                    next: "Next",

                    previous: "Previous"
                }
            },
        });
    </script>
    <!-- js-->
    <script src="{{ url('vendors/base/vendor.bundle.base.js') }}"></script>
    <script src="{{ url('js/template.js') }}"></script>
    <script src="{{ url('vendors/chart.js/Chart.min.js') }}"></script>
    <script src="{{ url('vendors/progressbar.js/progressbar.min.js') }}"></script>
    <script src="{{ url('vendors/chartjs-plugin-datalabels/chartjs-plugin-datalabels.js') }}"></script>
    <script src="{{ url('vendors/justgage/raphael-2.1.4.min.js') }}"></script>
    <script src="{{ url('vendors/justgage/justgage.js') }}"></script>
    <script src="{{ url('js/jquery.cookie.js" type="text/javascript') }}"></script>

    <script src="{{ url('js/dashboard.js') }}"></script>
    <script src="{{ url('/multiselect/js/jquery-3.3.1.min.js') }}"></script>
    <script src="{{ url('/multiselect/js/popper.min.js') }}"></script>
    <script src="{{ url('/multiselect/js/bootstrap.min.js') }}"></script>
    <script src="{{ url('/multiselect/js/chosen.jquery.min.js') }}"></script>
    <script src="{{ url('/multiselect/js/main.js') }}"></script>
    <script>
        window.setTimeout(function() {
            $(".alert").fadeTo(500, 0).slideUp(500, function() {
                $(this).remove();
            });
        }, 4000); // 4 seconds
    </script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const forms = document.querySelectorAll('form');

            forms.forEach(function(form) {
                let isSubmitting = false;

                form.addEventListener('submit', function(e) {
                    const submitButton = form.querySelector('button[type="submit"]');
                    if (isSubmitting) {
                        e.preventDefault(); // Already submitted
                        return;
                    }

                    isSubmitting = true; // Flag set

                    if (submitButton) {
                        submitButton.disabled = true;
                        submitButton.innerText = 'Submitting...';
                    }
                });
            });
        });
    </script>
    <script>
        $(document).ready(function() {
            // ================== Static Data ==================
            const states = {
                china: ['Beijing'],
                india: [
                    'Andhra Pradesh', 'Arunachal Pradesh', 'Assam', 'Bihar', 'Chhattisgarh', 'Goa',
                    'Gujarat', 'Haryana', 'Himachal Pradesh', 'Jharkhand', 'Karnataka', 'Kerala',
                    'Maharashtra', 'Madhya Pradesh', 'Manipur', 'Meghalaya', 'Mizoram', 'Nagaland',
                    'Odisha', 'Punjab', 'Rajasthan', 'Sikkim', 'Tamil Nadu', 'Tripura', 'Telangana',
                    'Uttar Pradesh', 'Uttarakhand', 'West Bengal', 'Andaman & Nicobar (UT)',
                    'Chandigarh (UT)', 'Dadra & Nagar Haveli and Daman & Diu (UT)',
                    'Delhi [NCT]', 'Jammu & Kashmir (UT)', 'Ladakh (UT)', 'Lakshadweep (UT)',
                    'Puducherry (UT)'
                ]
            };

            const districts = {
                "Andhra Pradesh": ['Chittoor', 'East Godavari', 'Guntur', 'Krishna', 'Kurnool', 'Nellore',
                    'Prakasam', 'Srikakulam'
                ],
                "Maharashtra": ['Mumbai', 'Pune', 'Nagpur', 'Thane', 'Nashik', 'Solapur', 'Satara'],
                "Tamil Nadu": ['Chennai', 'Coimbatore', 'Madurai', 'Salem', 'Trichy', 'Erode'],
                "Odisha": ["Angul", "Balangir", "Balasore", "Bargarh", "Bhadrak", "Boudh", "Cuttack",
                    "Debagarh", "Dhenkanal", "Gajapati", "Ganjam", "Jagatsinghpur", "Jajpur", "Jharsuguda",
                    "Kalahandi", "Kandhamal", "Kendrapara", "Kendujhar", "Khordha", "Koraput", "Malkangiri",
                    "Mayurbhanj", "Nabarangpur", "Nayagarh", "Nuapada", "Puri", "Rayagada", "Sambalpur",
                    "Subarnapur", "Sundargarh"
                ],
                "Karnataka": ['Bagalkot', 'Ballari', 'Belagavi', 'Bengaluru Rural', 'Bengaluru Urban', 'Bidar',
                    'Chamarajanagar', 'Chikballapur', 'Chikkamagaluru', 'Chitradurga', 'Dakshina Kannada',
                    'Davanagere', 'Dharwad', 'Gadag', 'Hassan', 'Haveri', 'Kalaburagi', 'Kodagu', 'Kolar',
                    'Koppal', 'Mandya', 'Mysuru', 'Raichur', 'Ramanagara', 'Shivamogga', 'Tumakuru',
                    'Udupi', 'Uttara Kannada', 'Vijayanagara', 'Yadgir'
                ]
            };

            // ================== Preselected (Laravel) ==================
            const selected = {
                country: "{{ $device->dealer->distributor->country ?? '' }}",
                state: "{{ $device->dealer->distributor->state ?? '' }}",
                district: "{{ $device->dealer->distributor->district ?? '' }}",
                rto: "{{ $device->dealer->distributor->rto ?? '' }}",
                distributor: "{{ $device->dealer->distributor->id ?? '' }}",
                dealer: "{{ $device->dealer_id ?? '' }}",
                deviceId: "{{ $device->barcode->id ?? '' }}",
                technicianId: "{{ $device->technician_id ?? '' }}",
            };

            var backendDefault = {
                id: "{{ $device->barcodes->id ?? '' }}",
                name: "{{ $device->barcodes->barcodeNo ?? '' }}"
            };

            // ================== Utility ==================
            function populateDropdown(selector, items, placeholder = 'Select', selectedValue = '') {
                const dropdown = $(selector);
                dropdown.empty().append(`<option value="">${placeholder}</option>`);
                items.forEach(item => {
                    dropdown.append(new Option(item, item, item == selectedValue, item == selectedValue));
                });
            }

            function fetchSimInfo(deviceId) {
                $('.simInfo').empty();
                if (!deviceId) return;

                $.ajax({
                    url: `/manufacturer/fetch/simInfoByBarcode/${deviceId}`,
                    type: 'GET',
                    dataType: 'json',
                    success: function(data) {
                        if (data && data.length) {
                            data.forEach(sim => {
                                $('.simInfo').append(`
                            <div class="py-2 row">
                                <div class="col-md-3">
                                    <label>Sim No.</label>
                                    <input class="form-control form-control-sm" value="${sim.simNo}">
                                </div>
                                <div class="col-md-3">
                                    <label>ICCID No.</label>
                                    <input class="form-control form-control-sm" value="${sim.ICCIDNo}">
                                </div>
                                <div class="col-md-3">
                                    <label>Validity</label>
                                    <input class="form-control form-control-sm" value="${sim.validity}">
                                </div>
                                <div class="col-md-3">
                                    <label>Operator</label>
                                    <input class="form-control form-control-sm" value="${sim.operator}">
                                </div>
                            </div>
                        `);
                            });
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error('Error fetching SIM info:', status, error);
                    }
                });
            }

            // ================== Country -> State ==================
            $('.country').on('change', function() {
                const key = (this.value || '').toLowerCase();
                populateDropdown('.state', states[key] || [], 'Select State', selected.state);
                populateDropdown('.district', [], 'Select District');
                populateDropdown('.rto', [], 'Select RTO');
            });

            // ================== State -> District + Distributor ==================
            $('.state').on('change', function() {
                const stateVal = this.value;
                populateDropdown('.district', districts[stateVal] || [], 'Select District', selected
                    .district);
                populateDropdown('.rto', [], 'Select RTO', selected.rto);

                if (!stateVal) return;
                $('.distributor').empty().append('<option value="">Loading...</option>');

                $.ajax({
                    url: `/manufacturer/fetch/distributer/${stateVal}`,
                    type: 'GET',
                    dataType: 'json',
                    success: function(data) {
                        $('.distributor').empty().append(
                            '<option value="">Select Distributor</option>');
                        data.forEach(d => $('.distributor').append(new Option(d.business_name, d
                            .id)));

                        if (selected.distributor) {
                            $('.distributor').val(selected.distributor).trigger('change');
                        }
                    }
                });
            });

            // ================== Distributor -> Dealer ==================
            $('.distributor').on('change', function() {
                const distributorId = this.value;
                if (!distributorId) return;
                $('.dealer').empty().append('<option value="">Loading...</option>');

                $.ajax({
                    url: `/fetch/dealer/${distributorId}`,
                    type: 'GET',
                    dataType: 'json',
                    success: function(data) {
                        $('.dealer').empty().append('<option value="">Select Dealer</option>');
                        data.forEach(d => {
                            $('.dealer').append(
                                `<option value="${d.id}" country="${d.country}" state="${d.state}" dis="${d.district}" rto="${d.rto_devision}">${d.business_name}</option>`
                            );
                        });

                        if (selected.dealer) $('.dealer').val(selected.dealer).trigger(
                        'change');
                    }
                });
            });

            // ================== Dealer -> Device & Technician ==================
            $('.dealer').on('change', function() {
                const $opt = $(this).find('option:selected');
                const dealerId = this.value;
                if (!dealerId) return;

                $('#state').val($opt.attr('state') || '');
                $('#country').val(($opt.attr('country') || '').replace(/\b\w/g, c => c.toUpperCase()));
                $('#district').val($opt.attr('dis') || '');

                // RTO
                $('#rto_division').empty();
                const rtoAttr = $opt.attr('rto');
                if (rtoAttr) rtoAttr.split(',').forEach(r => $('#rto_division').append(new Option(r, r)));

                // Devices
                $.ajax({
                    url: `/fetch/device-by-dealer/${dealerId}`,
                    type: 'GET',
                    dataType: 'json',
                    success: function(data) {
                        $('.deviceno').empty().append(
                            '<option value="">Select Device No</option>');

                        if (backendDefault && backendDefault.id) {
                            $('.deviceno').append(new Option(backendDefault.name, backendDefault
                                .id, true, true));
                        }

                        data.forEach(dev => {
                            if (!$('.deviceno option[value="' + dev.barcode.id + '"]')
                                .length) {
                                $('.deviceno').append(new Option(dev.barcode.IMEINO, dev
                                    .barcode.id));
                            }
                        });

                        const deviceId = selected.deviceId || backendDefault.id;
                        if (deviceId) $('.deviceno').val(deviceId).trigger('change');
                    }
                });

                // Technicians
                $.ajax({
                    url: `/fetch/technician/${dealerId}`,
                    type: 'GET',
                    dataType: 'json',
                    success: function(data) {
                        $('.technician').empty().append(
                            '<option value="">Select Technician</option>');
                        data.forEach(t => {
                            $('.technician').append(
                                `<option value="${t.id}" name="${t.name}" email="${t.email}" mobile="${t.mobile}">${t.name}</option>`
                            );
                        });

                        if (selected.technicianId) $('.technician').val(selected.technicianId);
                    }
                });
            });

            // ================== Device change -> fetch SIM ==================
            $(document).on('change', '.deviceno', function() {
                fetchSimInfo($(this).val());
            });

            // ================== On Page Load ==================
            if (selected.country) $('.country').val(selected.country).trigger('change');
            else $('.country').trigger('change');

            if (selected.state) $('.state').val(selected.state).trigger('change');
        });
    </script>

    <!-- End  js -->
</body>

</html>
