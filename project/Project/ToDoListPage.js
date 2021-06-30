$( document ).ready(function() {
        $.ajax({
            type:"GET",
            url:'api/projector.php',
            success:function (response){
                var res=response.split(",");
                for(var i=0;i<res.length;i+=5){
                    if(i+1!=res.length){
                        var id=res[i];
                        var task=res[i+1];
                        var username=res[i+2];
                        var status=res[i+3];
                        var duedate=res[i+4];
                        projection(id,task,username,status,duedate);

                    }
                }
            }
        });

    
        $("#addTaskForm").submit(function(e){
            e.preventDefault();
    
            $.ajax({
                type:"POST",
                url:'api/addtask.php',
                data:$(this).serialize(),
                async:true,
                success: function (response){
                    var jsonData = JSON.parse(response);
                    if(jsonData.success=="1"){
                        $.ajax({
                            type:"GET",
                            url:'api/projector.php',
                            async: true,
                
                            success:function (response){
                                var res=response.split(",");
                                document.getElementById('tbl1').innerHTML = '';
    
                                for(var i=0;i<res.length;i+=5){
                                    if(i+1!=res.length){
                                        var id=res[i];
                                        var task=res[i+1];
                                        var username=res[i+2];
                                        var status=res[i+3];
                                        var duedate=res[i+4];
                                        projection(id,task,username,status,duedate);
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
        let id=$('.selected').attr("data-id");

        var modal = document.getElementById('id01').style.display = 'block';
        // When the user clicks anywhere outside of the modal, close it
        window.onclick = function (event) {
            if (event.target == modal) {
                modal.style.display = "none";
            }
        }
        $(document).on("click", "#deletefromarray", function (e) {
            let id=$('.selected').attr("data-id");
            e.preventDefault();
            $.ajax({
                type: "POST",
                url: 'api/deletetask.php',
                data:{"id":id},
                async:true,
                success: function(response)
                {
                    var jsonData = JSON.parse(response);
                    if (jsonData.success == "1")
                    {   
                        $.ajax({
                            type:"GET",
                            url:'api/projector.php',
                            async: false,
            
                            success:function (response){
                                var res=response.split(",");
                                document.getElementById('tbl1').innerHTML = '';

                                for(var i=0;i<res.length;i+=5){
                                    if(i+1!=res.length){
                                        var id=res[i];
                                        var task=res[i+1];
                                        var username=res[i+2];
                                        var status=res[i+3];
                                        var duedate=res[i+4];
                                        projection(id,task,username,status,duedate);
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
    $(document).on("click","#Edit",function(){ 
        let id=$('.selected').attr("data-id");
   
        $("#editedDoneForm").submit(function(e){
            let id=$('.selected').attr("data-id");
            e.preventDefault();
            $.ajax({
                type:"POST",
                url:'api/edittask.php',
                data:$(this).serialize()+"&id="+id,
                async:true,
                success:function (response){
                    var jsonData = JSON.parse(response);
                    if(jsonData.success=="1"){
                        $.ajax({
                            type:"GET",
                            url:'api/projector.php',
                            async:true,
                            success:function (response){
                                var res=response.split(",");
                                document.getElementById('tbl1').innerHTML = '';
                                for(var i=0;i<res.length;i+=5){
                                    if(i+1!=res.length){
                                        var id=res[i];
                                        var task=res[i+1];
                                        var username=res[i+2];
                                        var status=res[i+3];
                                        var duedate=res[i+4];
                                        projection(id,task,username,status,duedate);   
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
             
            
            let id=$('.selected').attr("data-id");
        //  כאן יתבצע פעולה לאלמנט שנוסף באופן דינמי אחרי שהמסמך כבר היהי מוכן
            e.preventDefault();
            if (this.checked) {
                $(this).parents("tr").children().css("text-decoration", "line-through");
                $(this).parents("tr").children().css("color", "green");
                $.ajax({
                    type:"POST",
                    url:'api/edit_status.php',
                    data:{"id":id,"status":1},
                    async:true,

                    success:function (response){
                    
                        var jsonData = JSON.parse(response);
                        if(jsonData.success=="1"){
                            $.ajax({
                                type:"GET",
                                url:'api/projector.php',
                                async:true,

                                success:function (response){
                                    var res=response.split(",");
                                    document.getElementById('tbl1').innerHTML = '';
                                    for(var i=0;i<res.length;i+=5){
                                        if(i+1!=res.length){
                                            var id=res[i];
                                            var task=res[i+1];
                                            var username=res[i+2];
                                            var status=res[i+3];
                                            var duedate=res[i+4];
                                            projection(id,task,username,status,duedate);

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
                    type:"POST",
                    url:'api/edit_status.php',
                    data:{"id":id,"status":0},
                    async:true,
                    success:function (response){
                    
                        var jsonData = JSON.parse(response);
                        if(jsonData.success=="1"){
                            $.ajax({
                                type:"GET",
                                url:'api/projector.php',
                                async:true,

                                success:function (response){
                                    var res=response.split(",");
                                    document.getElementById('tbl1').innerHTML = '';
                                    for(var i=0;i<res.length;i+=5){
                                        if(i+1!=res.length){
                                            var id=res[i];
                                            var task=res[i+1];
                                            var username=res[i+2];
                                            var status=res[i+3];
                                            var duedate=res[i+4];
                                            projection(id,task,username,status,duedate);
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
    function projection(id,task,username,status,duedate){
        if(status==1){
            let tr1=`
                <tr data-id=${id} style="text-decoration:line-through; color:green">
                    <td class="id">${id}</td>
                    <td class="task">${task}</td>
                    <td class="username">${username}</td>
                    <td><input  class="checkbox" type="checkbox" checked=true ></td>
                    <td class="duedate">${duedate}</td>
                </tr>`;
            $("#tbl1").append(tr1);
        }
        else{
            let tr1=`
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
});
