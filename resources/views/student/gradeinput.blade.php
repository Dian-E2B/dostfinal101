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

                        @if (count($cogsdraft) > 0)
                            <div class="row justify-content-center">
                                <div class="card col-10">
                                    <div class="card-body">
                                        {{-- @dd($cogsdraft); --}}



                                        <table id="thisdatatable" class="hover table table-bordered compact nowrap" style="width:100%;">
                                            <thead>
                                                <tr>

                                                    <th scope="col">Academic Year</th>
                                                    <th scope="col">Semester</th>
                                                    <th scope="col">Subject</th>
                                                    <th scope="col">Grade</th>
                                                    <th scope="col">Unit</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($cogsdraft as $cogsdraft1)
                                                    @php
                                                        $ids1 = explode(',', $cogsdraft1->id);
                                                        $subjects1 = explode(',', $cogsdraft1->Subjectname);
                                                        $grades1 = explode(',', $cogsdraft1->Grade);
                                                        $units1 = explode(',', $cogsdraft1->Units);
                                                        $completed = explode(',', $cogsdraft1->Completed);

                                                    @endphp
                                                    <form id="draftForm" action="{{ route('saveDraft') }}" method="POST" enctype="multipart/form-data">
                                                        @csrf
                                                        <input type="hidden" name="scholar_id" value="{{ $cogsdraft1->scholar_id }}">
                                                        <input type="hidden" name="is_delete" id="is_delete" value="0">
                                                        <input type="hidden" name="cog_id" value="{{ $cogsdraft1->id1 }}">

                                                        <button style="margin-right: 5px;" class="btn btn-pill btn-primary mb-2" type="submit">Submit as Final</button>
                                                        <button type="button" class="btn btn-pill btn-danger mb-2" onclick="document.getElementById('is_delete').value = '1'; document.getElementById('draftForm').submit();">Delete Draft</button>
                                                        {{--  <a href="javascript:void(0);" onclick="openInNewTab('{{ asset($cogsdraft1->prospectus_details) }}')">View</a>

                                <script>
                                    function openInNewTab(url) {
                                        window.open(url, '_blank');
                                    }
                                </script>
                                <input type="file" class="form-control" name="prospectus1" id="prospectus" accept="image/*, application/pdf"> --}}
                                                    </form>
                                                    @for ($i = 0; $i < count($subjects1); $i++)
                                                        <tr>
                                                            {{--    <td>{{ $ids[$i] }}</td> --}}
                                                            @if ($i == 0)
                                                                <td rowspan="{{ count($subjects1) }}">{{ $cogsdraft1->startyear }}</td>
                                                                <td rowspan="{{ count($subjects1) }}">{{ $cogsdraft1->semester }}</td>
                                                            @endif
                                                            <td>{{ $subjects1[$i] }}</td>

                                                            @if ($completed[$i] == 0)
                                                                <td style="max-width: 200px">

                                                                    <form action="{{ route('studenteditcog') }}" method="POST">
                                                                        @csrf
                                                                        <input type="hidden" name="cog_id" value="{{ explode(',', $cogsdraft1->id)[$i] }}">
                                                                        <input class=" form-control-sm" type="text" name="grade" placeholder="Enter Grade" value="{{ $grades1[$i] }}">


                                                                        <button class="btn btn-pill btn-success" type="submit">Update</button>
                                                                    </form>
                                                                </td>
                                                            @else
                                                            @endif

                                                            <td>{{ $units1[$i] }}</td>


                                                        </tr>
                                                    @endfor
                                                @endforeach
                                            </tbody>
                                        </table>

                                    </div>
                                </div>
                            </div>
                        @endif

                        <form id="input-form" method="POST" action="{{ route('submitgrades') }}" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="is_draft" id="is_draft" value="0">
                            <div class="">
                                <div class="row d-flex justify-content-center">

                                    <div class="col-10">
                                        <div class="card">
                                            <div class="card-header">
                                                <h5 class="card-title mb-0">Certificate of Grades</h5>
                                            </div>
                                            <div class="card-body">
                                                <img class="py-md-3" id="image-preview" src="" alt="Image Preview" style="max-width: 500px; display: none; ">
                                                <label class="form-label">COG image/file:</label>
                                                <input required type="file" name="imagegrade" id="imagegradeid" class="form-control" accept="image/*, application/pdf">
                                                <div class="mt-2" id="previewLink" style="display: none;">
                                                    <a href="#" target="_blank" id="filePreviewLink">Review File</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row d-flex justify-content-center">

                                    <div class="col-10">

                                        <div class="card">
                                            <div class="card-header mb-0">

                                                <h5 class="card-title mb-0">Grades Input</h5>
                                            </div>
                                            <div class="card-body">

                                                <div class="row">
                                                    <div class="col-12">
                                                        <div class="mb-4">
                                                            <label>
                                                                <select id="semesterSelect" name="semester" class="form-control" required>
                                                                    <option value="">Choose Semester:
                                                                    </option>{{-- 0-Summer | 1-First Sem | 2-Second Sem | 3-Third Sem --}}
                                                                    <option value="1">1st Semester</option>
                                                                    <option value="2">2nd Semester</option>
                                                                    <option value="3">Summer</option>
                                                                </select>
                                                            </label>
                                                        </div>

                                                    </div>
                                                    <div class="col-12 mb-3">
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
                                                    <button type="button" class="btn btn-pill btn-secondary" onclick="document.getElementById('is_draft').value = '1'; document.getElementById('input-form').submit();">Submit as Draft</button>

                                                </div>
                                            </div>
                                        </div>


                                    </div>
                                </div>
                            </div>
                        </form>

                    </div>


                </main>
            </div>
        </div>

    </body>
    <script src="https://code.jquery.com/jquery-3.7.0.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script>
        // Get the file input element
        var fileInput = document.getElementById('imagegradeid');

        // Add an event listener for when a file is selected
        fileInput.addEventListener('change', function() {
            // Get the selected file
            var selectedFile = fileInput.files[0];

            // Check if a file is selected
            if (selectedFile) {
                // Show the preview link
                document.getElementById('previewLink').style.display = 'block';

                // Create a URL for the selected file
                var fileURL = URL.createObjectURL(selectedFile);

                // Set the href attribute of the preview link
                document.getElementById('filePreviewLink').href = fileURL;
            }
        });

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
            // Get the row ID
            var rowId = $(this).closest('.row1').attr('id');

            // Ask for confirmation before deleting the row
            var confirmDelete = window.confirm('Are you sure you want to delete this row?');

            if (confirmDelete) {
                // If user confirms, remove the row
                $('#' + rowId).remove();
            }
            // If user cancels, do nothing
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
