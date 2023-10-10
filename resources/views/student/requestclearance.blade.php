<!DOCTYPE html>
<html lang="en">

<head>
	 <title>DOST XI</title>
	 @vite(['resources/css/app.css', 'resources/js/app.js'])
	 <style>
       .noborder-bottom {
           border-bottom: none !important;
           border-top: none !important;
           border-right-width: medium !important;

           border-left-width: medium;

       }

       .input-group-textmod {


           color: #495057;
           display: flex;
           font-size: .875rem;
           font-weight: 400;
           line-height: 1.5;
           padding: 0.3rem 0.5rem;
           text-align: left;
           white-space: nowrap;
       }

       .styled-hr {
           border: none;
           height: 2px; /* Adjust the line height as needed */
           background-color: #000000; /* Use a darker color (e.g., #333) */
           margin: 10px 0; /* Adjust the margin for spacing */
       }

       /*.borderright {*/
       /*    border-right-width: medium !important;*/
       /*}*/

       .changebordercolor {
           border-left-width: medium;


           border-bottom-color: black !important;
           border-right-width: medium !important;
       }

       .form-check-input {
           border: solid #4c4c4c !important;
       }

       .noborderinput {
           width: 100%;
           height: 100%;
           border: none; /* Remove input border */
           padding: 0; /* Remove any padding */
           white-space: pre-line; /* Allow text to wrap like in a <textarea> */
           line-height: 1.5; /* Adjust line height for better readability */
       }


       .tabletd2 {
           max-width: 200px !important;
       }

       .tabletd2:focus {
           background-color: #fff;
           border-color: #9dbeee !important;
           box-shadow: 0 0 0 .25rem rgba(59, 125, 221, .25);
           color: #495057;
           outline: 0;
       }

       th {
           text-align: center;
           vertical-align: center;
       }
	 </style>
</head>

<body data-theme="light" data-layout="fluid" data-sidebar-position="left" data-sidebar-layout="default">


<div class="wrapper">


	 <div class="main">
			{{--HEADER START--}}
			@include('student.layoutsst.header')
			{{--HEADER END--}}

			<main class="content">
				 <div class="container-fluid p-0">

						<h1 class="h3 mb-3">REQUEST FOR SCHOLARSHIP CLEARANCE</h1>


						<div class="col-xxl-12">
							 <div style="padding-right: 20px; padding-left: 20px;" class="card">
									<form>
										 @csrf
										 <div class="table-responsive">
												<table class="table table-based">
													 <thead>

													 <tr style="">
															<th style="">Please check the needed documents</th>
															<th style="">Requirements</th>
													 </tr>
													 </thead>
													 <tbody>
													 <tr>
															<td class="noborder-bottom">For NBI – Clearance for local employment</td>
															<td class="changebordercolor borderright"><label class="form-check  ">
																		<input class="form-check-input" type="checkbox" value="">
																		<span class="form-check-label ">Transcript of Records or True Copy of Grades or diploma for scholar-graduate; or</span>
																 </label></td>
													 </tr>
													 <tr>
															<td class="noborder-bottom"></td>
															<td class="changebordercolor"><label class="form-check">
																		<input class="form-check-input" type="checkbox" value="">
																		<span class="form-check-label">Registration form for OJT/SIT certification from school for on-going scholar</span>
																 </label></td>
													 </tr>
													 <tr>
															<td style="border-right-width: medium;" class="changebordercolor"></td>
															<td class="changebordercolor"><label class="form-check">
																		<input class="form-check-input" type="checkbox" value="">
																		<span class="form-check-label">Transcript of Records or True Copy of Grades for NON-Compliance scholar</span>
																 </label></td>
													 </tr>
													 {{--END FIRST SECTION--}}
													 <tr>
															<td style="border-right-width: medium;" class="noborder-bottom"> For NBI – Clearance for
																 application for passport
															</td>
															<td class="changebordercolor"><label class="form-check">
																		<input class="form-check-input" type="checkbox" value="">
																		<span class="form-check-label"> Guaranty letter or</span>
																 </label></td>
													 </tr>
													 <tr>
															<td style="border-right-width: medium;" class="noborder-bottom">For DFA – Passport</td>
															<td class="changebordercolor"><label class="form-check">
																		<input class="form-check-input" type="checkbox" value="">
																		<span class="form-check-label"> Deed of Undertaking* or</span>
																 </label></td>
													 </tr>
													 <tr>
															<td style="border-right-width: medium;" class="noborder-bottom">For BI – Travel Order</td>
															<td class="changebordercolor"><label class="form-check">
																		<input class="form-check-input" type="checkbox" value="">
																		<span class="form-check-label">  Official Receipt of cash bond posted or</span>
																 </label></td>
													 </tr>
													 <tr>
															<td style="border-right-width: medium;" class="changebordercolor"></td>
															<td class="changebordercolor"><label class="form-check">
																		<input class="form-check-input" type="checkbox" value="">
																		<span class="form-check-label">  Original copy of GSIS Surety Bond* Photocopy of I.D. and ITR or Certificate of Employment of co-maker</span>
																 </label></td>
													 </tr>
													 {{--END SECOND SECTION--}}
													 <tr>
															<td style="border-right-width: medium;" class="noborder-bottom">Final clearance</td>
															<td class="changebordercolor"><label class="form-check">
																		<input class="form-check-input" type="checkbox" value="">
																		<span class="form-check-label"> Certificate/s of Employment/Service Record or</span>
																 </label></td>
													 </tr>
													 <tr>
															<td style="border-right-width: medium; " class="changebordercolor"></td>
															<td class="changebordercolor"><label class="form-check">
																		<input class="form-check-input" type="checkbox" value="">
																		<span class="form-check-label"> Official Receipt of refund of scholarship benefits received</span>
																 </label></td>
													 </tr>
													 {{--										 END THIRD SECTION--}}
													 <tr>
															<td style="border-right-width: medium;" class="noborder-bottom">Computation of scholarship
																 benefits received
															</td>
															<td class="changebordercolor"><label class="form-check">
																		<input class="form-check-input" type="checkbox" value="">
																		<span class="form-check-label"> Transcript of Records or True Copy of Grades and/or</span>
																 </label></td>
													 </tr>
													 <tr>
															<td style="border-right-width: medium;" class="changebordercolor"></td>
															<td class="changebordercolor"><label class="form-check">
																		<input class="form-check-input" type="checkbox" value="">
																		<span class="form-check-label"> Certificate of Employment</span>
																 </label></td>
													 </tr>
													 {{--END FOURTH SECTION--}}
													 <tr>
															<td style="border-right-width: medium; " class="changebordercolor">Others (Please specify)
															</td>
															<td class="changebordercolor"></td>
													 </tr>
													 <!-- END FIFTH SECTION-->
													 </tbody>

												</table>
										 </div>
										 <label>Purpose:
												<textarea cols="100" class="form-control"></textarea>
										 </label>

										 <div class="row">
												<div class="col-md-6">
													 <p style="margin-top: 20px;">Requested By:</p>

													 <div>
															<div class="input-group mb-1">
																 <label class="input-group-textmod" for="inputGroupFile01">Name/Signature:</label>
																 <input type="file" class="form-control" id="inputGroupFile01">
															</div>
													 </div>
												</div>

												<div class="col-md-6">
													 <section style="margin-top: 20px;">
													 <p >Sex:</p>
													 <div class="row">
															<div class="col-md-1">
																 <label class="form-check ">
																		<input class="form-check-input" type="radio" value="option1" name="radios-example"
																					 checked="">
																		<span class="form-check-label">M</span>
																 </label>
															</div>
															<div class="col-md-1">
																 <label class="form-check">
																		<input class="form-check-input" type="radio" value="option2" name="radios-example">
																		<span class="form-check-label">F</span>
																 </label>
															</div>
													 </div>
													 </section>
												</div>

										 </div>

										 <div class="row">
												<div class="col-md-6">
													 <section>
															<div class="input-group py-md-3">
																 <span class="input-group-textmod" id="inputGroup-sizing-default">Contact Number:</span>
																 <input type="text" class="form-control" placeholder="Mobile Number Here"
																				aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default">
															</div>
													 </section>
												</div>

												<div class="col-md-6">
													 <section>
													 <div class="input-group py-md-3">

															<span class="input-group-textmod" id="inputGroup-sizing-default">Email Address:</span>
															<input type="text" class="form-control" placeholder="Email here"
																		 aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default">

													 </div>
													 </section>
												</div>
										 </div>
										 {{--END SIXTH SECTION--}}
										 <div>
												<div class="table-responsive">
												<table style=" width: 100%; border-collapse: collapse;" class="table table-bordered">
													 <thead>
													 <tr style="">
															<th class="" style="width: 15% !important;">DOST Scholarship Category</th>
															<th class="">DOST Scholarship Program</th>
															<th style="">Year of the Award</th>
															<th style="">Course</th>
															<th style="">School</th>
													 </tr>
													 </thead>
													 <tbody>
													 <tr style="">
															<td style="">Undergraduate</td>
															<td contenteditable="true" class="tabletd2"></td>
															<td contenteditable="true" class="tabletd2"></td>
															<td contenteditable="true" class="tabletd2"></td>
															<td contenteditable="true" class="tabletd2"></td>
													 </tr>
													 <tr style="">
															<td style="">MS</td>
															<td contenteditable="true" class="tabletd2"></td>
															<td contenteditable="true" class="tabletd2"></td>
															<td contenteditable="true" class="tabletd2"></td>
															<td contenteditable="true" class="tabletd2"></td>
													 </tr>
													 <tr style="">
															<td style="">Ph.D</td>
															<td contenteditable="true" class="tabletd2"></td>
															<td contenteditable="true" class="tabletd2"></td>
															<td contenteditable="true" class="tabletd2"></td>
															<td contenteditable="true" class="tabletd2"></td>
													 </tr>
													 </tbody>
												</table>
												</div>
												<hr class="styled-hr">
												<hr class="styled-hr">

											 <span>	(To be filled out by Scholarship Staff)</span>

												<div class="row">
													 <div class="col-md-6">
															<section style="">
																 <div class="input-group py-md-3">
																		<span class="input-group-textmod" id="inputGroup-sizing-default">Request processed by:</span>
																		<input type="text" class="form-control"
																					 aria-label="Sizing example input"
																					 aria-describedby="inputGroup-sizing-default">
																 </div>
															</section>
													 </div>

													 <div class="col-md-6">
															<div class="input-group py-md-3">
																 <span class="input-group-textmod" id="inputGroup-sizing-default">Date:</span>
																 <input type="text" class="form-control"
																				aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default">
															</div>
													 </div>
												</div>

												<div class="row">
													 <div class="col-md-6">
															<section style="">
																 <div class="input-group py-md-1">
																		<span class="input-group-textmod" id="inputGroup-sizing-default">Mode of release Picked-up/mailed/faxed:</span>
																		<input type="text" class="form-control"
																					 aria-label="Sizing example input"
																					 aria-describedby="inputGroup-sizing-default">
																 </div>
															</section>
													 </div>

													 <div class="col-md-6">
															<div class="input-group py-md-1">
																 <span class="input-group-textmod" id="inputGroup-sizing-default">Date:</span>
																 <input type="text" class="form-control"
																				aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default">
															</div>
													 </div>
												</div>
										 </div>

										 <button  class="d-grid btn btn-primary col-4 mx-auto" style="margin: 20px auto;" type="submit">Submit</button>

									</form>

							 </div>

						</div>


				 </div>


			</main>

	 </div>
</div>


</body>
{{-- PRINT TOGGLING --}}


</html>
