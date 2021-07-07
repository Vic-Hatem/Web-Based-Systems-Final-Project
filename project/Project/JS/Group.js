$( document ).ready(function() {

        $("#groupForm").submit(function(e){
            
            e.preventDefault();
            d=$(this).serialize();
            $.ajax({
                type:"POST",
                url:'Group_API/groupprojector.php',
                data:d,
                success:function (response){
                    var res=response.split(",");
                    

                    document.getElementById('tbl1').innerHTML = '';
                    for(var i=0;i<res.length;i+=6){
                        if(i+1!=res.length){
                            var id=res[i];
                            var task=res[i+1];
                            var username=res[i+2];
                            var status=res[i+3];
                            var duedate=res[i+4];
                            var groupname=res[i+5];
                            group_projection(id,task,username,status,duedate,groupname,1,"","");
                        }
                    }
                    $.ajax({
                        type:"POST",
                        url:'Group_API/groupusersprojector.php',
                        data:d,
                        success:function (response){

                            var res=response.split(",");
                            document.getElementById('tbl2').innerHTML = '';

                            for(var i=0;i<res.length;i+=4){
                                if(i+1!=res.length){
                                    var id=res[i];
                                    var email=res[i+1];
                                    var admin=res[i+2];
                                    var groupname=res[i+3];
                                    group_projection(id,"","","","",groupname,2,email,admin);
                                }
                            }
                            
                        }
                    });

                }
                
            });
            
        });

    $("#addGroupForm").submit(function(e){
        e.preventDefault();
        $.ajax({
            type:"POST",
            url:'Group_API/addgrouptask.php',
            data:$(this).serialize(),
            async:true,
            success: function (response){
                var jsonData = JSON.parse(response);
                console.log(jsonData);
                if(jsonData.success=="1"){

                }
                 
            }
        }); 
    });
    $(document).on("click", "#tbl22 tr", function () {
        $('.selected').removeClass('selected');
        $(this).addClass("selected");

        $(document).on("click", "#Delete", function () {
            let id=$('.selected').attr("data-id");
            console.log("i got here");

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
                    url: 'Group_API/deletegroupusers.php',
                    data:{"id":id},
                    async:true,
                    success: function(response)
                    {
                        var jsonData = JSON.parse(response);
                        console.log(jsonData);
                        if (jsonData.success == "-1")
                        {   
                            alert("Only the Admin can delete users from the group!!");
                        }  
                        $('.selected').removeClass('selected');
                    }
               });
            });
        });
    });
    $(document).on("click", "#tbl1 tr", function () {
        $('.selected').removeClass('selected');
        $(this).addClass("selected");
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
                    url: 'Group_API/deletegrouptask.php',
                    data:{"id":id},
                    async:true,
                    success: function(response)
                    {
                        var jsonData = JSON.parse(response);
                        console.log(jsonData);
                        if (jsonData.success == "1")
                        {   
                            
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
                    url:'Group_API/editgrouptask.php',
                    data:$(this).serialize()+"&id="+id,
                    async:true,
                    success:function (response){
                        var jsonData = JSON.parse(response);
                        if(jsonData.success=="1"){
                            
                            
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
                        url:'Group_API/editgroup_status.php',
                        data:{"id":id,"status":1},
                        async:true,
                        success:function (response){
                            var jsonData = JSON.parse(response);
                            console.log(jsonData);
                            if(jsonData.success=="1"){
                                

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
                        url:'Group_API/editgroup_status.php',
                        data:{"id":id,"status":0},
                        async:true,
                        success:function (response){
                            var jsonData = JSON.parse(response);
                            if(jsonData.success=="1"){
                                
                            }
                            $('.selected').removeClass('selected');
                        }
                    });
                }
            });
        });
   
    function group_projection(id,task,username,status,duedate,groupname,tablenum,email,admin){
        if(tablenum == 1){
            if(status==1){
                let tr1=`
                    <tr data-id=${id} style="text-decoration:line-through; color:green">
                        <td class="id">${id}</td>
                        <td class="task">${task}</td>
                        <td class="username">${username}</td>
                        <td><input  class="checkbox" type="checkbox" checked=true ></td>
                        <td class="duedate">${duedate}</td>
                        <td class="groupname">${groupname}</td>
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
                        <td class="groupname">${groupname}</td>
                    </tr>`;
                $("#tbl1").append(tr1);
            }
        }
        else{
            
            
            let tr2=`
                    <tr data-id=${id}>
                        <td class="id">${id}</td>
                        <td class="email">${email}</td>
                        <td class="admin">${admin}</td>
                        <td class="groupname">${groupname}</td>
                    </tr>`;
                $("#tbl2").append(tr2);
            
           
        }
        
    }
});