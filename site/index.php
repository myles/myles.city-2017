<!DOCTYPE html>
<?php
date_default_timezone_set('America/Toronto');

require_once('./simplepie.php');

$feeds = array(
	'red' => array(
		'title' => 'Myles.RED',
		'url' => 'http://myles.red/',
		'feed_url' => 'http://myles.red/feeds.xml'
	),
	'lab' => array(
		'title' => 'Myles\' Lab',
		'url' => 'http://mylesbraithwaite.org/',
		'feed_url' => 'http://mylesbraithwaite.org/feeds.xml'
	),
	'blog' => array(
		'title' => 'Myles Braithwaite',
		'url' => 'http://mylesbraithwaite.com/',
		'feed_url' => 'http://mylesbraithwaite.com/feeds/'
	),
	'theworst' => array(
		'title' => 'You are the Worst Today',
		'url' => 'https://youaretheworst.today/',
		'feed_url' => 'https://youaretheworst.today/feeds.xml'
	)
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
			<div class="title">
				<h1>Myles.City</h1>
			</div>
			
			<div class="sites">
				<?php foreach ($feeds as $feed_data => $feed): ?>
					<?php
					$pie = new SimplePie();
					$pie->enable_cache(false);
					$pie->set_feed_url($feed[feed_url]);
					$pie->init();
					$pie->handle_content_type();
					?>
					<div class="site site-<?php echo $feed_data; ?>">
						<h2>
							<a href="<?php echo $feed[url]; ?>">
								<?php echo $feed[title]; ?>
							</a>
						</h2>
					
						<ul>
						<?php foreach ($pie->get_items() as $item): ?>
							<li>
								<a href="<?php echo $item->get_permalink(); ?>">
									<?php echo $item->get_title(); ?>
								</a>
							</li>
						<?php endforeach; ?>
						</ul>
					</div>
				<?php endforeach; ?>
			</div>
		</div>
	</body>
</html>