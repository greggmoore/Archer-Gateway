<?php header('Content-type: text/xml'); ?>
<?php echo '<?xml version="1.0" encoding="UTF-8" ?>'; ?>
 
 <urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
	<url>
        <loc><?php echo base_url(); ?></loc> 
        <priority>1.0</priority>
    </url>
    
<?php if(isset($data))
	{
		foreach($data as $d)
		{
			echo $d;
		}
	} 
?>

</urlset>