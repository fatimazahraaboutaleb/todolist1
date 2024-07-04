<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="todo.css">
    <script src="todo.js"></script>
</head>
<body>
    <?php
        $conn = new PDO("mysql:host=localhost; dbname=todolist", "root", "");
        $query=$conn->query("SELECT * FROM list");
        $rows=$query->fetchAll(PDO::FETCH_OBJ);

        if(@$_GET["action"]=="add"){
            $task=@$_GET["task"];
            $query=$conn->prepare("INSERT INTO list(task) VALUES(?)");
            $query->execute([$task]);
            header("Location: todo.php");
        }
        if(@$_GET["action"]=="delete"){
            $num=@$_GET["num"];
            $query=$conn->prepare("DELETE FROM list WHERE num=?");
            $query->execute([$num]);
            header("Location: todo.php");
        }
        
        
        
    ?>
<div class="all">
    <div class="header">
    <h2>to-do list</h2>
    <form action="" class="add">
        <input type="hidden" name="action" value="add">
        <input type="text" name="task" placeholder="write here!">
        <button>add</button>
    </form>
    </div>
    <div class="tasks">
        <?php foreach($rows as $row):?>
            <div class="task">
                <input type="checkbox" class="check" class="checkbox" name="check">
                <h3 class="task-text"><?=$row->task;?></h3>
                <div class="others">
                    <p><?= $row->date;?></p>
                    <form action="edit.php">
                        <input type="hidden" name="num" value="<?= $row->num;?>">
                        <button class="edit-btn" name="edit">edit</button>
                    </form>
                    <form action="">
                        <input type="hidden" name="num" value="<?= $row->num;?>">
                        <input type="hidden" name="action" value="delete">
                        <button class="close"><img src="close.png" alt=""></button>
                    </form>
                </div>
            </div>
            
        <?php endforeach;?>
        
    </div>
</div>
</body>
</html>