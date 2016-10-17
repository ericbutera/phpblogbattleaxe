<!DOCTYPE HTML PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xml:lang="en" xmlns="http://www.w3.org/1999/xhtml" lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <base href="<?php echo $this->escape($this->config->config['site.host']) ?>" />

    <title><?php echo $this->layout->getPageTitle() ?></title>

    <?php
    echo $this->layout->renderMeta();
    ?>

    <link rel="stylesheet" href="/css/axe/axe.css"  type="text/css" media="screen" />

    <meta name="robots" content="follow, all">

    <link rel="openid.server" href="http://www.myopenid.com/server">
    <link rel="openid.delegate" href="http://ericbutera.myopenid.com/">
    <meta http-equiv="X-XRDS-Location" content="http://www.myopenid.com/xrds?username=ericbutera.myopenid.com" />

    <link rel="alternate" type="application/rss+xml" title="RSS" href="<?php echo $this->createLink(array('route'=>'/post/rss', 'absolute'=>true)); ?>" />

    <link rel="shortcut icon" href="/favicon.ico" type="image/x-icon" />

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

            <div class="sidebaritem">
              <div class="sidebarbox">
                <h2>Welcome!</h2>
                <p>Lorem ipsum would have been better.</p>
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
                    <li><a href="http://www.kyleterry.com/">Kyle Terry</a></li>
                </ul>
              </div>
            </div>
            <!--end links-->
          </ul>

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

    </div>


    <!-- start nav -->
    <div id="catnav">
      <div id="toprss"><a href="feed://<?php echo $this->createLink(array('route'=>'/post/rss', 'absolute'=>true)) ?>"><img src="images/rss.png" alt="RSS Feed" height="14" width="14"></a></div>
      <?php echo $this->getRaw('menu'); ?>
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

</body>
</html>
