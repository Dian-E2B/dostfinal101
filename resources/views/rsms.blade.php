<!DOCTYPE html>
<html lang="en">

<head>
    <title>DOST XI</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href="https://cdn.datatables.net/v/bs5/dt-1.13.6/b-2.4.2/b-colvis-2.4.2/b-html5-2.4.2/b-print-2.4.2/date-1.5.1/fc-4.3.0/fh-3.4.0/r-2.5.0/sc-2.2.0/sp-2.2.0/sl-1.7.0/datatables.min.css" rel="stylesheet">
</head>

<body data-theme="light" data-layout="fluid" data-sidebar-position="left" data-sidebar-layout="default">
    <div class="wrapper">

        {{-- SIDEBAR START --}}
        @include('layouts.sidebar')
        {{-- SIDEBAR END --}}



        <div class="main">
            @include('layouts.header')

            <main class="content" style="padding:0.5rem 0.5rem 0.5rem">
                <div class="container-fluid p-0">


                    <div class="card">
                        <div class="card-body">
                            <table id="thisdatatable" class="table-striped display compact nowrap" style="width:100%;">

                                <thead>
                                <tr>
                                    <th>BATCH</th>
                                    <th>NO</th>
                                    <th>NAME</th>
                                    <th style=" ">M/F</th>
                                    <th>SCHOLARSHIP PROGRAM</th>
                                    <th style=" ">SCHOOL</th>
                                    <th style="  ">COURSE</th>
                                    <th style=" ">GRADES [2ND] SEM [2021-2022]</th>
                                    <th style=" ">SUMMER REG</th>
                                    <th style="">REG FORMS 1ST SEM 2022-2023</th>
                                    <th style=" ">REMARKS</th>
                                    <th style="  ">STATUS-ENDORSEMENT</th>
                                    <th style=" ">STATUS-ENDORSEMENT2</th>
                                    <th  style=" ">STATUS</th>
                                    <th style="  ">NOTATIONS</th>
                                    <th style=" ">SUMMER</th>
                                    <th style=" ">FA RELEASED</th>
                                    <th style=" ">FA RELEASED+TUITION+BOOK+STIPEND</th>
                                    <th style="">LVDC Account</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach ($rsms1 as $rsms2)
                                    <tr>

                                        <td style="color: black;">{{ $rsms2->BATCH }} </td>
                                        <td style="color: black">{{ $rsms2->NO }}</td>
                                        <td style="color: black">{{ $rsms2->NAME }}</td>
                                        <td style="color: black">{{ $rsms2->MF }}</td>
                                        <td style="color: black">{{ $rsms2->SCHOLARSHIPPROGRAM}}</td>
                                        <td style="color: black">{{ $rsms2->SCHOOL}}</td>
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
</body>
{{-- SIDEBAR TOGGLING --}}
<script src="https://code.jquery.com/jquery-3.7.0.js"></script>
<script src="https://cdn.datatables.net/v/bs5/dt-1.13.6/b-2.4.2/b-colvis-2.4.2/b-html5-2.4.2/b-print-2.4.2/date-1.5.1/fc-4.3.0/fh-3.4.0/r-2.5.0/sc-2.2.0/sp-2.2.0/sl-1.7.0/datatables.min.js"></script>
<script>
    jQuery(document).ready(function ($) {
        var percentageOfViewport = 65;
        var scrollY = (percentageOfViewport / 100) * $(window).height();
        $('#thisdatatable').DataTable({

            scrollX: true,
            paging: false,
            scrollCollapse: true,
            scrollY: scrollY + 'px',
            columnDefs: [
                {targets: [3, 5], orderable: false} // Disable sorting for the first and third columns (columns are zero-based)
            ],
            fixedColumns: {
                leftColumns: 3, // Specify the number of left columns to freeze
                //  rightColumns: 1 // Specify the number of right columns to freeze
            },
            initComplete: function () {
                this.api().columns([3, 5]).every(function (d) {
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
