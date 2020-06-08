<div class="container vh100">
	<div class="row">
		<div class="col-6">
			<?php helper('form'); ?>
			<?php echo form_open('admin/auth', ['method'=>'post', 'class'=>'form-signin']); ?>
				<?= csrf_field() ?>

				<h2 class="form-signin-heading">Please sign in</h2>

				<div class="form-group">
	                <?php echo form_label('Username', 'username');?>
	                <?php echo form_input('username', '', ['class'=>'form-control']);?>
	            </div>
	            <div class="form-group">
	                <?php echo form_label('Password', 'password');?>
	                <?php echo form_password('password', '', ['class'=>'form-control']);?>
	            </div>
	            <div class="form-group">
	                <input class="btn btn-success" type="submit" name="submit" value="Sign In" />
	            </div>
				
			<?php echo form_close(); ?>
		</div>
	</div>
</div> 