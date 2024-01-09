<!DOCTYPE html>
<html lang="en">

    <head>
        <title>DOST XI</title>
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        <link rel="icon" href="\icons\DOSTLOGOsmall.png" type="image/x-icon" />
        <link href="{{ asset('css/all.css') }}">


        <style>
            body[data-theme=light] .sidebar-item.active .sidebar-link:hover,
            body[data-theme=light] .sidebar-item.active>.sidebar-link {
                background: #48c4d361;
            }

            body[data-theme=light] .sidebar-item.active .sidebar-link:hover,
            body[data-theme=light] .sidebar-item.active>.sidebar-link {
                color: #0758cd;
            }
        </style>
    </head>

    <body data-theme="light" data-layout="fluid" data-sidebar-position="left" data-sidebar-layout="default">
        <div class="wrapper">

            @include('student.layoutsst.sidebar')
            <div class="main">
                @include('student.layoutsst.header')



                <div class="content" style="padding: 1.0rem 1.0rem 1.0rem;">
                    <main class="container-fluid p-0">

                        <label>
                            <input style="display: none;" value="{{ $scholarId }}">
                        </label>
                        @php
                            $scholarstatusid = DB::select('SELECT scholar_status_id FROM seis WHERE id = ?', [$scholarId]);
                        @endphp
                        @if ($scholarstatusid[0] === 3)
                        @endif
                        {{--  @dd($scholarstatusid[0]); --}}
                        @if (count($replyslips) > 0)
                            <div class="col-12 col-md-6 col-lg-4">
                                <div class="card">
                                    <div class="card-header">
                                        <h5 class="card-title mb-0">Reply Slip</h5>
                                    </div>
                                    <div class="card-body">
                                        <p class="card-text">We are thrilled to offer you the <strong>DOST-SEI S&T Undergraduate
                                                Scholarship</strong> for the academic year <strong>{{ now()->year }}</strong>. As a
                                            scholarship recipient, we kindly request your prompt response by signing and returning this
                                            reply slip to confirm your acceptance of the award.</p>
                                        @if ($replyslipstatus != 1)
                                            <a href="{{ route('student.replyslipview') }}" class="btn btn-primary">View <i class="align-middle me-2" data-feather="eye"></i></a>
                                        @else
                                            <a href="{{ route('student.replyslipview') }}" class="btn btn-success">View <i class="align-middle me-2" data-feather="edit-3"></i></a>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        @else
                        @endif

                    </main>
                </div>
            </div>

        </div>
    </body>
    <script src="{{ asset('js/all.js') }}"></script>
    <script src="https://code.jquery.com/jquery-3.7.0.js"></script>
    {{-- CHECKBOXES DISABLING --}}
    <script></script>

</html>
