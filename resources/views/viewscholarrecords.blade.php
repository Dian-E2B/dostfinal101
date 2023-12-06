<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>View Scholar Records</title>
    </head>

    <body style=" height: 100%;">
        <h1>Scholar Records for Number: {{ $number }}</h1>
        <!-- Add more content as needed -->



        @foreach ($cogdata as $cog)
            <p>Cog Data: {{ $cog->scholar_id }}</p>
            @foreach ($cog->cogdetails as $detail)
                <p>Subject Name: {{ $detail->subjectname }}</p>
                <p>Grade: {{ $detail->grade }}</p>
                <p>Unit: {{ $detail->unit }}</p>
            @endforeach
        @endforeach

        {{-- <iframe src="{{ asset('storage/prospectus/1prospectus1701785165.pdf') }}" frameBorder="0" scrolling="auto" height="100%" width="50%" type="application/pdf"></iframe> --}}
    </body>

</html>
