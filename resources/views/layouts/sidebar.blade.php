<nav id="sidebar" class="sidebar js-sidebar">
    <div class="sidebar-content js-simplebar">
        <a class='sidebar-brand' href='/'>
            <span class="sidebar-brand-text align-middle">
                [LOGO]

            </span>
            <svg class="sidebar-brand-icon align-middle" width="32px" height="32px" viewBox="0 0 24 24" fill="none"
                stroke="#FFFFFF" stroke-width="1.5" stroke-linecap="square" stroke-linejoin="miter" color="#FFFFFF"
                style="margin-left: -3px">
                <path d="M12 4L20 8.00004L12 12L4 8.00004L12 4Z"></path>
                <path d="M20 12L12 16L4 12"></path>
                <path d="M20 16L12 20L4 16"></path>
            </svg>
        </a>



        <ul class="sidebar-nav">
            <li class="sidebar-header">
                Main Pages
            </li>
            {{-- <li id="dashboard1" class="sidebar-item ">
                <a data-bs-target="#dashboards" data-bs-toggle="collapse" class="sidebar-link collapsed">
                    <i class="align-middle" data-feather="sliders"></i> <span class="align-middle">Dashboards</span>
                </a>
                <ul id="dashboards" class="sidebar-dropdown list-unstyled collapse" data-bs-parent="#sidebar">
                    <li id="dashboard2" class="sidebar-item "><a class='sidebar-link'
                            href='{{ route('home') }}'>Analytics</a>
                    </li>
                    <li class="sidebar-item"><a class='sidebar-link' href='/dashboard-ecommerce'>E-Commerce <span
                                class="sidebar-badge badge bg-primary">Pro</span></a></li>
                    <li class="sidebar-item"><a class='sidebar-link' href='/dashboard-crypto'>Crypto <span
                                class="sidebar-badge badge bg-primary">Pro</span></a></li>
                </ul>
            </li> --}}

            <li class="{{ request()->is('home') ? 'sidebar-item active' : 'sidebar-item' }}">
                <a class='sidebar-link' href='{{ route('home') }}'>
                    <i class="align-middle" data-feather="pie-chart"></i> <span class="align-middle">Dashboard</span>
                </a>
            </li>


            {{-- <li id="seilist1" class="{{ request()->is('seilist') ? 'sidebar-item active' : 'sidebar-item' }}">
                <a class='sidebar-link' href='{{ route('seilist') }}'>
                    <i class="align-middle" data-feather="list"></i> <span class="align-middle">SEI</span>
                </a>
            </li> --}}

             <li class="{{ request()->is('seilist') || request()->is('seilist2') ? 'sidebar-item active' : 'sidebar-item' }}">
                <a data-bs-target="#seilist1" data-bs-toggle="collapse"  class="sidebar-link collapsed">
                    <i class="align-middle" data-feather="list"></i> <span class="align-middle">SEI</span>
                </a>
                <ul id="seilist1" class="sidebar-dropdown list-unstyled collapse {{ request()->is('seilist') || request()->is('seilist2')  ? 'show' : ' ' }}" data-bs-parent="#sidebar">
                    <li class="sidebar-item {{ request()->is('seilist') ? 'active' : ' ' }}"><a class='sidebar-link' href='{{route('seilist')}}'>Qualifiers</a></li>
                    <li class="sidebar-item {{ request()->is('seilist2') ? 'active' : ' ' }}"><a class='sidebar-link' href='{{ route('seilist2')}}'>Potential Qualifiers </a></li>
                </ul>
            </li>

            <li id="" class="{{ request()->is('emails') ? 'sidebar-item active' : 'sidebar-item' }}">
                <a class='sidebar-link' href='{{ route('emails') }}'>
                    <i class="align-middle" data-feather="mail"></i> <span class="align-middle">Email Status</span>
                </a>
            </li>

            <li id="" class="{{ request()->is('emaileditor') ? 'sidebar-item active' : 'sidebar-item' }}">
                <a class='sidebar-link' href='{{ route('emaileditor') }}'>
                    <i class="align-middle" data-feather="edit"></i> <span class="align-middle">Email Edit</span>
                </a>
            </li>

{{--            <li id="" class="{{ request()->is('accesscontrol') ? 'sidebar-item active' : 'sidebar-item' }}">--}}
{{--                <a class='sidebar-link' href='{{ route('accesscontrol') }}'>--}}
{{--                    <i class="align-middle" data-feather="lock"></i> <span class="align-middle">Access Control</span>--}}
{{--                </a>--}}
{{--            </li>--}}


            <li class="{{ request()->is('accesscontrol') ? 'sidebar-item active' : 'sidebar-item' }}">
                <a data-bs-target="#accesscont1" data-bs-toggle="collapse"  class="sidebar-link collapsed">
                    <i class="align-middle" data-feather="lock"></i><span class="align-middle">Access Control</span>
                </a>
                <ul id="accesscont1" class="sidebar-dropdown list-unstyled collapse {{ request()->is('accesscontrol')
                    || request()->is('accesscontrolongoing')
                    || request()->is('accesscontrolpending')
                    || request()->is('accesscontrolenrolled')
                    || request()->is('accesscontroldeferred')
                    || request()->is('accesscontrolLOA')
                    || request()->is('accesscontrolterminated')? 'show' : ' ' }}" data-bs-parent="#sidebar">

                    <li class="sidebar-item {{ request()->is('accesscontrol') ? 'active' : ' ' }}"><a class='sidebar-link' href='{{route('accesscontrol')}}'>Show All</a></li>
                    <li class="sidebar-item {{ request()->is('accesscontrolpending') ? 'active' : ' ' }}"><a class='sidebar-link' href='{{route('accesscontrolpending')}}'>Pending </a></li>
                    <li class="sidebar-item {{ request()->is('accesscontrolongoing') ? 'active' : ' ' }}"><a class='sidebar-link' href='{{route('accesscontrolongoing')}}'>Ongoing </a></li>
                    <li class="sidebar-item {{ request()->is('accesscontrolenrolled') ? 'active' : ' ' }}"><a class='sidebar-link' href='{{route('accesscontrolenrolled')}}'>Enrolled </a></li>
                    <li class="sidebar-item {{ request()->is('accesscontroldeferred') ? 'active' : ' ' }}"><a class='sidebar-link' href='{{route('accesscontroldeferred')}}'>Deferred </a></li>
                    <li class="sidebar-item {{ request()->is('accesscontrolLOA') ? 'active' : ' ' }}"><a class='sidebar-link' href='{{route('accesscontrolLOA')}}'>LOA </a></li>
                    <li class="sidebar-item {{ request()->is('accesscontrolterminated') ? 'active' : ' ' }}"><a class='sidebar-link' href='{{route('accesscontrolterminated')}}'>Terminated </a></li>
                </ul>
            </li>

            {{-- <li id="" class="sidebar-item">
                <a data-bs-target="#pages" data-bs-toggle="collapse" class="sidebar-link collapsed">
                    <i class="align-middle" data-feather="layout"></i> <span class="align-middle">Pages</span>
                </a>
                <ul id="pages" class="sidebar-dropdown list-unstyled collapse " data-bs-parent="#sidebar">
                    <li class="sidebar-item"><a class='sidebar-link' href='/pages-settings'>Settings</a></li>
                    <li class="sidebar-item"><a class='sidebar-link' href='/pages-projects'>Projects <span
                                class="sidebar-badge badge bg-primary">Pro</span></a></li>
                    <li class="sidebar-item"><a class='sidebar-link' href='/pages-clients'>Clients <span
                                class="sidebar-badge badge bg-primary">Pro</span></a></li>
                    <li class="sidebar-item"><a class='sidebar-link' href='/pages-orders'>Orders <span
                                class="sidebar-badge badge bg-primary">Pro</span></a></li>
                    <li class="sidebar-item"><a class='sidebar-link' href='/pages-pricing'>Pricing <span
                                class="sidebar-badge badge bg-primary">Pro</span></a></li>
                    <li class="sidebar-item"><a class='sidebar-link' href='/pages-chat'>Chat <span
                                class="sidebar-badge badge bg-primary">Pro</span></a></li>
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
                    <li class="sidebar-item"><a class='sidebar-link' href='/pages-reset-password'>Reset Password
                            <span class="sidebar-badge badge bg-primary">Pro</span></a></li>
                    <li class="sidebar-item"><a class='sidebar-link' href='/pages-404'>404 Page <span
                                class="sidebar-badge badge bg-primary">Pro</span></a></li>
                    <li class="sidebar-item"><a class='sidebar-link' href='/pages-500'>500 Page <span
                                class="sidebar-badge badge bg-primary">Pro</span></a></li>
                </ul>
            </li>

            <li class="sidebar-header">
                Components
            </li>
            <li class="sidebar-item">
                <a data-bs-target="#ui" data-bs-toggle="collapse" class="sidebar-link collapsed">
                    <i class="align-middle" data-feather="briefcase"></i> <span class="align-middle">UI
                        Elements</span>
                </a>
                <ul id="ui" class="sidebar-dropdown list-unstyled collapse " data-bs-parent="#sidebar">
                    <li class="sidebar-item"><a class='sidebar-link' href='/ui-alerts'>Alerts <span
                                class="sidebar-badge badge bg-primary">Pro</span></a></a></li>
                    <li class="sidebar-item"><a class='sidebar-link' href='/ui-buttons'>Buttons</a></li>
                    <li class="sidebar-item"><a class='sidebar-link' href='/ui-cards'>Cards</a></li>
                    <li class="sidebar-item"><a class='sidebar-link' href='/ui-general'>General</a></li>
                    <li class="sidebar-item"><a class='sidebar-link' href='/ui-grid'>Grid</a></li>
                    <li class="sidebar-item"><a class='sidebar-link' href='/ui-modals'>Modals <span
                                class="sidebar-badge badge bg-primary">Pro</span></a></li>
                    <li class="sidebar-item"><a class='sidebar-link' href='/ui-offcanvas'>Offcanvas <span
                                class="sidebar-badge badge bg-primary">Pro</span></a></li>
                    <li class="sidebar-item"><a class='sidebar-link' href='/ui-placeholders'>Placeholders <span
                                class="sidebar-badge badge bg-primary">Pro</span></a></li>
                    <li class="sidebar-item"><a class='sidebar-link' href='/ui-tabs'>Tabs <span
                                class="sidebar-badge badge bg-primary">Pro</span></a></li>
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
                    <li class="sidebar-item"><a class='sidebar-link' href='/icons-font-awesome'>Font Awesome <span
                                class="sidebar-badge badge bg-primary">Pro</span></a></li>
                </ul>
            </li>
            <li class="sidebar-item">
                <a data-bs-target="#forms" data-bs-toggle="collapse" class="sidebar-link collapsed">
                    <i class="align-middle" data-feather="check-circle"></i> <span class="align-middle">Forms</span>
                </a>
                <ul id="forms" class="sidebar-dropdown list-unstyled collapse " data-bs-parent="#sidebar">
                    <li class="sidebar-item"><a class='sidebar-link' href='/forms-basic-inputs'>Basic Inputs</a></li>
                    <li class="sidebar-item"><a class='sidebar-link' href='/forms-layouts'>Form Layouts <span
                                class="sidebar-badge badge bg-primary">Pro</span></a></li>
                    <li class="sidebar-item"><a class='sidebar-link' href='/forms-input-groups'>Input Groups <span
                                class="sidebar-badge badge bg-primary">Pro</span></a></li>
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
                    <i class="align-middle" data-feather="check-square"></i> <span class="align-middle">Form
                        Plugins</span>
                </a>
                <ul id="form-plugins" class="sidebar-dropdown list-unstyled collapse " data-bs-parent="#sidebar">
                    <li class="sidebar-item"><a class='sidebar-link' href='/forms-advanced-inputs'>Advanced Inputs
                            <span class="sidebar-badge badge bg-primary">Pro</span></a></li>
                    <li class="sidebar-item"><a class='sidebar-link' href='/forms-editors'>Editors <span
                                class="sidebar-badge badge bg-primary">Pro</span></a></li>
                    <li class="sidebar-item"><a class='sidebar-link' href='/forms-validation'>Validation <span
                                class="sidebar-badge badge bg-primary">Pro</span></a></li>
                </ul>
            </li>
            <li class="sidebar-item">
                <a data-bs-target="#datatables" data-bs-toggle="collapse" class="sidebar-link collapsed">
                    <i class="align-middle" data-feather="list"></i> <span class="align-middle">DataTables</span>
                </a>
                <ul id="datatables" class="sidebar-dropdown list-unstyled collapse " data-bs-parent="#sidebar">
                    <li class="sidebar-item"><a class='sidebar-link' href='/tables-datatables-responsive'>Responsive
                            Table <span class="sidebar-badge badge bg-primary">Pro</span></a></li>
                    <li class="sidebar-item"><a class='sidebar-link' href='/tables-datatables-buttons'>Table with
                            Buttons <span class="sidebar-badge badge bg-primary">Pro</span></a></li>
                    <li class="sidebar-item"><a class='sidebar-link' href='/tables-datatables-column-search'>Column
                            Search <span class="sidebar-badge badge bg-primary">Pro</span></a></li>
                    <li class="sidebar-item"><a class='sidebar-link' href='/tables-datatables-fixed-header'>Fixed
                            Header <span class="sidebar-badge badge bg-primary">Pro</span></a></li>
                    <li class="sidebar-item"><a class='sidebar-link' href='/tables-datatables-multi'>Multi Selection
                            <span class="sidebar-badge badge bg-primary">Pro</span></a></li>
                    <li class="sidebar-item"><a class='sidebar-link' href='/tables-datatables-ajax'>Ajax Sourced Data
                            <span class="sidebar-badge badge bg-primary">Pro</span></a></li>
                </ul>
            </li>
            <li class="sidebar-item">
                <a data-bs-target="#charts" data-bs-toggle="collapse" class="sidebar-link collapsed">
                    <i class="align-middle" data-feather="bar-chart-2"></i> <span class="align-middle">Charts</span>
                </a>
                <ul id="charts" class="sidebar-dropdown list-unstyled collapse " data-bs-parent="#sidebar">
                    <li class="sidebar-item"><a class='sidebar-link' href='/charts-chartjs'>Chart.js</a></li>
                    <li class="sidebar-item"><a class='sidebar-link' href='/charts-apexcharts'>ApexCharts <span
                                class="sidebar-badge badge bg-primary">Pro</span></a></li>
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
                    <li class="sidebar-item"><a class='sidebar-link' href='/maps-vector'>Vector Maps <span
                                class="sidebar-badge badge bg-primary">Pro</span></a></li>
                </ul>
            </li>

            <li class="sidebar-item">
                <a data-bs-target="#multi" data-bs-toggle="collapse" class="sidebar-link collapsed">
                    <i class="align-middle" data-feather="corner-right-down"></i> <span class="align-middle">Multi
                        Level</span>
                </a>
                <ul id="multi" class="sidebar-dropdown list-unstyled collapse" data-bs-parent="#sidebar">
                    <li class="sidebar-item">
                        <a data-bs-target="#multi-2" data-bs-toggle="collapse" class="sidebar-link collapsed">Two
                            Levels</a>
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
                        <a data-bs-target="#multi-3" data-bs-toggle="collapse" class="sidebar-link collapsed">Three
                            Levels</a>
                        <ul id="multi-3" class="sidebar-dropdown list-unstyled collapse">
                            <li class="sidebar-item">
                                <a data-bs-target="#multi-3-1" data-bs-toggle="collapse"
                                    class="sidebar-link collapsed">Item 1</a>
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
            </li> --}}
        </ul>

        {{-- <div class="sidebar-cta">
            <div class="sidebar-cta-content">
                <strong class="d-inline-block mb-2">Weekly Sales Report</strong>
                <div class="mb-3 text-sm">
                    Your weekly sales report is ready for download!
                </div>

                <div class="d-grid">
                    <a href="https://adminkit.io/" class="btn btn-outline-primary" target="_blank">Download</a>
                </div>
            </div>
        </div> --}}
    </div>
</nav>
