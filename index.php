<?php
    $db = mysqli_connect("127.0.0.1:4306", "root", "", "todo");
    if (isset($_POST['submit'])) {	
			$task = $_POST['task'];
            $priority = $_POST['priority'];
			$sql = "INSERT INTO tasks(priority, taskname, status) VALUES ('$priority', '$task', 'incomplete')";
			mysqli_query($db, $sql);
			header('location: index.php');
    }

    if (isset($_GET['del_task'])) {
        $id = $_GET['del_task'];

        mysqli_query($db, "DELETE FROM tasks WHERE id=".$id);
        header('location: index.php');
    }

    if (isset($_GET['mark_task'])) {
        $id = $_GET['mark_task'];

        mysqli_query($db, "UPDATE tasks set status = 'complete' WHERE id=".$id);
        header('location: index.php');
    }

    if (isset($_GET['unmark_task'])) {
        $id = $_GET['unmark_task'];

        mysqli_query($db, "UPDATE tasks set status = 'incomplete' WHERE id=".$id);
        header('location: index.php');
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <title>To-Do List</title>
</head>
<body>

    <div class="container">
        <h1>To-Do List</h1>
        <form id="todo-form" action="index.php" method="post">
            <input type="text" id="task" placeholder="Add a new task" name="task" required>
            <select id="priority" name="priority" required>
                <option value="" disabled selected>Select priority</option>
                <option value="Low">Low</option>
                <option value="Medium">Medium</option>
                <option value="High">High</option>
            </select>
            <button class = "add-task" type="submit" name="submit">Add Task</button>
        </form>

        <table style="margin-top: 50px;">
            <thead>
                    <tr>
                        <th class="priority">Priority</th>
                        <th class="task">Tasks</th>
                        <th class="delete">Action</th>
                    </tr>
            </thead>

            <tbody>

                <?php 
                    for ($x = 1; $x <= 3; $x++) {
                        $tasks = mysqli_query($db, "SELECT * FROM tasks");

                        while ($row = mysqli_fetch_array($tasks)) { 

                            if($row['status'] == 'complete') {
                                continue;
                            }
                            if($x == 1 and $row['priority'] == "High") { ?>
                                <tr>
                                    <td class="priority"> <?php echo $row['priority']; ?> </td>
                                    <td class="task"> <?php echo $row['taskname']; ?> </td>
                                    <td class="delete"> 
                                        <a title="Mark completed" id="status" href="index.php?mark_task=<?php echo $row['id'] ?>"><i class="fa fa-minus-square-o"></i></a>
                                        <a title="Delete" id="close" href="index.php?del_task=<?php echo $row['id'] ?>">x</a>   
                                    </td>
                                </tr>
                            <?php }
                            else if($x == 2 and $row['priority'] == "Medium") { ?>
                                <tr>
                                    <td class="priority"> <?php echo $row['priority']; ?> </td>
                                    <td class="task"> <?php echo $row['taskname']; ?> </td>
                                    <td class="delete"> 
                                        <a title="Mark completed" id="status" href="index.php?mark_task=<?php echo $row['id'] ?>"><i class="fa fa-minus-square-o"></i></a>
                                        <a title="Delete" id="close" href="index.php?del_task=<?php echo $row['id'] ?>">x</a> 
                                    </td>
                                </tr>
                            <?php }
                            else if($x == 3 and $row['priority'] == "Low") { ?>
                                <tr>
                                    <td class="priority"> <?php echo $row['priority']; ?> </td>
                                    <td class="task"> <?php echo $row['taskname']; ?> </td>
                                    <td class="delete"> 
                                        <a title="Mark completed" id="status" href="index.php?mark_task=<?php echo $row['id'] ?>"><i class="fa fa-minus-square-o"></i></a>
                                        <a title="Delete" id="close" href="index.php?del_task=<?php echo $row['id'] ?>">x</a> 
                                    </td>
                                </tr>
                            <?php }
                        }
                    } 
                ?>

            </tbody>
        </table>
        
        <hr>

        <table class="marked"> 
            <tbody>

                <?php 
                    for ($x = 1; $x <= 3; $x++) {
                        $tasks = mysqli_query($db, "SELECT * FROM tasks");

                        while ($row = mysqli_fetch_array($tasks)) { 

                            if($row['status'] == 'incomplete') {
                                continue;
                            }
                            if($x == 1 and $row['priority'] == "High") { ?>
                                <tr>
                                    <td class="priority"> <?php echo $row['priority']; ?> </td>
                                    <td class="task"> <?php echo $row['taskname']; ?> </td>
                                    <td class="delete"> 
                                        <a title="Mark incomplete" id="status" href="index.php?unmark_task=<?php echo $row['id'] ?>"><i class="fa fa-minus-square"></i></a>
                                        <a title="Delete" id="close" href="index.php?del_task=<?php echo $row['id'] ?>">x</a>   
                                    </td>
                                </tr>
                            <?php }
                            else if($x == 2 and $row['priority'] == "Medium") { ?>
                                <tr>
                                    <td class="priority"> <?php echo $row['priority']; ?> </td>
                                    <td class="task"> <?php echo $row['taskname']; ?> </td>
                                    <td class="delete"> 
                                        <a title="Mark incomplete" id="status" href="index.php?unmark_task=<?php echo $row['id'] ?>"><i class="fa fa-minus-square"></i></a>
                                        <a title="Delete" id="close" href="index.php?del_task=<?php echo $row['id'] ?>">x</a> 
                                    </td>
                                </tr>
                            <?php }
                            else if($x == 3 and $row['priority'] == "Low") { ?>
                                <tr>
                                    <td class="priority"> <?php echo $row['priority']; ?> </td>
                                    <td class="task"> <?php echo $row['taskname']; ?> </td>
                                    <td class="delete"> 
                                        <a title="Mark incomplete" id="status" href="index.php?unmark_task=<?php echo $row['id'] ?>"><i class="fa fa-minus-square"></i></a>
                                        <a title="Delete" id="close" href="index.php?del_task=<?php echo $row['id'] ?>">x</a> 
                                    </td>
                                </tr>
                            <?php }
                        }
                    } 
                ?>

            </tbody>
        </table>


    </div>
</body>
</html>