<?php require_once("parts/header.php");?>
<?php session_start();?>
<?php
require_once("db.php");

$sql1="SELECT * FROM Assignments";
$result1=mysqli_query($conn,$sql1);
$tasks=array();
while($row=mysqli_fetch_assoc($result1)){
    $tasks[]=$row;
}
?>


<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
    <link rel="stylesheet" href="ToDoListPage.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.rtl.min.css"
        integrity="sha384-trxYGD5BY4TyBTvU5H23FalSCYwpLA0vWEvXXGm5eytyztxb+97WzzY+IWDOSbav" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"
        integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="ToDoListPage.js" ></script>

</head>

<body>
    <a type="button" id="addTask" class="btn" data-bs-toggle="modal" data-bs-target="#exampleModal">Add Task</a>
    <br><br>
    <div class="container">
        <table id="tbl" class="table table-Light table-striped table-hover">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Task</th>
                    <th>Username</th>
                    <th>Status</th>
                    <th>DueDate</th>
                </tr>
            </thead>
            <tbody id="tbl1">

            </tbody>
        </table>
        <br>
    </div>
    <h3 style="text-align: center;">Select The Row You Want First And Choose One Of Theese Functions :
    </h3>

    <div style="text-align: left; margin-left: 35%;">
        <button class="button" id="Edit" data-bs-toggle="modal" data-bs-target="#editModal">Edit</button>
        <button class="button" id="Delete">Delete</button>
        <button class="button" id="Forum">Forum</button>
    </div>
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add Task</h5>
                    <button type="button" id="closeme_Add" class="btn-close" data-bs-dismiss="modal" aria-label="Close" style="margin-left:350px;"></button>
                </div>
                <form method="POST" id="addTaskForm" autocomplete="on" >
                    <div class="modal-body">
                        <label for="username1" class="form-label">Username</label>
                        <input type="text" class="form-control" id="username1" name="username1">
                        <div class="autocomplete" style="width:467px;">
                            <label for="task" class="form-label">Task</label>
                            <input type="text" class="form-control" id="task" name="task">
                        </div>
                        <label for="dueDate" class="form-label">Due Date</label>
                        <input type="text" class="form-control" id="duedate" name="duedate">
                        <br>
                        <input type="submit"  name="addTask" id="addTask" onclick="document.getElementById('closeme_Add').click()" "value="Add"/>
                    </div>
                </form>
            </div>
        </div>
    </div>


    <div id="id01" class="modal">
        <span onclick="document.getElementById('id01').style.display='none'" class="close"
            title="Close Modal">&times;</span>
        <form class="modal-content" action="/action_page.php">
            <div class="container">
                <h1>Delete Task</h1>
                <p>Are you sure you want to delete this Task?</p>

                <div class="clearfix">
                    <button type="button" class="cancelbtn"
                        onclick="document.getElementById('id01').style.display='none'">Cancel</button>
                    <button type="button" class="deletebtn" id="deletefromarray"
                        onclick="document.getElementById('id01').style.display='none'">Delete</button>
                </div>
            </div>
        </form>
    </div>

    <div class="modal" id="editModal">
        
        <div class="modal-dialog">
            <div class="modal-content" >
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Task</h5>
                    <button type="button" id="closeme_Edit"class="btn-close" data-bs-dismiss="modal" aria-label="Close" style="margin-left:350px;"></button>
                </div>
                <form method="POST" id="editedDoneForm" action="/action_page.php">
                    <div class="modal-body">
                        <label for="username11" class="form-label">Username</label>
                        <input type="text" class="form-control" id="username11" name="username11">
                        <div class="autocomplete" style="width:467px;">
                            <label for="task1" class="form-label">Task</label>
                            <input type="text" class="form-control" id="task1" name="task1">
                        </div>
                        <label for="duedate1" class="form-label">Due Date</label>
                        <input type="text" class="form-control" id="duedate1" name="duedate1">
                        <br>
                        <input type="submit" name="editedDone" id="editedDone" onclick="document.getElementById('closeme_Edit').click()" value="Done">

                    </div>
                </form>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0"
        crossorigin="anonymous"></script>
</body>
<?php require_once("parts/footer.php");?>
