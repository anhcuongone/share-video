<script type="text/javascript">
	jQuery(document).ready(function($) {
		var url="<?php echo Yii::app()->request->baseUrl; ?>/admin/video/getAll";
		var source= {
			url: url,
			datatype:"json",
			pagesize: 20,
			datafields:[
				{ name: "video_id", type: "number"},
				{ name: "video_title", type: "string"},
				{ name: "video_description", type: "string" },
				{ name: "video_url", type: "string"},
				{ name: "video_image", type: "string"},
				{ name: "video_total_view", type: "number"},
				{ name: "video_date_create", type: "date"},
				{ name: "video_active", type: "number"}
			],
		};

		var dataAdapter= new $.jqx.dataAdapter(source);

		$("#btn-search").click(function () {
                var look=$("#txt-search").val();
                source.url = "<?php echo Yii::app()->request->baseUrl; ?>/admin/video/search?look="+look;
                dataAdapter.dataBind();
        });

		$("#jqxgrid").jqxGrid(
        {
			width: 1035,
			source: dataAdapter,
			pageable: true,
			autoheight: true,
	        theme:'ui-redmond',
	        pagesizeoptions: ['10', '20', '30', '40', '50'],
	        selectionmode: 'checkbox',
	        rowsheight: 90,
	        autorowheight: true,
	        columnsresize: true,
	        columns:[
	        	{text: "ID", datafield: "video_id", width: 20},
	        	{text: "Title", datafield: "video_title", width: 150},
	        	{text: "Description",datafield: "video_description", width: 230},
	        	{text: "Url",datafield: "video_url", width: 230},
	        	{text: "Create Date", datafield: "video_date_create", width: 150, cellsformat: 'dd-MM-yyyy h:mm:ss tt'},
	        	{text: "Image", datafield: "video_image", width: 100, height: 200, cellsrenderer: function(row){
	        		var dataRecord = $("#jqxgrid").jqxGrid('getrowdata', row); 
	        		return '<img style="margin-left: 5px;" height="90" width="90" src="<?php echo Yii::app()->request->baseUrl; ?>/images/' + dataRecord.video_image + '"/>';
	        		}
	        	},
	        	{text: "View", datafield: "video_total_view", width: 70},
	        	{text: "Active", datafield: "video_active", width: 50},
	        ],
		});
	});

</script>

<script type="text/javascript">
	jQuery(document).ready(function(){
		$("#category-id-add").jqxInput({placeHolder: "Input your username", height: 35, width: 300, theme:'bootstrap'});
		$("#title-add").jqxInput({placeHolder: "Input your username", height: 35, width: 300, theme:'bootstrap'});
		$("#url-add").jqxInput({placeHolder: "Input your username", height: 35, width: 300, theme:'bootstrap'});
		$("#description-add").jqxInput({placeHolder: "Input your username",  width: 300, theme:'bootstrap'});
		$("#active-add").jqxInput({placeHolder: "Input your username", height: 35, width: 300, theme:'bootstrap'});
		$("#Cancel-add").jqxButton({ width: '100', height:25, theme: 'ui-le-frog' });
        $("#Save-add").jqxButton({ width: '100', height:25, theme: 'ui-le-frog' });

		$("#popupWindow_add").jqxWindow({
            width: 450, resizable: false,  isModal: true, autoOpen: false, cancelButton: $("#Cancel-add"), modalOpacity: 0.01,theme:'summer'     
        });

		$('#popupWindow_add').on('moving', function (event) { 
			$('#popupWindow_add').jqxWindow('move', event.args.x, event.args.y);
		})

		$("#addNew").click(function(){
	        $('#popupWindow_add').jqxWindow({ showAnimationDuration: 700 }); 
	        $("#popupWindow_add").jqxWindow('open');
	    });
	});
	
</script>

<script type="text/javascript">
	var indexArray =new Array();
	jQuery(document).ready(function($) {
		$("#deleteAll").click(function(event) {
			$.ajax({
				url: '<?php echo Yii::app()->request->baseUrl; ?>/admin/video/deleteAll',
				type: 'POST',
				data: {
					id: indexArray
				},
				success:function(data){
					$("#jqxgrid").jqxGrid("updatebounddata");
					$("#jqxgrid").jqxGrid('clearselection');
					$("#result").html(data);
                    $("#error").show();
				},
			});
		indexArray.length=0;
		});

		$('#jqxgrid').on('rowselect', function (event) {
			indexArray.length=0;
		    var args = event.args; 
		    var row = args.rowindex;
		    if(typeof row.length == 'undefined'){
		        var dataRecord = $("#jqxgrid").jqxGrid('getrowdata', row);
		        indexArray.push(dataRecord.video_id);
		    }else{
	            for(var i=0 ; i<row.length ; i++){
	      	        var dataRecord = $("#jqxgrid").jqxGrid('getrowdata', i);
	      	        indexArray.push(dataRecord.video_id);
		        }
		    }
		});
		$("#error").hide();
		$("#txt-search").jqxInput({placeHolder: "Search", height: 25, width: 250, theme:'bootstrap'});	
	});
</script>
<div class="row">
    <div class="col-lg-12">
        <h3 class="alert alert-success">Video Management</h3>
    </div>
</div>

<div style="position:fixed; right:35px; z-index:10000">
    	<button type="button" class="btn btn-sm btn-primary" id="deleteAll">Delete</button>
    	<button type="button" class="btn btn-sm btn-primary" id="Edit">Edit</button>
    	<button type="button" class="btn btn-sm btn-primary" id="addNew">Add New</button>
</div>

<div class="row" style="margin-left: 1px;">
    <p>
        <span style="padding-left:50px;">
            <input type="text" name="txt-search" id="txt-search">
            <button type="button" class="btn btn-sm btn-primary" id="btn-search" value="Search">Search</button>
        </span>
    </p>    
</div>
<div class="row" id="error" style="margin-left: 1px;">
    <div class="alert alert-danger" id="result"></div>
</div>
<div class="row" style="margin-left: 1px; ">
    <div id='jqxWidget' style="font-size: 13px; font-family: Verdana; float: left;">
        <div id="jqxgrid"></div>
    </div>
</div>

<!-- Beign Form Add New -->
<div id="popupWindow_add" style="position:fixed;">
    <div>Add New</div>
    <div style="overflow:hidden; ">
        <table>
            <tr>
                <td><label>Category:<span style="color:red">*</span> </label></td>
                <td><input type="text" name="category-id-add" id="category-id-add"></td>
            </tr>

            <tr>
                <td><label>Title:<span style="color:red">*</span> </label></td>
                <td><input type="text" name="title-add" id="title-add"></td>
            </tr>

            <tr>
                <td><label>Url:<span style="color:red">*</span> </label></td>
                <td><input type="text" name="url-add" id="url-add"></td>
            </tr>

            <tr>
                <td><label>Active:<span style="color:red">*</span> </label></td>
                <td><input type="text" name="active-add" id="active-add"></td>
            </tr>

            <tr>
                <td><label>Description:<span style="color:red">*</span> </label></td>
                <td>
                	<textarea name="description-add"  id="description-add" rows="5"></textarea>
                </td>
            </tr>

            <tr>
                <td><label>Image:<span style="color:red">*</span> </label></td>
                <td><input type="file" name="image-add" id="image-add"></td>
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