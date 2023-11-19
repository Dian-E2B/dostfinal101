<!DOCTYPE html>
<html lang="en">

<head>
    <title>DOST XI</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
 <!-- Include DataTables CSS -->
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



        /* body{
            background-color: rgb(255, 255, 255);
        } */
        .content {
            background-color: white;
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
                <th>Grades2NDSEM20212022</th>
                <th>SummerREG</th>
                <th>REGFORMS1STSEM20222023</th>
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

            </tr>
        </thead>
        <tbody>
            <!-- DataTable content will be dynamically added here -->
        </tbody>
    </table>

                        </div>
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
        pageLength: 20, // Set the default page length to 10 rows
        ajax: '{{ route('datatable.data') }}',  // Adjust this route to your actual route
        columns: [
            { data: 'BATCH', name: 'BATCH' },
            { data: 'NUMBER', name: '' },
            { data: 'NAME', name: 'NAME' },
            { data: 'MF', name: 'MF' },
            { data: 'SCHOLARSHIPPROGRAM', name: 'SCHOLARSHIPPROGRAM' },
            { data: 'SCHOOL', name: 'SCHOOL' },
            { data: 'COURSE', name: 'COURSE' },
            { data: 'GRADES2NDSEM20212022', name: 'GRADES2NDSEM20212022' },
            { data: 'SummerREG', name: 'SummerREG' },
            { data: 'REGFORMS1STSEM20222023', name: 'REGFORMS1STSEM20222023' },
            { data: 'REMARKS', name: 'REMARKS' },
            { data: 'STATUSENDORSEMENT', name: 'STATUSENDORSEMENT' },
            { data: 'STATUSENDORSEMENT2', name: 'STATUSENDORSEMENT2' },
            { data: 'STATUS', name: 'STATUS' },
            { data: 'NOTATIONS', name: 'NOTATIONS' },
            { data: 'SUMMER', name: 'SUMMER' },
            { data: 'FARELEASEDTUITION', name: 'FARELEASEDTUITION' },
            { data: 'FARELEASEDTUITIONBOOKSTIPEND', name: 'FARELEASEDTUITIONBOOKSTIPEND' },
            { data: 'LVDCAccount', name: 'LVDCAccount' },
            { data: 'HVCNotes', name: 'HVCNotes' }

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
scrollX:true,
        order: [
                [0, 'asc'] //set batch sort from lowest
            ],
            // fixedColumns: {
            //     leftColumns: 3,
            // },

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

        drawCallback: function () {


            let start = table.page.info().start;
            let i = start + 1;

            table
                .column(1, { search: 'applied', order: 'applied' })
                .nodes()
                .each(function (cell, index) {
                    cell.innerHTML = i++;
                });
        }
    });
});

    </script>

</body>
{{-- SIDEBAR TOGGLING --}}

<!-- Include SweetAlert2 JS -->




</html>
