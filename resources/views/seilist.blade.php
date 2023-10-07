<!DOCTYPE html>
<html lang="en">

<head>
    <title>DOST XI</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        td {
            user-select: none;
            padding: 1px !important;
        }
        tfoot {
           display: table-header-group;
        }
        th{
            padding: 1px !important;
        }
        #thisdatatable.dataTable tbody td {
            white-space: nowrap;
        }
    </style>
</head>

<body data-theme="light" data-layout="fluid" data-sidebar-position="left" data-sidebar-layout="default">
    <div class="wrapper">

        {{-- SIDEBAR START --}}
        @include('layouts.sidebar')



        <div class="main">
            @include('layouts.header')

            @error('excel_file')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
            <main class="content" style="padding:0.5rem 0.5rem 0.5rem; !important;">
                <div class="container-fluid p-0">


                            <div class="card" style="white-space:nowrap; !important;">
                                <div class="card-body">
                                    <table id="thisdatatable" class="table-sm table-striped"
                                        style="width:100%; white-space:nowrap; !important;">

                                        <thead>
                                            <tr>
                                                <th>SPAS NO.</th>
                                                <th>Strand</th>
                                                <th>Program</th>
                                                <th>Firstname</th>
                                                <th>Surname</th>
                                                <th>Email</th>
                                                <th>Municipality</th>
                                               
                                            </tr>
                                        </thead>
                                       <tfoot >
                                       <tr>

                                          <th></th>
                                          <th></th>
                                          <th></th>
                                          <th></th>
                                          <th></th>
                                          <th></th>
                                          <th></th>


                                       </tr>
                                       </tfoot>
                                        <tbody style="white-space: nowrap !important;">
                                            @foreach ($seis as $sei)
                                                <tr>

                                                    <td style="color: black;">
                                                        {{ $sei->spasno }}</td>
                                                    <td style="color: black">{{ $sei->strand }}</td>
                                                    <td style="color: black">{{ $sei->program->progname }}</td>
                                                    @foreach ($sei->scholars as $scholar)
                                                        <td style="color: black">{{ $scholar->fname }}</td>
                                                        <td style="color: black">{{ $scholar->lname }}</td>
                                                        <td style="color: black">{{ $scholar->email }}</td>
                                                    @endforeach
                                                    <td style="color: black"> {{ $sei->municipality }}</td>
                                                   

                                                </tr>
                                            @endforeach
                                        </tbody>

                                    </table>
                                </div>
                            </div>

                </div>
                <button style="display: none" id="getEmailsButton">Get Selected Emails</button>
            </main>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.7.0.js"></script>
{{--    <script>--}}
{{--        // $('#datatables-column-search-select-inputs').dataTable({--}}
{{--        //     "scrollX": true--}}
{{--        // });--}}
{{--        document.addEventListener("DOMContentLoaded", function() {--}}
{{--            var table = $("#thisdatatable").DataTable({--}}

{{--                responsive: true,--}}

{{--                initComplete: function() {--}}
{{--                    this.api().columns([1, 6]).every(function() {--}}
{{--                        var column = this;--}}
{{--                        var select = $(--}}
{{--                                "<select style=\"padding: 1px !important;\" class=\"form-control\"><option value=\"\"></option></select>"--}}
{{--                            )--}}
{{--                            .appendTo($(column.footer()).empty())--}}
{{--                            .on("change", function() {--}}
{{--                                var val = $.fn.dataTable.util.escapeRegex(--}}
{{--                                    $(this).val()--}}
{{--                                );--}}
{{--                                column--}}
{{--                                    .search(val ? "^" + val + "$" : "", true, false)--}}
{{--                                    .draw();--}}
{{--                            });--}}
{{--                        column.data().unique().sort().each(function(d, j) {--}}
{{--                            select.append("<option value=\"" + d + "\">" + d +--}}
{{--                                "</option>")--}}
{{--                        });--}}
{{--                    });--}}
{{--                }--}}
{{--            });--}}

{{--        })--}}
{{--    </script>--}}
    <script></script>
</body>

</html>
