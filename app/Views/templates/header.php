<!doctype html>
<html>
<head>
	<!-- Required meta tags -->
    <meta charset="utf-8">
    <?php if ($no_index == 1 || !$no_index) : ?>
    	<meta name="robots" content="noindex">
    <?php endif;?>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="title" content="<?= esc($meta_title); ?>">
    <meta name="description" content="<?= esc($meta_description); ?>">
    <title><?= esc($meta_title); ?></title>
    <link href="/assets/css/fontawesome/all.css" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link href="/assets/css/style.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <script src="https://cdn.ckeditor.com/4.14.0/standard/ckeditor.js"></script>
</head>
<body>

	<header class="" role="navigation">
		<div id="headwrap">
	
			<div id="titlelogo">
					<a href="/pages/<?= $main_slug; ?>">			
					<div id="logo"><img src="/user_images/<?= esc($logo['file_name']);?>" height="100" alt="Site logo"></div>	
					<h1></h1></a>
					<h2></h2>
			</div>
				
				
			<a class="menu-toggle mobile-visible">
	            <i class="fa fa-bars"></i>
	        </a>
		
			<div class="site-nav mobile-menu-hide">
	            <ul id="menu-classic-menu" class="site-main-menu">
	            	
					<li class="menu-item"><a href="/pages/<?= esc($main_slug); ?>">Main</a></li>
					<li class="menu-item"><a href="#">How To Prepare</a></li>
					<li class="menu-item"><a href="#">CDA Interview Questions</a></li>
					<li class="menu-item"><a href="/pages/<?= esc($contact_slug);?>">Contact Us</a></li>
				</ul>					
			</div>
	
		</div>
	</header>
	<div class="mt-mob"></div>