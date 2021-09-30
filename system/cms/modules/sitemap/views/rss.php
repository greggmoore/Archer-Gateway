<?php header('Content-type: text/xml'); ?>
<?php echo '<?xml version="1.0" encoding="UTF-8" ?>'; ?>
<rss version="2.0">
<channel>
<title>WCI News</title>
<link>https://www.precip.com/</link>
<description>Industry Solutions for Air Pollution Control</description>
<?php if(isset($data)) echo $data; ?>	
</channel>
</rss>