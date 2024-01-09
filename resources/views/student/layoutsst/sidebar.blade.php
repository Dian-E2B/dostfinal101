<style>
    #sidebarimagelogo {
        filter: drop-shadow(-1px -2px 10px rgba(73, 196, 211, 0.9));
    }
</style>
<nav id="sidebar" class="sidebar js-sidebar">

    <div class="sidebar-content js-simplebar">


        <div class="row">
            <span style="margin-top:10px;" class="sidebar-brand-text d-flex justify-content-center">
                <img style="max-width: 90px; max-height: 90px;" id="sidebarimagelogo" src="{{ asset('icons/DOST_scholar_logo.svg') }}" alt="Image Description">
            </span>
            @php
                $scholarinfo = DB::select('SELECT fname,lname  FROM seis WHERE id = ?', [Auth::user()->scholar_id]);
            @endphp
            @if (!empty($scholarinfo))
                @foreach ($scholarinfo as $info)
                    <div class="d-flex justify-content-center mt-3" style="">
                        <div style="font-weight:600; color: rgb(43, 41, 41)">{{ $info->fname }} {{ $info->lname }}</div>
                    </div>
                @endforeach
            @endif
        </div>




        <div class="d-flex justify-content-center mt-2">

            @php
                $scholarstatusidresult = DB::select('SELECT scholar_status_id FROM seis WHERE id = ?', [$scholarId]);
                $statusExists = isset($scholarstatusidresult[0]);
            @endphp
            <div class="sidebar-user-subtitle" style="font-size: 20px">
                @if ($statusExists)
                    @switch($scholarstatusidresult[0]->scholar_status_id)
                        @case(2)
                            <span class="badge bg-info">Pending</span>
                        @break

                        @case(3)
                            <span class="badge bg-success">Enrolled</span>
                        @break

                        @case(4)
                            <span class="badge bg-warning">Deffered</span>
                        @break

                        @case(5)
                            <span class="badge bg-warning">LOA</span>
                        @break

                        @case(6)
                            <span class="badge bg-danger">Terminated</span>
                        @break
                    @endswitch
                @endif
            </div>


        </div>


        <ul class="sidebar-nav">
            <li class="sidebar-header">
                Pages
            </li>
            @if (request()->is('student/dashboard'))
                <li class="sidebar-item active">
            @endif
            <a class='sidebar-link' href='/pages-profile'>
                <i class="align-middle" data-feather="user"></i> <span class="align-middle">PROFILE</span>
            </a>
            </li>



            <li class="sidebar-item">
                <a data-bs-target="#dashboards" data-bs-toggle="collapse" class="sidebar-link collapsed">
                    <i class="align-middle" data-feather="sliders"></i> <span class="align-middle">DASHBOARD</span>
                </a>
                <ul id="dashboards" class="sidebar-dropdown list-unstyled collapse" data-bs-parent="#sidebar">
                    <li class="sidebar-item active"><a class='sidebar-link' href='/'>Analytics</a></li>
                    <li class="sidebar-item"><a class='sidebar-link' href='/dashboard-ecommerce'>E-Commerce <span class="sidebar-badge badge bg-primary">Pro</span></a></li>
                    <li class="sidebar-item"><a class='sidebar-link' href='/dashboard-crypto'>Crypto <span class="sidebar-badge badge bg-primary">Pro</span></a></li>
                </ul>
            </li>

            <li class="sidebar-item">
                <a data-bs-target="#requirements" data-bs-toggle="collapse" class="sidebar-link collapsed">
                    <i class="align-middle" data-feather="file-plus"></i> <span class="align-middle">SUBMIT REQ</span>
                </a>
                <ul id="requirements" class="sidebar-dropdown list-unstyled collapse" data-bs-parent="#sidebar">
                    <li class="sidebar-item"><a class='sidebar-link' href='/'>Periodic</a></li>
                    <li class="sidebar-item"><a class='sidebar-link' href='/dashboard-ecommerce'>Thesis<span class="sidebar-badge badge bg-primary">Pro</span></a></li>
                    <li class="sidebar-item"><a class='sidebar-link' href='/dashboard-crypto'>PTP <span class="sidebar-badge badge bg-primary">Pro</span></a></li>
                </ul>
            </li>

            <li class="sidebar-item">
                <a data-bs-target="#request" data-bs-toggle="collapse" class="sidebar-link collapsed">
                    <i class="align-middle" data-feather="arrow-down"></i> <span class="align-middle">REQUEST</span>
                </a>
                <ul id="request" class="sidebar-dropdown list-unstyled collapse" data-bs-parent="#sidebar">
                    <li class="sidebar-item"><a class='sidebar-link' href='/'>Shift</a></li>
                    <li class="sidebar-item"><a class='sidebar-link' href='/'>Transfer</a></li>
                    <li class="sidebar-item"><a class='sidebar-link' href='/dashboard-ecommerce'>LOA<span class="sidebar-badge badge bg-primary">Pro</span></a></li>
                    <li class="sidebar-item"><a class='sidebar-link' href='/dashboard-crypto'>Clearance <span class="sidebar-badge badge bg-primary">Pro</span></a></li>
                </ul>
            </li>

            <li class="sidebar-item">
                <a data-bs-target="#pages" data-bs-toggle="collapse" class="sidebar-link collapsed">
                    <i class="align-middle" data-feather="layout"></i> <span class="align-middle">Pages</span>
                </a>
                <ul id="pages" class="sidebar-dropdown list-unstyled collapse " data-bs-parent="#sidebar">
                    <li class="sidebar-item"><a class='sidebar-link' href='/pages-settings'>Settings</a></li>
                    <li class="sidebar-item"><a class='sidebar-link' href='/pages-projects'>Projects <span class="sidebar-badge badge bg-primary">Pro</span></a></li>
                    <li class="sidebar-item"><a class='sidebar-link' href='/pages-clients'>Clients <span class="sidebar-badge badge bg-primary">Pro</span></a></li>
                    <li class="sidebar-item"><a class='sidebar-link' href='/pages-orders'>Orders <span class="sidebar-badge badge bg-primary">Pro</span></a></li>
                    <li class="sidebar-item"><a class='sidebar-link' href='/pages-pricing'>Pricing <span class="sidebar-badge badge bg-primary">Pro</span></a></li>
                    <li class="sidebar-item"><a class='sidebar-link' href='/pages-chat'>Chat <span class="sidebar-badge badge bg-primary">Pro</span></a></li>
                    <li class="sidebar-item"><a class='sidebar-link' href='/pages-blank'>Blank Page</a></li>
                </ul>
            </li>

            <li class="sidebar-item">
                <a class='sidebar-link' href='/pages-profile'>
                    <i class="align-middle" data-feather="user"></i> <span class="align-middle">Profile</span>
                </a>
            </li>

            <li class="sidebar-item">
                <a class='sidebar-link' href='/pages-invoice'>
                    <i class="align-middle" data-feather="credit-card"></i> <span class="align-middle">Invoice</span>
                </a>
            </li>

            <li class="sidebar-item">
                <a class='sidebar-link' href='/pages-tasks'>
                    <i class="align-middle" data-feather="list"></i> <span class="align-middle">Tasks</span>
                    <span class="sidebar-badge badge bg-primary">Pro</span>
                </a>
            </li>

            <li class="sidebar-item">
                <a class='sidebar-link' href='/calendar'>
                    <i class="align-middle" data-feather="calendar"></i> <span class="align-middle">Calendar</span>
                    <span class="sidebar-badge badge bg-primary">Pro</span>
                </a>
            </li>

            <li class="sidebar-item">
                <a href="#auth" data-bs-toggle="collapse" class="sidebar-link collapsed">
                    <i class="align-middle" data-feather="users"></i> <span class="align-middle">Auth</span>
                </a>
                <ul id="auth" class="sidebar-dropdown list-unstyled collapse " data-bs-parent="#sidebar">
                    <li class="sidebar-item"><a class='sidebar-link' href='/pages-sign-in'>Sign In</a></li>
                    <li class="sidebar-item"><a class='sidebar-link' href='/pages-sign-up'>Sign Up</a></li>
                    <li class="sidebar-item"><a class='sidebar-link' href='/pages-reset-password'>Reset Password <span class="sidebar-badge badge bg-primary">Pro</span></a></li>
                    <li class="sidebar-item"><a class='sidebar-link' href='/pages-404'>404 Page <span class="sidebar-badge badge bg-primary">Pro</span></a></li>
                    <li class="sidebar-item"><a class='sidebar-link' href='/pages-500'>500 Page <span class="sidebar-badge badge bg-primary">Pro</span></a></li>
                </ul>
            </li>

            <li class="sidebar-header">
                Components
            </li>
            <li class="sidebar-item">
                <a data-bs-target="#ui" data-bs-toggle="collapse" class="sidebar-link collapsed">
                    <i class="align-middle" data-feather="briefcase"></i> <span class="align-middle">UI Elements</span>
                </a>
                <ul id="ui" class="sidebar-dropdown list-unstyled collapse " data-bs-parent="#sidebar">
                    <li class="sidebar-item"><a class='sidebar-link' href='/ui-alerts'>Alerts <span class="sidebar-badge badge bg-primary">Pro</span></a></a></li>
                    <li class="sidebar-item"><a class='sidebar-link' href='/ui-buttons'>Buttons</a></li>
                    <li class="sidebar-item"><a class='sidebar-link' href='/ui-cards'>Cards</a></li>
                    <li class="sidebar-item"><a class='sidebar-link' href='/ui-general'>General</a></li>
                    <li class="sidebar-item"><a class='sidebar-link' href='/ui-grid'>Grid</a></li>
                    <li class="sidebar-item"><a class='sidebar-link' href='/ui-modals'>Modals <span class="sidebar-badge badge bg-primary">Pro</span></a></li>
                    <li class="sidebar-item"><a class='sidebar-link' href='/ui-offcanvas'>Offcanvas <span class="sidebar-badge badge bg-primary">Pro</span></a></li>
                    <li class="sidebar-item"><a class='sidebar-link' href='/ui-placeholders'>Placeholders <span class="sidebar-badge badge bg-primary">Pro</span></a></li>
                    <li class="sidebar-item"><a class='sidebar-link' href='/ui-tabs'>Tabs <span class="sidebar-badge badge bg-primary">Pro</span></a></li>
                    <li class="sidebar-item"><a class='sidebar-link' href='/ui-typography'>Typography</a></li>
                </ul>
            </li>
            <li class="sidebar-item">
                <a data-bs-target="#icons" data-bs-toggle="collapse" class="sidebar-link collapsed">
                    <i class="align-middle" data-feather="coffee"></i> <span class="align-middle">Icons</span>
                    <span class="sidebar-badge badge bg-light">1.500+</span>
                </a>
                <ul id="icons" class="sidebar-dropdown list-unstyled collapse " data-bs-parent="#sidebar">
                    <li class="sidebar-item"><a class='sidebar-link' href='/icons-feather'>Feather</a></li>
                    <li class="sidebar-item"><a class='sidebar-link' href='/icons-font-awesome'>Font Awesome <span class="sidebar-badge badge bg-primary">Pro</span></a></li>
                </ul>
            </li>
            <li class="sidebar-item">
                <a data-bs-target="#forms" data-bs-toggle="collapse" class="sidebar-link collapsed">
                    <i class="align-middle" data-feather="check-circle"></i> <span class="align-middle">Forms</span>
                </a>
                <ul id="forms" class="sidebar-dropdown list-unstyled collapse " data-bs-parent="#sidebar">
                    <li class="sidebar-item"><a class='sidebar-link' href='/forms-basic-inputs'>Basic Inputs</a></li>
                    <li class="sidebar-item"><a class='sidebar-link' href='/forms-layouts'>Form Layouts <span class="sidebar-badge badge bg-primary">Pro</span></a></li>
                    <li class="sidebar-item"><a class='sidebar-link' href='/forms-input-groups'>Input Groups <span class="sidebar-badge badge bg-primary">Pro</span></a></li>
                </ul>
            </li>
            <li class="sidebar-item">
                <a class='sidebar-link' href='/tables-bootstrap'>
                    <i class="align-middle" data-feather="list"></i> <span class="align-middle">Tables</span>
                </a>
            </li>

            <li class="sidebar-header">
                Plugins & Addons
            </li>
            <li class="sidebar-item">
                <a data-bs-target="#form-plugins" data-bs-toggle="collapse" class="sidebar-link collapsed">
                    <i class="align-middle" data-feather="check-square"></i> <span class="align-middle">Form Plugins</span>
                </a>
                <ul id="form-plugins" class="sidebar-dropdown list-unstyled collapse " data-bs-parent="#sidebar">
                    <li class="sidebar-item"><a class='sidebar-link' href='/forms-advanced-inputs'>Advanced Inputs <span class="sidebar-badge badge bg-primary">Pro</span></a></li>
                    <li class="sidebar-item"><a class='sidebar-link' href='/forms-editors'>Editors <span class="sidebar-badge badge bg-primary">Pro</span></a></li>
                    <li class="sidebar-item"><a class='sidebar-link' href='/forms-validation'>Validation <span class="sidebar-badge badge bg-primary">Pro</span></a></li>
                </ul>
            </li>
            <li class="sidebar-item">
                <a data-bs-target="#datatables" data-bs-toggle="collapse" class="sidebar-link collapsed">
                    <i class="align-middle" data-feather="list"></i> <span class="align-middle">DataTables</span>
                </a>
                <ul id="datatables" class="sidebar-dropdown list-unstyled collapse " data-bs-parent="#sidebar">
                    <li class="sidebar-item"><a class='sidebar-link' href='/tables-datatables-responsive'>Responsive Table <span class="sidebar-badge badge bg-primary">Pro</span></a></li>
                    <li class="sidebar-item"><a class='sidebar-link' href='/tables-datatables-buttons'>Table with Buttons <span class="sidebar-badge badge bg-primary">Pro</span></a></li>
                    <li class="sidebar-item"><a class='sidebar-link' href='/tables-datatables-column-search'>Column Search <span class="sidebar-badge badge bg-primary">Pro</span></a></li>
                    <li class="sidebar-item"><a class='sidebar-link' href='/tables-datatables-fixed-header'>Fixed Header <span class="sidebar-badge badge bg-primary">Pro</span></a></li>
                    <li class="sidebar-item"><a class='sidebar-link' href='/tables-datatables-multi'>Multi Selection <span class="sidebar-badge badge bg-primary">Pro</span></a></li>
                    <li class="sidebar-item"><a class='sidebar-link' href='/tables-datatables-ajax'>Ajax Sourced Data <span class="sidebar-badge badge bg-primary">Pro</span></a></li>
                </ul>
            </li>
            <li class="sidebar-item">
                <a data-bs-target="#charts" data-bs-toggle="collapse" class="sidebar-link collapsed">
                    <i class="align-middle" data-feather="bar-chart-2"></i> <span class="align-middle">Charts</span>
                </a>
                <ul id="charts" class="sidebar-dropdown list-unstyled collapse " data-bs-parent="#sidebar">
                    <li class="sidebar-item"><a class='sidebar-link' href='/charts-chartjs'>Chart.js</a></li>
                    <li class="sidebar-item"><a class='sidebar-link' href='/charts-apexcharts'>ApexCharts <span class="sidebar-badge badge bg-primary">Pro</span></a></li>
                </ul>
            </li>
            <li class="sidebar-item">
                <a class='sidebar-link' href='/notifications'>
                    <i class="align-middle" data-feather="bell"></i> <span class="align-middle">Notifications</span>
                    <span class="sidebar-badge badge bg-primary">Pro</span>
                </a>
            </li>
            <li class="sidebar-item">
                <a data-bs-target="#maps" data-bs-toggle="collapse" class="sidebar-link collapsed">
                    <i class="align-middle" data-feather="map"></i> <span class="align-middle">Maps</span>
                </a>
                <ul id="maps" class="sidebar-dropdown list-unstyled collapse " data-bs-parent="#sidebar">
                    <li class="sidebar-item"><a class='sidebar-link' href='/maps-google'>Google Maps</a></li>
                    <li class="sidebar-item"><a class='sidebar-link' href='/maps-vector'>Vector Maps <span class="sidebar-badge badge bg-primary">Pro</span></a></li>
                </ul>
            </li>

            <li class="sidebar-item">
                <a data-bs-target="#multi" data-bs-toggle="collapse" class="sidebar-link collapsed">
                    <i class="align-middle" data-feather="corner-right-down"></i> <span class="align-middle">Multi Level</span>
                </a>
                <ul id="multi" class="sidebar-dropdown list-unstyled collapse" data-bs-parent="#sidebar">
                    <li class="sidebar-item">
                        <a data-bs-target="#multi-2" data-bs-toggle="collapse" class="sidebar-link collapsed">Two Levels</a>
                        <ul id="multi-2" class="sidebar-dropdown list-unstyled collapse">
                            <li class="sidebar-item">
                                <a class="sidebar-link" href="#">Item 1</a>
                            </li>
                            <li class="sidebar-item">
                                <a class="sidebar-link" href="#">Item 2</a>
                            </li>
                        </ul>
                    </li>
                    <li class="sidebar-item">
                        <a data-bs-target="#multi-3" data-bs-toggle="collapse" class="sidebar-link collapsed">Three Levels</a>
                        <ul id="multi-3" class="sidebar-dropdown list-unstyled collapse">
                            <li class="sidebar-item">
                                <a data-bs-target="#multi-3-1" data-bs-toggle="collapse" class="sidebar-link collapsed">Item 1</a>
                                <ul id="multi-3-1" class="sidebar-dropdown list-unstyled collapse">
                                    <li class="sidebar-item">
                                        <a class="sidebar-link" href="#">Item 1</a>
                                    </li>
                                    <li class="sidebar-item">
                                        <a class="sidebar-link" href="#">Item 2</a>
                                    </li>
                                </ul>
                            </li>
                            <li class="sidebar-item">
                                <a class="sidebar-link" href="#">Item 2</a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </li>
        </ul>

        <div class="sidebar-cta">
            <div class="sidebar-cta-content">
                <strong class="d-inline-block mb-2">Weekly Sales Report</strong>
                <div class="mb-3 text-sm">
                    Your weekly sales report is ready for download!
                </div>

                <div class="d-grid">
                    <a href="https://adminkit.io/" class="btn btn-outline-primary" target="_blank">Download</a>
                </div>
            </div>
        </div>
    </div>
</nav>
