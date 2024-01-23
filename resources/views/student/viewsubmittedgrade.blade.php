<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>DOST</title>
        <style>
            table,
            td,
            th {
                border: 3px solid black;
                border-color: black;
            }
        </style>
    </head>

    <body data-theme="light" data-layout="fluid" data-sidebar-position="left" data-sidebar-layout="default">
        <div class="wrapper">


            <div class="main">
                <main class="content" style="padding: 1rem 1rem 1rem !important;">
                    <div class="container-fluid p-0">
                        <div class="card">
                            <div class="card-body">
                                <table id="thisdatatable" class="hover table table-bordered compact nowrap" style="width:100%; ">
                                    <thead>
                                        <tr>
                                            <th>Academic Year</th>
                                            <th>Semester</th>
                                            <th>Subjectname</th>
                                            <th>Grade</th>
                                            <th>Units</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($cogs as $cog)
                                            <tr>
                                                <td rowspan="{{ count(explode(',', $cog->Subjectname)) }}">{{ $cog->startyear }}- {{ $cog->startyear + 1 }}</td>
                                                <td rowspan="{{ count(explode(',', $cog->Subjectname)) }}">{{ $cog->semester }}</td>

                                                {{-- Explode concatenated values back into arrays --}}
                                                @php
                                                    $subjectnames = explode(',', $cog->Subjectname);
                                                    $grades = explode(',', $cog->Grade);
                                                    $units = explode(',', $cog->Units);
                                                @endphp

                                                {{-- Display first row --}}
                                                <td>{{ $subjectnames[0] }}</td>
                                                <td>{{ $grades[0] }}</td>
                                                <td>{{ $units[0] }}</td>
                                            </tr>

                                            {{-- Display remaining rows --}}
                                            @for ($i = 1; $i < count($subjectnames); $i++)
                                                <tr>
                                                    <td>{{ $subjectnames[$i] }}</td>
                                                    <td>{{ $grades[$i] }}</td>
                                                    <td>{{ $units[$i] }}</td>
                                                </tr>
                                            @endfor
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                </main>
            </div>
        </div>
        </div>
    </body>

</html>
