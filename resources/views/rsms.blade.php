<!DOCTYPE html>
<html lang="en">

<head>
    <title>DOST XI</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="https://code.jquery.com/jquery-3.7.0.js"></script>
    <link href="{{ asset('css/all.css') }}">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">

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



                <button id="saveButton" style="display: none;">Save</button>
                <div class="container-fluid p-0">


                    <div class="">
                        <div class="">
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
                                            <span style="display: none;">PROGRAM
                                            </span>
                                        </th>
                                        <th style=" ">
                                            <span style="display: none;">SCHOOL
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
                                        <th>ID</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    @foreach ($ongoing1 as $ongoing2)
                                        <tr>

                                            <td style="color: black;">{{ $ongoing2->BATCH }} </td>
                                            <td style="color: black"> </td>
                                            <td style="color: black">{{ $ongoing2->NAME }}</td>
                                            <td style="color: black;padding: 0 15px">{{ $ongoing2->MF }}</td>
                                            <td style="color: black; padding: 0 20px">
                                                {{ $ongoing2->SCHOLARSHIPPROGRAM }}
                                            </td>
                                            <td style="color: black ; padding: 0 15px">{{ $ongoing2->SCHOOL }}</td>
                                            <td style="color: black;">{{ $ongoing2->COURSE }}</td>
                                            <td style="color: black">{{ $ongoing2->GRADES2NDSEM20212022 }}</td>
                                            <td style="color: black">{{ $ongoing2->SummerREG }}</td>
                                            <td style="color: black">{{ $ongoing2->REGFORMS1STSEM20222023 }}</td>
                                            <td style="color: black">{{ $ongoing2->REMARKS }}</td>
                                            <td style="color: black">{{ $ongoing2->STATUSENDORSEMENT }}</td>
                                            <td style="color: black">{{ $ongoing2->STATUSENDORSEMENT2 }}</td>
                                            <td style="color: black">{{ $ongoing2->STATUS }}</td>
                                            <td style="color: black">{{ $ongoing2->NOTATIONS }}</td>
                                            <td style="color: black">{{ $ongoing2->SUMMER }}</td>
                                            <td style="color: black">{{ $ongoing2->FARELEASEDTUITION }}</td>
                                            <td style="color: black">{{ $ongoing2->FARELEASEDTUITIONBOOKSTIPEND }}</td>
                                            <td style="color: black">{{ $ongoing2->LVDCAccount }}</td>

                                            <td style="color: black; text-align: center; ">
                                                <!-- Trigger button -->
                                                <a href="#" class="offcanvas-trigger" data-bs-toggle="offcanvas" data-bs-target="#offcanvasScrolling{{ $ongoing2->NUMBER }}">
                                                    <i class="fad fa-money-check-edit btn-icon"></i>
                                                </a>

                                                <!-- Offcanvas container -->
                                                <div class="offcanvas offcanvas-start" data-bs-scroll="true" data-bs-backdrop="false" tabindex="-1" id="offcanvasScrolling{{ $ongoing2->NUMBER }}">
                                                    <div class="offcanvas-header">
                                                        <h5 class="offcanvas-title" id="offcanvasTitle{{ $ongoing2->NUMBER }}">
                                                            {{ $ongoing2->NAME }}
                                                        </h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                                                    </div>
                                                    <div class="offcanvas-body">
                                                        <!-- Your offcanvas body content here -->
                                                    </div>
                                                </div>


                                            </td>
                                            <td style="color: black">{{ $ongoing2->NUMBER }}</td>
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

<!-- Include SweetAlert2 JS -->


<script src="{{ asset('js/all.js') }}"></script>

<script
    src="https://cdn.datatables.net/v/bs5/dt-1.13.6/b-2.4.2/b-colvis-2.4.2/b-html5-2.4.2/b-print-2.4.2/date-1.5.1/fc-4.3.0/fh-3.4.0/r-2.5.0/sc-2.2.0/sp-2.2.0/sl-1.7.0/datatables.min.js">
</script>
<script>
    $(document).ready(function($) {
        var percentageOfViewport = 55;
        var scrollY = (percentageOfViewport / 100) * $(window).height();
        var table = $('#thisdatatable').DataTable({
            fixedHeader: true,
            "processing": true,
            "pageLength": 50,
            scrollX: true,
            paging: true,
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
            order: [
                [0, 'asc']
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
            }
        });

        table.on('order.dt search.dt', function() {
                let i = 1;

                table
                    .cells(null, 1, {
                        search: 'applied',
                        order: 'applied'
                    })
                    .every(function(cell) {
                        this.data(i++);
                    });
            })
            .draw();
    });
</script>

</html>
