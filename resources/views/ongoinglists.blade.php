<!DOCTYPE html>
<html lang="en">

    <head>
        <title>DOST XI</title>
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        <!-- Include DataTables CSS -->
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <link
            href="https://cdn.datatables.net/v/bs5/dt-1.13.6/b-2.4.2/b-colvis-2.4.2/b-html5-2.4.2/b-print-2.4.2/date-1.5.1/fc-4.3.0/fh-3.4.0/r-2.5.0/sc-2.2.0/sp-2.2.0/sl-1.7.0/datatables.min.css"
            rel="stylesheet">
        <!-- Include jQuery -->
        <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>


        <link href="{{ asset('css/all.css') }}">







        <style>
            /* div.dataTables_scrollBody thead {
    display: none;
} */

            /* #yourDataTable thead th,
#yourDataTable tbody td {
    box-sizing: border-box;
} */
            body {
                background-color: #dddddd;
                font-family: "Calibri", sans-serif;
                /*  font-size: 12pt; */
            }

            .sidebar {
                font-size: 12pt;
            }

            th {
                padding-left: 8px;
                padding-right: 8px;
                border-bottom-width: thin;
                border-collapse: separate;
            }

            table td {
                padding-left: 8px;
                padding-right: 8px;
                border-bottom-width: thin;
                border-right-width: thin;
                color: black;
            }


            .text-center {
                text-align: center;
            }


            /* body{
            background-color: rgb(255, 255, 255);
        } */
            .content {
                background-color: white;
            }

            @media print {
                #logo {
                    display: block;
                    position: relative;
                    top: 0;
                    left: 0;

                }


            }

            .viewtd,
            .viewth {
                text-align: center !important;
                vertical-align: middle !important;

                margin-left: auto;
                margin-right: auto;
                margin: 0;
                padding: 0;
                box-sizing: border-box;
            }
        </style>
    </head>

    <body data-theme="light" data-layout="fluid" data-sidebar-position="left" data-sidebar-layout="default">
        <div data-bs-theme="dark" class="wrapper">

            {{-- SIDEBAR START --}}
            @include('layouts.sidebar')
            {{-- SIDEBAR END --}}



            <div class="main">
                @include('layouts.header')

                <main class="content" style="padding:0.5rem 0.5rem 0.5rem">




                    <div class="">


                        <div class="">
                            <img id="logo" src="{{ asset('icons/DOSTlogoONGOING.jpg') }}" style="display: none;">

                            <div class="">


                                <table id="yourDataTable" class="display nowrap compact table-striped"
                                    style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>StartYear</th>
                                            <th>EndYear</th>
                                            <th>Semester</th>
                                            <th>Total Records</th>
                                            <th class="viewth" style="align-items: center !important;">View</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <!-- DataTable content will be dynamically added here -->
                                        </tr>
                                    </tbody>

                                </table>



                            </div>

                            <div>


                            </div>




                        </div>





                </main>







            </div>
        </div>



        <script src="{{ asset('js/all.js') }}"></script>
        <!-- Include DataTables JS -->
        <script
            src="https://cdn.datatables.net/v/bs5/dt-1.13.6/b-2.4.2/b-colvis-2.4.2/b-html5-2.4.2/b-print-2.4.2/date-1.5.1/fc-4.3.0/fh-3.4.0/r-2.5.0/sc-2.2.0/sp-2.2.0/sl-1.7.0/datatables.min.js">
        </script>
        <script>
            $(document).ready(function() {
                $.noConflict();
                var table = $('#yourDataTable').DataTable({
                    processing: true,
                    serverSide: true,
                    ajax: '{{ route('getongoinglistgroupsajax') }}', // Adjust this route to your actual route
                    type: 'POST',
                    columns: [{
                            data: 'startyear',
                            name: 'startyear',
                            type: 'num' // change this to 'date' if 'startyear' is a date
                        },
                        {
                            data: 'endyear',
                            name: 'endyear'
                        },
                        {
                            data: 'semester',
                            name: 'semester'
                        },
                        {
                            data: 'group_year',
                            name: 'Records'
                        },
                        {
                            data: null,
                            orderable: false,
                            searchable: false,
                            className: 'viewtd',

                            render: function(data, type, row) {
                                var startyear = row.startyear;
                                var endyear = row.endyear;
                                var semester = row.semester;

                                // Assuming 'rsms2' is the route name
                                var url =
                                    '{{ route('rsms2', [':startyear', ':endyear', ':semester']) }}';

                                // Replace placeholders with actual values
                                url = url.replace(':startyear', startyear)
                                    .replace(':endyear', endyear)
                                    .replace(':semester', semester);

                                return '<td class="text-center" style="display: flex; justify-content: center; align-items: center;">' +
                                    '<a href="' + url +
                                    '" class="edit-btn" style="display: block; margin: auto;"><i class="fad fa-eye" style="--fa-primary-color: #000000; --fa-secondary-color: #2899a7; --fa-secondary-opacity: 1;"></i></a></td>';
                            }

                        }

                    ],

                    fixedHeader: {
                        header: true,
                        footer: true
                    },
                    scrollX: true,
                    "order": [],
                    rowCallback: function(row, data) {
                        $(row).on('click', '.edit-btn', function() {
                            // Extract the values from the clicked row
                            var startyear = data.startyear;
                            var endyear = data.endyear;
                            var semester = data.semester;

                            // Make an Ajax request to the server
                            $.ajax({
                                url: 'ONGOINGLISTVIEW2',
                                type: 'POST',
                                headers: {
                                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr(
                                        'content')
                                },
                                data: {
                                    startyear: startyear,
                                    endyear: endyear,
                                    semester: semester
                                },
                                success: function(response) {
                                    // Assuming the server returns a success message
                                    console.log(response);

                                    // No client-side redirection
                                },
                                error: function(error) {
                                    console.error(error);
                                }
                            });

                        });
                    }
                });
            });
        </script>

    </body>
    {{-- SIDEBAR TOGGLING --}}

    <!-- Include SweetAlert2 JS -->




</html>
