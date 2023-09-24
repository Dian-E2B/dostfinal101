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
												<th>Action</th>
										 </tr>
										 </thead>
										 <tbody>

										 <tr>
												@foreach($replyslipsjoinscholar as $replyslipsjoinscholar1)
													 <td>{{ $replyslipsjoinscholar1->id }}</td>
													 <td>{{ $replyslipsjoinscholar1->lname }}, {{ $replyslipsjoinscholar1->fname }} {{ $replyslipsjoinscholar1->mname }} </td>
													 <td class="">{{ $replyslipsjoinscholar1->email }}</td>
													 <td class="table-action">
															<a href="#" style="color: black;" data-bs-toggle="tooltip" data-bs-placement="top" title="Temporary lock account	"><i class="fad fa-user-lock"></i></a>
															<a style="color: red; margin-left: 8px;"  href="#" data-bs-toggle="tooltip" data-bs-placement="top" title="Permanently delete account	"><i class="fas fa-trash"></i></a>
													 </td>

												@endforeach
										 </tr>

										 </tbody>
									</table>

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
