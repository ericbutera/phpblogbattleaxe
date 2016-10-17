<!DOCTYPE HTML PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xml:lang="en" xmlns="http://www.w3.org/1999/xhtml" lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <base href="<?php echo $this->escape($this->config->config['site.host']) ?>" />

    <title><?php echo $this->layout->getPageTitle() ?></title>

    <?php
    echo $this->layout->renderMeta();
    ?>

    <meta name="robots" content="follow, all">

    <link rel="openid.server" href="http://www.myopenid.com/server">
    <link rel="openid.delegate" href="http://ericbutera.myopenid.com/">
    <meta http-equiv="X-XRDS-Location" content="http://www.myopenid.com/xrds?username=ericbutera.myopenid.com" />

    <link rel="stylesheet" href="/css/pixel/style.css"  type="text/css" media="screen" />
    <link rel="stylesheet" href="/css/main.css" type="text/css" media="screen" />

    <style type="text/css">
    <!--
    body {
    text-align: center;
    margin: 0;
    padding: 0 0 15px 0;
    background: #000 url(/css/pixel/images/bgbody.jpg) top center no-repeat;
    -->
    </style>

  <!--[if lt IE 8]>
  <link href="/css/pixel/ie.css" rel="stylesheet" type="text/css" />
  <![endif]-->

  <!--[if lt IE 7]>
  <link href="/css/pixel/ie6.css" rel="stylesheet" type="text/css" />
  <script src="http://ie7-js.googlecode.com/svn/version/2.0(beta3)/IE7.js" type="text/javascript"></script>
  <![endif]-->

  <link rel="alternate" type="application/rss+xml" title="RSS" href="<?php echo $this->createLink(array('route'=>'/post/rss', 'absolute'=>true)); ?>" />

</head>
<body>

  <div id="wrapper">


    <!-- start content -->
    <div id="main">

      <div id="contentwrapper">

        <?php if ($this->flash->hasErrors()): ?>
            <div><div class="errors"><?php echo $this->flash->showErrors() ?></div></div>
        <?php endif; ?>

        <?php if ($this->flash->hasMessages()): ?>
            <div><div class="message"><?php echo $this->flash->showMessages() ?></div></div>
        <?php endif; ?>

        <a name="main"></a>
        <?php
        echo $this->getRaw('content')
        ?>

      </div>

      <!-- start sidebar -->
      <div id="sidebars">
        <div id="sidebar_full">
          <ul>
            <li class="sidebaritem">
              <div class="sidebarbox">
                <h2 class="widgettitle">welcome!</h2>
                <div class="textwidget"><p>lorem ipsum would have been better.</p></div>
              </div>
            </li>

            <?php /*
            <!--start tags-->
            <li>
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
            </li>
            <!--end tags-->
            */ ?>&nbsp;

            <!--start links-->
            <li>
              <div class="sidebarbox">
                <h2>Links</h2>
                <a href="http://www.kyleterry.com/">Kyle Terry</a>
              </div>
            </li>
            <!--end links-->
          </ul>
        </div>

        <div id="sidebar_left">&nbsp;</div>

        <div id="sidebar_right">&nbsp;<?php  /* validator */ ?></div>

        <div class="cleared"></div>
      </div>
      <!-- end sidebar -->

      <div class="cleared"></div>
    </div>
    <!-- end content -->

    <div id="header">

      <div id="logo">
        <h1><a href="<?php echo $this->escape($this->config->config['site.host']) ?>">Eric Butera</a></h1>
        <span>[citation needed]</span>
      </div>


      <div id="topright">
        <ul>
          <?php /*<li><a href="#searchform">search</a></li>*/ ?>
          <li><a href="#main">skip to content &darr;</a></li>
        </ul>
      </div>

    </div>


    <!-- start nav -->
    <div id="catnav">
      <div id="toprss"><a href="feed://<?php echo $this->createLink(array('route'=>'/post/rss', 'absolute'=>true)) ?>"><img src="images/rss.png" alt="RSS Feed" height="14" width="14"></a></div>
      <?php echo $this->getRaw('menu'); ?>
    </div>
    <div class="cleared"></div>
    <!-- end nav -->



    <!-- start 3 col footer -->
    <?php  /*
    <div id="morefoot">
      <div class="col1"><h3>col1</h3><p>col1</p></div>
      <div class="col2"><h3>col2</h3><p>col2</p></div>
      <div class="col3"><h3>col3</h3><p>col3</p></div>
      <div class="cleared"></div>
    </div>
    */ ?>
    <!-- end 3 col footer -->


    <!-- start footer -->
    <div id="footer">
      <div id="footerleft">
        <p>
          <!-- Please don't remove my credits! I worked hard to create this theme and distribute it freely. Thanks! -->
          <a href="http://samk.ca/freebies/" title="WordPress theme">pixeled</a> by <a href="http://samk.ca/" title="WordPress theme design">samk</a>.
          Sweet icons by <a href="http://famfamfam.com/">famfamfam</a>.
          <a href="#main">Back to top &uarr;</a>
        </p>
      </div>
      <div class="cleared"></div>
    </div>
    <!-- end footer -->

  </div>

</body>
</html>
