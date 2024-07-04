<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="todo.css">
    <title>Document</title>
</head>
<body>
    <?php
    $conn = new PDO("mysql:host=localhost; dbname=todolist", "root", "");
    if(@$_POST["action"]=="edit"){
        $num=@$_GET["num"];
        $task=@$_POST["task-edit"];
        $query=$conn->prepare("UPDATE list SET task=? WHERE num=?");
        $query->execute([$task,$num]);
        header("Location: todo.php");
    }
    $num=@$_GET["num"];
    $query=$conn->prepare("SELECT * FROM list WHERE num=?");
    $query->execute([$num]);
    $task=$query->fetch(PDO::FETCH_OBJ);
    ?>
    <div class="tasks">
    <div class="edit">
        <form action="" method="POST">
            <input type="text" name="task-edit" class="input-edit" value="<?= $task->task;?>" >
            <input type="hidden" name="action" value="edit">
            <button>save</button>
        </form>
        <form action="todo.php">
            <button>cancel</button>
        </form>
    </div>
    </div>
</body>
</html>