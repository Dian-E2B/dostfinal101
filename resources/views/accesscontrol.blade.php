<!DOCTYPE html>
<html lang="en">

<head>
	 <title>DOST XI</title>
	 @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>

<body data-theme="default" data-layout="fluid" data-sidebar-position="left" data-sidebar-layout="default">
<div class="wrapper">

	 {{-- SIDEBAR START --}}
	 @include('layouts.sidebar')
	 {{-- SIDEBAR END --}}



	 <div class="main">
			@include('layouts.header')

			<main class="">
				 <div class="container-fluid p-1">


						<div class="col-12">
							 <div class="card">
									<div style="margin-bottom: -10px;"class="card-header">
										 <h5 class="card-title">Scholars</h5>
										 <h6 class="card-subtitle text-muted">All scholars that have access to the system after accepting notice of awards.
										 </h6>
									</div>
									<table class="table table-striped table-sm">
										 <thead>
										 <tr>
												<th>Fullname</th>
												<th class="text-end">Email</th>
												<th class="text-end">Share</th>
										 </tr>
										 </thead>
										 <tbody>
										 <tr>
												@foreach($replyslipsjoinscholar as $replyslipsjoinscholar1)
													 <td>{{ $replyslipsjoinscholar1->lname }}, {{ $replyslipsjoinscholar1->fname }} {{ $replyslipsjoinscholar1->mname }} </td>
													 <td class="text-end">{{ $replyslipsjoinscholar1->email }}</td>
													 <td class="text-end">40%</td>
												@endforeach

										 </tr>
										 <tr>
												<td>Mac OS</td>
												<td class="text-end">3.322</td>
												<td class="text-end">20%</td>
										 </tr>
										 <tr>
												<td>Linux</td>
												<td class="text-end">4.232</td>
												<td class="text-end">34%</td>
										 </tr>
										 <tr>
												<td>FreeBSD</td>
												<td class="text-end">1.121</td>
												<td class="text-end">12%</td>
										 </tr>
										 <tr>
												<td>Chrome OS</td>
												<td class="text-end">1.331</td>
												<td class="text-end">15%</td>
										 </tr>
										 <tr>
												<td>Android</td>
												<td class="text-end">2.301</td>
												<td class="text-end">20%</td>
										 </tr>
										 <tr>
												<td>iOS</td>
												<td class="text-end">1.162</td>
												<td class="text-end">14%</td>
										 </tr>
										 <tr>
												<td>Windows Phone</td>
												<td class="text-end">562</td>
												<td class="text-end">7%</td>
										 </tr>
										 <tr>
												<td>Other</td>
												<td class="text-end">1.181</td>
												<td class="text-end">14%</td>
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
{{-- SIDEBAR TOGGLING --}}
<script></script>

</html>
