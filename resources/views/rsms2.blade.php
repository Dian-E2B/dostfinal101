<!DOCTYPE html>
<html lang="en">

    <head>
        <title>DOST XI</title>
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        <meta name="csrf-token" content="{{ csrf_token() }}" />
        <!-- Include DataTables CSS -->
        <link href="https://cdn.datatables.net/v/bs5/jszip-3.10.1/dt-1.13.8/b-2.4.2/b-colvis-2.4.2/b-html5-2.4.2/b-print-2.4.2/date-1.5.1/fc-4.3.0/fh-3.4.0/r-2.5.0/sc-2.3.0/sp-2.2.0/sl-1.7.0/datatables.min.css" rel="stylesheet">
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

            body {
                background-color: rgb(255, 255, 255);
            }

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


                table,
                table tr,
                table td {
                    border-top: #000 solid 1px;
                    border-bottom: #000 solid 1px;
                    border-left: #000 solid 1px;
                    border-right: #000 solid 1px;
                }
            }


            .custom-font-size {
                font-size: 12px;
                /* Replace with your preferred font size */
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
                        <h3>
                            @if ($semester == 1)
                                @php
                                    echo $semester . 'ST SEM ' . $startyear . '-' . $endyear;
                                @endphp
                            @elseif ($semester == 2)
                                @php
                                    echo $semester . 'ND SEM ' . $startyear . '-' . $endyear;
                                @endphp
                            @else
                                @php
                                    echo 'SUMMER ' . $startyear . '-' . $endyear;
                                @endphp
                            @endif
                        </h3>
                        <input hidden id=startyear value="{{ $startyear }}">
                        <input hidden id=endyear value="{{ $endyear }}">
                        <input hidden id=semester value="{{ $semester }}">

                        <div class="">
                            <img id="logo" src="{{ asset('icons/DOSTlogoONGOING.jpg') }}" style="display: none;">
                            <div class="">
                                <table id="yourDataTable" class="display nowrap compact table-striped" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>Batch</th>
                                            <th>Number</th>
                                            <th>Name</th>
                                            <th>MF</th>
                                            <th>Scholarship Program</th>
                                            <th>School</th>
                                            <th>Course</th>
                                            <th>
                                                @if ($semester == 1)
                                                    {{-- 1ST SEM --}}
                                                    @php
                                                        $semester2 = $semester + 1; //2ND
                                                        $startyear2 = $startyear - 1;
                                                        $endyear2 = $endyear - 1;
                                                    @endphp
                                                    {{ 'GRADES' . $semester2 . 'NDSEM' . $startyear2 . '' . $endyear2 }}
                                                @elseif ($semester == 2)
                                                    {{-- 2ND SEM --}}
                                                    @php
                                                        $semester2 = $semester - 1; //1ST
                                                        $startyear2 = $startyear;
                                                        $endyear2 = $endyear;
                                                    @endphp
                                                    {{ 'GRADES' . $semester2 . 'STSEM' . $startyear2 . '' . $endyear2 }}
                                                @elseif ($semester == 3)
                                                    {{-- SUMMER --}}
                                                    @php
                                                        $semester2 = $semester - 1; //2ND SEM
                                                        $startyear2 = $startyear - 1; //CURRENT
                                                        $endyear2 = $endyear; //
                                                    @endphp
                                                    {{ 'GRADES' . $semester2 . 'NDSEM' . $startyear2 . '' . $endyear2 }}
                                                @endif
                                            </th>
                                            <th>SummerREG</th>
                                            <th>
                                                @if ($semester == 1)
                                                    {{-- 1ST SEM --}}
                                                    @php
                                                        $semester2 = $semester;
                                                        $startyear2 = $startyear;
                                                        $endyear2 = $endyear;
                                                    @endphp
                                                    {{ 'REG FORMS' . $semester2 . 'STSEM' . $startyear2 . '' . $endyear2 }}
                                                @elseif ($semester == 2)
                                                    {{-- 2ND SEM --}}
                                                    @php
                                                        $semester2 = $semester;
                                                        $startyear2 = $startyear;
                                                        $endyear2 = $endyear;
                                                    @endphp
                                                    {{ 'REG FORMS' . $semester2 . 'NDSEM' . $startyear2 . '' . $endyear2 }}
                                                @elseif ($semester == 3)
                                                    {{-- SUMMER --}}
                                                    @php
                                                        $semester2 = $semester - 2; //1ST SEM
                                                        $startyear2 = $startyear; //(SAME STARTYEAR,+1 ENDYEAR)
                                                        $endyear2 = $endyear + 1; //
                                                    @endphp
                                                    {{ 'REG FORMS' . $semester2 . 'STSEM' . $startyear2 . '' . $endyear2 }}
                                                @endif
                                            </th>
                                            <th>REMARKS</th>
                                            <th>STATUSENDORSEMENT</th>
                                            <th>STATUSENDORSEMENT2</th>
                                            <th>STATUS</th>
                                            <th>NOTATIONS</th>
                                            <th>SUMMER</th>
                                            <th>FARELEASEDTUITION</th>
                                            <th>FARELEASEDTUITIONBOOKSTIPEND</th>
                                            <th>LVDCAccount</th>
                                            <th>HVCNotes</th>
                                            <th>startyear</th>
                                            <th>endyear</th>
                                            <th>semester</th>
                                            <th style="vertical-align:center;">Action</th>

                                        </tr>
                                    </thead>
                                    <tbody>
                                        <!-- DataTable content will be dynamically added here -->
                                    </tbody>

                                </table>
                            </div>
                        </div>



                        {{-- YEAR LOGIC --}}




                        {{-- OFF-CANVAS --}}
                        <div class="offcanvas offcanvas-start" id="editModal" data-bs-scroll="true" data-bs-backdrop="false" tabindex="-1" id="offcanvasScrolling" aria-labelledby="offcanvasScrollingLabel">
                            <div class="offcanvas-header">
                                <h5 class="offcanvas-title" id="offcanvasScrollingLabel">EDIT SCHOLAR DETAILS</h5>
                                <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                            </div>
                            <div class="offcanvas-body">
                                <div class="row align-items-center mb-1">
                                    <div class="col-3   custom-font-size">
                                        <strong>ID:</strong>
                                    </div>
                                    <div class="col-6">
                                        <input disabled class="form-control form-control-sm" id="idField" name="idField" placeholder="">
                                    </div>
                                </div>

                                <div class="row align-items-center mb-1">
                                    <div class="col-3 custom-font-size ">
                                        <strong>Name:</strong>
                                    </div>
                                    <div class="col-9 custom-font-size ">
                                        <input class="form-control form-control-sm" id="nameField" name="nameField">
                                    </div>
                                </div>

                                <div class="row align-items-center mb-1">
                                    <div class="col-3 custom-font-size ">
                                        <strong>Gender:</strong>
                                    </div>
                                    <div class="col-9">
                                        <input class="form-control form-control-sm" id="genderField" name="genderField">
                                    </div>
                                </div>

                                <div class="row align-items-center mb-1">
                                    <div class="col-3 custom-font-size ">
                                        <strong>Program:</strong>
                                    </div>
                                    <div class="col-9">
                                        <input class="form-control form-control-sm" id="programField" name="programField">
                                    </div>
                                </div>

                                <div class="row align-items-center mb-1">
                                    <div class="col-3 custom-font-size ">
                                        <strong>School:</strong>
                                    </div>
                                    <div class="col-9">
                                        <input class="form-control form-control-sm" id="schoolField" name="schoolField">
                                    </div>
                                </div>
                                <div class="row align-items-center mb-1">
                                    <div class="col-3 custom-font-size ">
                                        <strong>Course:</strong>
                                    </div>
                                    <div class="col-9">
                                        <input class="form-control form-control-sm" id="courseField" name="courseField">
                                    </div>
                                </div>

                                <div class="row align-items-center mb-1">
                                    <div class="col-3 custom-font-size ">
                                        <strong>GRADES:</strong>
                                    </div>
                                    <div class="col-9">
                                        <input class="form-control form-control-sm" id="gradesField" name="gradesField">
                                    </div>
                                </div>

                                <div class="row align-items-center mb-1">
                                    <div class="col-4 custom-font-size ">
                                        <strong>SummerREG:</strong>
                                    </div>
                                    <div class="col-8">
                                        <input class="form-control form-control-sm" id="summerRegField" name="summerRegField">
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-4 custom-font-size ">
                                        <strong class="custom-font-size">REGFORMS</strong>
                                    </div>
                                    <div class="col-8">
                                        <input class="form-control form-control-sm" id="regFormsField" name="regFormsField">
                                    </div>
                                </div>

                                <div class="row align-items-center">
                                    <div class="custom-font-size ">
                                        <strong>REMARKS:</strong>
                                    </div>
                                    <div class="">
                                        <textarea class="form-control form-control-sm" id="remarksField" name="remarksField"></textarea>
                                    </div>
                                </div>

                                <div class="row align-items-center mb-1">
                                    <div class="col-5 custom-font-size ">
                                        <strong>STATUSENDORSEMENT:</strong>
                                    </div>
                                    <div class="col-7">
                                        <input class="form-control form-control-sm" id="statusEndorsementField" name="statusEndorsementField">
                                    </div>
                                </div>

                                <div class="row align-items-center mb-1">
                                    <div class="col-5 custom-font-size ">
                                        <strong>STATUSENDORSEMENT2:</strong>
                                    </div>
                                    <div class="col-7 custom-font-size ">
                                        <input class="form-control form-control-sm" id="statusEndorsement2Field" name="statusEndorsement2Field">
                                    </div>
                                </div>

                                <div class="row align-items-center mb-1">
                                    <div class="col-5 custom-font-size ">
                                        <strong>STATUS:</strong>
                                    </div>
                                    <div class="col-7 custom-font-size ">
                                        <input class="form-control form-control-sm" id="statusField" name="statusField">
                                    </div>
                                </div>

                                <div class="row align-items-center mb-1">
                                    <div class="custom-font-size ">
                                        <strong>NOTATIONS:</strong>
                                    </div>
                                    <div class="">
                                        <textarea class="form-control form-control-sm" id="notationsField" name="notationsField"></textarea>
                                    </div>
                                </div>

                                <div class="row align-items-center mb-1">
                                    <div class="col-5 custom-font-size ">
                                        <strong>SUMMER:</strong>
                                    </div>
                                    <div class="col-7">
                                        <input class="form-control form-control-sm" id="summerField" name="summerField">
                                    </div>
                                </div>


                                <div class="row align-items-center mb-1">
                                    <div class="col-5 custom-font-size ">
                                        <strong>FARELEASEDTUITION:</strong>
                                    </div>
                                    <div class="col-7">
                                        <input class="form-control form-control-sm" id="faReleaseTuitionField" name="faReleaseTuitionField">
                                    </div>
                                </div>

                                <div class="row align-items-center mb-1">
                                    <div class="col-5 custom-font-size ">
                                        <strong>FARELEASEDTUITION<br>BOOKSTIPEND:</strong>
                                    </div>
                                    <div class="col-7">
                                        <input class="form-control form-control-sm" id="faReleaseTuitionBookStipendField" name="faReleaseTuitionBookStipendField">
                                    </div>
                                </div>

                                <div class="row align-items-center mb-1">
                                    <div class="col-5 custom-font-size ">
                                        <strong>LVDCAccount:</strong>
                                    </div>
                                    <div class="col-7">
                                        <input class="form-control form-control-sm" id="lvdCAccountField" name="lvdCAccountField">
                                    </div>
                                </div>

                                <div class="row align-items-center mb-1">
                                    <div class="col-5 custom-font-size ">
                                        <strong>HVCNotes:</strong>
                                    </div>
                                    <div class="col-7 ">
                                        <input class="form-control form-control-sm" id="hvcNotesField" name="hvcNotesField">
                                    </div>
                                </div>

                                <button type="button" class="btn btn-primary" id="saveChangesBtn">Save Changes</button>
                            </div>


                        </div>

                    </div>
                </main>
            </div>
        </div>



        <script src="{{ asset('js/all.js') }}"></script>
        <!-- Include DataTables JS -->
        <script src="https://cdn.datatables.net/v/bs5/jszip-3.10.1/dt-1.13.8/b-2.4.2/b-colvis-2.4.2/b-html5-2.4.2/b-print-2.4.2/date-1.5.1/fc-4.3.0/fh-3.4.0/r-2.5.0/sc-2.3.0/sp-2.2.0/sl-1.7.0/datatables.min.js"></script>
        <script>
            $(document).ready(function() {
                var startyearValue = $('#startyear').val();
                var endyearValue = $('#endyear').val();
                var semesterValue = $('#semester').val();
                var semesterValue2;

                if (semesterValue == 1) {
                    semesterValue2 = semesterValue + 1;
                } else if (semesterValue == 2) {
                    semesterValue2 = semesterValue - 1;
                } else {
                    semesterValue2 = "SUMMER";
                }

                $.noConflict();
                var table = $('#yourDataTable').DataTable({
                    processing: true,
                    serverSide: true,

                    // pageLength: 20, // Set the default page length to 10 rows
                    ajax: '{{ route('getongoinglistgroupsajaxviewclicked') }}', // Adjust this route to your actual route
                    type: 'POST',
                    columns: [{
                            data: 'BATCH',
                            name: 'BATCH'
                        },
                        {
                            data: 'NUMBER',
                            name: 'NUMBER'
                        },
                        {
                            data: 'NAME',
                            name: 'NAME'
                        },
                        {
                            data: 'MF',
                            name: 'MF'
                        },
                        {
                            data: 'SCHOLARSHIPPROGRAM',
                            name: 'SCHOLARSHIPPROGRAM'
                        },
                        {
                            data: 'SCHOOL',
                            name: 'SCHOOL'
                        },
                        {
                            data: 'COURSE',
                            name: 'COURSE'
                        },
                        {
                            data: 'GRADES',
                            name: 'GRADES' + semesterValue2 + 'SEM' + startyearValue - 1 + endyearValue - 1
                        },
                        {
                            data: 'SummerREG',
                            name: 'SummerREG'
                        },
                        {
                            data: 'REGFORMS',
                            name: 'REGFORMS1STSEM20222023'
                        },
                        {
                            data: 'REMARKS',
                            name: 'REMARKS'
                        },
                        {
                            data: 'STATUSENDORSEMENT',
                            name: 'STATUSENDORSEMENT'
                        },
                        {
                            data: 'STATUSENDORSEMENT2',
                            name: 'STATUSENDORSEMENT2'
                        },
                        {
                            data: 'STATUS',
                            name: 'STATUS'
                        },
                        {
                            data: 'NOTATIONS',
                            name: 'NOTATIONS'
                        },
                        {
                            data: 'SUMMER',
                            name: 'SUMMER'
                        },
                        {
                            data: 'FARELEASEDTUITION',
                            name: 'FARELEASEDTUITION'
                        },
                        {
                            data: 'FARELEASEDTUITIONBOOKSTIPEND',
                            name: 'FARELEASEDTUITIONBOOKSTIPEND'
                        },
                        {
                            data: 'LVDCAccount',
                            name: 'LVDCAccount'
                        },
                        {
                            data: 'HVCNotes',
                            name: 'HVCNotes'
                        },
                        {
                            data: 'startyear',
                            name: 'startyear'
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
                            data: null,
                            orderable: false,
                            searchable: false,
                            render: function(data, type, row) {
                                var number = row
                                    .NUMBER; // Assuming 'NUMBER' is the column name in your database

                                return '<td class="text-center" style="text-align: center !important;">' +
                                    '<a href="#" class="edit-btn" data-number="' + number +
                                    '"><i class="fa fa-pencil"></i></a></td>';
                            }
                        }

                    ],
                    columnDefs: [{
                            targets: [1], // Index of the "No" column
                            orderable: false,
                            searchable: false,
                        },
                        {
                            targets: [3, 5, 19, 4],
                            orderable: false,
                        },

                    ],
                    fixedHeader: {
                        header: true,
                        footer: true
                    },
                    scrollX: true,
                    order: [
                        [0, 'asc'] //set batch sort from lowest
                    ],
                    fixedColumns: {
                        leftColumns: 3,
                    },

                    initComplete: function() {
                        this.api().columns([3, 5, 4]).every(function(d) {
                            var column = this;
                            var theadname = $("#thisdatatable th").eq([d]).text();
                            var select = $(
                                    "<select style=\"padding: 1px !important;\" class=\"form-control\"><option value=\"\"> " +
                                    theadname + " </option></select>"
                                )
                                .appendTo($(column.header()))
                                .on("change", function() {
                                    var val = $.fn.dataTable.util.escapeRegex(
                                        $(this).val()
                                    );
                                    column
                                        .search(val ? "^" + val + "$" : "", true, false)
                                        .draw();
                                });
                            column.data().unique().sort().each(function(d, j) {
                                select.append("<option value=\"" + d + "\">" + d +
                                    "</option>")
                            });
                        });
                    },

                    drawCallback: function() {
                        let start = table.page.info().start;
                        let i = start + 1;
                        table
                            .column(1, {
                                search: 'applied',
                                order: 'applied'
                            })
                            .nodes()
                            .each(function(cell, index) {
                                cell.innerHTML = i++;
                            });
                    }
                });


                $(document).on('click', '.edit-btn', function() {
                    var number = $(this).data('number');
                    $.ajax({
                        url: '{{ url('/get-ongoing/') }}' + '/' + number,
                        method: 'GET',
                        success: function(data) {
                            $('#editModal #idField').val(data.NUMBER);
                            $('#editModal #nameField').val(data.NAME);
                            $('#editModal #genderField').val(data.MF);
                            $('#editModal #programField').val(data.SCHOLARSHIPPROGRAM);
                            $('#editModal #schoolField').val(data.SCHOOL);
                            $('#editModal #courseField').val(data.COURSE);
                            $('#editModal #gradesField').val(data.GRADES);
                            $('#editModal #summerRegField').val(data.SummerREG);
                            $('#editModal #regFormsField').val(data.REGFORMS);
                            $('#editModal #remarksField').val(data.REMARKS);
                            $('#editModal #statusEndorsementField').val(data.STATUSENDORSEMENT);
                            $('#editModal #statusEndorsement2Field').val(data.STATUSENDORSEMENT2);
                            $('#editModal #statusField').val(data.STATUS);
                            $('#editModal #notationsField').val(data.NOTATIONS);
                            $('#editModal #summerField').val(data.SUMMER);
                            $('#editModal #faReleaseTuitionField').val(data.FARELEASEDTUITION);
                            $('#editModal #faReleaseTuitionBookStipendField').val(data
                                .FARELEASEDTUITIONBOOKSTIPEND);
                            $('#editModal #lvdCAccountField').val(data.LVDCAccount);
                            $('#editModal #hvcNotesField').val(data.HVCNotes);
                            // alert(data.NAME);
                            $('#editModal').offcanvas('show');
                            data.semester = $('#semesterFilter').val();
                            data.start_year = $('#startYearFilter').val();
                            data.end_year = $('#endYearFilter').val();
                        },
                        error: function(error) {
                            console.error('Error fetching data for editing:', error);
                        }
                    });


                    $('#saveChangesBtn').off('click').click(function() {
                        // Gather the updated data from the modal fields
                        var updatedData = {
                            // NUMBER: $('#editModal #idField').val(),
                            NAME: $('#editModal #nameField').val(),
                            MF: $('#editModal #genderField').val(),
                            SCHOLARSHIPPROGRAM: $('#editModal #programField').val(),
                            SCHOOL: $('#editModal #schoolField').val(),
                            COURSE: $('#editModal #courseField').val(),
                            GRADES: $('#editModal #gradesField').val(),
                            SummerREG: $('#editModal #summerRegField').val(),
                            REGFORMS: $('#editModal #regFormsField').val(),
                            REMARKS: $('#editModal #remarksField').val(),
                            STATUSENDORSEMENT: $('#editModal #statusEndorsementField').val(),
                            STATUSENDORSEMENT2: $('#editModal #statusEndorsement2Field').val(),
                            STATUS: $('#editModal #statusField').val(),
                            NOTATIONS: $('#editModal #notationsField').val(),
                            SUMMER: $('#editModal #summerField').val(),
                            FARELEASEDTUITION: $('#editModal #faReleaseTuitionField').val(),
                            FARELEASEDTUITIONBOOKSTIPEND: $('#editModal #faReleaseTuitionField').val(),
                            LVDCAccount: $('#editModal #lvdCAccountField').val(),
                            HVCNotes: $('#editModal #lvdCAccountField').val(),
                        };

                        // Send the updated data to the server using AJAX
                        $.ajax({
                            url: '{{ url('/savechangesongongoing/') }}' + '/' + number, // Replace with your server endpoint
                            method: 'POST', // You can use POST or PUT based on your server-side implementation
                            data: updatedData,
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            },
                            success: function(response) {
                                // Handle success, e.g., close the modal or show a success message
                                console.log('Changes saved successfully:', response);
                                notyf.success({
                                    message: 'Record has been edited.',
                                    duration: 3000,
                                    position: {
                                        x: 'right',
                                        y: 'top',
                                    },
                                })
                                // Update specific cells in DataTable with new data
                                // Update specific cells in DataTable with new data
                                var dataTable = $('#yourDataTable').DataTable();

                                // Assuming 'response' is the updated data you received from the server
                                var newData = response;

                                // Assuming 'newData.NUMBER' is the unique identifier for the row
                                var uniqueIdentifier = newData.NUMBER;



                                // Iterate over each row in the DataTable
                                dataTable.rows().every(function(rowIdx, tableLoop, rowLoop) {
                                    // Access the data for the current row
                                    var row = dataTable.row(rowIdx);


                                    // Replace this condition with your own logic to identify the row
                                    if (row.NUMBER == uniqueIdentifier) {
                                        // Update the specific cells in the DataTable
                                        dataTable.cell(rowIdx, 0).data(newData.BATCH);
                                        dataTable.cell(rowIdx, 2).data(newData.NAME);
                                        dataTable.cell(rowIdx, 3).data(newData.MF);
                                        dataTable.cell(rowIdx, 4).data(newData.SCHOLARSHIPPROGRAM);
                                        dataTable.cell(rowIdx, 5).data(newData.SCHOOL);
                                        dataTable.cell(rowIdx, 6).data(newData.COURSE);
                                        dataTable.cell(rowIdx, 7).data(newData.GRADES);
                                        dataTable.cell(rowIdx, 8).data(newData.SummerREG);
                                        dataTable.cell(rowIdx, 9).data(newData.REGFORMS);
                                        dataTable.cell(rowIdx, 10).data(newData.REMARKS);
                                        dataTable.cell(rowIdx, 11).data(newData.STATUSENDORSEMENT);
                                        dataTable.cell(rowIdx, 12).data(newData.STATUSENDORSEMENT2);
                                        dataTable.cell(rowIdx, 13).data(newData.STATUS);
                                        dataTable.cell(rowIdx, 14).data(newData.NOTATIONS);
                                        dataTable.cell(rowIdx, 15).data(newData.SUMMER);
                                        dataTable.cell(rowIdx, 16).data(newData.FARELEASEDTUITION);
                                        dataTable.cell(rowIdx, 17).data(newData.FARELEASEDTUITIONBOOKSTIPEND);
                                        dataTable.cell(rowIdx, 18).data(newData.LVDCAccount);
                                        dataTable.cell(rowIdx, 19).data(newData.HVCNotes);
                                        // ... Repeat for other cells ...


                                        this.invalidate();
                                        // Exit the loop since we found the row to update
                                        return false;
                                    }

                                    return true; // Continue the loop
                                });


                                // Redraw the DataTable
                                dataTable.draw();
                                $('#editModal input').val('');
                                $('#editModal').offcanvas('hide'); // Assuming you want to hide the modal on success

                            },
                            error: function(error) {
                                console.error('Error saving changes:', error);
                            }
                        });
                    });

                });

                // Populate startyear, endyear, and semester dropdowns
                var startyearSelect = $('#startyear');
                var endyearSelect = $('#endyear');
                var semesterSelect = $('#semester');

                var columnsToHide = [20, 21, 22];

                columnsToHide.forEach(function(columnIndex) {
                    table.column(columnIndex).visible(false);
                });


            });


            function customExportAction(e, dt, button, config) {
                var self = this;
                var oldStart = dt.settings()[0]._iDisplayStart;
                dt.one('preXhr', function(e, s, data) {
                    // Just this once, load all data from the server...
                    data.start = 0;
                    data.length = 2147483647;
                    dt.one('preDraw', function(e, settings) {
                        // Call the original action function
                        if (button[0].className.indexOf('buttons-print') >= 0) {
                            $.fn.dataTable.ext.buttons.print.action(e, dt, button, config);
                        }
                        dt.one('preXhr', function(e, s, data) {
                            // DataTables thinks the first item displayed is index 0, but we're not drawing that.
                            // Set the property to what it was before exporting.
                            settings._iDisplayStart = oldStart;
                            data.start = oldStart;
                        });
                        // Reload the grid with the original page. Otherwise, API functions like table.cell(this) don't work properly.
                        setTimeout(dt.ajax.reload, 0);
                        // Prevent rendering of the full data to the DOM
                        return false;
                    });
                });
                // Requery the server with the new one-time export settings
                dt.ajax.reload();
            }


            $.extend(true, $.fn.dataTable.defaults, {
                dom: 'flrtipB',
                buttons: [{
                        extend: 'print',
                        text: '<i class="fas fa-print"></i>',
                        title: 'ON-GOING SCHOLARS MONITORING CHECKLIST {{ session('semester') }} AY {{ session('startyear') }}-{{ session('endyear') }}',
                        exportOptions: {
                            columns: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 12, 13, 14],
                            modifier: {
                                search: 'none'
                            }
                        },
                        action: customExportAction,
                        customize: function(win) {
                            $(win.document.body).find('table td').css({
                                'white-space': 'normal',
                                'word-wrap': 'break-word'
                            });

                            // Remove wrapping style from the 3rd column
                            $(win.document.body).find('table td:nth-child(3)').css({
                                'white-space': 'nowrap',
                                'word-wrap': 'normal'
                            });
                            $(win.document.body).find('table td:nth-child(6)').css({
                                'white-space': 'nowrap',
                                'word-wrap': 'normal'
                            });

                            // Apply wrapping style to all columns except the 3rd column

                            $(win.document.body).find('h1').css('font-size', '50pt'); // Change the font size of the title
                            $(win.document.body).find('h1').css('font-weight', 'bold'); // Make the title bold
                            if (win.document.body.innerHTML.indexOf('<img id="logo"') === -1) {
                                $(win.document.body).prepend('<img id="logo" src="{{ asset('icons/DOSTlogoONGOING.jpg') }}">');
                            }
                            $(win.document.body)
                                .css('font-size', '36pt')
                                .find('td')
                                .css('font-size', '36pt')
                            //.css('border', '1px solid black');
                            //Add borders to the table
                            //$(win.document.body).find('table').css('border', '2px solid black');
                            $(win.document.body).find('table td').css({
                                'border': '2px solid black',
                                'margin': '0.5rem'
                            });
                            //$(win.document.body).find('table th').css({'border': '1px solid black','margin': '10px'});


                            $(win.document.body).find('table td, table th').css({

                                'padding-left': '0.5rem',
                                'padding-right': '0.5rem'
                            });


                            // Customize the header names
                            $(win.document.body).find('table thead th').each(function(index) {
                                var customHeaderName;
                                switch (index) {
                                    case 0:
                                        customHeaderName = 'BATCH';
                                        break;
                                    case 1:
                                        customHeaderName = 'No'; // Change the second column header to 'No'
                                        break;
                                    case 2:
                                        customHeaderName = 'NAME';
                                        break;
                                    case 3:
                                        customHeaderName = 'M/F';
                                        break;
                                    case 4:
                                        customHeaderName = 'SCHOLARSHIP\nPROGRAM';
                                        break;
                                    case 5:
                                        customHeaderName = 'School';
                                        break;
                                    case 6:
                                        customHeaderName = 'Course';
                                        break;
                                    case 7:
                                        customHeaderName = 'Grades';
                                        break;
                                    case 8:
                                        customHeaderName = 'Summer REG';
                                        break;
                                    case 9:
                                        customHeaderName = 'REG FORM';
                                        break;
                                    case 10:
                                        customHeaderName = 'REMARKS';
                                        break;
                                    case 11:
                                        customHeaderName = 'ENDORSEMENT';
                                        break;
                                    case 12:
                                        customHeaderName = 'STATUS';
                                        break;
                                    case 13:
                                        customHeaderName = 'NOTATION';
                                        break;
                                        // Add more cases as needed
                                    default:
                                        customHeaderName = 'Default Header';
                                }
                                $(this).text(customHeaderName);
                                $(this).css({
                                    'font-size': '40pt',
                                    'white-space': 'pre-wrap',
                                    'border': '2px solid black' // Add border to the header
                                });
                            });

                            // Customize the data in the second column (index 1)
                            $(win.document.body).find('table tbody td:nth-child(2)').each(function(index) {
                                // Set the content of each cell in the second column to be the index + 1
                                $(this).text(index + 1);
                            });
                            $(win.document.body).find('table').addClass('compact');
                            $(win.document.body).find('table').removeClass('table-striped');

                        },

                    },
                    {
                        extend: 'excel',
                        text: '<i class="fas fa-file-excel"></i>',
                        title: 'ON-GOING SCHOLARS MONITORING CHECKLIST {{ session('semester') }} AY {{ session('startyear') }}-{{ session('endyear') }}',
                        exportOptions: {
                            columns: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 12, 13, 14],
                            modifier: {
                                search: 'none'
                            }
                        },
                    },
                    {
                        extend: 'csv',
                        text: '<i class="fas fa-file-csv"></i>',
                        title: 'ON-GOING SCHOLARS MONITORING CHECKLIST {{ session('semester') }} AY {{ session('startyear') }}-{{ session('endyear') }}',
                        exportOptions: {
                            columns: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 12, 13, 14],
                            modifier: {
                                search: 'none'
                            }
                        },
                    }
                ]
            });
        </script>

    </body>
    {{-- SIDEBAR TOGGLING --}}

    <!-- Include SweetAlert2 JS -->




</html>
