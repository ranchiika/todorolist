<?php

include 'db.php';

// select data yang akan di edit
$q_select = "SELECT * FROM task WHERE task_id = '".$_GET['id']."'";
$run_q_select = mysqli_query($conn, $q_select);
$d = mysqli_fetch_object($run_q_select);

// update data
if(isset($_POST['edit'])){
    $q_update = "UPDATE task SET task_label = '".$_POST['task']."' WHERE task_id = '".$_GET['id']."'";
    $run_q_update = mysqli_query($conn, $q_update);
    header('Refresh:0; url=todo.php');
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>To Do List</title>
    <link rel="stylesheet" href="css/stylem.css">
    <link rel="shortcut icon" href="img/33.png" type="image/x-icon">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>

</head>

<body>
    <div class="container">

        <!-- header -->
        <div class="header">
            <div class="title">
                <img src="img/todoro_logow.png" alt="">
            </div>
            <div class="decription">
                <p class="youtube"><?= date("l, d M Y") ?></p>
            </div>
        </div>
        
        <!-- content -->
        <div class="content">
            <div class="card-up">
                <form action="" method="post">
                    <input name="task" type="text" class="input-control" placeholder="Edit your list..." value="<?=$d->task_label?>">
                    <div class="text-right">
                        <button type="submit" name="edit">Edit a List</button>
                    </div>
                </form>
            </div>
            </div>
        </div>
    </div>
    <div class="background">
        <img src="img/gelombang.png" alt="" class="gelom">
        <img src="img/bintangg1.png" alt="" class="b1">
        <img src="img/bintangg2.png" alt="" class="b2">

    </div>
</body>

</html>