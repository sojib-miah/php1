<?php
include './config/db_connect.php';

function configer($data)
{
    $data = trim($data);
    $data = stripcslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

$email = $title = $comment = '';

$errors = ['email' => '', 'title' => '', 'comment' => ''];

if (isset($_POST['submit'])) {

    // Email Validate
    if (empty($_POST['email'])) {
        $errors['email'] = 'The Email field is Required';
    } else {
        $email = configer($_POST['email']);
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errors['email'] = 'Email Must be a valid Email';
        }
    }

    // title Validate    
    if (empty($_POST['title'])) {
        $errors['title'] = 'The Title field is Required';
    } else {
        $title = configer($_POST['title']);
        if (!preg_match('/^[a-zA-Z\s]+$/', $title)) {
            $errors['title'] = 'Title must be letter and space Only';
        }
    }

    // Comment Validate
    if (empty($_POST['comment'])) {
        $errors['comment'] = 'The Comment field is Required';
    } else {
        $comment = configer($_POST['comment']);
        if (!preg_match('/^([a-zA-Z\s]+)(,\s*[a-zA-Z\s]*)*$/', $comment)) {
            $errors['comment'] = 'Comment Must be Comma to seperete';
        }
    }

    if (array_filter($errors)) {
    } else {
        $email = mysqli_real_escape_string($conn, $_POST['email']);
        $title = mysqli_real_escape_string($conn, $_POST['title']);
        $comment = mysqli_real_escape_string($conn, $_POST['comment']);

        $sql = "INSERT INTO table_one(title,email,comment) VALUES ('$title','$email','$comment')";

        if (mysqli_query($conn, $sql)) {

            header('Location:index.php');
        } else {
            echo 'Query Error : ' . mysqli_errno($conn);
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Task</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <?php include "templates/header.php" ?>

    <div class="container">
        <h3 class="center title">Add a Task</h3>
        <form action="add.php" method="POST" class="form">

            <label for="email">Enter Email : </label>
            <input type="email" name="email" placeholder="Email...." value="<?php echo configer($email) ?>">
            <p style="color:red;"><?php echo $errors['email'] ?></p>

            <label for="title">Enter Title : </label>
            <input type="text" name="title" placeholder="Title...." value="<?php echo configer($title) ?>">
            <p style="color:red;"><?php echo $errors['title'] ?></p>

            <label for="comment">Enter Comment : </label>
            <input type="text" name="comment" placeholder="Comment...." value="<?php echo configer($comment) ?>">
            <p style="color:red;"><?php echo $errors['comment'] ?></p>

            <div class="center">
                <input class="btn" type="submit" name="submit" value="Submit">
            </div>
        </form>
    </div>

    <?php include "templates/footer.php" ?>
</body>

</html>