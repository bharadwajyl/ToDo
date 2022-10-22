<?php
//Check the type of the form posted
switch ($_POST["FormType"]) {
        case "Task_create": case "Task_display_delete": case "Task_display_complete": case "Task_display_incomplete":
            Task::Crud(''.$_POST['FormType'].'');
            break;
        default:
            require_once '404.html';
            break;
}

//Class Task
class   Task{
    public function Crud($type){
        try {
            require("db.php");
            include("Crud.php");
        }
        catch(Exception $e) {
            echo 'Message: ' .$e->getMessage();
        }
    }
}
?>
