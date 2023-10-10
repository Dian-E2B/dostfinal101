<!DOCTYPE html>
<html lang="en">

<head>
	 <title>DOST XI</title>
	 @vite(['resources/css/app.css', 'resources/js/app.js'])
	 <link href="https://cdn.datatables.net/v/bs5/jszip-3.10.1/dt-1.13.6/b-2.4.2/b-html5-2.4.2/b-print-2.4.2/date-1.5.1/fc-4.3.0/fh-3.4.0/r-2.5.0/sc-2.2.0/sp-2.2.0/sl-1.7.0/datatables.min.css"
				 rel="stylesheet">
	 <style>
       td {
           user-select: none;
       }

       th {
           padding-left: 8px;
           padding-right:8px;
           border-bottom-width: thin;
           border-collapse: separate;

       }

       table td {
           padding-left: 8px;
           padding-right:8px;
           border-bottom-width: thin;
           border-right-width: thin;
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


						<div class="card">
							 <div class="card-body">
									<table id="thisdatatable" class="table-striped display compact nowrap" style="width:100%;">

										 <thead>
										 <tr>
												<th>SPAS NO.</th>
												<th>Fullname</th>
												<th>Email</th>
												<th style="padding-left: 0 !important; padding-right: 0 !important; "><span
																 style="display: none">- Strand -</span></th>

												<th>Program</th>

												<th style="  padding-left: 0 !important; padding-right: 0 !important;"><span
																 style="display: none; ">- Municipality -</span></th>
												<th>Lacking</th>
										 </tr>
										 </thead>

										 <tbody>
										 @foreach ($seis as $sei)
												<tr>

													 <td style="color: black;">
															{{ $sei->spasno }}</td>
													 @foreach ($sei->scholars as $scholar)
															<td  style="color: black;">{{ $scholar->lname }}
																 , {{ $scholar->fname }} {{ $scholar->mname }} </td>
															<td style="color: black">{{ $scholar->email }}</td>
													 @endforeach
													 <td style="color: black">{{ $sei->strand }}</td>
													 <td style="color: black">{{ $sei->program->progname }}</td>

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
<script src="https://code.jquery.com/jquery-3.7.0.js"></script>
<script src="https://cdn.datatables.net/v/bs5/jszip-3.10.1/dt-1.13.6/b-2.4.2/b-html5-2.4.2/b-print-2.4.2/date-1.5.1/fc-4.3.0/fh-3.4.0/r-2.5.0/sc-2.2.0/sp-2.2.0/sl-1.7.0/datatables.min.js"></script>

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
                leftColumns: 2, // Specify the number of left columns to freeze
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

</body>

</html>
