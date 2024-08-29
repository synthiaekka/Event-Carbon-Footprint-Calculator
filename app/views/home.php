<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome | Event Carbon Footprint Calculator</title>
    <link rel="stylesheet" href="./css/home.css">
</head>
<body>
    <div class="container">
        <div class="character character-1"></div>
        <div class="character character-2"></div>
        <div class="character character-3"></div>
        <div class="character character-4"></div>
        <div class="content">
            <h1 class="fade-in">Welcome to Event Carbon Footprint Calculator</h1>
            <p class="fade-in">Organize sustainable events by tracking and reducing your carbon footprint.</p>
            <div class="buttons">
                <a href="/signin" class="btn">Signin</a>
                <a href="/Register" class="btn">Register</a>

                <!-- show the calculator button only the user in signed in  -->
                @php $signedIn = (isset($_SESSION['email']))? 1: 0; @endphp
                @if( $signedIn )
                <a href="/calculator" class="btn">Calculator</a>
                @endif



            </div>
        </div>
    </div>
</body>
</html>
