<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/events.css">
    <title>College Event Carbon Footprint Calculator</title>
</head>
<body>
    <div class="container">
        <div class="content">
            <h1>Choose event !!! </h1>
            <div class="buttons">
                @foreach( $event_cat as $cat )
                    <a href="/calc?id={{ $cat['id'] }}" class="btn"> {{ $cat['name'] }} </a>
                @endforeach
            </div>
        </div>
    </div>
</body>
</html>