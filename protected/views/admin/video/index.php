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

<div class="row" style="margin-left: 1px;">
    <p>
    	<button type="button" class="btn btn-sm btn-primary" id="deleteAll">Delete</button>
    	<button type="button" class="btn btn-sm btn-primary" id="addNew">Edit</button>
        <button type="button" class="btn btn-sm btn-primary" id="addNew">Add New</button>
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