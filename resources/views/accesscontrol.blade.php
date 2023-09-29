<!DOCTYPE html>
<html lang="en">

<head>
	 <title>DOST XI</title>
	 <link href="{{ asset('css/all.css') }}">
	 @vite(['resources/sass/app.scss', 'resources/js/app.js'])
<style>

</style>
</head>

<body data-theme="default" data-layout="fluid" data-sidebar-position="left" data-sidebar-layout="default">
<div class="wrapper">

	 {{-- SIDEBAR START --}}
	 @include('layouts.sidebar')
	 {{-- SIDEBAR END --}}



	 <div class="main">
			@include('layouts.header')

			<main class="main">
				 <div class="container-fluid p-1">


						<div class="col-12">


							 <div class="card">

									<div style="margin-bottom: -10px;" class="card-header">
										 <div class="row">
												<div class="col-8">
													 <h5 class="card-title">Scholars</h5>
													 <h6 class="card-subtitle text-muted">All scholars that have access to the system after accepting notice of awards.
													 </h6>
												</div>

												<div class="col-4">
													 <label for="searchInput"></label><input  style="max-width: 300px; margin-right: 20px; margin-left: auto"  id="searchInput" class="form-control mb-3" type="text" placeholder="Search Filter">
												</div>

										 </div>

									</div>
									<table id="AllTable" style="margin-bottom: 1rem !important;" class="table table-striped table-sm">
										 <thead>
										 <tr>
												<th>ID</th>
												<th>Fullname</th>
												<th class="d-none d-md-table-cell">Email</th>
												<th class="d-none d-md-table-cell">Status</th>
												<th>Action</th>
										 </tr>
										 </thead>
										 <tbody>


									@if(request()->is('accesscontrol'))
												<tbody>
												@foreach($replyslipsjoinscholar as $replyslipsjoinscholar1)
												<tr>

															<td>{{ $replyslipsjoinscholar1->id }}</td>
															<td>{{ $replyslipsjoinscholar1->lname }}, {{ $replyslipsjoinscholar1->fname }} {{ $replyslipsjoinscholar1->mname }} </td>
															<td class="">{{ $replyslipsjoinscholar1->email }}</td>

															@if ($replyslipsjoinscholar1->scholar_status_id == 1) {{--Pending--}}
																<td style="color:blue"> <strong>{{ $replyslipsjoinscholar1->status_name }}</strong></td>
															@elseif ($replyslipsjoinscholar1->scholar_status_id == 2) {{--Ongoing--}}
																 <td style="color:deepskyblue"><strong>{{ $replyslipsjoinscholar1->status_name }}</strong></td>
															@elseif ($replyslipsjoinscholar1->scholar_status_id == 3) {{--Enrolled--}}
																 <td style="color:green"><strong>{{ $replyslipsjoinscholar1->status_name }}</strong></td>
															@elseif ($replyslipsjoinscholar1->scholar_status_id == 4) {{--Deferred--}}
																 <td style="color:orange"><strong>{{ $replyslipsjoinscholar1->status_name }}</strong></td>
															@elseif ($replyslipsjoinscholar1->scholar_status_id == 5) {{--LOA--}}
																 <td style="color:red"><strong>{{ $replyslipsjoinscholar1->status_name }}</strong></td>
															@elseif ($replyslipsjoinscholar1->scholar_status_id == 6) {{--Terminate--}}
																 <td style="color:black"><strong>{{ $replyslipsjoinscholar1->status_name }}</strong></td>

															@endif

															<td class="table-action">
																 <a href="#" style="color: black;" data-bs-toggle="tooltip" data-bs-placement="top" title="Temporary lock account	"><i class="fad fa-user-lock"></i></a>
																 <a style="color: red; margin-left: 8px;"  href="#" data-bs-toggle="tooltip" data-bs-placement="top" title="Permanently delete account	"><i class="fas fa-trash"></i></a>
															</td>

													 @endforeach
												</tr>
												</tbody>

									@elseif(request()->is('accesscontrolpending'))
												<tbody>

												@foreach($replyslipsjoinscholarpending as $replyslipsjoinscholarpending1)
													 <tr>

													 <td>{{ $replyslipsjoinscholarpending1->id }}</td>
													 <td>{{ $replyslipsjoinscholarpending1->lname }}, {{ $replyslipsjoinscholarpending1->fname }} {{ $replyslipsjoinscholarpending1->mname }} </td>
													 <td class="">{{ $replyslipsjoinscholarpending1->email }}</td>
													 <td style="color:blue"><strong>{{ $replyslipsjoinscholarpending1->status_name }}</strong></td>
													 <td class="table-action">
															<a href="#" style="color: black;" data-bs-toggle="tooltip" data-bs-placement="top" title="Temporary lock account	"><i class="fad fa-user-lock"></i></a>
															<a style="color: red; margin-left: 8px;"  href="#" data-bs-toggle="tooltip" data-bs-placement="top" title="Permanently delete account	"><i class="fas fa-trash"></i></a>
													 </td>

										 </tr>

												@endforeach
												</tbody>
									@elseif(request()->is('accesscontrolongoing'))
												<tbody>
										 <tr>
												@foreach($replyslipsjoinscholarongoing as $replyslipsjoinscholarongoing1)
													 <td>{{ $replyslipsjoinscholarongoing1->id }}</td>
													 <td>{{ $replyslipsjoinscholarongoing1->lname }}, {{ $replyslipsjoinscholarongoing1->fname }} {{ $replyslipsjoinscholarongoing1->mname }} </td>
													 <td class="">{{ $replyslipsjoinscholarongoing1->email }}</td>
													 <td style="color:deepskyblue"><strong>{{ $replyslipsjoinscholarongoing1->status_name }}</strong></td>
													 <td class="table-action">
															<a href="#" style="color: black;" data-bs-toggle="tooltip" data-bs-placement="top" title="Temporary lock account	"><i class="fad fa-user-lock"></i></a>
															<a style="color: red; margin-left: 8px;"  href="#" data-bs-toggle="tooltip" data-bs-placement="top" title="Permanently delete account	"><i class="fas fa-trash"></i></a>
													 </td>
												@endforeach
										 </tr>
												</tbody>
									@elseif(request()->is('accesscontrolenrolled'))
												<tbody>
										 <tr>
												@foreach($replyslipsjoinscholarenrolled as $replyslipsjoinscholarenrolled1)
													 <td>{{ $replyslipsjoinscholarenrolled1->id }}</td>
													 <td>{{ $replyslipsjoinscholarenrolled1->lname }}, {{ $replyslipsjoinscholarongoing1->fname }} {{ $replyslipsjoinscholarenrolled1->mname }} </td>
													 <td class="">{{ $replyslipsjoinscholarenrolled1->email }}</td>
													 <td style="color:green"><strong>{{ $replyslipsjoinscholarenrolled1->status_name }}</strong></td>
													 <td class="table-action">
															<a href="#" style="color: black;" data-bs-toggle="tooltip" data-bs-placement="top" title="Temporary lock account	"><i class="fad fa-user-lock"></i></a>
															<a style="color: red; margin-left: 8px;"  href="#" data-bs-toggle="tooltip" data-bs-placement="top" title="Permanently delete account	"><i class="fas fa-trash"></i></a>
													 </td>
												@endforeach
										 </tr>
												</tbody>
									@elseif(request()->is('replyslipsjoinscholardeferred'))


												@foreach($replyslipsjoinscholardeferred as $replyslipsjoinscholardeferred1)
													 <tr>
													 <td>{{ $replyslipsjoinscholardeferred1->id }}</td>
													 <td>{{ $replyslipsjoinscholardeferred1->lname }}, {{ $replyslipsjoinscholardeferred1->fname }} {{ $replyslipsjoinscholardeferred1->mname }} </td>
													 <td class="">{{ $replyslipsjoinscholardeferred1->email }}</td>
													 <td style="color:green"><strong>{{ $replyslipsjoinscholardeferred1->status_name }}</strong></td>
													 <td class="table-action">
															<a href="#" style="color: black;" data-bs-toggle="tooltip" data-bs-placement="top" title="Temporary lock account	"><i class="fad fa-user-lock"></i></a>
															<a style="color: red; margin-left: 8px;"  href="#" data-bs-toggle="tooltip" data-bs-placement="top" title="Permanently delete account	"><i class="fas fa-trash"></i></a>
													 </td>
													 </tr>
												@endforeach

												</tbody>
									@elseif(request()->is('replyslipsjoinscholarLOA'))
															<tbody>

												@foreach($replyslipsjoinscholarLOA as $replyslipsjoinscholarLOA1)
													 <tr>
													 <td>{{ $replyslipsjoinscholarLOA1->id }}</td>
													 <td>{{ $replyslipsjoinscholarLOA1->lname }}, {{ $replyslipsjoinscholarLOA1->fname }} {{ $replyslipsjoinscholarLOA1->mname }} </td>
													 <td class="">{{ $replyslipsjoinscholarLOA1->email }}</td>
													 <td style="color:green"><strong>{{ $replyslipsjoinscholarLOA1->status_name }}</strong></td>
													 <td class="table-action">
															<a href="#" style="color: black;" data-bs-toggle="tooltip" data-bs-placement="top" title="Temporary lock account	"><i class="fad fa-user-lock"></i></a>
															<a style="color: red; margin-left: 8px;"  href="#" data-bs-toggle="tooltip" data-bs-placement="top" title="Permanently delete account	"><i class="fas fa-trash"></i></a>
													 </td>
													 </tr>
												@endforeach

															</tbody>
									@elseif(request()->is('replyslipsjoinscholarterminated'))
															<tbody>
										 <tr>
												@foreach($replyslipsjoinscholarterminated as $replyslipsjoinscholarterminated1)
													 <td>{{ $replyslipsjoinscholarterminated1->id }}</td>
													 <td>{{ $replyslipsjoinscholarterminated1->lname }}, {{ $replyslipsjoinscholarterminated1->fname }} {{ $replyslipsjoinscholarterminated1->mname }} </td>
													 <td class="">{{ $replyslipsjoinscholarterminated1->email }}</td>
													 <td style="color:green"><strong>{{ $replyslipsjoinscholarterminated1->status_name }}</strong></td>
													 <td class="table-action">
															<a href="#" style="color: black;" data-bs-toggle="tooltip" data-bs-placement="top" title="Temporary lock account	"><i class="fad fa-user-lock"></i></a>
															<a style="color: red; margin-left: 8px;"  href="#" data-bs-toggle="tooltip" data-bs-placement="top" title="Permanently delete account	"><i class="fas fa-trash"></i></a>
													 </td>
										 </tr>
												@endforeach


												</tbody>

									@else

									@endif





							 </div>
						</div>



				 </div>
			</main>
	 </div>
</div>
</body>
<script src="{{ asset('js/all.js') }}"></script>
<script src="https://code.jquery.com/jquery-3.7.0.js"></script>
<script>
    document.addEventListener("DOMContentLoaded", function () {
        // Your JavaScript code here

        // Get references to the input field and table
        const searchInput = document.getElementById("searchInput");
        const table = document.getElementById("AllTable");
        const rows = table.querySelectorAll("tbody tr");

        // Add an event listener to the search input
        searchInput.addEventListener("input", function () {
            const searchValue = this.value.toLowerCase();

            rows.forEach((row) => {
                const columns = row.querySelectorAll("td");
                let rowMatchesSearch = false;

                columns.forEach((column) => {
                    if (column.textContent.toLowerCase().includes(searchValue)) {
                        rowMatchesSearch = true;
                    }
                });

                // Toggle the row's visibility based on search results
                if (rowMatchesSearch) {
                    row.style.display = "";
                } else {
                    row.style.display = "none";
                }
            });
        });
    });
</script>
</html>
