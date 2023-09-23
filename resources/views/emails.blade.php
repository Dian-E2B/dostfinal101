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

                                        @if($replyslipsandscholarjoinpending->isNotEmpty())
                                            <tbody>
                                            @foreach ($replyslipsandscholarjoinpending as $replyslipsandscholarjoinpending1)
                                                <tr>
                                                    <td>{{ $replyslipsandscholarjoinpending1->fname }} {{$replyslipsandscholarjoinpending1->mname  }} {{$replyslipsandscholarjoinpending1->lname}}</td>
                                                    <td>{{$replyslipsandscholarjoinpending1->email}}</td>
                                                    <td class="d-none d-md-table-cell">{{$replyslipsandscholarjoinpending1->bday}}</td>
                                                    <td class="table-action">
                                                        <a href="#">edit</a>
                                                        <a href="#"></a>
                                                    </td>

                                                </tr>
                                            @endforeach
                                            </tbody>
                                        @else
                                            <tbody>
                                            <tr>
                                                <td>&nbsp;</td>
                                                <td>&nbsp;</td>
                                                <td>&nbsp;</td>
                                                <td>&nbsp;</td>

                                            </tr>

                                            </tbody>
                                        @endif


                                    </table>
                                </div>
                                <div class="tab-pane" id="tab-2" role="tabpanel">
                                    {{-- ACCEPTED TABLE --}}
                                    <table class="table table-sm table-striped">
                                        <thead>
                                        <tr>
                                            <th style="width:40%;">Name</th>
                                            <th style="width:20%">Email</th>
                                            <th class="d-none d-md-table-cell" style="width:25%">Date of Birth</th>
                                            <th>Actions</th>
                                        </tr>
                                        </thead>

                                        @if($replyslipsandscholarjoinaccepted->isNotEmpty())
                                            <tbody>
                                            <tr>
                                            @foreach ($replyslipsandscholarjoinaccepted as $replyslipsandscholarjoinaccepted1)
                                                <tr>
                                                    <td>{{ $replyslipsandscholarjoinaccepted1->fname }} {{$replyslipsandscholarjoinaccepted1->mname  }} {{$replyslipsandscholarjoinaccepted1->lname}}</td>
                                                    <td>{{$replyslipsandscholarjoinaccepted1->email}}</td>
                                                    <td class="d-none d-md-table-cell">{{$replyslipsandscholarjoinaccepted1->bday}}</td>
                                                    <td class="table-action">
                                                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#sizedModalLg">
                                                            Large
                                                        </button>
                                                        <div class="modal fade" id="sizedModalLg" tabindex="-1" role="dialog" aria-hidden="true">
                                                            <div class="modal-dialog modal-lg" role="document">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title">{{ $replyslipsandscholarjoinaccepted1->fname }} {{$replyslipsandscholarjoinaccepted1->mname  }} {{$replyslipsandscholarjoinaccepted1->lname}}</h5>
                                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                    </div>
                                                                    <div class="modal-body m-1">
                                                                        <strong><p class="mb-0">I am AVAILING my scholarship award.</p></strong>

                                                                        <div class="row">
                                                                            <div class="col-md-6" style="margin-top: 15px;">
                                                                                <p class="mb-0">Qualifier's Name and Signature</p>
                                                                                <img style="max-height: 350px; max-width:350px; " src="{{ $replyslipsandscholarjoinaccepted1->signature }}" alt="">
                                                                            </div>
                                                                            <div class="col-md-6" style="margin-top: 15px;">
                                                                                <p class="mb-0">Parent's/Guardian's Name and Signature</p>
                                                                                <img style="max-height: 350px; max-width:350px; " src="{{ $replyslipsandscholarjoinaccepted1->signatureparents }}" alt="">
                                                                            </div>
                                                                        </div>

                                                                    </div>

                                                                    <div  class="modal-footer">
                                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                                    </div>
                                                                </div>
                                                                </div>
                                                            </div>

                                                    </td>

                                                </tr>
                                            </tbody>
                                            @endforeach
                                        @else
                                            <tbody>
                                            <tr>
                                                <td>&nbsp;</td>
                                                <td>&nbsp;</td>
                                                <td>&nbsp;</td>
                                                <td>&nbsp;</td>

                                            </tr>

                                            </tbody>
                                        @endif



                                    </table>
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
