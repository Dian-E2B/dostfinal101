<!DOCTYPE html>
<html lang="en">

<head>
	 <title>DOST XI</title>
	 @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        .vertical-line {
            width: 1px; /* Adjust the width of the line as needed */
            background-color: #000; /* Adjust the color of the line as needed */
            height: 100%; /* Make the line span the full height of the column */
        }
    </style>
</head>

<body data-theme="light" data-layout="fluid" data-sidebar-position="left" data-sidebar-layout="default">
<div class="wrapper">




	 <div class="main">
			{{-- HEADER START --}}
			@include('student.layoutsst.header')
			{{-- HEADER END --}}
			<main style="padding: 0.5rem 0.5rem 0.5rem 0.5rem" class="content">
				 <div class="container-fluid p-0">

						<div class="col-12">
							 <div class="card">
									<div class="card-header">
										 <h5 class="card-title mb-0">Grade Input</h5>
									</div>
									<div class="card-body">
										 {{--BODY--}}

                                        <div class="row">
                                            <div class="col-md-6 text-left">
                                                <div class="py-0 py-md-0 border">
                                                    <div class="card-body">
                                                        <label class="form-label">COG image/file:</label>
                                                        <input style="max-width: 300px;"  name="image" id="image" class="form-control" type="file">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6 text-left">
                                                <div class="py-0 py-md-0 border">
                                                    <div class="card-body">
                                                        <label>
                                                            <select class="form-control mb-3">
                                                                <option selected="">Choose Semester:</option>
                                                                <option>1st Semester</option>
                                                                <option>2nd Semester</option>
                                                                <option>Summer</option>
                                                            </select>
                                                        </label>

                                                        <button  style="margin: 10px 10px;" class="btn btn-pill btn-primary">Add Subject:</button>

                                                        <div class="row">

                                                        <div class="form-floating col-md-6"  >
                                                            <input type="email" class="form-control" id="floatingInputValue" placeholder="name@example.com" value="">
                                                            <label style="margin-left: 10px;" for="floatingInputValue">Subject Name Here:</label>
                                                        </div>

                                                        <div  class="form-floating col-md-6">
                                                            <input type="email" class="form-control" id="floatingInputValue" placeholder="name@example.com" value="">
                                                            <label style="margin-left: 10px;" for="floatingInputValue">Grade:</label>
                                                        </div>

                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

									</div>
							 </div>
						</div>

				 </div>
			</main>
	 </div>
</div>
</body>
<script>

</script>

</html>
