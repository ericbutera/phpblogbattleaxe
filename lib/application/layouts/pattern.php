<?php
$baseUrl = $this->config->config['site.host'];
$rssUrl = "$baseUrl/post/rss";
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xml:lang="en" xmlns="http://www.w3.org/1999/xhtml" lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

    <title><?php echo $this->layout->getPageTitle() ?></title>

    <style type="text/css">
    body {
        background-image:url('/css/axe/i/grey-swirls.gif');
        background-repeat:repeat;
    }
    </style>

    <?php
    echo $this->layout->renderMeta();
    ?>

    <link rel="stylesheet" href="/css/axe/axe2.css"  type="text/css" media="screen" />

    <meta name="robots" content="follow, all">

    <link rel="openid.server" href="http://www.myopenid.com/server">
    <link rel="openid.delegate" href="http://ericbutera.myopenid.com/">
    <meta http-equiv="X-XRDS-Location" content="http://www.myopenid.com/xrds?username=ericbutera.myopenid.com" />

    <link rel="alternate" type="application/rss+xml" title="RSS" href="<?php echo $rssUrl ?>" />

    <link rel="shortcut icon" href="/favicon.ico" type="image/x-icon" />

    <link rel="stylesheet" type="text/css" href="/js/fancybox/jquery.fancybox-1.2.6.css" media="screen" />
</head>
<body>

  <div id="wrapper">


    <!-- start content -->
    <div id="main">

      <div id="contentwrapper">
        <?php
        //$flash = $this->flash; /* @var $flash baxe_Flash */
        //$error = $flash->getError();
        //$message = $flash->getMessage();
        ?>
        <?php /*
        <?php if ($error->has()): ?>
            <div><div class="errors"><?php echo $error->show() ?></div></div>
        <?php endif; ?>

        <?php if ($message->has()): ?>
            <div><div class="message"><?php echo $message->show() ?></div></div>
        <?php endif; ?>
        */ ?>

        <a name="main"></a>
        <?php
        echo $this->content
        ?>

      </div>

      <!-- start sidebar -->
      <div id="sidebars">

            <div class="sidebaritem">
              <div class="sidebarbox">
                <h2>Welcome!</h2>
		<p class="vcard">Behold, the blog of <span class="fn">Eric Butera</span> full of information on programming, the web, and other topics.</p>
              </div>
            </div>

            <?php /*
            <!--start tags-->
            <div class="sidebaritem">
              <div class="sidebarbox">
                <g:if test="${null == tags || 0 == tags.size()}">
                  &nbsp;
                </g:if>
                <g:else>
                  <h2>Tags</h2>
                  <div>
                  <g:each var="tag" in="${tags}">
                    <span><g:link controller="post" action="tag" id="${tag.name}">${tag.name}&nbsp;</g:link></span>
                  </g:each>
                  </div>
                </g:else>
              </div>
            </div>
            <!--end tags-->
            */ ?>

            <!--start links-->
            <div class="sidebaritem">
              <div class="sidebarbox">
                <h2>Links</h2>
                <ul class="friends">
                    <li><a href="http://dan.doezema.com/" rel="friend met">Daniel Doezema</a></li>
                    <?php /*<li><a href="http://www.kyleterry.com/" rel="friend">Kyle Terry</a></li> */ ?>
                </ul>
              </div>
            </div>
            <!--end links-->

        <div class="cleared"></div>
      </div>
      <!-- end sidebar -->

      <div class="cleared"></div>
    </div>
    <!-- end content -->

    <div id="header">

      <div id="logo">
        <h1><a href="<?php echo $this->escape($baseUrl) ?>">Eric Butera</a></h1>
      </div>

    </div>


    <!-- start nav -->
    <div id="catnav">
      <div id="toprss"><a href="feed://<?php echo $rssUrl ?>"><img src="/images/rss.png" alt="RSS Feed" height="14" width="14"></a></div>
      <?php echo $this->menu; ?>
    </div>
    <div class="cleared"></div>
    <!-- end nav -->


    <!-- start footer -->
    <div id="footer">
      <div id="footerleft">
        <p>
          <a href="#main">Back to top &uarr;</a>
        </p>
      </div>
      <div class="cleared"></div>
    </div>
    <!-- end footer -->

  </div>

    <script type="text/javascript" src="/js/jquery-1.3.2.min.js"></script>
    <script type="text/javascript" src="/js/fancybox/jquery.fancybox-1.2.6.pack.js"></script>

    <script type="text/javascript">
    $(document).ready(function() {
        $("a.zoom").fancybox();
    });
    </script>
<script type="text/javascript">
var gaJsHost = (("https:" == document.location.protocol) ? "https://ssl." : "http://www.");
document.write(unescape("%3Cscript src='" + gaJsHost + "google-analytics.com/ga.js' type='text/javascript'%3E%3C/script%3E"));
</script>
<script type="text/javascript">
try {
var pageTracker = _gat._getTracker("UA-12747887-1");
pageTracker._trackPageview();
} catch(err) {}</script>
</body>
</html>
