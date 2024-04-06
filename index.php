<?php

popen("php Bootstrap/worker.php " . escapeshellarg(file_get_contents('php://input')) . " >> /dev/null 2>&1 &", "r");

?>

<!doctype html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <title>LaraGram</title>
</head>
<body>
    <h1 style="font-size: 32px; text-align: center; user-select: none;">Silence is gold!</h1>
</body>
</html>