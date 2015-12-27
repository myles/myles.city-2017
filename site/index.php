<!DOCTYPE html>
<?php
date_default_timezone_set('America/Toronto');

require_once('./simplepie.php');
require_once('./config.php');
?>
<html class="no-js" lang="en">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
		
		<title>Myles.City</title>
		
		<meta name="description" content="Myles.City">
		
		<meta name="viewport" content="width=device-width, initial-scale=1">
		
		<link rel="stylesheet" href="/assets/css/style.css">
		
		<link rel="shortcut icon" href="/assets/images/toronto.png"> 
		<link rel="apple-itouch-icon" href="/assets/images/toronto.png">
		
		<link rel="alternate" type="application/rss+xml" title="RSS" href="rss.php">
	</head>
	<body>
		<div class="page">
			<div class="page-title">
				<img class="logo" data-src="/assets/images/toronto.svg" data-fallback="/assets/images/toronto.png" title="Toronto">
				<h1>Myles.City</h1>
			</div>
			
			<div class="site-list">
				<?php foreach ($feeds as $feed_data => $feed) {
					$pie = new SimplePie();
					$pie->enable_cache(true);
					$pie->set_feed_url($feed[feed_url]);
					$pie->init();
					$pie->handle_content_type();
					$feed_url = preg_replace('/&?utm_.+?(&|$)$/', '', $feed[url]);
					$feed_title = $feed[title];
					$important = $feed[important];
				?>
					<div class="site site-<?php echo $feed_data; ?><?php if($important) { echo ' site-important'; } ?>">
						<div class="site-title">
							<h2>
								<a href="<?php echo $feed_url; ?>">
									<?php echo $feed_title; ?>
								</a>
							</h2>
						</div>
						
						<div class="post-list">
						<?php
						$first = true;
						foreach ($pie->get_items() as $item) {
							preg_match('@<img.+src="(.*)".*>@Uims', $item->get_content(), $matches);
							$image = $matches[1];
							$title = html_entity_decode($item->get_title());
							$date = $item->get_local_date('%e %b %Y');
							$permalink = preg_replace('/&?utm_.+?(&|$)$/', '', $item->get_permalink());
						?>
							<div class="post">
								<a href="<?php echo $permalink; ?>">
									<?php if ($image and $first) { ?>
									<span class="post-image" style="background-image:url(<?php if ($image and $first) { echo $image; } ?>);"></span>
									<?php } ?>
									<span class="post-date">
										<?php echo $date; ?>
									</span>
									<span class="post-title">
										<?php echo $title; ?>
									</span>
								</a>
							</div>
						<?php
							if ($first) {
								$first = false;
							}
						};
						?>
						</div>
					</div>
				<?php }; ?>
			</div>
		</div>
		
		<script src="/assets/javascript/libs/jquery.js"></script>
		<script src="/assets/javascript/libs/jquery.fittext.js"></script>
		<script src="/assets/javascript/libs/jquery.lettering.js"></script>
		<script src="/assets/javascript/libs/svg-injector.js"></script>
		<script src="/assets/javascript/app.js"></script>
		
		<script>(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o), m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m) })(window,document,'script','//www.google-analytics.com/analytics.js','ga');ga('create', 'UA-1642439-41', 'auto');ga('send', 'pageview'); </script>
	</body>
</html>
