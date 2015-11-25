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
		<link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Lato">
	</head>
	<body>
		<div class="page">
			<div class="page-title">
				<img class="logo" src="/assets/images/toronto.svg">
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
				?>
					<div class="site site-<?php echo $feed_data; ?>">
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
		<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/FitText.js/1.2.0/jquery.fittext.min.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/lettering.js/0.7.0/jquery.lettering.min.js"></script>
		<script src="/assets/javascript/svg-injector.min.js"></script>
		<script type="text/javascript">
			$(document).ready(function () {
				$('.page-title h1').lettering();
				$('.page-title h1').fitText(0.6);
				$('.site-title h2').fitText(1.4);
				SVGInjector($('.page-title img'));
			});
		</script>
	</body>
</html>
