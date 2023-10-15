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
																 <img class="py-md-3" id="image-preview" src="" alt="Image Preview" style="max-width: 500px; display: none;">
																 <label class="form-label">COG image/file:</label>
																 <input style="max-width: 300px;" name="image" id="image" class="form-control"
																				type="file">

															</div>
													 </div>
												</div>
												<div class="col-md-6 text-left">
													 <div class="py-0 py-md-0 border">
															<div class="card-body">
																 <form id="input-form">
																 <label>
																		<select class="form-control mb-3">
																			 <option selected="">Choose Semester:</option>{{-- 0-Summer | 1-First Sem | 2-Second Sem | 3-Third Sem--}}
																			 <option>1st Semester</option>
																			 <option>2nd Semester</option>
																			 <option>Summer</option>
																		</select>
																 </label>


{{--																 <div class="row" id="input-container">--}}

{{--																		<div class="form-floating col-md-6">--}}
{{--																			 <input type="email" class="form-control" id="floatingInputValue1" placeholder="name@example.com" value="">--}}
{{--																			 <label style="margin-left: 10px;" for="floatingInputValue1">Subject Name--}}
{{--																					Here:</label>--}}
{{--																		</div>--}}

{{--																		<div class="form-floating col-md-6">--}}
{{--																			 <input type="email" class="form-control" id="floatingInputValue2" placeholder="name@example.com" value="">--}}
{{--																			 <label style="margin-left: 10px;" for="floatingInputValue2">Grade:</label>--}}
{{--																		</div>--}}
{{--																		<button id="addFormField" style="margin: 10px 10px;"--}}
{{--																						class="btn btn-pill btn-primary">Add Subject:--}}
{{--																		</button>--}}

{{--																 </div>--}}


																 <div id="subjectgrade_row1" class="row">
																		<div class="col-md-6">
																			 <label>Subject Name:</label>
																			 <input id="name1" type="text" class="form-control">
																		</div>
																		<div class="col-md-3">
																			 <label>Grade:</label>
																			 <input id="grade1" type="number" class="form-control">
																		</div>
																		<div class="col-md-1">
																			 <br>
																			 <button style="display: none" onclick="delete_row('1')"  type="button" class="btn btn-danger">Delete</button>
																		</div>
																 </div>




																 </form>

																 <div  class="text-md-end py-md-3">
																		<button onclick="add_more()" class="btn btn-pill btn-primary">Add More</button>

																 </div>




															</div>
													 </div>
												</div>
										 </div>

										<div style="text-align: center; margin-top: 20px;">
										 <button onclick="submit_form()"  class="btn btn-pill btn-success">Submit All</button>
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
                    <div class="col-md-3">
                        <label>Grade:</label>
                        <input id="grade${counter}" type="number" class="form-control">
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
        document.getElementById('subjectgrade'+id).remove()
    }

    function submit_form() {
        var subjectgradeData = []
        for (var i = 1; i <= counter; i++){
            var product_row = document.getElementById('subjectgrade'+i)
            if (product_row) {
                var product_name = document.getElementById('name' + i).value
                var price = document.getElementById('grade' + i).value
                var data = {
                    name: product_name,
                    grade: price
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

</script>

</html>
