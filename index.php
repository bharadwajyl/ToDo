<?php
require("db.php");
//Variables
$list_count = 0;
//Fetch all Inventory details
$sql = "SELECT * FROM Task ORDER BY id DESC";
$list = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en-US">
<head>

<!--Title-->
<title>Todo</title>

<!--Shortcut Icon-->
<link rel="shortcut icon" href="images/#">

<!--Meta Tags-->
<meta charset="UTF-8">
<meta name="language" content="ES">
<meta content="IE=edge,chrome=1" http-equiv="X-UA-Compatible"/>
<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">

<!--FONT AWESOME-->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

<!--PLUGIN-->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>

<!--StyleSheet-->
<link rel="stylesheet" href="assets/css/main.css">
<link rel="stylesheet" href="assets/css/home.css">
</head>
<body class="animate-bottom" id="body">

<!--Main-->
<main>
    <form class="flex" id="Task_form">
        <input type="text" name="task" maxlength="200">
        <button class="btn btn1" id="Task_btn" onclick="Crud_Task(1)">Add task</button>
    </form>
    <section>
        <form id="Task_display_form">
            <table>
                <tr>
                    <th><input type="checkbox" id="select_all"></th>
                    <th>Slno.</th>
                    <th>Task</th>
                    <th>Status.</th>
                </tr>
                <?php
            if ($list->num_rows > 0) {
                while($row = $list->fetch_assoc()) {
                    $list_count++;
                    $row["status"] == "1" ? $status = '<i class="fa fa-check-circle-o"></i>' : $status ='<i class="fa fa-times-circle-o"></i>';
                    echo '
                        <tr>
                            <td><input type="checkbox" name="Task_action[]" value="'.$row["id"].'" class="selection_box"></td>
                            <td>'.$list_count.'</td>
                            <td>'.$row["task"].'</td>
                            <td>'.$status.'</td>
                        </tr>
                        
                    ';
                }
            } else {
                echo '
                    <tr>
                        <td></td>
                        <td>0</td>
                        <td>No Tasks Created</td>
                        <td class="tooltip">
                            <span class="tooltiptext">Add task to the DB</span>
                            <i class="fa fa-question-circle-o"></i>
                        </td>
                    </tr>
                ';
            }
            ?>
            </table>
        </form>
    </section>
</main>

<!--Actions-->
<div class="action" id="action_btns">
    <a href="javascript:{}" title="Delete" onclick="Crud_Task(2)"><i class="fa fa-trash"></i></a>
    <a href="javascript:{}" title="Completed" onclick="Crud_Task(3)"><i class="fa fa-check"></i></a>
    <a href="javascript:{}" title="Incomplete" onclick="Crud_Task(4)"><i class="fa fa-times"></i></a>
</div>

<!--JQUERY PLUGIN-->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
<!--Javascript-->
<script type="text/javascript" src="assets/js/main.js"></script>
</body>
</html>
