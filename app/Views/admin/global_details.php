<div class="container">
    <div class="row">
        <div class="col">
        	<?php if ($success === true) : ?>
        		<div class="alert alert-success">Success!</div>
	        <?php endif;?>
            <h2>Global Details</h2>
            <?php helper('form');?>
            <form action="<?= current_url() ;?>" method="post">
            	<div class="form-group">
                    <?php echo form_label('Email for Contact form (& Footer)', 'email' );?>
                    <?php echo form_input('email', esc($global_details['email']), ['class'=>'form-control']);?>
                </div>
                <div class="form-group">
                    <label for="ga_script">Google Analytics script</label>
                    <?php echo form_textarea(
                    	'ga_script', 
                    	$global_details['ga_script'] ? $global_details['ga_script'] : '', 
                    	['class'=>'form-control']
                    ); ?>
                </div>
                <div class="form-group">
                    <label for="fb_script">Facebook Pixel script</label>
                    <?php echo form_textarea(
                    	'fb_script', 
                    	$global_details['fb_script'] ? $global_details['fb_script'] : '', 
                    	['class'=>'form-control']
                    ); ?>
                </div>
                <div class="form-group">
                    <input class="btn btn-success" type="submit" name="submit" value="Update Global Details">
                </div>
            </form>

        </div>
    </div>
</div>