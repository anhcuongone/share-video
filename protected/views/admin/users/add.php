<script type="text/javascript">
	$(document).ready(function () {
        $("#username").jqxInput({placeHolder: "Input your username", height: 35, width: 300, theme:'bootstrap'});
        $("#password").jqxInput({placeHolder: "Input your password", height: 35, width: 300, theme:'bootstrap'});
        $("#comfirmpassword").jqxInput({placeHolder: "Input your comfirm password", height: 35, width: 300, theme:'bootstrap'});
        $("#submit").jqxButton({ width: '100', height:25,theme: 'ui-le-frog'});

       $('#add-form').jqxValidator({ rules: [
                { input: '#username', message: 'The username is required!', action: 'keyup', rule: 'required' },
                { input: '#password', message: 'The password is required!', action: 'keyup', rule: 'required'},
                { input: '#comfirmpassword', message: 'The comfirm password is required!', action: 'keyup', rule: 'required'}
                
                ], theme: 'summer'});

       $('#submit').on('click', function (e) {
                var val=$('#add-form').jqxValidator('validate');
                if (val==false) {
                	e.preventDefault();
                };
            });

    });
</script>

<div>
	<?php $form = $this->beginWidget('CActiveForm', array(
    'id'=>'add-form',
    'enableAjaxValidation'=>true,
    'enableClientValidation'=>true,
	)); ?>
	    <table style="width: 50%;" class="table table-striped table-bordered table-hover">
			<tr>
				<td><?php echo $form->labelEx($user,'username: ');?></td>
				<td><?php echo $form->textField($user,'username',array("id"=>"username","name"=>"username")); ?>
				</td>
			</tr>

			<tr>
				<td><?php echo $form->labelEx($user,'password: ');?></td>
				<td><?php echo $form->textField($user,'password',array("id"=>"password","name"=>"password")); ?></td>
			</tr>

			<tr>
				<td><?php echo $form->labelEx($user,'Comfirm Password: ');?></td>
				<td><?php echo $form->textField($user,'comfirmpassword',array("id"=>"comfirmpassword","name"=>"comfirmpassword")); ?></td>
			</tr>

			<tr>
	            <td colspan="2" style="text-align:center;" ><input type="submit" id="submit" name="submit" value="Save"></td>            
			</tr>
		</table>
	<?php $this->endWidget(); ?>
</div>