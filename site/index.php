<!DOCTYPE html>
<?php
date_default_timezone_set('America/Toronto');

require_once('./simplepie.php');

$feeds = array(
	'blog' => array(
		'title' => 'Myles Braithwaite',
		'url' => 'http://mylesbraithwaite.com/',
		'feed_url' => 'http://mylesbraithwaite.com/feeds/'
	),
	'lab' => array(
		'title' => 'Myles\' Lab',
		'url' => 'http://mylesbraithwaite.org/',
		'feed_url' => 'http://mylesbraithwaite.org/feeds.xml'
	),
	'life' => array(
		'title' => 'Myles\' Life',
		'url' => 'http://www.myles.life/',
		'feed_url' => 'http://www.myles.life/feed/'
	),
	'theworst' => array(
		'title' => 'You are the Worst Today',
		'url' => 'https://youaretheworst.today/',
		'feed_url' => 'https://youaretheworst.today/feeds.xml'
	),
	'red' => array(
		'title' => 'Myles.RED',
		'url' => 'http://myles.red/',
		'feed_url' => 'http://myles.red/feeds.xml'
	),
);
?>
<html class="no-js" lang="en">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
		
		<title>Myles.City</title>
		
		<meta name="description" content="Myles.City">
		
		<meta name="viewport" content="width=device-width, initial-scale=1">
		
		<link rel="stylesheet" href="/assets/css/style.css">
	</head>
	<body>
		<div class="page">
			<div class="page-title">
				<h1>Myles.City</h1>
			</div>
			
			<div class="sites">
				<?php foreach ($feeds as $feed_data => $feed): ?>
					<?php
					$pie = new SimplePie();
					$pie->enable_cache(true);
					$pie->set_feed_url($feed[feed_url]);
					$pie->init();
					$pie->handle_content_type();
					?>
					<div class="site site-<?php echo $feed_data; ?>">
						<div class="site-title">
							<h2>
								<a href="<?php echo $feed[url]; ?>">
									<?php echo $feed[title]; ?>
								</a>
							</h2>
						</div>
					
						<div class="post-list">
							<?php foreach ($pie->get_items() as $item): ?>
							<div class="post">
								<a href="<?php echo $item->get_permalink(); ?>">
									<span class="post-date">
										<?php echo $item->get_local_date('%e %b %Y'); ?>
									</span>
									<span class="post-title">
										<?php echo html_entity_decode($item->get_title()); ?>
									</span>
								</a>
							</div>
						<?php endforeach; ?>
						</div>
					</div>
				<?php endforeach; ?>
			</div>
		</div>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/FitText.js/1.2.0/jquery.fittext.min.js"></script>
		<script type="text/javascript">
			$(document).ready(function () {
				$('.page-title h1').fitText(0.6);
				$('.site-title h2').fitText(1.4);
			});
		</script>
	</body>
</html>