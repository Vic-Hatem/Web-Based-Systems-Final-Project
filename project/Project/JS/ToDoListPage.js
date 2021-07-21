
$(document).ready(function () {

    $.ajax({
        type: "GET",
        url: 'Task_API/projector.php',
        success: function (response) {
            var res = response.split(",");
            for (var i = 0; i < res.length; i += 5) {
                if (i + 1 != res.length) {
                    var id = res[i];
                    var task = res[i + 1];
                    var username = res[i + 2];
                    var status = res[i + 3];
                    var duedate = res[i + 4];

                    projection(id, task, username, status, duedate);
                }
            }
        }
    });

    $(document).on("click", "#sortDate", function () {
        $.ajax({
            type: "GET",
            url: 'Task_API/sortDate.php',
            success: function (response) {
                var res = response.split(",");
                document.getElementById('tbl1').innerHTML = '';

                for (var i = 0; i < res.length; i += 5) {
                    if (i + 1 != res.length) {
                        var id = res[i];
                        var task = res[i + 1];
                        var username = res[i + 2];
                        var status = res[i + 3];
                        var duedate = res[i + 4];
                        projection(id, task, username, status, duedate);
                    }
                }
            }
        });
    });
    $(document).on("click", "#sortTask", function () {
        $.ajax({
            type: "GET",
            url: 'Task_API/sortTask.php',
            success: function (response) {
                var res = response.split(",");
                document.getElementById('tbl1').innerHTML = '';

                for (var i = 0; i < res.length; i += 5) {
                    if (i + 1 != res.length) {
                        var id = res[i];
                        var task = res[i + 1];
                        var username = res[i + 2];
                        var status = res[i + 3];
                        var duedate = res[i + 4];
                        projection(id, task, username, status, duedate);
                    }
                }
            }
        });
    });

    $("#groupcreateForm").submit(function (e) {
        e.preventDefault();

        $.ajax({
            type: "POST",
            url: 'Group_API/addtogroup.php',
            data: $(this).serialize() + "&admin=" + 1,
            async: true,
            success: function (response) {
                var jsonData = JSON.parse(response);
                if (jsonData.success == "1") {
                    console.log("Added Succesfully");
                }
                $.ajax({
                    type: "GET",
                    url: 'Group_API/groupprojectorall.php',
                    success: function (response) {
                        var res = response.split(",");
                        groupnames = [];
                        for (var i = 0; i < res.length; i += 1) {
                            if (i + 1 != res.length) {
                                groupnames.push(res[i]);
                            }
                        }
                        autocomplete(document.getElementById("group_name1"), groupnames);


                    }
                });
            }
        });
    });

    $("#groupjoinForm").submit(function (e) {
        e.preventDefault();

        $.ajax({
            type: "POST",
            url: 'Group_API/joingroup.php',
            data: $(this).serialize() + "&admin=" + 0,
            async: true,
            success: function (response) {
                var jsonData = JSON.parse(response);
                if (jsonData.success == "1") {
                    console.log("Added Succesfully");
                }
                else {
                    if (jsonData.success == "-1") {
                        alert("No Group By this name! try another one please.");
                    }
                }
            }
        });
    });

    $("#addTaskForm").submit(function (e) {
        e.preventDefault();

        $.ajax({
            type: "POST",
            url: 'Task_API/addtask.php',
            data: $(this).serialize(),
            async: true,

            success: function (response) {
                var jsonData = JSON.parse(response);
                if (jsonData.success == "1") {
                    $.ajax({
                        type: "GET",
                        url: 'Task_API/projector.php',
                        async: true,

                        success: function (response) {
                            var res = response.split(",");
                            document.getElementById('tbl1').innerHTML = '';

                            for (var i = 0; i < res.length; i += 5) {
                                if (i + 1 != res.length) {
                                    var id = res[i];
                                    var task = res[i + 1];
                                    var username = res[i + 2];
                                    var status = res[i + 3];
                                    var duedate = res[i + 4];
                                    projection(id, task, username, status, duedate);
                                }
                            }
                        }
                    });
                }

            }
        });
    });
    // row selection to edit/delete
    $(document).on("click", "#tbl1 tr", function () {


        $('.selected').removeClass('selected');

        $(this).addClass("selected");


        //Delete
        $(document).on("click", "#Delete", function () {
            let id = $('.selected').attr("data-id");

            var modal = document.getElementById('id01').style.display = 'block';
            // When the user clicks anywhere outside of the modal, close it
            window.onclick = function (event) {
                if (event.target == modal) {
                    modal.style.display = "none";
                }
            }
            $(document).on("click", "#deletefromarray", function (e) {
                let id = $('.selected').attr("data-id");
                e.preventDefault();
                $.ajax({
                    type: "POST",
                    url: 'Task_API/deletetask.php',
                    data: { "id": id },
                    async: true,
                    success: function (response) {
                        var jsonData = JSON.parse(response);
                        if (jsonData.success == "1") {
                            $.ajax({
                                type: "GET",
                                url: 'Task_API/projector.php',
                                async: false,

                                success: function (response) {
                                    var res = response.split(",");
                                    document.getElementById('tbl1').innerHTML = '';

                                    for (var i = 0; i < res.length; i += 5) {
                                        if (i + 1 != res.length) {
                                            var id = res[i];
                                            var task = res[i + 1];
                                            var username = res[i + 2];
                                            var status = res[i + 3];
                                            var duedate = res[i + 4];
                                            projection(id, task, username, status, duedate);
                                        }
                                    }
                                }
                            });
                        }
                        $('.selected').removeClass('selected');
                    }
                });

            });
        });





        //Edit
        $(document).on("click", "#Edit", function () {
            let id = $('.selected').attr("data-id");

            $("#editedDoneForm").submit(function (e) {
                let id = $('.selected').attr("data-id");
                e.preventDefault();
                $.ajax({
                    type: "POST",
                    url: 'Task_API/edittask.php',
                    data: $(this).serialize() + "&id=" + id,
                    async: true,
                    success: function (response) {
                        var jsonData = JSON.parse(response);
                        if (jsonData.success == "1") {
                            $.ajax({
                                type: "GET",
                                url: 'Task_API/projector.php',
                                async: true,
                                success: function (response) {
                                    var res = response.split(",");
                                    document.getElementById('tbl1').innerHTML = '';
                                    for (var i = 0; i < res.length; i += 5) {
                                        if (i + 1 != res.length) {
                                            var id = res[i];
                                            var task = res[i + 1];
                                            var username = res[i + 2];
                                            var status = res[i + 3];
                                            var duedate = res[i + 4];
                                            projection(id, task, username, status, duedate);
                                        }
                                    }
                                }
                            });

                        }
                        $('.selected').removeClass('selected');

                    }
                });
            });
        });









        $(document).on("click", ".checkbox", function (e) {
            let id = $('.selected').attr("data-id");
            //  כאן יתבצע פעולה לאלמנט שנוסף באופן דינמי אחרי שהמסמך כבר היהי מוכן
            e.preventDefault();
            if (this.checked) {
                $(this).parents("tr").children().css("text-decoration", "line-through");
                $(this).parents("tr").children().css("color", "green");
                $.ajax({
                    type: "POST",
                    url: 'Task_API/edit_status.php',
                    data: { "id": id, "status": 1 },
                    async: true,
                    success: function (response) {
                        var jsonData = JSON.parse(response);
                        if (jsonData.success == "1") {
                            $.ajax({
                                type: "GET",
                                url: 'Task_API/projector.php',
                                async: true,
                                success: function (response) {
                                    var res = response.split(",");
                                    document.getElementById('tbl1').innerHTML = '';
                                    for (var i = 0; i < res.length; i += 5) {
                                        if (i + 1 != res.length) {
                                            var id = res[i];
                                            var task = res[i + 1];
                                            var username = res[i + 2];
                                            var status = res[i + 3];
                                            var duedate = res[i + 4];
                                            projection(id, task, username, status, duedate);
                                        }
                                    }
                                }
                            });
                        }
                        $('.selected').removeClass('selected');
                    }
                });
            }
            else {
                $(this).parents("tr").children().css("text-decoration", "none");
                $(this).parents("tr").children().css("color", "black");
                $.ajax({
                    type: "POST",
                    url: 'Task_API/edit_status.php',
                    data: { "id": id, "status": 0 },
                    async: true,
                    success: function (response) {
                        var jsonData = JSON.parse(response);
                        if (jsonData.success == "1") {
                            $.ajax({
                                type: "GET",
                                url: 'Task_API/projector.php',
                                async: true,
                                success: function (response) {
                                    var res = response.split(",");
                                    document.getElementById('tbl1').innerHTML = '';
                                    for (var i = 0; i < res.length; i += 5) {
                                        if (i + 1 != res.length) {
                                            var id = res[i];
                                            var task = res[i + 1];
                                            var username = res[i + 2];
                                            var status = res[i + 3];
                                            var duedate = res[i + 4];
                                            projection(id, task, username, status, duedate);
                                        }
                                    }
                                }
                            });

                        }
                        $('.selected').removeClass('selected');
                    }
                });
            }
        });
    });
    // 
    function projection(id, task, username, status, duedate) {
        if (status == 1) {
            let tr1 = `
                <tr data-id=${id} style="text-decoration:line-through; color:green">
                    <td class="id">${id}</td>
                    <td class="task">${task}</td>
                    <td class="username">${username}</td>
                    <td><input  class="checkbox" type="checkbox" checked=true ></td>
                    <td class="duedate">${duedate}</td>
                </tr>`;
            $("#tbl1").append(tr1);
        }
        else {
            let tr1 = `
                <tr data-id=${id} style="text-decoration:none; color:black">
                    <td class="id">${id}</td>
                    <td class="task">${task}</td>
                    <td class="username">${username}</td>
                    <td><input  class="checkbox" type="checkbox" unchecked=true ></td>
                    <td class="duedate">${duedate}</td>
                </tr>`;
            $("#tbl1").append(tr1);
        }
    }
    function autocomplete(inp, arr) {
        /*the autocomplete function takes two arguments,
        the text field element and an array of possible autocompleted values:*/
        var currentFocus;
        /*execute a function when someone writes in the text field:*/
        inp.addEventListener("input", function (e) {
            var a, b, i, val = this.value;
            /*close any already open lists of autocompleted values*/
            closeAllLists();
            if (!val) { return false; }
            currentFocus = -1;
            /*create a DIV element that will contain the items (values):*/
            a = document.createElement("DIV");
            a.setAttribute("id", this.id + "autocomplete-list");
            a.setAttribute("class", "autocomplete-items");
            /*append the DIV element as a child of the autocomplete container:*/
            this.parentNode.appendChild(a);
            /*for each item in the array...*/
            for (i = 0; i < arr.length; i++) {
                /*check if the item starts with the same letters as the text field value:*/
                if (arr[i].substr(0, val.length).toUpperCase() == val.toUpperCase()) {
                    /*create a DIV element for each matching element:*/
                    b = document.createElement("DIV");
                    /*make the matching letters bold:*/
                    b.innerHTML = "<strong>" + arr[i].substr(0, val.length) + "</strong>";
                    b.innerHTML += arr[i].substr(val.length);
                    /*insert a input field that will hold the current array item's value:*/
                    b.innerHTML += "<input type='hidden' value='" + arr[i] + "'>";
                    /*execute a function when someone clicks on the item value (DIV element):*/
                    b.addEventListener("click", function (e) {
                        /*insert the value for the autocomplete text field:*/
                        inp.value = this.getElementsByTagName("input")[0].value;
                        /*close the list of autocompleted values,
                        (or any other open lists of autocompleted values:*/
                        closeAllLists();
                    });
                    a.appendChild(b);
                }
            }
        });
        /*execute a function presses a key on the keyboard:*/
        inp.addEventListener("keydown", function (e) {
            var x = document.getElementById(this.id + "autocomplete-list");
            if (x) x = x.getElementsByTagName("div");
            if (e.keyCode == 40) {
                /*If the arrow DOWN key is pressed,
                increase the currentFocus variable:*/
                currentFocus++;
                /*and and make the current item more visible:*/
                addActive(x);
            } else if (e.keyCode == 38) { //up
                /*If the arrow UP key is pressed,
                decrease the currentFocus variable:*/
                currentFocus--;
                /*and and make the current item more visible:*/
                addActive(x);
            } else if (e.keyCode == 13) {
                /*If the ENTER key is pressed, prevent the form from being submitted,*/
                e.preventDefault();
                if (currentFocus > -1) {
                    /*and simulate a click on the "active" item:*/
                    if (x) x[currentFocus].click();
                }
            }
        });
        function addActive(x) {
            /*a function to classify an item as "active":*/
            if (!x) return false;
            /*start by removing the "active" class on all items:*/
            removeActive(x);
            if (currentFocus >= x.length) currentFocus = 0;
            if (currentFocus < 0) currentFocus = (x.length - 1);
            /*add class "autocomplete-active":*/
            x[currentFocus].classList.add("autocomplete-active");
        }
        function removeActive(x) {
            /*a function to remove the "active" class from all autocomplete items:*/
            for (var i = 0; i < x.length; i++) {
                x[i].classList.remove("autocomplete-active");
            }
        }
        function closeAllLists(elmnt) {
            /*close all autocomplete lists in the document,
            except the one passed as an argument:*/
            var x = document.getElementsByClassName("autocomplete-items");
            for (var i = 0; i < x.length; i++) {
                if (elmnt != x[i] && elmnt != inp) {
                    x[i].parentNode.removeChild(x[i]);
                }
            }
        }
        /*execute a function when someone clicks in the document:*/
        document.addEventListener("click", function (e) {
            closeAllLists(e.target);
        });
    }

});


