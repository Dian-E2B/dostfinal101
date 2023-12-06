<!DOCTYPE html>
<html lang="en">

    <head>
        <title>DOST XI</title>
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        <script src="https://code.jquery.com/jquery-3.7.0.js"></script>
        <link href="{{ asset('css/all.css') }}">

        <script src="{{ asset('js/all.js') }}"></script>
        <style>
            #image-preview {
                width: 100%;
                /* 100% width to fill the magnifier container */
                height: auto;
                /* To maintain the aspect ratio */
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
                transform: scale(1.5);
                /* Adjust the scale factor to control the zoom level */
                margin-left: 20%;
                z-index: 9999 !important;
            }
        </style>
    </head>

    <body data-theme="light" data-layout="fluid" data-sidebar-position="left" data-sidebar-layout="default">
        <div class="wrapper">


            <div class="main">
                {{-- HEADER START --}}



                @include('student.layoutsst.header')
                {{-- HEADER END --}}
                <main class="content" style="padding: 1rem 1rem 1rem !important;">
                    <div class="container-fluid p-0">

                        <h1 class="h3 mb-1">Grades</h1>
                        <form id="input-form" method="POST" action="{{ route('submitgrades') }}" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-md-5 col-xl-4">

                                    <div class="card">
                                        <div class="card-header">
                                            <h5 class="card-title mb-0">Certificate of Grades</h5>
                                        </div>
                                        <div class="card-body">
                                            <img class="py-md-3" id="image-preview" src="" alt="Image Preview" style="max-width: 500px; display: none; ">
                                            <label class="form-label">COG image/file:</label>

                                            <input required type="file" name="imagegrade" id="imagegradeid" class="form-control" accept="image/*, application/pdf">
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-7 col-xl-8">
                                    <div class="tab-content">
                                        <div class="tab-pane fade show active" id="account" role="tabpanel">

                                            <div class="card">
                                                <div class="card-header mb-0">

                                                    <h5 class="card-title mb-0">Grades Input</h5>
                                                </div>
                                                <div class="card-body">

                                                    <div class="row">
                                                        <div class="col-md-3">
                                                            <div class="mb-3">
                                                                <label>
                                                                    <select id="semesterSelect" name="semester" class="form-control" required>
                                                                        <option value="">Choose Semester:
                                                                        </option>{{-- 0-Summer | 1-First Sem | 2-Second Sem | 3-Third Sem --}}
                                                                        <option value="1">1st Semester</option>
                                                                        <option value="2">2nd Semester</option>
                                                                        <option value="0">Summer</option>
                                                                    </select>
                                                                </label>
                                                            </div>

                                                        </div>
                                                        <div class="col-md-9">
                                                            <div class="d-flex align-items-center">
                                                                <label for="inputSchoolyear" class="me-2">School Year:</label>
                                                                <input style="max-width: 80px;" required type="text" name="startyear" placeholder="yyyy" class="numeric-input form-control me-2">
                                                                <span class="me-2">-</span>
                                                                <input style="max-width: 80px;" required type="text" name="endyear" placeholder="yyyy" class=" numeric-input form-control">
                                                            </div>
                                                        </div>

                                                        <div class="d-flex align-items-center mt-1">
                                                            <div class="me-2">
                                                                <label>Subject Name:</label>
                                                                <input name="subjectnames[0][name]" type="text" class="form-control" required>
                                                            </div>
                                                            <div class="me-2">
                                                                <label>Grade:</label>
                                                                <input id="grade1" type="number" name="grades[0][grade]" class="form-control numeric-input">
                                                            </div>
                                                            <div class="me-2">
                                                                <label>Units:</label>
                                                                <input id="unit1" name="units[0][unit]" type="number" class="form-control numeric-input">
                                                            </div>
                                                            <div class="">
                                                                <br>
                                                                <button name="add" id="add" type="button" class="btn btn-success">Add Row
                                                                </button>
                                                            </div>
                                                        </div>

                                                        <div id="table">

                                                        </div>
                                                    </div>

                                                    <label>
                                                        <input id="scholaridinput" name="scholarid" style="display: none;" value="{{ $scholarId }}">
                                                    </label>

                                                    <div class="mt-3">
                                                        <button type="submit" class="btn btn-pill btn-primary">Submit All</button>
                                                    </div>
                                                </div>

                        </form>

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
    <script src="https://code.jquery.com/jquery-3.7.0.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script>
        var i = 0;
        $('#add').click(function() {
            ++i;
            $('#table').append(
                '<div style="" class="d-flex align-items-center mt-1 row1" id="row' + i + '">' +
                '<div class="me-2">' +
                ' <label>Subject Name:</label>' +
                '<input id="subjectname1" name="subjectnames[' + i + '][name]"  type="text" class="form-control" required>' +
                ' </div>' +
                '<div class="me-2">' +
                ' <label>Grade:</label>' +
                '<input id="grade1" type="number" name="grades[' + i + '][grade]"  class="form-control allow_decimal" required pattern="[0-9]+" title="Please enter a valid number" >' +
                '</div>' +
                '<div class="me-2">' +
                '<label>Units:</label>' +
                '<input id="unit1" name="units[' + i + '][unit]"type="number" class="form-control allow_decimal" required pattern="[0-9]+" title="Please enter a valid number">' +
                '</div>' +
                '<div class="me-2">' +
                '<br>' +
                ' <button name="add" id="add" type="button" class="btn btn-danger remove-table-row">Delete</button>' +
                ' </div>' +
                '</div>'
            );
        });

        $(document).on('click', '.remove-table-row', function() {
            var rowId = $(this).closest('.row1').attr('id');
            $('#' + rowId).remove();
        });

        // // Add an event listener to the file input
        // document.getElementById('imagegradeid').addEventListener('change', function() {
        //     var imagePreview = document.getElementById('image-preview');
        //     var fileInput = this;

        //     // Check if a file is selected
        //     if (fileInput.files && fileInput.files[0]) {
        //         var reader = new FileReader();

        //         reader.onload = function(e) {
        //             imagePreview.src = e.target.result;
        //             imagePreview.style.display = 'block'; // Display the image preview
        //         };

        //         reader.readAsDataURL(fileInput.files[0]);
        //     } else {
        //         imagePreview.src = '';
        //         imagePreview.style.display = 'none'; // Hide the image preview
        //     }
        // });

        // const image = document.getElementById('image-preview');

        // image.addEventListener('mouseenter', () => {
        //     image.classList.add('magnify');
        // });

        // image.addEventListener('mouseleave', () => {
        //     image.classList.remove('magnify');
        // });

        function viewFile() {
            var fileInput = document.getElementById('imagegradeid');
            var file = fileInput.files[0];
            var filePreviewElement = document.getElementById('filePreview');

            if (file) {
                // Display the filename or some indication
                filePreviewElement.textContent = 'Selected File: ' + file.name;

                // ... (rest of the code for preview or link based on file type)
            } else {
                filePreviewElement.textContent = 'No file selected.';
            }
        }

        $('.numeric-input').keypress(function(event) {
            var charCode = (event.which) ? event.which : event.keyCode;
            if ((charCode != 46 || $(this).val().indexOf('.') != -1) && (charCode < 48 || charCode > 57)) {
                event.preventDefault();
                notyf.error({
                    message: 'Numeric input only.',
                    duration: 3000,
                    position: {
                        x: 'right',
                        y: 'top',
                    },
                })
            } else {

            }
        });
    </script>

</html>
