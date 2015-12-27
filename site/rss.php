<?php
include_once('./simplepie.php');
require_once('./config.php');

$feed_link = 'http://myles.city/rss.php';
$feed_title = 'Myles Braithwaite\'s Feeds';
$feed_home = 'http://myles.city';
$feed_desc = 'Hoping for the Best, Imagining the Worst.';

function array_value_recursive($key, array $arr) {
	/**
	* Get all values from specific key in a multidimensional array
	*
	* @param $key string
	* @param $arr array
	* @return null|string|array
	*/
	$val = array();
	
	array_walk_recursive($arr, function($v, $k) use($key, &$val){
		if($k == $key) array_push($val, $v);
	});
	
	return count($val) > 1 ? $val : array_pop($val);
}

$rss_feeds = array_value_recursive('feed_url', $feeds);

date_default_timezone_set('America/Toronto');

$pie = new SimplePie();

$pie->set_feed_url($rss_feeds);
$pie->set_cache_duration (600);
$pie->get_raw_data(isset($_GET['xmldump']) ? true : false);
$success = $pie->init();
$pie->handle_content_type();

header('Content-Type: application/rss+xml; charset=UTF-8');

echo '<?xml version="1.0" encoding="UTF-8"?>';
?>

<rss version="2.0" xmlns:atom="http://www.w3.org/2005/Atom" xmlns:content="http://purl.org/rss/1.0/modules/content/"  xmlns:dc="http://purl.org/dc/elements/1.1/" xmlns:creativeCommons="http://backend.userland.com/creativeCommonsRssModule">
	<channel>
		<title><?php echo $feed_title; ?></title>
		<atom:link href="<?php echo $feed_link; ?>" rel="self" type="application/rss+xml" />
		<link><?php echo $feed_home; ?></link>
		<description><?php echo $feed_desc; ?></description>
		<language>en-us</language>
		<copyright>Copyright <?php echo date("Y"); ?></copyright>
		<creativeCommons:license>http://creativecommons.org/licenses/by-nc-sa/3.0/</creativeCommons:license>
		
		<?php
		if ($success) {
			$item_limit = 0;
			foreach ($pie->get_items() as $item) {
				if ($item_limit == 40) {
					break;
				}
		?>
		<item>
			<title><?php echo $item->get_title(); ?></title>
			<link><?php echo $item->get_permalink(); ?></link>
			<guid><?php echo $item->get_permalink(); ?></guid>
			<pubDate><?php echo $item->get_date('D, d M Y H:i:s T'); ?></pubDate>
			<dc:creator><?php if ($author = $item->get_author()) { echo $author->get_name()." at "; }; ?><?php if ($feed_title = $item->get_feed()->get_title()) {echo $feed_title;}?></dc:creator>
				<description><?php echo htmlspecialchars(strip_tags($item->get_description())); ?></description>
				<content:encoded><![CDATA[<?php echo $item->get_content(); ?>]]></content:encoded>
				<creativeCommons:license>http://creativecommons.org/licenses/by-nc-sa/3.0/</creativeCommons:license>
		</item>
		<?php
				$item_limit = $item_limit + 1;
			}
		}
		?>
	</channel>
</rss>
