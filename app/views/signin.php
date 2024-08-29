<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign In - CarbonFootprint Calc</title>
    <link rel="stylesheet" href="./css/signin.css">
</head>
<body>
    <form action="/signin" method="POST">

        @php $exists = (isset($_GET['error']))? 1: 0; @endphp
        @if( $exists )
            <div class="error-message">
                {{ $_GET['error'] }}
            </div>
        @endif
    
        <input type="email" placeholder="Enter your email" name="email">
        <input type="password" placeholder="Enter your password" name="password">
        <input type="submit">

        <p>Don't have an account? <a href="/Register">Register</a></p>
    </form>
</body>
</html>