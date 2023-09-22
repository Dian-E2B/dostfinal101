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

                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div style="margin-bottom: -25px;" class="card-header">
                                <h5 class="card-title mb-0">Reply Slip</h5>
                            </div>
                            <div  class="card-body">
                                <form>
                                @foreach ($replyslips as $replyslip)

                                    <p>As one of those who qualified for the {{ now()->year }} DOST-SEI S&T Undergraduate Scholarships under {{ $programname }}, I wish to inform you that: (Please check)</p>
                                    <label class="form-check">
                                        <input id="checkbox1" class="form-check-input option-checkbox" type="checkbox" value="">
                                        <span  class="form-check-label">
												I am AVAILING my scholarship award.
                                        </span>
                                    </label>
                                    <label class="form-check">
                                        <input class="form-check-input option-checkbox" type="checkbox" value="">
                                        <span class="form-check-label">
												I am DEFERRING my scholarship award due to … (Please indicate reason on the field below.)
                                        </span>
                                    </label>
                                    <label class="form-check">
                                        <input class="form-check-input option-checkbox" type="checkbox" value="">
                                        <span class="form-check-label">
												I am NOT AVAILING the scholarship due to…  (Please indicate reason on the field below.)
                                        </span>
                                    </label>
                                    <label>
                                        <input style="display: none;" value="{{ $replyslip->scholar_id }}" >
                                    </label>


                                        <label for="textarea1"></label><textarea disabled style="width: 100% !important;" id="textarea1" class="form-control" rows="2" placeholder="Reasons:" required></textarea>

                                @endforeach
                                </form>
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
{{--CHECKBOXES DISABLING--}}
<script>
    const checkbox1 = document.getElementById('checkbox1');
    const checkboxes = document.querySelectorAll('.option-checkbox');
    const textarea1 = document.getElementById('textarea1');
    checkboxes.forEach(checkbox => {
        checkbox.addEventListener('change', () => {
            if (checkbox1.checked) {
                // If checked, disable the textarea
                if (checkbox.checked) {
                    // Disable other checkboxes
                    checkboxes.forEach(otherCheckbox => {
                        if (otherCheckbox !== checkbox) {
                            otherCheckbox.disabled = true;
                        }
                    });
                } else {
                    // Enable all checkboxes
                    checkboxes.forEach(otherCheckbox => {
                        otherCheckbox.disabled = false;
                    });
                }
                textarea1.disabled = true;
            } else {
                if (checkbox.checked) {
                    // Disable other checkboxes
                    checkboxes.forEach(otherCheckbox => {
                        if (otherCheckbox !== checkbox) {
                            otherCheckbox.disabled = true;
                        }
                    });
                } else {
                    // Enable all checkboxes
                    checkboxes.forEach(otherCheckbox => {
                        otherCheckbox.disabled = false;
                    });
                }
                // If not checked, enable the textarea
                textarea1.disabled = false;
            }

        });
    });
</script>

</html>
