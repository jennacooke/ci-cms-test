<div class="container">
	<?php echo $page['body'];?> 

	<div class="row">
		<div class="col">
			<?php helper('form'); ?>
			<?php echo form_open(current_url(), ['method'=>'post']); ?>
				<div class="form-group">
                    <?php echo form_label('Name', 'name');?>
                    <?php echo form_input('name', '', ['class'=>'form-control']);?>
                </div>
                <div class="form-group">
                    <?php echo form_label('Email Address', 'email');?>
                    <?php echo form_input('email', '', ['class'=>'form-control']);?>
                </div>
                <div class="form-group">
                    <?php echo form_label('How can we help you?', 'message');?>
                    <?php echo form_textarea('message', '', ['class'=>'form-control']);?>
                </div>
                <div class="form-group">
                    <input class="btn btn-success" type="submit" name="submit" value="Send Email" />
                </div>
            <?php echo form_close(); ?>
            <p><strong>Note:</strong> If you are having difficulties with our contact us form above, send us an email to <?= esc($global_data['email']); ?> (copy &amp; paste the email address)</p>
		</div>
	</div>
</div>