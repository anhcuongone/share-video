<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="language" content="en" />
	<title>Login</title>
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/bootstrap.min.css" rel="stylesheet" />
    <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/font-awesome.css" rel="stylesheet" />
    <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/sb-admin.css" rel="stylesheet" />
    <link rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/css/jqwidgets/jqx.bootstrap.css" type="text/css" />
    <link rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/css/jqwidgets/jqx.ui-redmond.css" type="text/css" />
    <link rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/css/jqwidgets/jqx.ui-le-frog.css" type="text/css" />
	
	<script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
    <script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/jqwidgets/jqxcore.js"></script>
    <script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/jqwidgets/jqxdata.js"></script>
    <script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/jqwidgets/jqxbuttons.js"></script>
    <script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/jqwidgets/jqxinput.js"></script>
    <script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/jqwidgets/jqxvalidator.js"></script>
	<script type="text/javascript">
		$(document).ready(function () {
	        $("#username").jqxInput({placeHolder: "Input your username", height: 35, width: 300, theme:'bootstrap'});
	        $("#password").jqxInput({placeHolder: "Input your password", height: 35, width: 300, theme:'bootstrap'});
	        $("#submit").jqxButton({ width: '315', height:35,theme: 'ui-le-frog'});
	    });
</script>
</head>
<body>
	<div class="container">
		<div class="row">
			<div class="col-md-4 col-md-offset-4">
				<div class="login-panel panel panel-default">
					<div class="panel-heading">
                        <h3 class="panel-title">Please Sign In</h3>
                    </div>
                     <div class="panel-body">
                    	<?php $form = $this->beginWidget('CActiveForm', array(
					    'id'=>'login-form',
					    'enableAjaxValidation'=>true,
					    'enableClientValidation'=>true,
					    'htmlOptions'=>array("role"=>"form"),
						)); ?>
						
						<fieldset>
							<div style="color:red" class="form-group">
								<?php
									echo $error;
								?>
                            </div>                      
							<div class="form-group">
								<?php echo $form->textField($model,'username',array("id"=>"username","name"=>"username","class"=>"form-control"));
								?>
                            </div>
                            <div class="form-group">
								<?php echo $form->passwordField($model,'password',array("id"=>"password","name"=>"password","class"=>"form-control")); ?>
                            </div>
                            <div class="checkbox">
                                    <label>
                                        <input name="remember" id="remember" type="checkbox" value="1">Remember Me
                                    </label>
                            </div>
                            <div class="form-group">
								<input type="submit" id="submit" name="submit" value="Login" class="btn btn-lg btn-success btn-block">
                            </div>
						</fieldset>
						<?php $this->endWidget(); ?>
                    </div>
				</div>
			</div>
		</div>
	</div>
</body>
</html>
