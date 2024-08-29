<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up - CarbonFootprint Calc</title>
    <link rel="stylesheet" href="./css/signup.css">
</head>
<body>
    <form action="/signup" method="POST">
        <input type="text" placeholder="Enter your full name" name="fullname">
        <input type="email" placeholder="Enter your email" name="email">
        <input type="number" placeholder="Enter your contact" name="contact">
        <input type="password" placeholder="Enter your password" name="password">
        <input type="password" placeholder="Re-enter your password" name="repassword">
        <select name="usertype" id="">
            <option value="1">Event Organizer</option>
            <option value="2">Participant</option>
            <option value="3">Vendors</option>
        </select>
        <input type="submit">
    </form>
</body>
</html>