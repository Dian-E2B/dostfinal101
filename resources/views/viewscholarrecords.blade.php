<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="csrf-token" content="{{ csrf_token() }}" />
        <title>DOST</title>
        <link href="{{ asset('css/all.css') }}">
        <link href="https://cdn.datatables.net/v/bs5/jszip-3.10.1/dt-1.13.8/b-2.4.2/b-colvis-2.4.2/b-html5-2.4.2/b-print-2.4.2/date-1.5.1/fc-4.3.0/fh-3.4.0/r-2.5.0/sc-2.3.0/sp-2.2.0/sl-1.7.0/datatables.min.css" rel="stylesheet">
        <script src="{{ asset('js/all.js') }}"></script>
        <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
        <script src="https://cdn.datatables.net/v/bs5/jszip-3.10.1/dt-1.13.8/b-2.4.2/b-colvis-2.4.2/b-html5-2.4.2/b-print-2.4.2/date-1.5.1/fc-4.3.0/fh-3.4.0/r-2.5.0/sc-2.3.0/sp-2.2.0/sl-1.7.0/datatables.min.js"></script>
    </head>
    <style>
        .customtable,
        .customth,
        .customtd {
            /* border-width: thin;
            border: 1px solid rgb(198, 198, 198); */
            border-collapse: collapse;
        }

        .customth,
        .customtd {
            padding: 3px;
            text-align: left;
        }
    </style>

    <body data-theme="light" data-layout="fluid" data-sidebar-position="left" data-sidebar-layout="default">
        <div data-bs-theme="dark" class="wrapper">
            <!-- Add more content as needed -->


            {{-- SIDEBAR START --}}
            @include('layouts.sidebar')
            {{-- SIDEBAR END --}}




            <div class="main">

                @include('layouts.header')




                <main class="content" style="padding:0.5rem 0.5rem 0.5rem">

                    <div class="row">
                        <div class="col-12 col-lg-12">
                            <div class="tab">
                                <ul class="nav nav-tabs" role="tablist">
                                    <li class="nav-item"><a class="nav-link tablinks active" href="#tab-1" data-bs-toggle="tab" role="tab">Grading</a></li>
                                    <li class="nav-item"><a class="nav-link tablinks" id="tab2" href="#tab-2" data-bs-toggle="tab" role="tab">Documents</a></li>

                                </ul>
                                <div class="tab-content">
                                    <div class="tab-pane active" id="tab-1" role="tabpanel">

                                        <table id="thisdatatable" class="display nowrap compact table-striped" style="width:100%">
                                            <thead>
                                                <tr>
                                                    <th>ID: </th>
                                                    <th>Subject Name: </th>
                                                    <th>Grade:</th>
                                                    <th>Unit:</th>
                                                    <th>Semester:</th>
                                                    <th>Academic Year:</th>
                                                    <th>Edit</th>
                                                </tr>
                                            </thead>
                                            <tbody>

                                                @foreach ($cogdata as $cog)
                                                    <tr>
                                                        @foreach ($cog->cogdetails as $detail)
                                                            <td>{{ $cog->scholar_id }}</td>
                                                            <td>{{ $detail->subjectname }}</td>
                                                            <td> {{ $detail->grade }}</td>
                                                            <td> {{ $detail->unit }}</td>
                                                            <td> {{ $cog->semester }} </td>
                                                            <td> {{ $cog->startyear }}- {{ $cog->endyear }} </td>
                                                            <td> <a href="#" class="edit-btn" data-number="{{ $detail->id }}"><i class="fas fa-edit"></i></a></td>
                                                        @endforeach
                                                    </tr>
                                                @endforeach

                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="tab-pane" id="tab-2" role="tabpanel">
                                        <table id="thisdatatable2" class="display nowrap compact table-striped" style="width:100%">
                                            <thead>
                                                <tr>
                                                    <th>View: </th>
                                                    <th>COR/COG: </th>
                                                    <th>Semester:</th>
                                                    <th>Startyear:</th>
                                                </tr>
                                            </thead>
                                            <tbody>

                                            </tbody>
                                        </table>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card">

                        <div class="card-body">
                            <input hidden value="{{ $number }}">

                        </div>
                    </div>
                </main>
            </div>

            <div class="offcanvas offcanvas-start" id="editModal" data-bs-scroll="true" data-bs-backdrop="false" tabindex="-1" id="offcanvasScrolling" aria-labelledby="offcanvasScrollingLabel">
                <div class="offcanvas-header">
                    <h5 class="offcanvas-title" id="offcanvasScrollingLabel">EDIT SCHOLAR DETAILS</h5>
                    <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                </div>
                <div class="offcanvas-body">


                    <table class="  customtable" style="width:100%">

                        <thead>
                            <tr>
                                <th class="customth">ID</th>
                                <td class="customtd"> <input disabled class="form-control form-control-sm" id="idField" name="idField" placeholder=""></td>
                            </tr>
                            <tr>
                                <th class="customth">Subject Name:</th>
                                <td class="customtd"> <input class="form-control form-control-sm" id="subjectField" name="subjectField"></td>
                            </tr>
                            <tr>
                                <th class="customth">Grade:</th>
                                <td class="customtd"> <input class="form-control form-control-sm" id="gradeField" name="gradeField"></td>
                            </tr>
                            <tr>
                                <th class="customth">Unit:</th>
                                <td class="customtd"> <input class="form-control form-control-sm" id="unitField" name="unitField"></td>
                            </tr>

                        <tbody>
                        </tbody>
                    </table>

                    <button type="button" class="btn btn-primary mt-3" id="saveChangesBtn">Save Changes</button>
                </div>


            </div>
        </div>

        {{-- <iframe src="{{ asset('storage/prospectus/1prospectus1701785165.pdf') }}" frameBorder="0" scrolling="auto" height="100%" width="50%" type="application/pdf"></iframe> --}}
    </body>

    <script>
        jQuery(document).ready(function($) {

            var table = $('#thisdatatable').DataTable({});

            $(document).on('click', '.edit-btn', function() {
                var number = $(this).data('number');
                $.ajax({
                    url: '{{ url('/getscholargrades/') }}' + '/' + number,
                    method: 'GET',
                    success: function(data) {
                        $('#editModal #idField').val(data.id);
                        $('#editModal #subjectField').val(data.subjectname);
                        $('#editModal #gradeField').val(data.grade);
                        $('#editModal #unitField').val(data.unit);
                        $('#editModal').offcanvas('show');


                        $('#saveChangesBtn').off('click').click(function() {
                            // Gather the updated data from the modal fields
                            var updatedData = {
                                // NUMBER: $('#editModal #idField').val(),
                                subjectname: $('#editModal #subjectField').val(),
                                grade: $('#editModal #gradeField').val(),
                                unit: $('#editModal #unitField').val(),

                            };

                            // Send the updated data to the server using AJAX
                            $.ajax({
                                url: '{{ url('/savecholargrades/') }}' + '/' + number, // Replace with your server endpoint
                                method: 'POST', // You can use POST or PUT based on your server-side implementation
                                data: updatedData,
                                headers: {
                                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                },
                                success: function(response) {
                                    // Handle success, e.g., close the modal or sho w a success message
                                    console.log('Changes saved successfully:', response);
                                    notyf.success({
                                        message: 'Record has been edited.',
                                        duration: 3000,
                                        position: {
                                            x: 'right',
                                            y: 'top',
                                        },
                                    })

                                    location.reload();

                                    $('#editModal input').val('');
                                    $('#editModal').offcanvas('hide'); // Assuming you want to hide the modal on success

                                },
                                error: function(error) {
                                    console.error('Error saving changes:', error);
                                }
                            });
                        });

                    },
                    error: function(error) {
                        console.error('Error fetching data for editing:', error);
                    }
                });

            });

            var table1;
            var table2;

            $('#tab-1').on('shown.bs.tab', function(e) {
                if (!table1Initialized) {
                    $('#thisdatatable').DataTable().columns.adjust().responsive.recalc().draw();
                    table1Initialized = true;
                }
            });

            $('#tab2').on('click', function() {
                if (!table2) {
                    table2 = $('#thisdatatable2').DataTable({
                        autoWidth: true,
                        select: true,
                        processing: true,
                        serverSide: true,
                        responsive: true,

                        // pageLength: 20, // Set the default page length to 10 rows
                        ajax: "{{ route('getprospectusdata', ['number' => $number]) }}", // Adjust this route to your actual route
                        type: 'GET',
                        columns: [{
                                data: null,
                                orderable: false,
                                searchable: false,
                                render: function(data, type, row) {
                                    var number = row
                                        .id; // Assuming 'NUMBER' is the column name in your database

                                    return '<td >' +
                                        '<a href="#" class="view-btn" data-id="' + number +
                                        '"><i class="fa fa-eye"></i></a>' + '</td>';
                                }
                            },
                            // {
                            //     data: 'id',
                            // },
                            {
                                data: 'date_uploaded',
                            },
                            {
                                data: 'semester',
                            },
                            {
                                data: 'startyear',
                            },

                        ],
                        fixedHeader: {
                            header: true,
                            footer: true
                        },
                        scrollX: true,

                    });
                } else {
                    table2.columns.adjust().responsive.recalc().draw();
                }
            });


            $(document).on('click', '.view-btn', function() {
                var number = $(this).data('id');
                var url = '{{ url('/viewscholarprospectus/') }}' + '/' + number;
                window.location.href = url;
            });


            // var table = $('#thisdatatable2').DataTable({



            // });


            $('#tab-1').on('shown.bs.tab', function(e) {
                setTimeout(function() {
                    $('#thisdatatable').DataTable().columns.adjust().draw();
                }, 100);
            });

            // Code for the second tab


        });
    </script>
    <script></script>

</html>
