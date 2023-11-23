<?php

include 'db.php';

// Proses insert data
if(isset($_POST['add'])){
    $q_insert = "INSERT INTO task (task_label, task_status) VALUE (
        '".$_POST['task']."',
        'open'
    )";
    $run_q_insert = mysqli_query($conn, $q_insert);
    if($run_q_insert){
        header('Refresh:0; url=todo.php');
    }
}

// show data

$q_select = "SELECT * FROM task ORDER BY task_id DESC";
$run_q_select = mysqli_query($conn, $q_select);

// delete data
if (isset($_GET['delete'])){
    $q_delete = "DELETE FROM task WHERE task_id = '".$_GET['delete']."' ";
    $run_q_delete = mysqli_query($conn, $q_delete);
    header('Refresh:0; url=todo.php');
}

// update status data
if(isset($_GET['done'])){
    $status = 'close';
    if($_GET['status']=='open'){
        $status = 'close';
    }else{
        $status = 'open';
    }

    $q_update = "UPDATE task SET task_status = '".$status."' WHERE task_id = '".$_GET['done']."'";
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
                    <input name="task" type="text" class="input-control" placeholder="Add your list...">
                    <div class="text-right">
                        <button type="submit" name="add">Make a List</button>
                    </div>
                </form>
            </div>

            <!-- tugas -->
            <?php
            if(mysqli_num_rows($run_q_select) > 0){
                while($r = mysqli_fetch_array($run_q_select)){
            ?>
            <div class="card">
                <div class="task-item <?= $r['task_status']== 'close' ? 'done':''?>">
                    <div>
                        <input type="checkbox" onclick="window.location.href = '?done=<?= $r['task_id']?>&status=<?= $r['task_status']?>'" <?= $r['task_status']== 'close' ? 'checked':''?>>
                        <span><?= $r['task_label']?></span>
                    </div>

                    <div>
                        <a href="edit.php?id=<?= $r['task_id']?>" class='edit-task' title="edit"><i class='bx bx-edit'></i></a>
                        <a href="?delete=<?=$r['task_id']?>" class='delete-task' title="Remove" onclick="return confirm('Are you sure?')"><i class='bx bx-trash'></i></a>
                    </div>
                </div>
            </div>
                <?php }} else{  ?>
                    <div class="lomdata">There's no list, Lets make it!</div>
                <?php } ?>
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