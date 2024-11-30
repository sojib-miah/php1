<?php
include 'config/db_connect.php';

if (isset($_POST['delete'])) {
    $id_delete = mysqli_real_escape_string($conn, $_POST['id_delete']);
    $sql = "DELETE FROM table_one WHERE id = $id_delete";

    if (mysqli_query($conn, $sql)) {
        header('Location:index.php');
    } else {
        echo 'Query Error : ' . mysqli_error($conn);
    }
}

if (isset($_GET['id'])) {
    $id = mysqli_real_escape_string($conn, $_GET['id']);

    $sql = "SELECT * FROM table_one WHERE id = $id";

    $result = mysqli_query($conn, $sql);

    $table = mysqli_fetch_assoc($result);

    mysqli_free_result($result);
    mysqli_close($conn);
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Details Page</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <?php include "templates/header.php" ?>

    <div class="container">
        <h1 class="center title">details page</h1>
        <?php if ($table): ?>

            <div class="details">
                <h4><?php echo htmlspecialchars($table['title']) ?></h4>

                <p> Created By : <?php echo htmlspecialchars($table['email']) ?></p>

                <p><?php echo date($table['create_at']) ?></p>

                <h5>Comments</h5>
                <p><?php echo htmlspecialchars($table['comment']) ?></p>

                <form action="details.php" method="post">
                    <input type="hidden" name="id_delete" value="<?php echo $table['id'] ?>">
                    <input type="submit" name="delete" value="delete" class="btn">
                </form>
            </div>

        <?php else: ?>
            <h5>No such anything</h5>
        <?php endif; ?>
    </div>

    <?php include "templates/footer.php" ?>
</body>

</html>