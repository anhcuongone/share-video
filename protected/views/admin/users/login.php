<script type="text/javascript">
	$(document).ready(function () {
        $("#username").jqxInput({placeHolder: "Input your username", height: 35, width: 300, theme:'bootstrap'});
        $("#password").jqxInput({placeHolder: "Input your password", height: 35, width: 300, theme:'bootstrap'});
        $("#submit").jqxButton({ width: '150', height:35,theme: 'ui-le-frog'});
    });
</script>

<div>
	<?php $form = $this->beginWidget('CActiveForm', array(
    'id'=>'login-form',
    'enableAjaxValidation'=>true,
    'enableClientValidation'=>true,
	)); ?>
	    <table style="width: 40px;">
			<tr>
				<td><label>Username: </label></td>
				<td><input type="text" id="username" name="username"></td>
			</tr>
			<tr>
				<td><label>Password: </label></td>
				<td><input type="password" id="password" name="password"></td>
			</tr>
			<tr>
	            <td colspan="2" style="text-align:center;" ><input type="submit" id="submit" name="submit" value="Login"></td>            
			</tr>
		</table>
	<?php $this->endWidget(); ?>
</div>
