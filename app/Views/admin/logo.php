<div class="container vh100">
    <div class="row">
        <div class="col">
        	
            <h2>Update Logo</h2>
            
            <?php if ($success != false && $msg != '' ) : ?>
            	<div class="alert alert-<?= $success === true ? 'success' : 'danger'?> ">
            		<?= esc($msg);?>
            	</div>
            <?php endif; ?>

            <?php helper('form');?>
            <?php echo form_open_multipart('/admin/logo_update', ['method'=>'post']); ?>
            	<div class="form-group">
            		Existing logo: <img src="/user_images/<?= $logo; ?>" style="width: 100px;"><br>
            	    <?php echo form_label('Upload an logo for the header', 'logo');?>
            	    <?php echo form_upload('logo', ($logo != null ? esc($logo) : ''), ['class'=>'form-control']);?>
            	</div>
            	<div class="form-group">
            	    <input class="btn btn-success" type="submit" name="submit" value="Update logo" />
            	</div>
            <?php echo form_close(); ?>
        </div>
    </div>
</div>