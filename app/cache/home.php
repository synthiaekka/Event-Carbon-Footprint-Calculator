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

    <?php echo  $information ; ?> <br>

    <?php for($i = 1; $i < 10; $i++): ?>
        <?php $str = <<<HTML
            <b> $i </b> <br>
         HTML; echo $str; ?>
    <?php endfor; ?>

</body>
</html>