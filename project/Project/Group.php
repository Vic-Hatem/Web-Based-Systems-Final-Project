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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
    <link rel="stylesheet" href="Group.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.rtl.min.css" integrity="sha384-trxYGD5BY4TyBTvU5H23FalSCYwpLA0vWEvXXGm5eytyztxb+97WzzY+IWDOSbav" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>
    <script src="JS/Group.js"></script>

</head>

<body>
    <br>
    <h2 style="text-align: center;">Groups To Share List With</h2>
    <br><br>
    <div class="container">
    <h3 id="ttl-2" style="color:#024e4e; margin-right:80%;
  font-weight: 700;">Select Group</h3>
        <table id="tbl33" class="table table-Light table-striped table-hover">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>GroupName</th>
                </tr>
            </thead>
            <tbody id="tbl3">

            </tbody>
        </table>
        <br><br>
        <h3 id="ttl-2" style="color:#024e4e; margin-right:70%;
  font-weight: 700;">Tasks Shared With The Group</h3>
        <table id="tbl" class="table table-Light table-striped table-hover">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Task</th>
                    <th>Username</th>
                    <th>Status</th>
                    <th>DueDate</th>
                    <th>GroupName</th>
                </tr>
            </thead>
            <tbody id="tbl1">

            </tbody>
        </table>
        <br><br>
        <h3 id="ttl-2" style="color:#024e4e; margin-right:85%;
  font-weight: 700;">Group Details</h3>
        <table id="tbl22" class="table table-Light table-striped table-hover">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Email</th>
                    <th>GroupName</th>
                    <th>Admin</th>
                </tr>
            </thead>
            <tbody id="tbl2">

            </tbody>
        </table>

        <br>
    </div>
    <br>
    <a type="button" id="addTask" class="btn" data-bs-toggle="modal" data-bs-target="#exampleModal" style="margin-left:40%;">Add Task</a>
    <br>
    <br>
    <a type="button" id="addMyTasks" class="btn" style="margin-left:40%;">Add My Tasks</a>
    <br>
    <br>
    <br>
    <h3 id="ttl-1">Select Row To </h3> 
<br>
    <div style="text-align: left; margin-left: 35%;">
        <button class="button" id="Edit" data-bs-toggle="modal" data-bs-target="#editModal">Edit</button>
        <button class="button" id="Delete">Delete</button>
    </div>


    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add Task</h5>
                    <button type="button" id="closeme_Add" class="btn-close" data-bs-dismiss="modal" aria-label="Close" style="margin-left:350px;"></button>
                </div>
                <div id="example">
                    <form method="POST" id="addGroupForm" autocomplete="on">
                        <div class="modal-body">
                            <label for="username11" class="form-label">Username</label>
                            <input type="text" class="form-control" id="username11" name="username11" v-model="username">

                            <div class="autocomplete" style="width:467px;">
                                <label for="task" class="form-label">Task</label>
                                <input type="text" class="form-control" id="task" name="task" v-model="task">
                            </div>
                            <label for="dueDate" class="form-label">Due Date</label>
                            <input type="text" class="form-control" id="duedate" name="duedate" v-model="duedate">
                            <br>
                            <input type="submit" name="addTask" id="add_Task" onclick="document.getElementById('closeme_Add').click()" value="Create" />
                        </div>
                    </form>
                    <div class="table-responsive my-4">
                        <h5 class="text" style="margin-left:2%; font-weight:bold;">Preview</h5>
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th class="col-3">Task</th>
                                    <th class="col-3">Username</th>
                                    <th class="col-3">DueDate</th>
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
        <span onclick="document.getElementById('id01').style.display='none'" class="close" title="Close Modal">&times;</span>
        <form class="modal-content" action="/action_page.php">
            <div class="container">
                <h1>Delete Task</h1>
                <p>Are you sure you want to delete this Task?</p>

                <div class="clearfix">
                    <button type="button" class="cancelbtn" onclick="document.getElementById('id01').style.display='none'">Cancel</button>
                    <button type="button" class="deletebtn" id="deletefromarray" onclick="document.getElementById('id01').style.display='none'">Delete</button>
                </div>
            </div>
        </form>
    </div>

    <div class="modal" id="editModal">

        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Task</h5>
                    <button type="button" id="closeme_Edit" class="btn-close" data-bs-dismiss="modal" aria-label="Close" style="margin-left:350px;"></button>
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
    <div class="modal" id="groupModal">

        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Display</h5>
                    <button type="button" id="closeme_group" class="btn-close" data-bs-dismiss="modal" aria-label="Close" style="margin-left:350px;"></button>
                </div>
                <form method="POST" autocomplete="off" id="groupForm">
                    <div class="modal-body">
                        <div class="autocomplete" style="width:467px;">
                            <label for="group_name2" class="form-label">Group Name</label>
                            <input type="text" class="form-control" id="group_name2" name="group_name2">
                        </div>

                        <br>
                        <br>


                        <input type="submit" name="GroupNameShow" id="GroupNameShow" onclick="document.getElementById('closeme_group').click()" style="background-color: #fae2b2bb;
    color: black;
    border-radius: 10%;
    border-color: rgba(0, 0, 0, 0.658);" value="Done">

                    </div>
                </form>
            </div>
        </div>
    </div>
    <script>
        new Vue({
            el: "#example",
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
<?php require_once("Parts/footer.php"); ?>