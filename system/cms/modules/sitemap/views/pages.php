<?php header('Content-type: text/xml'); ?>
<?php echo '<?xml version="1.0" encoding="UTF-8" ?>'; ?>
 
 <urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
	<url>
        <loc><?php echo base_url(); ?></loc> 
        <priority>1.0</priority>
    </url>
    
<?php if(!empty($data)): ?>
    	
	<?php foreach($data as $url):	
	$link = base_url().$url->uri;
	$date = date('Y-m-d', strtotime($url->modified_ts)); 
	?>
	<url>
	    <loc><?php echo $link; ?></loc>
	    <lastmod><?php echo $date; ?></lastmod>
	    <priority>0.5</priority>
	</url>
	<?php endforeach; ?>
    	
<?php endif; ?>
</urlset>