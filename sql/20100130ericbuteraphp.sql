/*
Navicat MySQL Data Transfer

Source Server         : ericbutera.us
Source Server Version : 50051
Source Host           : localhost:13306
Source Database       : ericbuteraphp

Target Server Type    : MYSQL
Target Server Version : 50051
File Encoding         : 65001

Date: 2010-01-30 11:44:22
*/

SET FOREIGN_KEY_CHECKS=0;
-- ----------------------------
-- Table structure for `blog_post`
-- ----------------------------
DROP TABLE IF EXISTS `blog_post`;
CREATE TABLE `blog_post` (
  `postId` mediumint(11) unsigned NOT NULL auto_increment,
  `name` varchar(255) default NULL,
  `copy` text,
  `allowComments` tinyint(1) unsigned default NULL,
  `lastUpdated` int(10) unsigned default NULL,
  `published` tinyint(1) unsigned default NULL,
  `teaser` text,
  `status` tinyint(1) default NULL,
  `splashImage` varchar(128) default NULL,
  `createdTs` int(11) default NULL,
  `slug` varchar(64) default NULL,
  PRIMARY KEY  (`postId`),
  UNIQUE KEY `slug` (`slug`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of blog_post
-- ----------------------------
INSERT INTO `blog_post` VALUES ('1', 'Hello World!', '<p>Obligatory first post.</p>', '0', '1247284800', '1', 'So it begins…', '1', null, '1247284800', '1');
INSERT INTO `blog_post` VALUES ('2', 'Zend_Tool woes', '<p>Recently I started a new project and it was the perfect opportunity to use  Zend_Tool.  After looking at a few tutorials I decided to give it a go.  Usually when starting out with something new I am in the mindset of if it does not work, it is my fault.  Lately though with each release of Zend Framework it seems the code quality is falling more.  Also the ZF manual documentation is not keeping pace with the minor releases either.  This is not a show stopper of course  because I can usually find someone who wrote a blog post or browse the code  myself.  Just a little bit of an inconvenience.</p>\r\n<p>Here is a little gotcha with Zend_Tool.  Say I create a module like so:</p>\r\n<pre class=\"shell\">zf create module manage</pre>\r\n<p>This works great for creating directory structures.  It does not register the  module with the bootstrap autoloader or give a way for the front controller to know where your new controllers are at.  All of this is still a manual task.   That is part of the reason for my rant above.  ZF is nice because it gives you a lot of flexibility, but it is also a pain in the rear since there is no  consistent way of doing the same things.  It would be nice if it at least could generate output saying \"Please place this chunk in your  Bootstrap::_initFrontcontroller().  Anything would be better than nothing.  Very misleading.</p>\r\n<p>Now to the gotcha.  If you want to create a test controller in your manage  module, you would run this command:</p>\r\n<pre class=\"shell\">zf create controller test 1 manage</pre>\r\n<p>That generates a ./modules/manage/controllers/TestController.php.  The class  name inside of the TestController is missing the \"Manage_\" module prefix making it unable to ever be accessed.  Whoops!</p>\r\n<p>What happened to the incubator phase?  What happened to the peer review?</p>', '0', '1247716800', '1', 'Recently I started a new project and it was the perfect opportunity to use Zend_Tool. In this post I share my first experience using it.', '1', null, '1247716800', '2');
INSERT INTO `blog_post` VALUES ('3', ' FCKEditor 2.6.4.1', '<p>According to this <a href=\\\"\\\\\\\">CVE</a>, there is a vulnerability with FCKEditor 2.6.3 that warrants an immediate upgrade.&nbsp; After playing with it for a minute it seems like 2.6.4.1 will drop in place of 2.6.3 just fine.</p>', '0', '1258609397', '1', 'FCKEditor 2.6.3 has a vuln. Upgrade immediately.', '1', null, '1258609397', '3');
INSERT INTO `blog_post` VALUES ('18', 'Using Eclipse Templates', '<h1>\r\n	Using Eclipse templates.</h1>\r\n<p>\r\n	Eclipse templates can help you cut out a lot of repetitive keystrokes. &nbsp;At work I created a few to go along with the codebase I have.&nbsp; Examples are a gateway, vo, controller, and service class skeletons.</p>\r\n<p>\r\n	&nbsp;</p>\r\n<h2>\r\n	Creating a code template.</h2>\r\n<p>\r\n	<a class=\"zoom\" href=\"/i/b/create-template.png\" rel=\"group\"> <img align=\"right\" alt=\"Create an Eclipse code template\" height=\"147\" src=\"/i/b/create-template.png\" title=\"Create an Eclipse code template\" width=\"200\" /></a></p>\r\n<p>\r\n	To create a template, first open the Eclipse preferences.&nbsp; On Linux this is located at Window &gt; Preferences.&nbsp; OS X is Eclipse Menu &gt; Preferences.&nbsp; Once you are in preferences, navigate the menu to PHP &gt; Editor &gt; Templates.&nbsp; If you managed to find that (you can tell this was made by programmers) then you will be presented with a list of all the default PDT templates.&nbsp; I would suggest looking at a few in here to get a general idea of how it works.&nbsp; The entry &quot;class&quot; is a prety simple example yet covers custom variables &amp; final cursor position.</p>\r\n<p>\r\n	&nbsp;</p>\r\n<p>\r\n	A few notes here. &nbsp;To add a literal $ character, you have to escape it with $ ending up with $$. &nbsp;There are built in variables that Eclipse will auto populate for you also. &nbsp;You can find these in the &#39;Insert Variable&#39; menu. &nbsp;An example built-in would be&nbsp;<code>${date}</code>.</p>\r\n<p>\r\n	<br />\r\n	You can try using the following template to get you up and running.</p>\r\n<p>\r\n	<strong>Name</strong>: bytevo</p>\r\n<p>\r\n	<strong>Context</strong>: php</p>\r\n<p>\r\n	<strong>Description</strong>: vo object skeleton</p>\r\n<pre class=\"shell\">/**\r\n * @package     ${project}\r\n */\r\n/**\r\n * @author      ${user}\r\n * @package     ${project}\r\n * @created     ${date}\r\n * @version     $$Id$$\r\n */\r\nclass ${classname} extends byte_DB_VOAbstract {\r\n\r\n    public $$${pk};\r\n    ${cursor}\r\n\r\n    public function getId() {\r\n        return $$this-&gt;${pk};\r\n    }\r\n\r\n}\r\n\r\n</pre>\r\n<h2>\r\n	Inserting a code template.</h2>\r\n<p>\r\n	<a class=\"zoom\" href=\"/i/b/template-code-completion.png\" rel=\"group\"> <img align=\"right\" alt=\"Inserting an Eclipse code template\" height=\"74\" src=\"/i/b/template-code-completion.png\" title=\"Insert\" width=\"200\" /> </a></p>\r\n<p>\r\n	Once you have added &amp; saved your template it is time to use it.&nbsp; Start out by creating a blank php file.&nbsp; Make sure there is nothing in the file except &lt;?php.&nbsp; After that, type &#39;bytevo&#39; and hit Control + Space.&nbsp; If there is only one match to what you&#39;ve typed it will automatically inject the code template at the current cursor position. &nbsp;If there are multiple choices, it will pop up the dialog shown here allowing you to choose.</p>\r\n<p>\r\n	&nbsp;</p>\r\n<h2>\r\n	Using a code template inside a php file</h2>\r\n<p>\r\n	<a class=\"zoom\" href=\"/i/b/using-template.png\" rel=\"group\"> <img align=\"right\" alt=\"Using an Eclipse code template\" height=\"237\" hspace=\"5\" src=\"/i/b/using-template.png\" title=\"Using\" width=\"200\" /> </a></p>\r\n<p>\r\n	When the template has been inserted, all of the variables you created in the template using the <code>${name}</code> syntax will ask you to type in their value.&nbsp; If you have these specified multiple times in a file, then it will set all of them in one go.&nbsp; After filling out the appropriate values, you can then press tab to jump between the different variables you defined.</p>\r\n<p>\r\n	&nbsp;</p>\r\n<p>\r\n	Give code templates a shot. &nbsp;If you&#39;re using an MVC stack, it is very simple to set these up for the m, v, &amp; c classes.</p>\r\n', '0', '1258822612', '1', 'Using Eclipse Templates', '1', null, '1258822612', '18');
INSERT INTO `blog_post` VALUES ('19', 'Migrating to Nginx from Apache2', '<p>\r\n	&nbsp;</p>\r\n<p>\r\n	(http://how2forge.org/installing-nginx-with-php5-and-mysql-support-on-debian-lenny)</p>\r\n<p>\r\n	&nbsp;</p>\r\n<p>\r\n	apt-getinstall php5-cgi nginx</p>\r\n<p>\r\n	vim /etc/nginx/nginx.conf</p>\r\n<p>\r\n	http {</p>\r\n<p>\r\n	server_tokens off;</p>\r\n<p>\r\n	}</p>\r\n<p>\r\n	expose_php = off</p>\r\n<p>\r\n	edit site</p>\r\n<p>\r\n	vim /etc/nginx/sites-available/default</p>\r\n<p>\r\n	add rewrite(http://thehook.eu/2009/02/bruisedfruit-rewrite-rule-for-nginx/)</p>\r\n<p>\r\n	install php-fcgi from (http://wiki.nginx.org/PHPFcgiExample#Spawning_a_FastCGI_Process)</p>\r\n<p>\r\n	chown root:root php-fcgi&nbsp;</p>\r\n<p>\r\n	chmod +x php-fcgi</p>\r\n<p>\r\n	/etc/init.d/php-fcgi restart</p>\r\n<p>\r\n	apt-getinstall php5-cgi nginx</p>\r\n<p>\r\n	&nbsp;</p>\r\n<p>\r\n	vim /etc/nginx/nginx.conf http {</p>\r\n<p>\r\n	&nbsp;server_tokens off;</p>\r\n<p>\r\n	&nbsp;}</p>\r\n<p>\r\n	expose_php = off</p>\r\n<p>\r\n	&nbsp;</p>\r\n<p>\r\n	&nbsp;</p>\r\n<p>\r\n	edit sitevim /etc/nginx/sites-available/default</p>\r\n<p>\r\n	&nbsp;add rewrite(http://thehook.eu/2009/02/bruisedfruit-rewrite-rule-for-nginx/)</p>\r\n<p>\r\n	&nbsp;</p>\r\n<p>\r\n	&nbsp;</p>\r\n<p>\r\n	&nbsp;</p>\r\n<p>\r\n	install php-fcgi from (http://wiki.nginx.org/PHPFcgiExample#Spawning_a_FastCGI_Process)</p>\r\n<p>\r\n	&nbsp;chown root:root php-fcgi&nbsp;</p>\r\n<p>\r\n	&nbsp;chmod +x php-fcgi</p>\r\n<p>\r\n	&nbsp;/etc/init.d/php-fcgi restart</p>\r\n\r\n<img alt=\"\" height=\"84\" src=\"/b/i/6a00d83451b05569e20120a5b8f224970c-900wi.jpg\" width=\"200\" />', '0', '1258853355', '0', 'Migrating to Nginx from Apache2', '1', null, '1258853355', '19');
INSERT INTO `blog_post` VALUES ('20', 'The verbosity of git push & pull.', '<p>\r\n	After installing <a href=\"http://scie.nti.st/2007/11/14/hosting-git-repositories-the-easy-and-secure-way\">gitosis</a> I had unpleasant error messages spewing all over my screen each time I ran <code>git push</code> or <code>git pull</code>.</p>\r\n<h3>\r\n	Hushing git push</h3>\r\n<p>\r\n	Edit your /path/to/project/.git/config file and&nbsp;add this block:</p>\r\n<pre class=\"shell\">[branch &quot;master&quot;] \r\n    remote = origin \r\n    merge = refs/heads/master</pre>\r\n<h3>\r\n	Hushing git pull:</h3>\r\n<p>\r\n	Run this command in your project directory.</p>\r\n<pre class=\"shell\">$ cd /path/to/project\r\n$ git config push.default current\r\n</pre>\r\n<p>\r\n	Ta-da!</p>\r\n', '0', '1263060009', '1', 'The verbosity of git push & pull for the lazy.', '1', 'git-man-page.png', '1261265974', '20');
INSERT INTO `blog_post` VALUES ('22', 'Adventures of parsing HTML in Python', '<p>\r\n	Tonight I was working on a project where I needed to parse some remote HTML documents and fetch the &lt;title&gt; tag value. After doing some searching I was not finding a solution that worked against the content I was trying to parse. Unfortunately most of the web is not made of well formed markup. A lot of people were recommending the use of <a href=\"http://www.crummy.com/software/BeautifulSoup/\">Beautiful Soup</a>, but it would seem this project has fall into disrepair. The author claims he is not motivated to maintain the latest release even though it seems to have <a href=\"http://www.crummy.com/software/BeautifulSoup/3.1-problems.html\">serious regressions</a>. So strike that idea.</p>\r\n<p>\r\n	Next up I tried <a href=\"http://codespeak.net/lxml/\">lxml</a> which seemed to be promising. It turned out to be a little vague as far as the api usage goes. The project does have a lot of documentation, but it felt very scattered and harder to follow than I&#39;d like. I know that is my fault, but if I am going to invest my time in using a piece of software it needs to feel right. So again, the search continued.</p>\r\n<p>\r\n	Enter <a href=\"http://pyquery.org/\">pyquery</a>. One might find this amusing since internally it uses lxml. This is exactly what I was looking for. &nbsp;It has what I consider one of the most remarkable api&#39;s for traversing the dom: jquery selectors! That&#39;s right, the ease of d(&quot;#hello&quot;) is just a package away.</p>\r\n<h3>\r\n	Debian Installation</h3>\r\n<pre class=\"shell\"># apt-get install python-lxml\r\n# easy_install pyquery\r\n</pre>\r\n<h3>\r\n	Usage</h3>\r\n<pre class=\"shell\">import urllib;\r\nfrom pyquery import PyQuery as pq\r\nfrom lxml import etree\r\n\r\nurl = &quot;http://google.com/&quot;\r\nf = urllib.urlopen(url);\r\nd = pq(f.read())\r\ntitle = d(&quot;title&quot;).text()\r\nprint &quot;title(%s)&quot; % title # result: title(Google)\r\n</pre>', '0', '1264833392', '1', 'Tonight I was working on a project where I needed to parse some remote HTML of various quality using Python.  Read on to see how my adventure went.', '1', null, '1264832802', '22');

-- ----------------------------
-- Table structure for `blog_post_tags`
-- ----------------------------
DROP TABLE IF EXISTS `blog_post_tags`;
CREATE TABLE `blog_post_tags` (
  `postId` mediumint(8) unsigned NOT NULL default '0',
  `tagId` mediumint(8) unsigned NOT NULL default '0',
  PRIMARY KEY  (`postId`,`tagId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of blog_post_tags
-- ----------------------------
INSERT INTO `blog_post_tags` VALUES ('22', '1');
INSERT INTO `blog_post_tags` VALUES ('22', '2');
INSERT INTO `blog_post_tags` VALUES ('22', '3');
INSERT INTO `blog_post_tags` VALUES ('22', '4');

-- ----------------------------
-- Table structure for `blog_tag`
-- ----------------------------
DROP TABLE IF EXISTS `blog_tag`;
CREATE TABLE `blog_tag` (
  `tagId` mediumint(9) NOT NULL auto_increment,
  `name` varchar(20) default NULL,
  PRIMARY KEY  (`tagId`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of blog_tag
-- ----------------------------
INSERT INTO `blog_tag` VALUES ('1', 'Python');
INSERT INTO `blog_tag` VALUES ('2', 'Beautiful Soup');
INSERT INTO `blog_tag` VALUES ('3', 'lxml');
INSERT INTO `blog_tag` VALUES ('4', 'pyquery');

-- ----------------------------
-- Table structure for `blog_user`
-- ----------------------------
DROP TABLE IF EXISTS `blog_user`;
CREATE TABLE `blog_user` (
  `userId` tinyint(3) unsigned NOT NULL auto_increment,
  `email` varchar(255) default NULL,
  `firstName` varchar(20) default NULL,
  `lastName` varchar(25) default NULL,
  `pass` varchar(255) default NULL,
  `user` varchar(32) default NULL,
  PRIMARY KEY  (`userId`),
  UNIQUE KEY `emailUnique` (`email`),
  KEY `userpass` (`user`,`pass`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of blog_user
-- ----------------------------
INSERT INTO `blog_user` VALUES ('1', 'eric@ericbutera.us', 'Eric', 'Butera', '392badf440eb0400f26cbb168deba7211c720b439e21bcb312a524c7381181ca786c527c5f45929e07308edac6a5c9eb41e4a9722a8d96a73883998ebec8e3a3', 'eric');
