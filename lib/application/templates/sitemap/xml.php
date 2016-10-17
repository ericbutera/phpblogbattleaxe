<?php echo '<?xml version="1.0" encoding="UTF-8"?>' ?>
<urlset
      xmlns="http://www.sitemaps.org/schemas/sitemap/0.9"
      xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance"
      xsi:schemaLocation="http://www.sitemaps.org/schemas/sitemap/0.9
            http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd">
<url>
  <loc>http://ericbutera.us/</loc>
  <changefreq>weekly</changefreq>
</url>
<url>
  <loc>http://ericbutera.us/about</loc>
  <changefreq>monthly</changefreq>
</url>
<url>
  <loc>http://ericbutera.us/post/list</loc>
  <changefreq>weekly</changefreq>
</url>

<?php try { ?>
    <?php foreach (Blog_Post_Service::getInstance($this->app)->fetchPublished() as $post): /* @var $post Blog_Post_VO */ ?>
    <url>
        <loc><?php echo $this->baseUrl ."/post/view/". $post->slug ?></loc>
        <changefreq>monthly</changefreq>
    </url>
    <?php endforeach; ?>
<?php } catch (Exception $e) {} ?>

<?php /*<url>
  <loc>http://ericbutera.us/post/view/2</loc>
  <changefreq>weekly</changefreq>
</url>
<url>
  <loc>http://ericbutera.us/post/view/1</loc>
  <changefreq>weekly</changefreq>
</url> */ ?>

</urlset>
