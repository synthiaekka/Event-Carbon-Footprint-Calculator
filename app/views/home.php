<?php

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    this is home page <br>

    {{ $information }} <br>

    @for($i = 1; $i < 10; $i++)
        @template
            <b> $i </b> <br>
        @endtemplate
    @endfor

</body>
</html>