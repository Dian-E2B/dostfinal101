<!DOCTYPE html>
<html lang="en">

<head>
	 <title>DOST XI</title>
	 @vite(['resources/css/app.css', 'resources/js/app.js'])
	 <script src="https://code.jquery.com/jquery-3.7.0.js"></script>
	 <style>
       .vertical-line {
           width: 1px; /* Adjust the width of the line as needed */
           background-color: #000; /* Adjust the color of the line as needed */
           height: 100%; /* Make the line span the full height of the column */
       }

       #image-preview {
           width: 100%; /* 100% width to fill the magnifier container */
           height: auto; /* To maintain the aspect ratio */
           z-index: 999 !important;
       }


       .magnifier {
           width: 100%;
           height: 100%;

           align-items: center;
           z-index: 9999 !important;
       }

       #image-preview.magnify {
           transition: transform 0.5s;
           transform: scale(1.5); /* Adjust the scale factor to control the zoom level */
           margin-left: 20%;
           z-index: 9999 !important;
       }
	 </style>
</head>

<body data-theme="light" data-layout="fluid" data-sidebar-position="left" data-sidebar-layout="default">
<div class="wrapper">


	 <div class="main">
			{{-- HEADER START --}}

			<label>
				 <input name="scholarid" style="display: none;" value="{{ $scholarId }}">
			</label>

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

										 {{--IMAGE SECTION--}}
										 <div class="row">
												<div class="col-md-6 text-left">
													 <div class="py-0 py-md-0 border">
															<div class="card-body">

																 <div class="magnifier">
																		<img class="py-md-3" id="image-preview" src="" alt="Image Preview"
																				 style="max-width: 500px; display: none; ">
																		<label class="form-label">COG image/file:</label>
																		<input name="image" id="image" class="form-control"
																					 type="file">
																 </div>

															</div>
													 </div>
												</div>

												{{--GRADING SECTION--}}
												<div class="col-md-6 text-left">
													 <div class="py-0 py-md-0 border">
															<div class="card-body">
																 <form id="input-form">

																		<div class="row">

																			 <div class="col-md-3">
																					<label>
																						 <select class="form-control">
																								<option selected="">Choose Semester:
																								</option>{{-- 0-Summer | 1-First Sem | 2-Second Sem | 3-Third Sem--}}
																								<option>1st Semester</option>
																								<option>2nd Semester</option>
																								<option>Summer</option>
																						 </select>
																					</label>
																			 </div>

																			 <div style="z-index: 0" class="col-md-6">
																					{{--																					<div  class="input-group mb-3">--}}
																					{{--																						 <span  class="input-group-text"--}}
																					{{--																									 id="inputGroup-sizing-default">School Year:</span>--}}
																					{{--																						 <input placeholder="yyyy-yyyy" type="text" class="form-control"--}}
																					{{--																										name="schoolyear" aria-label="Sizing example input"--}}
																					{{--																										aria-describedby="inputGroup-sizing-default"--}}
																					{{--																										style="max-width: 250px;">--}}
																					{{--																					</div>--}}
																					<label for="test">Enroll with us:</label>
																					<span style="display: table-cell;
            width: 1px;
            white-space: nowrap;"><input name="test" id="test"
																											 type="text"
																											 placeholder="Enter your input"/></span>
																			 </div>
																		</div>


																		<div id="subjectgrade_row1" class="row">
																			 <div class="col-md-6">
																					<label>Subject Name:</label>
																					<input id="name1" type="text" class="form-control">
																			 </div>
																			 <div class="col-md-2">
																					<label>Grade:</label>
																					<input id="grade1" type="number" class="form-control">
																			 </div>
																			 <div class="col-md-2">
																					<label>Units:</label>
																					<input id="unit1" type="number" class="form-control">
																			 </div>
																			 <div class="col-md-1">
																					<br>
																					<button style="display: none" onclick="delete_row('1')" type="button"
																									class="btn btn-danger">Delete
																					</button>
																			 </div>
																		</div>


																 </form>

																 <div class="text-md-end py-md-3">
																		<button onclick="add_more()" class="btn btn-pill btn-primary">Add More</button>

																 </div>


															</div>
													 </div>
												</div>
										 </div>

										 <div style="text-align: center; margin-top: 20px;">
												<button onclick="submit_form()" class="btn btn-pill btn-success">Submit All</button>
										 </div>

									</div>
							 </div>
						</div>

				 </div>
			</main>
	 </div>
</div>
</body>
<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
<script>
    var counter = 1;

    function add_more() {
        counter++
        var newDiv = `<div id="subjectgrade${counter}" class="row">
                    <div class="col-md-6">
                        <label>Subject Name:</label>
                        <input id="name${counter}" type="text" class="form-control">
                    </div>
                    <div class="col-md-2">
                        <label>Grade:</label>
                        <input id="grade${counter}" type="number" class="form-control">
                    </div>
                     <div class="col-md-2">
												<label>Units:</label>
												<input id="unit${counter}" type="number" class="form-control">
										</div>
                    <div class="col-md-1">
                        <br>
                        <button style="display: ${counter > 1 ? 'block' : 'none'}" onclick="delete_row('${counter}')" type="button" class="btn btn-danger">Delete</button>
                    </div>
                </div>`
        var form = document.getElementById('input-form')
        form.insertAdjacentHTML('beforeend', newDiv);
    }

    function delete_row(id) {
        document.getElementById('subjectgrade' + id).remove()
    }

    function submit_form() {
        var subjectgradeData = []
        for (var i = 1; i <= counter; i++) {
            var product_row = document.getElementById('subjectgrade' + i)
            if (product_row) {
                var subject_name = document.getElementById('name' + i).value
                var grade = document.getElementById('grade' + i).value
                var unit = document.getElementById('unit' + i).value
                var data = {
                    name: subject_name,
                    grade: grade,
                    unit: unit
                }
                subjectgradeData.push(data)
            }
        }

        axios.post('submitgrades', {
            subjectgradeData: subjectgradeData
        }).then(resp => {
            window.location.reload()
        })


    }


    // Add an event listener to the file input
    document.getElementById('image').addEventListener('change', function () {
        var imagePreview = document.getElementById('image-preview');
        var fileInput = this;

        // Check if a file is selected
        if (fileInput.files && fileInput.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                imagePreview.src = e.target.result;
                imagePreview.style.display = 'block'; // Display the image preview
            };

            reader.readAsDataURL(fileInput.files[0]);
        } else {
            imagePreview.src = '';
            imagePreview.style.display = 'none'; // Hide the image preview
        }
    });

    const image = document.getElementById('image-preview');

    image.addEventListener('mouseenter', () => {
        image.classList.add('magnify');
    });

    image.addEventListener('mouseleave', () => {
        image.classList.remove('magnify');
    });

</script>

</html>
