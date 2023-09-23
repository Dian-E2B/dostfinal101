<!DOCTYPE html>
<html lang="en">

<head>
    <title>DOST XI</title>
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>

<body data-theme="default" data-layout="fluid" data-sidebar-position="left" data-sidebar-layout="default">
<div class="wrapper">


    <div class="main">
        @include('layoutsst.header')

        <main class="content">
            <div class="container-fluid p-0">


                <label>
                    <input style="display: none;" value="{{ $scholarId }}">
                </label>
                @if (count($replyslips) > 0)
                    <div class="col-12 col-md-6 col-lg-4">
                        <div class="card">
                            <div class="card-header">
                                <h5 class="card-title mb-0">Reply Slip</h5>
                            </div>
                            <div class="card-body">
                                <p class="card-text">We are thrilled to offer you the <strong>DOST-SEI S&T Undergraduate Scholarship</strong> for the academic year <strong>{{ now()->year }}</strong>. As a scholarship recipient, we kindly request your prompt response by signing and returning this reply slip to confirm your acceptance of the award.</p>
                                <a href="{{ route('student.replyslipview') }}"  class="btn btn-primary">View <i class="align-middle me-2" data-feather="eye"></i></a>
                            </div>
                        </div>
                    </div>
            </div>
        @endif




    </div>
    </main>
</div>

</body>
<script src="https://code.jquery.com/jquery-3.7.0.js"></script>
{{--CHECKBOXES DISABLING--}}
<script>

</script>

</html>
