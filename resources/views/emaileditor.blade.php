<!DOCTYPE html>
<html lang="en">

<head>
    <title>DOST XI</title>


    <?php echo app('Illuminate\Foundation\Vite')(['resources/sass/app.scss', 'resources/js/app.js']); ?>
    <link href="<?php echo e(asset('css/toastr.min.css')); ?>" rel="stylesheet">

    <script src="https://cdn.ckeditor.com/ckeditor5/39.0.2/decoupled-document/ckeditor.js"></script>

</head>

<body data-theme="default" data-layout="fluid" data-sidebar-position="left" data-sidebar-layout="default">
<div class="wrapper">


    @include('layouts.sidebar')


    <div class="main">
        @include('layouts.header')

        <main class="content">
            <div class="container-fluid p-0">


                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h5 class="card-title">Email Edit</h5>

                            </div>
                            <div class="card-body">

                                <input type="hidden" name="action" id="action" value="create">
                                <div id="toolbar-container"></div>

                                <?php echo csrf_field(); ?>

                                <!-- This container will become the editable. -->
                                <div id="editor">
                                    {!! $emailContent->content ?? 'Enter your email' !!}
                                </div>


                                <button type="button" style="max-width: 200px ;  margin-bottom: 0.5rem; margin-top: 1rem;" id="submit"
                                        class="btn btn-primary">Submit
                                </button>


                            </div>


                        </div>
                    </div>
                </div>
            </div>
        </main>

    </div>
</div>


</div>
</body>


<script type="module" src="<?php echo e(asset('js/toastr.min.js')); ?>"></script>
<script src="<?php echo e(asset('js/jquery.min.js')); ?>"></script>
<script>
    //let editor;
    DecoupledEditor
        .create(document.querySelector('#editor'), {
            ckfinder: {
                uploadUrl: "{{ route('ckeditor.upload', ['_token' => csrf_token()]) }}",
            }
        })
        .then(editor => {
            const toolbarContainer = document.querySelector('#toolbar-container');
            toolbarContainer.appendChild(editor.ui.view.toolbar.element);

            // Add an event listener to the button
            document.querySelector('#submit').addEventListener('click', () => {
                // Get the CKEditor data
                const editorData = editor.getData();

                // Check if 'retrieveddata' is declared and initialized elsewhere
                if (typeof editorData !== 'undefined') {
                    // Assign ata the CKEditor data to 'retrieveddata'
                    retrievedd = editorData;
                    console.log('DATA:', editorData);

                    // Send the data to the server using AJAX
                    $.ajax({
                        url: "{{ route('create') }}",
                        method: 'POST',
                        data: {
                            _token: "{{ csrf_token() }}",
                            content: editorData,
                        },
                        success: function (response) {
                            // Handle the server's response (if needed)
                            console.log('Data saved to the database:', response);
                            toastr.info('SAVED')
                        },
                        error: function (error) {
                            console.error('Error:', error);
                        }
                    });
                } else {
                    console.error('retrieveddata is not defined or initialized.');
                }
            });
        })
        .catch(error => {
            console.error('Error during CKEditor initialization:', error);
        });


</script>
<script>

</script>

</html>
