<?php
include './config/db_connect.php';

$sql = 'SELECT id,title,comment FROM table_one ORDER by create_at';

$result = mysqli_query($conn, $sql);

$tableOne = mysqli_fetch_all($result, MYSQLI_ASSOC);

mysqli_free_result($result);

mysqli_close($conn);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>First Project</title>
    <link rel="stylesheet" href="style.css">
    <style>
        .row {
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .card {
            width: 300px;
            height: 180px;
            background: #fff;
            color: black;
            text-align: center;
            padding: 10px;
            margin: 10px;
            border-radius: 5px;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }

        .right {
            text-align: right;
            margin-bottom: 5px;
        }

        .right a {
            color: black;
            border: 1px solid black;
            padding: 5px 10px;
            display: inline-block;
            margin-right: 10px;
        }
    </style>
</head>

<body>
    <?php include "templates/header.php" ?>

    <div class="container">
        <h3 class="center title"> All Task</h3>
        <div class="row">
            <?php foreach ($tableOne as $table) { ?>
                <div class="card">
                    <div class="card-content">
                        <h4><?php echo htmlspecialchars($table['title']) ?></h4>
                        <p><?php echo htmlspecialchars($table['comment']) ?></p>
                    </div>
                    <hr>
                    <div class="right">
                        <a href="details.php?id=<?php echo $table['id'] ?>">more info</a>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>

    <?php include "templates/footer.php" ?>
</body>

</html>