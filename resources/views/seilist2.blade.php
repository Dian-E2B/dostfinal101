<!DOCTYPE html>
<html lang="en">

<head>
    <title>DOST XI</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="https://code.jquery.com/jquery-3.7.0.js"></script>
    <script src={{ asset('js/dataTables.fixedHeader.min.js') }}></script>
    <style>
        td {
            user-select: none;
           padding: 1px 10px !important;
        }
        thead th{
           padding-right: 5px !important;
           padding-left: 5px !important;

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
            <main class="content" style="padding: 0.5rem 0.5rem 0.5rem; !important;">
                <div class="container-fluid p-0">


                            <div class="card" style="white-space:nowrap; !important;">
                                <div class="card-body">
                                    <table id="thisdatatable" class="table-sm table-striped table-bordered"
                                        style="width:100%; white-space:nowrap; !important;">

                                        <thead>
                                            <tr>
                                                <th>SPAS NO.</th>
                                                <th ><span style="display: none">Strand</span></th>
                                                <th>Program</th>
                                                <th>Firstname</th>
                                                <th>Surname</th>
                                                <th>Email</th>
                                                <th><span style="display: none">Municipality</span></th>
                                                <th>Lacking</th>
                                            </tr>
                                        </thead>

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
                                                    <td style="color: black"> {{ $sei->lacking }}</td>

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


    <script>
        // $('#datatables-column-search-select-inputs').dataTable({
        //     "scrollX": true
        // });
        document.addEventListener("DOMContentLoaded", function() {
            var datatablesMulti = $("#thisdatatable").DataTable({
                //responsive: true,
               scrollX: true,

                fixedColumns: {
                    leftColumns: 3, // Number of columns to freeze on the left
                    rightColumns: 0, // Number of columns to freeze on the right
                },
                initComplete: function() {
                    this.api().columns([1, 6]).every(function(d) {
                        var column = this;
                       var theadname = $("#thisdatatable th").eq([d]).text(); //used this specify table name and head
                        var select = $(
                              "<select style=\"padding: 1px !important; border-width: thin; border-color:#999999; max-width: 300px\" class=\"form-control\"><option value=\"\"> " +
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

        })


    </script>
    <script></script>
</body>

</html>
