 <!DOCTYPE html>
 <html lang="en">

     <head>
         <title>DOST XI</title>
         <link href="{{ asset('css/all.css') }}">
         @vite(['resources/css/app.css', 'resources/js/app.js'])
         <link href="https://cdn.datatables.net/v/bs5/dt-1.13.8/b-2.4.2/b-colvis-2.4.2/b-html5-2.4.2/b-print-2.4.2/date-1.5.1/fc-4.3.0/fh-3.4.0/r-2.5.0/sc-2.3.0/sp-2.2.0/sl-1.7.0/datatables.min.css" rel="stylesheet">
         <style>
             body {
                 background-color: #dddddd;
                 
                 /*  font-size: 12pt; */
             }

             .sidebar {
               
             }
         </style>
     </head>

     <body data-theme="default" data-layout="fluid" data-sidebar-position="left" data-sidebar-layout="default">
         <div class="wrapper">

             {{-- SIDEBAR START --}}
             @include('layouts.sidebar')
             {{-- SIDEBAR END --}}



             <div class="main">
                 @include('layouts.header')

                 <main class="main">
                     <div class="container-fluid p-2">


                         <div class="col-12">


                             <div class="card">

                                 <div style="margin-bottom: -10px;" class="card-header">
                                     <div class="row">
                                         <div class="col-8">
                                             <h5 class="card-title">Scholars</h5>
                                             <h6 class="card-subtitle text-muted">All scholars that have access to the
                                                 system
                                                 after accepting notice of awards.
                                             </h6>
                                         </div>



                                     </div>

                                 </div>

                                 <div class="card-body">
                                     <table id="thisdatatable" style="margin-bottom: 1rem !important;" class="table table-striped table-sm">
                                         <thead>
                                             <tr>
                                                 <th>ID</th>
                                                 <th>SCHOLARSHIP BATCH</th>
                                                 <th>NAME</th>
                                                 <th>M/F</th>
                                                 <th class="d-none d-md-table-cell">Email</th>
                                                 <th class="d-none d-md-table-cell">Status</th>
                                                 <th>Action</th>
                                             </tr>
                                         </thead>
                                         <tbody>


                                             @if (request()->is('accesscontrol'))

                                                 @foreach ($seisallstatus as $seisallstatus1)
                                                     <tr>
                                                         <td>{{ $seisallstatus1->id }}</td>

                                                         <td>{{ $seisallstatus1->year }}</td>

                                                         <td>{{ $seisallstatus1->lname }},
                                                             {{ $seisallstatus1->fname }}
                                                             {{ $seisallstatus1->mname }} </td>
                                                         <td>
                                                             @if ($seisallstatus1->gender_id == 1)
                                                                 F
                                                             @else
                                                                 M
                                                             @endif
                                                             {{--  {{ $seisterminated1->gender_id }} --}}
                                                         </td>
                                                         <td class="">{{ $seisallstatus1->email }}</td>

                                                         @if ($seisallstatus1->scholar_status_id == 1)
                                                             {{-- Pending --}}
                                                             <td style="color:blue">
                                                                 <strong>Pending</strong>
                                                             </td>
                                                         @elseif ($seisallstatus1->scholar_status_id == 2)
                                                             {{-- Ongoing --}}
                                                             <td style="color:deepskyblue">
                                                                 <strong>Pending</strong>
                                                             </td>
                                                         @elseif ($seisallstatus1->scholar_status_id == 3)
                                                             {{-- Enrolled --}}
                                                             <td style="color:green">
                                                                 <strong>Enrolled</strong>
                                                             </td>
                                                         @elseif ($seisallstatus1->scholar_status_id == 4)
                                                             {{-- Deferred --}}
                                                             <td style="color:orange">
                                                                 <strong>Deferred</strong>
                                                             </td>
                                                         @elseif ($seisallstatus1->scholar_status_id == 5)
                                                             {{-- LOA --}}
                                                             <td style="color:red">
                                                                 <strong>LOA</strong>
                                                             </td>
                                                         @elseif ($seisallstatus1->scholar_status_id == 6)
                                                             {{-- Terminate --}}
                                                             <td style="color:black">
                                                                 <strong>Terminate</strong>
                                                             </td>
                                                         @endif

                                                         <td class="table-action">
                                                             <a href="#" style="color: black;" data-bs-toggle="tooltip" data-bs-placement="top" title="Temporary lock account	"><i class="fad fa-user-lock"></i></a>
                                                             <a style="color: red; margin-left: 8px;" href="#" data-bs-toggle="tooltip" data-bs-placement="top" title="Permanently delete account	"><i class="fas fa-trash"></i></a>
                                                         </td>
                                                 @endforeach
                                                 </tr>
                                             @elseif(request()->is('accesscontrolpending'))
                                                 @foreach ($replyslipsandscholarjoinpending as $rasp)
                                                     <tr>

                                                         <td>{{ $rasp->sei_id }}</td>
                                                         <td>{{ $rasp->program_id }}</td>

                                                         <td>{{ $rasp->lname }},
                                                             {{ $rasp->fname }}
                                                             {{ $rasp->mname }} </td>
                                                         <td>
                                                             @if ($rasp->gender_id == 1)
                                                                 F
                                                             @else
                                                                 M
                                                             @endif
                                                             {{--  {{ $seisterminated1->gender_id }} --}}
                                                         </td>
                                                         <td class="">{{ $rasp->email }}</td>
                                                         @if ($rasp->scholar_status_id == 1)
                                                             {{-- Pending --}}
                                                             <td style="color:blue">
                                                                 <strong>Pending</strong>
                                                             </td>
                                                         @elseif ($rasp->scholar_status_id == 2)
                                                             {{-- Ongoing --}}
                                                             <td style="color:deepskyblue">
                                                                 <strong>Pending</strong>
                                                             </td>
                                                         @elseif ($rasp->scholar_status_id == 3)
                                                             {{-- Enrolled --}}
                                                             <td style="color:green">
                                                                 <strong>Enrolled</strong>
                                                             </td>
                                                         @elseif ($rasp->scholar_status_id == 4)
                                                             {{-- Deferred --}}
                                                             <td style="color:orange">
                                                                 <strong>Deferred</strong>
                                                             </td>
                                                         @elseif ($rasp->scholar_status_id == 5)
                                                             {{-- LOA --}}
                                                             <td style="color:red">
                                                                 <strong>LOA</strong>
                                                             </td>
                                                         @elseif ($rasp->scholar_status_id == 6)
                                                             {{-- Terminate --}}
                                                             <td style="color:black">
                                                                 <strong>Terminate</strong>
                                                             </td>
                                                         @endif
                                                         <td class="table-action">
                                                             <a href="#" style="color: black;" data-bs-toggle="tooltip" data-bs-placement="top" title="Temporary lock account	"><i class="fad fa-user-lock"></i></a>
                                                             <a style="color: red; margin-left: 8px;" href="#" data-bs-toggle="tooltip" data-bs-placement="top" title="Permanently delete account"><i class="fas fa-trash"></i></a>
                                                             <a href="{{ route('enrollscholartoongoing', ['id' => $rasp->sei_id]) }}" style="color:  black; margin-left: 8px;" data-bs-toggle="tooltip" data-bs-placement="top" title="Enroll Scholar"><i class="fas fa-user-check" style="color: #006f1c;"></i></a>
                                                         </td>

                                                     </tr>
                                                 @endforeach
                                             @elseif(request()->is('accesscontrolongoing'))
                                                 @foreach ($replyslipsjoinscholarongoing as $replyslipsjoinscholarongoing1)
                                                     <tr>
                                                         <td>{{ $replyslipsjoinscholarongoing1->sei_id }}</td>
                                                         <td>{{ $replyslipsjoinscholarongoing1->lname }},
                                                             {{ $replyslipsjoinscholarongoing1->fname }}
                                                             {{ $replyslipsjoinscholarongoing1->mname }} </td>
                                                         <td class="">{{ $replyslipsjoinscholarongoing1->email }}
                                                         </td>
                                                         <td style="color:deepskyblue">
                                                             <strong>{{ $replyslipsjoinscholarongoing1->status_name }}</strong>
                                                         </td>
                                                         <td class="table-action">
                                                             <a href="#" style="color: black;" data-bs-toggle="tooltip" data-bs-placement="top" title="Temporary lock account	"><i class="fad fa-user-lock"></i></a>
                                                             <a style="color: red; margin-left: 8px;" href="#" data-bs-toggle="tooltip" data-bs-placement="top" title="Permanently delete account	"><i class="fas fa-trash"></i></a>
                                                         </td>
                                                     </tr>
                                                 @endforeach
                                             @elseif(request()->is('accesscontrolenrolled'))
                                                 @foreach ($replyslipsjoinscholarenrolled as $replyslipsjoinscholarenrolled1)
                                                     <tr>
                                                         <td>{{ $replyslipsjoinscholarenrolled1->sei_id }}</td>
                                                         <td>{{ $replyslipsjoinscholarenrolled1->lname }},
                                                             {{ $replyslipsjoinscholarenrolled1->fname }}
                                                             {{ $replyslipsjoinscholarenrolled1->mname }} </td>
                                                         <td class="">{{ $replyslipsjoinscholarenrolled1->email }}
                                                         </td>
                                                         <td style="color:green">
                                                             <strong>{{ $replyslipsjoinscholarenrolled1->status_name }}</strong>
                                                         </td>
                                                         <td class="table-action">
                                                             <a href="#" style="color: black;" data-bs-toggle="tooltip" data-bs-placement="top" title="Temporary lock account	"><i class="fad fa-user-lock"></i></a>
                                                             <a style="color: red; margin-left: 8px;" href="#" data-bs-toggle="tooltip" data-bs-placement="top" title="Permanently delete account	"><i class="fas fa-trash"></i></a>
                                                         </td>
                                                 @endforeach
                                                 </tr>
                                             @elseif(request()->is('replyslipsjoinscholardeferred'))
                                                 @foreach ($replyslipsjoinscholardeferred as $replyslipsjoinscholardeferred1)
                                                     <tr>
                                                         <td>{{ $replyslipsjoinscholardeferred1->id }}</td>
                                                         <td>{{ $replyslipsjoinscholardeferred1->lname }},
                                                             {{ $replyslipsjoinscholardeferred1->fname }}
                                                             {{ $replyslipsjoinscholardeferred1->mname }} </td>
                                                         <td class="">{{ $replyslipsjoinscholardeferred1->email }}
                                                         </td>
                                                         <td style="color:green">
                                                             <strong>{{ $replyslipsjoinscholardeferred1->status_name }}</strong>
                                                         </td>
                                                         <td class="table-action">
                                                             <a href="#" style="color: black;" data-bs-toggle="tooltip" data-bs-placement="top" title="Temporary lock account	"><i class="fad fa-user-lock"></i></a>
                                                             <a style="color: red; margin-left: 8px;" href="#" data-bs-toggle="tooltip" data-bs-placement="top" title="Permanently delete account	"><i class="fas fa-trash"></i></a>

                                                         </td>
                                                     </tr>
                                                 @endforeach
                                             @elseif(request()->is(''))
                                                 @foreach ($replyslipsjoinscholarLOA as $replyslipsjoinscholarLOA1)
                                                     <tr>
                                                         <td>{{ $replyslipsjoinscholarLOA1->id }}</td>
                                                         <td>{{ $replyslipsjoinscholarLOA1->lname }},
                                                             {{ $replyslipsjoinscholarLOA1->fname }}
                                                             {{ $replyslipsjoinscholarLOA1->mname }} </td>
                                                         <td class="">{{ $replyslipsjoinscholarLOA1->email }}
                                                         </td>
                                                         <td style="color:green">
                                                             <strong>{{ $replyslipsjoinscholarLOA1->status_name }}</strong>
                                                         </td>
                                                         <td class="table-action">
                                                             <a href="#" style="color: black;" data-bs-toggle="tooltip" data-bs-placement="top" title="Temporary lock account	"><i class="fad fa-user-lock"></i></a>
                                                             <a style="color: red; margin-left: 8px;" href="#" data-bs-toggle="tooltip" data-bs-placement="top" title="Permanently delete account	"><i class="fas fa-trash"></i></a>
                                                         </td>
                                                     </tr>
                                                 @endforeach
                                             @elseif(request()->is('accesscontrolterminated'))
                                                 @foreach ($seisterminated as $seisterminated1)
                                                     <tr>
                                                         <td>{{ $seisterminated1->id }}</td>
                                                         <td>{{ $seisterminated1->year }}</td>
                                                         <td>{{ $seisterminated1->lname }},
                                                             {{ $seisterminated1->fname }}
                                                             {{ $seisterminated1->mname }}</td>
                                                         <td>
                                                             @if ($seisterminated1->gender_id == 1)
                                                                 F
                                                             @else
                                                                 M
                                                             @endif
                                                             {{--  {{ $seisterminated1->gender_id }} --}}
                                                         </td>
                                                         <td class="">
                                                             {{ $seisterminated1->email }}</td>
                                                         <td style="color:green">
                                                             <strong>{{ $seisterminated1->status_name }}</strong>
                                                         </td>
                                                         <td class="table-action">
                                                             <a href="#" style="color: black;" data-bs-toggle="tooltip" data-bs-placement="top" title="Temporary lock account	"><i class="fad fa-user-lock"></i></a>
                                                             <a style="color: red; margin-left: 8px;" href="#" data-bs-toggle="tooltip" data-bs-placement="top" title="Permanently delete account	"><i class="fas fa-trash"></i></a>
                                                             <a style="color: red; margin-left: 8px;" href="#" data-bs-toggle="tooltip" data-bs-placement="top" title="Permanently delete account	"><i class="fas fa-trash"></i></a>
                                                         </td>
                                                     </tr>
                                                 @endforeach


                                         </tbody>
                                     @else
                                         @endif





                                 </div>
                             </div>



                         </div>
                 </main>
             </div>
         </div>
     </body>
     <script src="{{ asset('js/all.js') }}"></script>

     <script src="https://code.jquery.com/jquery-3.7.0.js"></script>
     <script src="https://cdn.datatables.net/v/bs5/jq-3.7.0/dt-1.13.8/b-2.4.2/b-colvis-2.4.2/b-html5-2.4.2/b-print-2.4.2/date-1.5.1/fc-4.3.0/fh-3.4.0/r-2.5.0/sc-2.3.0/sp-2.2.0/sl-1.7.0/datatables.min.js"></script>
     <script>
         jQuery(document).ready(function($) {
             var table = $('#thisdatatable').DataTable({});
         });
     </script>

 </html>
