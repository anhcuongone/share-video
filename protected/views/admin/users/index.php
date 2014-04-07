<script type="text/javascript">
    $(document).ready(function(){

        var url ="<?php echo Yii::app()->request->baseUrl; ?>/admin/users/getAll";
        var source =
            {
                url: url ,
                datatype: "json",
                //pagenum: 3,
                pagesize: 15,
                datafields:
                [
                    {name: 'id', type: 'number' },
                    {name: 'username', type: 'string'},
                    {name: 'role_name', type: 'string'},
                    {name: 'created' ,type: 'date'},
                    {name: 'modified',type: 'date'},
                    {name: 'active',type: 'string'}
                ],
            };
       
        $("#username-edit").jqxInput({placeHolder: "Input your username", height: 35, width: 300, theme:'bootstrap'});
        $("#role-edit").jqxInput({placeHolder: "Input your username", height: 35, width: 300, theme:'bootstrap'});
        $("#active-edit").jqxInput({placeHolder: "Input active", height: 35, width: 300, theme:'bootstrap'});
        $("#Cancel-edit").jqxButton({ width: '100', height:25, theme: 'ui-le-frog' });
        $("#Save-edit").jqxButton({ width: '100', height:25, theme: 'ui-le-frog' });

        var dataAdapter = new $.jqx.dataAdapter(source);
        $("#jqxgrid").jqxGrid(
        {
            width: 970,
            source: dataAdapter,
            pageable: true,
            autoheight: true,
            theme:'ui-redmond',
            pagesizeoptions: ['10', '15', '20', '25', '30'],
            ready: function () {
                    // $("#jqxgrid").jqxGrid('sortby', 'id', 'asc');

                },
            selectionmode: 'checkbox',
            columns: [
                { text: 'ID', datafield: 'id', width: 100 },
                { text: 'Username', datafield: 'username', width: 180 },
                { text: 'Role', datafield: 'role_name', width: 100 },
                { text: 'Created Date', datafield: 'created', width: 150,cellsformat: 'dd-MM-yyyy h:mm:ss tt '  },
                { text: 'Modified Date', datafield: 'modified', width: 150, cellsformat: 'dd-MM-yyyy h:mm:ss tt' },
                { text: 'Active', datafield: 'active', width: 100 },
                { text: 'Edit', datafield: 'Edit',columntype: 'button', width: 80, cellsrenderer:function(){
                        return "Edit";
                    }, buttonclick:function(row)
                        {
                            editrow = row;
                            var offset = $("#jqxgrid").offset();
                            $("#popupWindow_edit").jqxWindow({ position: { x: parseInt(offset.left) + 340, y: parseInt(offset.top) + 50 } });
                             // get the clicked row's data and initialize the input fields.
                            var dataRecord = $("#jqxgrid").jqxGrid('getrowdata', editrow); 
                            $("#username-edit").val(dataRecord.username);
                            $("#id-edit").val(dataRecord.id);
                            $("#role-edit").val(dataRecord.role);

                            if ( dataRecord.active =='Inactive') {
                               $("#active-edit").val(0);
                            }else{
                                 $("#active-edit").val(1);
                            }
                             // show the popup window.
                            $("#popupWindow_edit").jqxWindow('open');
                        }
                },
                { text: 'Delete', datafield: 'Delete',columntype: 'button', width: 80,cellsrenderer:function(){
                        return "Delete";
                    },buttonclick:function(row){
                        deleteRow=row;
                        var dataRecord = $("#jqxgrid").jqxGrid('getrowdata', deleteRow);
                        $.ajax({
                            url: '<?php echo Yii::app()->baseUrl; ?>/admin/users/delete?id='+dataRecord.id,
                            type: 'GET',
                            success:function(data){
                                $("#jqxgrid").jqxGrid('updatebounddata');
                                $("#result").html(data);
                                $("#error").show();
                            },
                            error: function (error) {
                                $("#result").html(error.responseText);
                                $("#error").show();
                            },
                        });
                    },
                }
                ]
        });
        
         // initialize the popup window and buttons.
            $("#popupWindow_edit").jqxWindow({
                width: 420, resizable: false,  isModal: true, autoOpen: false, cancelButton: $("#Cancel-edit"), modalOpacity: 0.01           
            });
           
            //$("#jqxgrid").jqxGrid('gotopage', 1);
});

</script>

<script type="text/javascript">
   jQuery(document).ready(function($) {

        $("#username-add").jqxInput({placeHolder: "Input your username", height: 35, width: 300, theme:'bootstrap'});
        $("#role-add").jqxInput({placeHolder: "Input your role", height: 35, width: 300, theme:'bootstrap'});
        $("#password-add").jqxInput({placeHolder: "Input your password", height: 35, width: 300, theme:'bootstrap'});
        $("#confirm-password").jqxInput({placeHolder: "Input your password", height: 35, width: 300, theme:'bootstrap'});
        $("#active-add").jqxInput({placeHolder: "Input your active", height: 35, width: 300, theme:'bootstrap'});

        $("#Cancel-add").jqxButton({  width: '100', height:25, theme: 'ui-le-frog' });
        $("#Save-add").jqxButton({ width: '100', height:25, theme: 'ui-le-frog' });

        $("#popupWindow_add").jqxWindow({
                width: 450, resizable: false,  isModal: true, autoOpen: false, cancelButton: $("#Cancel-add"), modalOpacity: 0.01,theme:'summer'         
            });

        $("#addNew").click(function(){
            var offset = $("#jqxgrid").offset();
            //$("#popupWindow_add").jqxWindow({ position: { x: parseInt(offset.left) + 340, y: parseInt(offset.top) + 40 ,showAnimationDuration: 2000} });
            $('#popupWindow_add').jqxWindow({ showAnimationDuration: 700 }); 
            $("#popupWindow_add").jqxWindow('open');
        });

        $("#error").hide();
    });
</script>


<script type="text/javascript">
    jQuery(document).ready(function($) {
        $("#Save-add").click(function(event) {
            
            $.ajax({
                url: '<?php echo Yii::app()->baseUrl; ?>/admin/users/add',
                type: 'POST',
                data: {
                    submit: $("#Save-add").val(),
                    username: $("#username-add").val(),
                    password: $("#password-add").val(),
                    role: $("#role-add").val(),
                    active: $("#active-add").val()
                },
                success:function(data){
                    $("#result").html(data);
                    $("#error").show();
                    $("#jqxgrid").jqxGrid('updatebounddata');
                },
                error: function (error) {
                    $("#result").html(error.responseText);
                    $("#error").show();
                },
               
            });

            $("#popupWindow_add").jqxWindow('close');
        });

        $("#Save-edit").click(function(event) {
            $.ajax({
                url: '<?php echo Yii::app()->baseUrl; ?>/admin/users/edit',
                type: 'POST',
                data: {
                    id : $("#id-edit").val(),
                    submit: $("#Save-edit").val(),
                    username: $("#username-edit").val(),
                    role: $("#role-edit").val(),
                    active: $("#active-edit").val()
                },
                success:function(data){
                    $("#result").html(data);
                    $("#error").show();
                    $("#jqxgrid").jqxGrid('updatebounddata');
                },
                error: function (error) {
                    $("#result").html(error.responseText);
                    $("#error").show();
                },
               
            });

            $("#popupWindow_edit").jqxWindow('close');
        }); 

        var indexArray=new Array();
        $("#deleteAll").click(function(event) {
            $.ajax({
                url: '<?php echo Yii::app()->baseUrl; ?>/admin/users/deleteAll',
                type: 'POST',
                data: {
                    id: indexArray
                },
                success:function(data){
                    $("#result").html(data);
                    $("#error").show();
                    $("#jqxgrid").jqxGrid('updatebounddata');
                },
                error: function (error) {
                    $("#result").html(error.responseText);
                    $("#error").show();
                },
            });
            indexArray.length=0;
        });

        $('#jqxgrid').on('rowselect', function (event) 
        {
            var args = event.args; 
            var row = args.rowindex;
            if(typeof row.length == 'undefined'){
                var dataRecord = $("#jqxgrid").jqxGrid('getrowdata', row);
                indexArray.push(dataRecord.id);
            }else{
                for(var i=0 ; i<row.length ; i++){
                    var dataRecord = $("#jqxgrid").jqxGrid('getrowdata', i);
                    indexArray.push(dataRecord.id);
                }
            }

        });
    });
</script>
<div class="row">
    <div class="col-lg-12">
        <h3 class="alert alert-success">User Management</h3>
    </div>
</div>

<div class="row" style="margin-left: 1px;">
    <p>
        <button type="button" class="btn btn-sm btn-primary" id="deleteAll">Delete</button>
        <button type="button" class="btn btn-sm btn-primary" id="addNew">Add New</button>
    </p>
</div>
<div class="row" style="margin-left: 1px;">

</div>
<div class="row" id="error" style="margin-left: 1px;">
    <div class="alert alert-danger" id="result">
        
    </div>
</div>

<div class="row" style="margin-left: 1px; ">
    <div id='jqxWidget' style="font-size: 13px; font-family: Verdana; float: left;">
        <div id="jqxgrid"></div>
    </div>
</div>
<!--Begin Form Edit -->
<div id="popupWindow_edit">
    <div>Edit</div>
    <div style="overflow:hidden; ">
        <table>
            <tr>
                <td><input type="hidden" id="id-edit"></td>
            </tr>
            <tr>
                <td><label>Username:<span style="color:red">*</span> </label></td>
                <td><input type="text" name="username" id="username-edit"></td>
            </tr>
            <tr>
                <td><label>Role: </label></td>
                <td> <select name="role-edit" id="role-edit">
                        <?php
                            foreach ($role as $value) {
                                echo "<option value=".$value["id"].">".$value["role_name"]."</option>";
                            }
                        ?>
                    </select> 
                </td>
            </tr>
             <tr>
                <td><label>Active: </label></td>
                <td>
                    <select name="active-edit" id="active-edit">
                        <option value="1" >Active</option>
                        <option value="0">Inactive</option>
                    </select>
                </td>
            </tr>
            <tr>
                <td colspan="2" style="text-align: center;">
                    <input type="button" value="Save" id="Save-edit">
                    <input type="button" value="Cancel" id="Cancel-edit">
                </td>
            </tr>
        </table>
    </div>    
</div><!-- End Form Edit -->

<!-- Beign Form Add New -->
<div id="popupWindow_add">
    <div>Add New</div>
    <div style="overflow:hidden; ">
        <table>
            <tr>
                <td><label>Username:<span style="color:red">*</span> </label></td>
                <td><input type="text" name="username-add" id="username-add"></td>
            </tr>
            <tr>
                <td><label>Password:<span style="color:red">*</span> </label></td>
                <td><input type="password" name="password-add" id="password-add"></td>
            </tr>
            <tr>
                <td><label>Confirm Password:<span style="color:red">*</span> </label></td>
                <td><input type="password" name="confirm-password" id="confirm-password"></td>
            </tr>
            <tr>
                <td><label>Role: </label></td>
                <td>
                    <select name="role-add" id="role-add">
                        <?php
                            foreach ($role as $value) {
                                echo "<option value=".$value["id"].">".$value["role_name"]."</option>";
                            }
                        ?>
                    </select>                    
                </td>
                <!-- <td><input type="text" name="role-add" id="role-add"></td> -->
            </tr>
             <tr>
                <td><label>Active: </label></td>
                <td>
                    <select name="active-add" id="active-add">
                        <option value="1">Active</option>
                        <option value="0">Inactive</option>
                    </select>
                    <!-- <input type="select" name="active-add" id="active-add"> -->
                </td>
            </tr>
            <tr>
                <td colspan="2" style="text-align: center;">
                    <input type="button" value="Save" id="Save-add" name="Save-add">
                    <input type="button" value="Cancel" id="Cancel-add">
                </td>
            </tr>
        </table>
    </div>    
</div> <!-- End Form Add New -->