<?php
//----------------------------------------------------------------------
//  CrawlTrack 3.2.8
//----------------------------------------------------------------------
// Crawler Tracker for website
//----------------------------------------------------------------------
// Author: Jean-Denis Brun
//----------------------------------------------------------------------
// Code cleaning: Philippe Villiers
//----------------------------------------------------------------------
// Website: www.crawltrack.net
//----------------------------------------------------------------------
// That script is distributed under GNU GPL license
//----------------------------------------------------------------------
// file: alexa.php
//----------------------------------------------------------------------
//  Last update: 01/12/2010
//----------------------------------------------------------------------
$url= $_GET['url'];
?>
<html><head></head><body>
<a href="http://www.alexa.com/siteinfo/<?php echo $url; ?>" target="blank"><script type="text/javascript" src="http://xslt.alexa.com/site_stats/js/s/c?url=<?php echo $url; ?>"></script></a>
</body></html>
