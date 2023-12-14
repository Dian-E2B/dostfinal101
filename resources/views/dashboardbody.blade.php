<main class="content" style="padding: 0.5rem 0.5rem 0.5rem;">
    <div class="container-fluid">

        {{-- PROGRAM CHART CARD --}}
        <div class="card" style="padding: 15px 15px;">
            <div class="row" >
                <div class="col-9">
                    <div class="col" style="display: flex; align-items: start; "> {{-- FILTER BUTTON --}}
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
                        <div class="col" style="margin-left: 10px;"> {{--DESCRIPTION--}}
                            <h3 class="card-title mt-2"  style="font-size: 15pt; ">Programs</h3>
                            <p>This chart displays the number of scholarships awarded each year for different programs.</p>
                        </div>


                    {{--PROGRAM CHART CANVAS--}}
                    <canvas style="margin-left: 10px;" id="myProgramChart" width="" height="80"></canvas>
                </div>
                <div class="col-3  align-self-center"> {{--PROGRAM PORTION SECTION--}}
                    <div id="programportioncounter-container" class="card programportioncard w-100 p-2" style="">
                        <div  class="">
                        <table style="width: 100%" class="" id="programportioncounter" >
                            <tbody id="programportioncounter-body">
                                @foreach ($ongoingPROGRAMcounter as $index => $result)
                                    <tr>
                                        <td style="" ">
                                            @if ($result->scholarshipprogram == 'MERIT')
                                                <i class="fas fa-circle portionicon" style="color :blue"></i>{{ $result->scholarshipprogram }}:
                                            @elseif ($result->scholarshipprogram == 'RA 10612')
                                              <i class="fas fa-circle portionicon" style="color :rgb(27, 27, 28)"></i>{{ $result->scholarshipprogram }}:
                                            @elseif ($result->scholarshipprogram == 'RA 7687')
                                              <i class="fas fa-circle portionicon" style="color :rgb(40, 253, 243)"></i>{{ $result->scholarshipprogram }}:
                                            @endif
                                        </td>
                                        <td style="">
                                            @php
                                                $percentage = ($result->scholarshipprogramcount / $totalCount) * 100;
                                            @endphp
                                            {{ number_format($percentage, 2) }}%
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    </div>

                </div>
            </div>
        </div>
    </div>


    </div>
</main>
