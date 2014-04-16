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

		$("#jqxgrid").jqxGrid(
        {
			width: 1035,
			source: dataAdapter,
			pageable: true,
			autoheight: true,
	        theme:'ui-redmond',
	        pagesizeoptions: ['10', '20', '30', '40', '50'],
	        selectionmode: 'checkbox',
	        rowsheight: 60,
	        columns:[
	        	{text: "ID", datafield: "video_id", width: 20},
	        	{text: "Title", datafield: "video_title", width: 150},
	        	{text: "Description",datafield: "video_description", width: 250},
	        	{text: "Create Date", datafield: "video_date_create", width: 150, cellsformat: 'dd-MM-yyyy h:mm:ss tt'},
	        	{text: "Image", datafield: "video_image", width: 100, height: 200, cellsrenderer: function(row){
	        		var dataRecord = $("#jqxgrid").jqxGrid('getrowdata', row); 
	        		return '<img style="margin-left: 5px;" height="60" width="50" src="<?php echo Yii::app()->request->baseUrl; ?>/images/' + dataRecord.video_image + '"/>';
	        		}
	        	},
	        	{text: "View", datafield: "video_total_view", width: 70},
	        	{text: "Active", datafield: "video_active", width: 50},
	        ],
		});
	});

</script>


<div class="row">
    <div class="col-lg-12">
        <h3 class="alert alert-success">Video Management</h3>
    </div>
</div>

<div class="row" style="margin-left: 1px; ">
    <div id='jqxWidget' style="font-size: 13px; font-family: Verdana; float: left;">
        <div id="jqxgrid"></div>
    </div>
</div>