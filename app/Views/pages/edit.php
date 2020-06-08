<h2><?= esc($title); ?></h2>

<?= \Config\Services::validation()->listErrors(); ?>

<form action="/admin/edit" method="post">
    <?= csrf_field() ?>

    <label for="title">Title</label>
    <!-- <input type="input" name="title" value="<?= $page['title'];?>"/><br /> -->
    <?php echo form_input( ['title', $page[0]['title'] ]);?>
    <label for="body">Page Content</label>
    <div id="body"></div><br />

    <input type="submit" name="submit" value="Create page" />

</form>
<script>
    ClassicEditor
        .create( document.querySelector( '#body' ),  )
        .catch( error => {
            console.error( error );
        } );
</script>