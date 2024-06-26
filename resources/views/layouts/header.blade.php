<nav class="navbar navbar-expand navbar-light navbar-bg">
    <a class="sidebar-toggle js-sidebar-toggle">
        <i class="hamburger align-self-center"></i>
    </a>

    <a style="{{ request()->is('viewdocument*') ? '' : 'display:none' }}; border: 1px solid #ccc;" href="{{ url()->previous() }}" class="btn ">
        <i class="fad fa-long-arrow-left" style="--fa-primary-color: #000000; --fa-secondary-color: #2899a7; --fa-secondary-opacity: 1;"></i>
    </a>


    <div style="padding-right: 30px"></div>

    <div style="{{ request()->is('seilist') ? 'display:block' : 'display:none' }}" class="btn-group">
        <button style="background-color: darkgreen; color:snow;" id="uploadlist" type="button" class="btn dropdown-toggle" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            Update SEI
        </button>

        <form method="POST" enctype="multipart/form-data" action="{{ route('sei.store') }}">
            <ul style="width: 300px; " class="dropdown-menu" aria-labelledby="dropdownMenu2">
                <li style="padding: 0px 10px 0px 10px ;min-width: 50% !important;">
                    @csrf
                    <input class="form-control" type="file" name="excel_file" accept=".xlsx">
                </li>
                <div style="padding: 1%"></div>
                <li style="padding-left: 10px;"><button class="btn btn-primary" type="submit">Import</button></li>
            </ul>
        </form>

    </div>

    <div style="padding-right: 20px"></div>

    <div class="btn">

        <a style="{{ request()->is('seilist') || request()->is('emaileditor') ? 'display:block' : 'display:none' }}" href="{{ route('sendmail') }}" class="btn btn-primary"> Email Notice to All</a>
    </div>


    <div class="navbar-collapse collapse">

        <section style="text-align: left !important;">
            <ul class="navbar-nav d-1 d-lg-flex">

                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="resourcesDropdown" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Resources
                    </a>
                    <div class="dropdown-menu" aria-labelledby="resourcesDropdown">
                        <a class="dropdown-item"><i style="font-size:15px; margin-right:5px" class="fas fa-scroll"></i> Requests</a>
                        <a class="dropdown-item"><i style="font-size:15px; margin-right:5px" class="fad fa-scroll"></i> Announce</a>


                    </div>
                </li>
            </ul>
        </section>

        <ul class="navbar-nav navbar-align">
            <li class="nav-item dropdown">
                <a class="nav-icon dropdown-toggle" href="#" id="alertsDropdown" data-bs-toggle="dropdown">
                    {{-- <div class="position-relative">
                        <i style="--fa-primary-color: #1f2223; --fa-secondary-color: #121212; --fa-secondary-opacity: 0.6;" class="align-middle fad fa-bell"></i> --}}

                    {{--                        <span class="indicator">10</span> --}}
                    {{-- </div> --}}
                </a>
                <div class="dropdown-menu dropdown-menu-lg dropdown-menu-end py-0" aria-labelledby="alertsDropdown">
                    <div class="dropdown-menu-header">
                        {{--                        4 New Notifications --}}
                    </div>
                    {{--                    <div class="list-group"> --}}
                    {{--                        <a href="#" class="list-group-item"> --}}
                    {{--                            <div class="row g-0 align-items-center"> --}}
                    {{--                                <div class="col-2"> --}}
                    {{--                                    <i class="text-danger" data-feather="alert-circle"></i> --}}
                    {{--                                </div> --}}
                    {{--                                <div class="col-10"> --}}
                    {{--                                    <div class="text-dark">Update completed</div> --}}
                    {{--                                    <div class="text-muted small mt-1">Restart server 12 to complete the update.</div> --}}
                    {{--                                    <div class="text-muted small mt-1">30m ago</div> --}}
                    {{--                                </div> --}}
                    {{--                            </div> --}}
                    {{--                        </a> --}}
                    {{--                        <a href="#" class="list-group-item"> --}}
                    {{--                            <div class="row g-0 align-items-center"> --}}
                    {{--                                <div class="col-2"> --}}
                    {{--                                    <i class="text-warning" data-feather="bell"></i> --}}
                    {{--                                </div> --}}
                    {{--                                <div class="col-10"> --}}
                    {{--                                    <div class="text-dark">Lorem ipsum</div> --}}
                    {{--                                    <div class="text-muted small mt-1">Aliquam ex eros, imperdiet vulputate hendrerit --}}
                    {{--                                        et.</div> --}}
                    {{--                                    <div class="text-muted small mt-1">2h ago</div> --}}
                    {{--                                </div> --}}
                    {{--                            </div> --}}
                    {{--                        </a> --}}
                    {{--                        <a href="#" class="list-group-item"> --}}
                    {{--                            <div class="row g-0 align-items-center"> --}}
                    {{--                                <div class="col-2"> --}}
                    {{--                                    <i class="text-primary" data-feather="home"></i> --}}
                    {{--                                </div> --}}
                    {{--                                <div class="col-10"> --}}
                    {{--                                    <div class="text-dark">Login from 192.186.1.8</div> --}}
                    {{--                                    <div class="text-muted small mt-1">5h ago</div> --}}
                    {{--                                </div> --}}
                    {{--                            </div> --}}
                    {{--                        </a> --}}
                    {{--                        <a href="#" class="list-group-item"> --}}
                    {{--                            <div class="row g-0 align-items-center"> --}}
                    {{--                                <div class="col-2"> --}}
                    {{--                                    <i class="text-success" data-feather="user-plus"></i> --}}
                    {{--                                </div> --}}
                    {{--                                <div class="col-10"> --}}
                    {{--                                    <div class="text-dark">New connection</div> --}}
                    {{--                                    <div class="text-muted small mt-1">Christina accepted your request.</div> --}}
                    {{--                                    <div class="text-muted small mt-1">14h ago</div> --}}
                    {{--                                </div> --}}
                    {{--                            </div> --}}
                    {{--                        </a> --}}
                    {{--                    </div> --}}
                    <div class="dropdown-menu-footer">
                        <a href="#" class="text-muted">Show all notifications</a>
                    </div>
                </div>
            </li>



            <li class="nav-item dropdown">
                <a class="nav-icon dropdown-toggle" href="#" id="messagesDropdown" data-bs-toggle="dropdown">
                    {{-- <div class="position-relative">
                        <i class="align-middle fas fa-comment" style="color: #717171;"></i>

                    </div> --}}
                </a>
                <div class="dropdown-menu dropdown-menu-lg dropdown-menu-end py-0" aria-labelledby="messagesDropdown">
                    <div class="dropdown-menu-header">
                        <div class="position-relative">
                            4 New Messages
                        </div>
                    </div>
                    <div class="list-group">
                        <a href="#" class="list-group-item">
                            <div class="row g-0 align-items-center">
                                <div class="col-2">
                                    {{--                                    <img src="img/avatars/avatar-5.jpg" class="avatar img-fluid rounded-circle" --}}
                                    {{--                                        alt="Vanessa Tucker"> --}}
                                </div>
                                <div class="col-10 ps-2">
                                    <div class="text-dark">Vanessa Tucker</div>
                                    <div class="text-muted small mt-1">Nam pretium turpis et arcu. Duis arcu tortor.
                                    </div>
                                    <div class="text-muted small mt-1">15m ago</div>
                                </div>
                            </div>
                        </a>
                        <a href="#" class="list-group-item">
                            <div class="row g-0 align-items-center">
                                <div class="col-2">
                                    {{--                                    <img src="img/avatars/avatar-2.jpg" class="avatar img-fluid rounded-circle" --}}
                                    {{--                                        alt="William Harris"> --}}
                                </div>
                                <div class="col-10 ps-2">
                                    <div class="text-dark">William Harris</div>
                                    <div class="text-muted small mt-1">Curabitur ligula sapien euismod vitae.</div>
                                    <div class="text-muted small mt-1">2h ago</div>
                                </div>
                            </div>
                        </a>
                        <a href="#" class="list-group-item">
                            <div class="row g-0 align-items-center">
                                <div class="col-2">
                                    {{--                                    <img src="img/avatars/avatar-4.jpg" class="avatar img-fluid rounded-circle" --}}
                                    {{--                                        alt="Christina Mason"> --}}
                                </div>
                                <div class="col-10 ps-2">
                                    <div class="text-dark">Christina Mason</div>
                                    <div class="text-muted small mt-1">Pellentesque auctor neque nec urna.</div>
                                    <div class="text-muted small mt-1">4h ago</div>
                                </div>
                            </div>
                        </a>
                        <a href="#" class="list-group-item">
                            <div class="row g-0 align-items-center">
                                <div class="col-2">
                                    {{--                                    <img src="img/avatars/avatar-3.jpg" class="avatar img-fluid rounded-circle" --}}
                                    {{--                                        alt="Sharon Lessman"> --}}
                                </div>
                                <div class="col-10 ps-2">
                                    <div class="text-dark">Sharon Lessman</div>
                                    <div class="text-muted small mt-1">Aenean tellus metus, bibendum sed, posuere ac,
                                        mattis non.</div>
                                    <div class="text-muted small mt-1">5h ago</div>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="dropdown-menu-footer">
                        <a href="#" class="text-muted">Show all messages</a>
                    </div>
                </div>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-icon dropdown-toggle d-inline-block d-sm-none" href="#" data-bs-toggle="dropdown">
                    <i class="align-middle" data-feather="settings"></i>
                </a>

                <a class="nav-link dropdown-toggle d-none d-sm-inline-block" href="#" data-bs-toggle="dropdown">
                    <span class="text-dark">{{ Auth::user()->username }}</span>
                </a>
                <div class="dropdown-menu dropdown-menu-end">
                    <a class="dropdown-item" href="pages-profile.html"><i class="align-middle me-1" data-feather="user"></i> Profile</a>
                    <a class="dropdown-item" href="#"><i class="align-middle me-1" data-feather="pie-chart"></i> Analytics</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="index.html"><i class="align-middle me-1" data-feather="settings"></i> Settings & Privacy</a>
                    <a class="dropdown-item" href="#"><i class="align-middle me-1" data-feather="help-circle"></i> Help Center</a>
                    <div class="dropdown-divider"></div>
                    {{-- LOGOUT --}}
                    <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Log out</a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                </div>
            </li>
        </ul>
    </div>
</nav>
