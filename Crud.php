<?php
switch ($type){
    case "Task_create":
        //Variable
        $task = $_POST['task'];
        //Check for input field & replace all special characters except space
        $task == "" ? die(print("failure: Blank fields not allowed")) : $task = trim($task,'\'"');
        //Create new Inventory
        $conn->query("INSERT INTO Task (task, status) VALUES ('$task', '1')") === TRUE ? print("success: Task Created") :
        die(print("failure: Please try again"));
        break;
    case "Task_display_delete":
        strpos($type, "Task") !== false ? $table = "Task" : $table = "";
        foreach ($_POST[''.$table.'_action'] as $task){
            //Delete Inventory & Books
            $conn->query("DELETE FROM $table WHERE id = $task")  === TRUE ? $message = "success: Deletion successfull" :
            $message = "failure: Error occured";
        }
        print($message);
        break;
    case "Task_display_complete": case "Task_display_incomplete":
        strpos($type, "Task") !== false ? $table = "Task" : $table = "";
        strpos($type, "incomplete") !== false ? $status = "0" : $status = "1";
        foreach ($_POST[''.$table.'_action'] as $task){
            //Delete Inventory & Books
            $conn->query("UPDATE $table set status = '$status' WHERE id = $task")  === TRUE ? $message = "success: Status changed" :
            $message = "failure: Error occured";
        }
        print($message);
        break;
    default:
        require_once '404.html';
        break;
}
?>
