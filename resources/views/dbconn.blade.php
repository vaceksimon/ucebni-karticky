</<!DOCTYPE HTML>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
    <title>Laravel mysql connection</title>
</head>
<body>
    <div>
        <?php
            if (DB::connection()->getPdo()) {
                echo "Succesfully connected to: ". DB::connection()->getDatabaseName();
            }
        ?>
    </div>
</body>
</html>
