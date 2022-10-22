//Selection box
var cb_count = 0, 
action_btn = document.getElementById("action_btns"), 
serialize, url = "root.php";
var selection_box = document.getElementsByClassName("selection_box");
for (var i=0; i < selection_box.length; i++) {
    selection_box[i].addEventListener('change', function(e) {
        e.target.checked ? cb_count++ : cb_count-- ;
        cb_count > 0 ? action_btn.style.right = "0" : action_btn.style.right = "-50%";
    });
}



//Detect select all checkboxes
$("#select_all").click(function(){
    if ($('input#select_all').is(':checked')) {
        $(':checkbox.selection_box').prop('checked', true); 
        cb_count = $('.selection_box').length;
    } else {
        $(':checkbox.selection_box').prop('checked', false);   
        cb_count = 0;
    }
    cb_count > 0 ? action_btn.style.right = "0" : action_btn.style.right = "-50%";
});
$('.selection_box').change(function(){
    cb_count = $('.selection_box').filter(':checked').length;
    if (cb_count == $('.selection_box').length){
        $('#select_all').prop('checked', true);   
    } else {
        $('#select_all').prop('checked', false);   
    }
});



//Create Inventory & add books
function Crud_Task(type){
    event.preventDefault();
    switch (type){
        case 1:
            type = "Task";
            operation = "create";
            break;
        case 2:
            type = "Task_display";
            operation = "delete";
            break;
        case 3:
            type = "Task_display";
            operation = "complete";
            break;
        case 4:
            type = "Task_display";
            operation = "incomplete";
            break;
        default:
            break;
    }
    serialize =  $("#" + type + "_form").serialize() +"&FormType="+type+"_"+operation;
    if (operation == "create") {$('#' + type + "_btn").text('Processing...');}
    $.ajax({
    type: "POST",
    url: url,
    data: serialize,
        success: function(message){
            if (operation == "create") {
                $('#' + type + "_btn").text('Add task');
            }
            if (message.match(/success:/g)){
                setTimeout(function(){$('body').load(window.location.href + '#body')}, 5000);
            }
            popup(message);
        }
    });
}



//Popup messages
function popup(message){
    var popup = document.createElement("div");
    popup.setAttribute("id","popup");
    popup.setAttribute("class","show");
    if (message.match(/success:/g)){ 
        popup.innerHTML = message.replace(/success:/g,"<i class='fa fa-check-circle-o'></i>");
        popup.classList.add("success");
    } else {
        popup.innerHTML = message.replace(/failure:/g,"<i class='fa fa-times-circle-o'></i>");
        popup.classList.add("failure");
    }
    document.body.appendChild(popup);
    setTimeout(function(){
            popup.className = popup.className.replace("show", "");
            popup.remove();
            }, 5000);
    return 1;
}


