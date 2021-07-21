<?php 
require_once("Parts/header.php");
session_start();
require_once("db.php");

?>


<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="ToDoListPage.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
    
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.rtl.min.css"
        integrity="sha384-trxYGD5BY4TyBTvU5H23FalSCYwpLA0vWEvXXGm5eytyztxb+97WzzY+IWDOSbav" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"
        integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>

    <script src="JS/ToDoListPage.js" ></script>

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
        <button  id="sortDate" name="sortDate">Sort By Date</button>
        
        <br>
        <br>
        <button id="sortTask" name="sortTask" class="">Sort By Task</button>
        <br>
    </div>
    <div style="text-align: left; margin-left: 25%;" class="container">
    <div class="col-6">
    <h3 id="ttl-1">Select Row To </h3>
    <br>
    <button class="button" id="Edit" data-bs-toggle="modal" data-bs-target="#editModal">Edit</button>
    <button class="button" id="Delete">Delete</button>
    </div>
    

    <div style="text-align: left; margin-left: 35%; margin-top:-19%;" class="col-6">
    <h3 id="ttl-1">You Can Also </h3>
<br>
        <a href="Group.php">
        <button class="button" id="Group" action="Group.php">View Groups Page</button>
        </a>
        <br>
        <br>
        <button class="button" id="creatGroup" data-bs-toggle="modal" data-bs-target="#groupcreateModal">Create Group</button>
        <br>
        <br>
        <button class="button" id="joinGroup" data-bs-toggle="modal" data-bs-target="#groupjoinModal">Join a Group</button>

    </div>
    </div>
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add Task</h5>
                    <button type="button" id="closeme_Add" class="btn-close" data-bs-dismiss="modal" aria-label="Close" style="margin-left:350px;"></button>
                </div>
                <div id="example">
                    <form method="POST" id="addTaskForm" autocomplete="on" >
                    <div class="modal-body" >
                        <label for="username1" class="form-label">Username</label>
                        <input type="text" class="form-control" id="username1" name="username1" v-model="username">
                        <div class="autocomplete" style="width:467px;">
                            <label for="task" class="form-label">Task</label>
                            <input type="text" class="form-control" id="task" name="task" v-model="task">
                        </div>
                        <label for="dueDate" class="form-label">Due Date</label>
                        <input type="text" class="form-control" id="duedate" name="duedate" v-model="duedate">
                        <br>
                        <input type="submit"  name="addTask" id="add_Task" onclick="document.getElementById('closeme_Add').click()" style="background-color: #fae2b2bb;
    color: black;
    border-radius: 10%;
    border-color: rgba(0, 0, 0, 0.658);" value="Add"/>
                    </div>
                </form>
                <div class="table-responsive my-4">
                    <h5 class="text" style="margin-left:2%; font-weight:bold;">Preview</h5>
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th class="col-4">Task</th>
                                <th class="col-4">Username</th>
                                <th class="col-4">DueDate</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td id="task_vue" class="text-wrap">{{task}}</td>
                                <td id="username_vue" class="text-wrap">{{username}}</td>

                                <td id="duedate_vue" class="text-wrap">{{duedate}}</td>

                            </tr>
                        </tbody>

                    </table>
                </div>
                </div>
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
                        
                        <input type="submit" name="editedDone" id="editedDone" onclick="document.getElementById('closeme_Edit').click()" style="background-color: #fae2b2bb;
    color: black;
    border-radius: 10%;
    border-color: rgba(0, 0, 0, 0.658);" value="Done">

                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="modal" id="groupcreateModal">
        
        <div class="modal-dialog">
            <div class="modal-content" >
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Create</h5>
                    <button type="button" id="closeme_group"class="btn-close" data-bs-dismiss="modal" aria-label="Close" style="margin-left:350px;"></button>
                </div>
                <form method="POST" id="groupcreateForm">
                    <div class="modal-body">
                            <label for="group_name" class="form-label">Group Name</label>
                            <input type="text" class="form-control" id="group_name" name="group_name">

                        <br>
                        <br>                 
                        <input type="submit" name="GroupNameDone" id="GroupNameDone" onclick="document.getElementById('closeme_group').click()" style="background-color: #fae2b2bb;
    color: black;
    border-radius: 10%;
    border-color: rgba(0, 0, 0, 0.658);" value="Done">
                        
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="modal" id="groupjoinModal">
        
        <div class="modal-dialog">
            <div class="modal-content" >
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Join</h5>
                    <button type="button" id="closeme_groupj"class="btn-close" data-bs-dismiss="modal" aria-label="Close" style="margin-left:350px;"></button>
                </div>
                <form method="POST"  autocomplete="off" id="groupjoinForm">
                    <div class="modal-body">
                        <div class="autocomplete">
                            <label for="group_name1" class="form-label">Group Name</label>
                            <input type="text" class="form-control" id="group_name1" name="group_name1">
                        </div>
                        <br>
                        <br>                 
                        <input type="submit" name="GroupNameDonej" id="GroupNameDonej" onclick="document.getElementById('closeme_groupj').click()" style="background-color: #fae2b2bb;
    color: black;
    border-radius: 10%;
    border-color: rgba(0, 0, 0, 0.658);" value="Done">
                        
                    </div>
                </form>
            </div>
        </div>
    </div>
    
    <script >
    

        new Vue({
            el:"#example",
            data() {
                return {
                    username: "",
                    task: "",
                    duedate: ""
                }
            }
        })
    </script>
</body>
<?php require_once("Parts/footer.php");?>
