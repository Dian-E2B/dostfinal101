<main class="content" style="padding: 0.5rem 0.5rem 0.5rem;">
    <div class="container-fluid">

        {{-- PROGRAM CHART SECTION --}}
        <div class="row">
            <div class="col-6">
                <div class="card" style="padding: 15px 15px;">
                    <div class="" style="display: flex; align-items: start; "> {{-- FILTER BUTTON --}}
                        <button type="button" class="btn btn-light dropdown-toggle" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fas fa-filter"></i>
                        </button>
                        <div class="dropdown-menu ">
                            <div style="display: flex;">
                                <form id="programyearform" action="{{ route('getprogramchartyearfilter') }}">
                                    @csrf
                                    <div class="row g-2 selectportion">
                                        <div class="col">
                                            <select name="startyear" class="form-select">
                                                @foreach ($uniqueYears as $uyear)
                                                    <option value="{{ $uyear }}">
                                                        {{ $uyear }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col">
                                            <select name="endyear" class="form-select">
                                                @foreach ($uniqueYears as $uyear)
                                                    <option value="{{ $uyear }}">
                                                        {{ $uyear }}
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <span style="padding: 10px;">
                                        <button class="btn" type="submit">Filter</button>
                                    </span>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <div class="" style="margin-left: 10px;"> {{-- DESCRIPTION --}}
                                <h3 class="card-title mt-2" style="font-size: 15pt; ">Programs</h3>
                                <p>This chart displays the number of scholarships awarded each year for different programs.</p>
                            </div>
                        </div>
                        <div class="col-6">{{-- Program Portion --}}
                            <div id="programportioncounter-container" class="card programportioncard w-100 p-1" style="">
                                <canvas id="myPieChart" width="" height="90"></canvas>
                            </div>
                        </div>
                    </div>

                    {{-- PROGRAM CHART CANVAS --}}
                    <div>
                        <canvas style="margin-left: 10px;" id="myProgramChart" width="" height="200"></canvas>
                    </div>
                </div>
            </div>

            {{-- GENDER CHART SECTION --}}
            <div class="col-6">
                <div class="card" style="padding: 15px 15px;">
                    <div class="" style="display: flex; align-items: start; "> {{-- FILTER BUTTON --}}
                        <button type="button" class="btn btn-light dropdown-toggle" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fas fa-filter"></i>
                        </button>
                        <div class="dropdown-menu ">
                            <div style="display: flex;">
                                <form id="genderyearform" action="{{ route('getgenderchartyearfilter') }}">
                                    @csrf
                                    <div class="row g-2 selectportion">
                                        <div class="col">
                                            <select name="startyeargender" class="form-select">
                                                @foreach ($uniqueYears as $uyear)
                                                    <option value="{{ $uyear }}">
                                                        {{ $uyear }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="col">
                                            <select name="endyeargender" class="form-select">
                                                @foreach ($uniqueYears as $uyear)
                                                    <option value="{{ $uyear }}">
                                                        {{ $uyear }}-{{ $uyear + 1 }}
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <span style="padding: 10px;">
                                        <button class="btn" type="submit">Filter</button>
                                    </span>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <div class="" style="margin-left: 10px;"> {{-- DESCRIPTION --}}
                                <h3 class="card-title mt-2" style="font-size: 15pt; ">Gender</h3>
                                <p>This chart displays the number of scholarships awarded each year for different genders.</p>
                            </div>
                        </div>
                        <div class="col-6">{{-- Gender Portion --}}
                            <div class="card genderportioncard w-100 p-1" style="">
                                <canvas id="myGenderPie" width="" height="90"></canvas>
                            </div>
                        </div>
                    </div>
                    <div>
                        <canvas style="margin-left: 10px;" id="myGenderChart" width="" height="200"></canvas>
                    </div>
                </div>
            </div>


        </div>



    </div>


    </div>
</main>
