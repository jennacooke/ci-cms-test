<div class="container">
    <div class="row">
        <div class="col">
            <h2><?= esc($title); ?></h2>
            <?php helper('form');?>
            <?= \Config\Services::validation()->listErrors(); ?>

            <?php if (! empty($page) && $page['title']!='' ) : ?>
            <?php echo form_open_multipart(current_url(), ['method'=>'post']); ?>
            <!-- <form action="<?= current_url();?>" method="post"> -->
                <?= csrf_field() ?>
                <div class="form-group">
                    <label for="title">Title</label>
                    <!-- <input type="input" name="title" value="<?= $page['title'];?>"/><br /> -->
                    <?php echo form_input('title', esc($page['title']), ['class'=>'form-control']);?>
                </div>
                <div class="form-group">
                    <?php echo form_label('No-index', 'no_index');?>
                    <?php echo form_checkbox('no_index', 1, $page['no_index'] == 1 ? TRUE : FALSE, ['class'=>'form-control']);?>
                </div>
                <div class="form-group">
                    <?php echo form_label('Meta Title', 'meta_title' );?>
                    <?php echo form_textarea(
                        'meta_title', 
                        $page['meta_title'] ? $page['meta_title'] : '', 
                        ['class'=>'form-control']
                    ); ?>
                </div>
                <div class="form-group">
                    <?php echo form_label('Meta Description', 'meta_description' );?>
                    <?php echo form_textarea(
                        'meta_description', 
                        $page['meta_description'] ? $page['meta_description'] : '', 
                        ['class'=>'form-control']
                    ); ?>
                </div>
                <!-- <div class="form-group"> -->
                    <?php //echo form_label('Upload an image for the header', 'hero_img');?>
                    <?php //echo form_upload('hero_img', esc($page['hero_img']), ['class'=>'form-control']);?>
                <!-- </div> -->
                <div class="form-group">
                    <label for="body">Page Content</label>
                    <textarea id="body" name="body"><?= esc($page['body']);?></textarea>
                </div>
                <div class="form-group">
                    <input class="btn btn-success" type="submit" name="submit" value="Update page" />
                </div>
            <!-- </form> -->
            <?php echo form_close(); ?>
            <script>
                CKEDITOR.replace( document.querySelector( '#body'), {

                } );
            </script>
            <?php else : ?>

                <h3>No pages</h3>

                <p>Unable to find any pages for you.</p>

            <?php endif ?>
        </div>
    </div>
</div>
