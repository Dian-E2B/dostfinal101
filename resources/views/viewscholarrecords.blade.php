<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Scholar Records</title>
</head>
<body>
    <h1>Scholar Records for Number: {{ $number }}</h1>
    <!-- Add more content as needed -->

    @foreach($cogData as $cog)
    <p>Cog Data: {{ $cog->your_column_name }}</p>
    <!-- Add more content as needed -->
@endforeach
</body>
</html>
