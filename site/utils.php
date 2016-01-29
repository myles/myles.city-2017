<?php
function FixURLs($url, $utm_queries)
{
	$url = preg_replace('/&?utm_.+?(&|$)$/', '', $url);
	
	if (substr($url, -1) == '?') {
		$url = $url . http_build_query($utm_queries);
	} elseif (strpos($url, '?') !== false) {
		$url = $url . '&' . http_build_query($utm_queries);
	} else {
		$url = $url . '?' . http_build_query($utm_queries);
	}
	
	return $url;
}
?>