<!DOCTYPE html>
<html lang="en">

<head>
    <title>DOST XI</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href="{{ asset('css/all.css') }}">
    <link
        href="https://cdn.datatables.net/v/bs5/dt-1.13.6/b-2.4.2/b-colvis-2.4.2/b-html5-2.4.2/b-print-2.4.2/date-1.5.1/fc-4.3.0/fh-3.4.0/r-2.5.0/sc-2.2.0/sp-2.2.0/sl-1.7.0/datatables.min.css"
        rel="stylesheet">
    <style>
        td {
            user-select: none;
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



    </style>
</head>

<body data-theme="light" data-layout="fluid" data-sidebar-position="left" data-sidebar-layout="default">
<div class="wrapper">

    {{-- SIDEBAR START --}}
    @include('layouts.sidebar')
    {{-- SIDEBAR END --}}


    <div class="main">
        @include('layouts.header')

        <main class="content" style="padding:0.5rem 0.5rem 0.5rem">
            <button id="saveButton" style="display: none;">Save</button>
            <div class="container-fluid p-0">


                <div class="card">
                    <div class="card-body">
                        <table id="thisdatatable" class="table-striped compact nowrap" style="width:100%;">

                            <thead>
                            <tr>
                                <th>BATCH</th>
                                <th>NO</th>
                                <th>NAME</th>
                                <th style=" ">
                                    <span style="display: none;">M/F</span>
                                </th>
                                <th>
                                    <span
                                        style="display: none;">PROGRAM
                                        </span>
                                </th>
                                <th style=" ">
                                        <span
                                            style="display: none;">SCHOOL
                                        </span>
                                </th>
                                <th style="  ">COURSE</th>
                                <th style=" ">GRADES [2ND] SEM [2021-2022]</th>
                                <th style=" ">SUMMER REG</th>
                                <th style="">REG FORMS 1ST SEM 2022-2023</th>
                                <th style=" ">REMARKS</th>
                                <th style="  ">STATUS-ENDORSEMENT</th>
                                <th style=" ">STATUS-ENDORSEMENT2</th>
                                <th style=" ">STATUS</th>
                                <th style="  ">NOTATIONS</th>
                                <th style=" ">SUMMER</th>
                                <th style=" ">FA RELEASED</th>
                                <th style=" ">FA RELEASED+TUITION+BOOK+STIPEND</th>
                                <th style="">LVDC Account</th>
                                <th style="">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($rsms1 as $rsms2)
                                <tr>

                                    <td style="color: black;">{{ $rsms2->BATCH }} </td>
                                    <td style="color: black">{{ $rsms2->NO }}</td>
                                    <td style="color: black">{{ $rsms2->NAME }}</td>
                                    <td style="color: black;padding: 0 15px">{{ $rsms2->MF }}</td>
                                    <td style="color: black; padding: 0 20px">{{ $rsms2->SCHOLARSHIPPROGRAM}}</td>
                                    <td style="color: black ; padding: 0 15px">{{ $rsms2->SCHOOL}}</td>
                                    <td style="color: black;">{{ $rsms2->COURSE}}</td>
                                    <td style="color: black">{{ $rsms2->GRADES2NDSEM20212022}}</td>
                                    <td style="color: black">{{ $rsms2->SummerREG}}</td>
                                    <td style="color: black">{{ $rsms2->REGFORMS1STSEM20222023}}</td>
                                    <td style="color: black">{{ $rsms2->REMARKS}}</td>
                                    <td style="color: black">{{ $rsms2->STATUSENDORSEMENT}}</td>
                                    <td style="color: black">{{ $rsms2->STATUSENDORSEMENT2}}</td>
                                    <td style="color: black">{{ $rsms2->STATUS}}</td>
                                    <td style="color: black">{{ $rsms2->NOTATIONS}}</td>
                                    <td style="color: black">{{ $rsms2->SUMMER}}</td>
                                    <td style="color: black">{{ $rsms2->FARELEASEDTUITION}}</td>
                                    <td style="color: black">{{ $rsms2->FARELEASEDTUITIONBOOKSTIPEND}}</td>
                                    <td style="color: black">{{ $rsms2->LVDCAccount}}</td>
                                    <td style="color: black; text-align: center; ">

                                        <!-- Button trigger modal -->
                                        <a data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                                            Launch static backdrop modal
                                        </a>

                                        <!-- Modal -->
                                        <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static"
                                             data-bs-keyboard="false" tabindex="-1"
                                             aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h1 class="modal-title fs-5" id="staticBackdropLabel">Modal
                                                            title</h1>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                                aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        ...
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                                data-bs-dismiss="modal">Close
                                                        </button>
                                                        <button type="button" class="btn btn-primary">Understood
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>


                                    </td>
                                </tr>
                            @endforeach
                            </tbody>

                        </table>

                    </div>
                </div>


            </div>
        </main>

    </div>
</div>
<!-- END primary modal -->
</body>
{{-- SIDEBAR TOGGLING --}}
<script src="https://code.jquery.com/jquery-3.7.0.js"></script>
<script src="{{ asset('js/all.js') }}"></script>
<script
    src="https://cdn.datatables.net/v/bs5/dt-1.13.6/b-2.4.2/b-colvis-2.4.2/b-html5-2.4.2/b-print-2.4.2/date-1.5.1/fc-4.3.0/fh-3.4.0/r-2.5.0/sc-2.2.0/sp-2.2.0/sl-1.7.0/datatables.min.js"></script>
<script>

    jQuery(document).ready(function ($) {
        var percentageOfViewport = 55;
        var scrollY = (percentageOfViewport / 100) * $(window).height();
        $('#thisdatatable').DataTable({
            "processing": true,
            "pageLength": 100, // Set the default number of entries
            scrollX: true,
            paging: true,
            scrollY: scrollY + 'px',
            columnDefs: [
                {targets: [3, 5, 19,4], orderable: false, type: "string"} // Disable sorting for the first and third columns (columns are zero-based)
            ],
            fixedColumns: {
                leftColumns: 3, // Specify the number of left columns to freeze
                //  rightColumns: 1 // Specify the number of right columns to freeze
            },
            initComplete: function () {
                this.api().columns([3, 5,4]).every(function (d) {
                    var column = this;
                    var theadname = $("#thisdatatable th").eq([d]).text(); //used this specify table name and head
                    var select = $(
                        "<select style=\"padding: 1px !important;\" class=\"form-control\"><option value=\"\"> " + theadname + " </option></select>"
                    )
                        .appendTo($(column.header()))
                        .on("change", function () {
                            var val = $.fn.dataTable.util.escapeRegex(
                                $(this).val()
                            );
                            column
                                .search(val ? "^" + val + "$" : "", true, false)
                                .draw();
                        });
                    column.data().unique().sort().each(function (d, j) {
                        select.append("<option value=\"" + d + "\">" + d +
                            "</option>")
                    });
                });
            }

        });
    });
</script>

</html>
