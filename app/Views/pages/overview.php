<h1><?= esc($title); ?></h1>

<?php if (! empty($pages) && is_array($pages)) : ?>

    <?php foreach ($pages as $page): ?>

        <h2><?= esc($page['title']); ?></h2>

        <div class="main">
            <?= html_entity_decode($page['body']); ?>
        </div>
        <p><a href="/pages/<?= esc($page['slug'], 'url'); ?>">View article</a></p>

    <?php endforeach; ?>

<?php else : ?>

    <h3>No pages</h3>

    <p>Unable to find any pages for you.</p>

<?php endif ?>