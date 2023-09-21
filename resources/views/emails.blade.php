<!DOCTYPE html>
<html lang="en">

<head>
    <title>DOST XI</title>
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>

<body data-theme="default" data-layout="fluid" data-sidebar-position="left" data-sidebar-layout="default">
    <div class="wrapper">

        {{-- SIDEBAR START --}}
        @include('layouts.sidebar')
        {{-- SIDEBAR END --}}

        <div class="main">
            @include('layouts.header')

            <main class="">
                <div class="container-fluid p-3">

                    <div class="col-lg-12 col-lg-6">
                        <div class="tab">
                            <ul class="nav nav-tabs" role="tablist">
                                <li class="nav-item"><a id="thistab1" class="nav-link active" href="#tab-1"
                                        data-bs-toggle="tab" role="tab">Pending</a></li>
                                <li class="nav-item"><a class="nav-link" href="#tab-2" data-bs-toggle="tab"
                                        role="tab">Accepted</a></li>
                                <li class="nav-item"><a class="nav-link" href="#tab-3" data-bs-toggle="tab"
                                        role="tab">Messages</a></li>
                            </ul>
                            <div class="tab-content">
                                <div class="tab-pane active" id="tab-1" role="tabpanel">
                                    {{-- PENDING TABLE --}}
                                    <table class="table table-sm table-striped">
                                        <thead>
                                            <tr>
                                                <th style="width:40%;">Name</th>
                                                <th style="width:20%">Email</th>
                                                <th class="d-none d-md-table-cell" style="width:25%">Date of Birth</th>
                                                <th>Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        @foreach ($replyslips as $reply)
                                            <tr>
                                                <td>{{ $reply->scholars->fname }} {{$reply->scholars->mname  }} {{$reply->scholars->lname}}</td>
                                                <td>{{$reply->scholars->email}}</td>
                                                <td class="d-none d-md-table-cell">{{$reply->scholars->bday}}</td>
                                                <td class="table-action">
                                                    <a href="#">edit</a>
                                                    <a href="#"></a>
                                                </td>

                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                                <div class="tab-pane" id="tab-2" role="tabpanel">
                                    <h4 class="tab-title">Another one</h4>
                                    <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula
                                        eget dolor tellus eget condimentum
                                        rhoncus. Aenean massa. Cum sociis natoque penatibus et magnis neque dis
                                        parturient montes, nascetur ridiculus mus.
                                    </p>
                                    <p>Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem. Nulla
                                        consequat massa quis enim. Donec pede
                                        justo, fringilla vel, aliquet nec, vulputate eget, arcu. In enim justo, rhoncus
                                        ut, imperdiet a, venenatis vitae,
                                        justo.</p>
                                </div>
                                <div class="tab-pane" id="tab-3" role="tabpanel">
                                    <h4 class="tab-title">One more</h4>
                                    <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula
                                        eget dolor tellus eget condimentum
                                        rhoncus. Aenean massa. Cum sociis natoque penatibus et magnis neque dis
                                        parturient montes, nascetur ridiculus mus.
                                    </p>
                                    <p>Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem. Nulla
                                        consequat massa quis enim. Donec pede
                                        justo, fringilla vel, aliquet nec, vulputate eget, arcu. In enim justo, rhoncus
                                        ut, imperdiet a, venenatis vitae,
                                        justo.</p>
                                </div>
                            </div>
                        </div>
                    </div>




                </div>
            </main>
        </div>
    </div>
</body>
{{-- TAB TOGGLING --}}
<script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
<script></script>

</html>
