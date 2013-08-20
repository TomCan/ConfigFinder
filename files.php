<?php

	// tries to identify a site as a specific type
	$sites["drupal"] = array(
		'check' => array(
			array('url' => '/', 'find' => '#sites/[^/]+/files/css#i'),
			array('url' => '/user', 'find' => '/value="user_login"/i')
		),
		'files' => array(
			'/sites/default/settings.php' => '/<\?/'
		)
	);

	$sites["magento"] = array(
		'check' => array(
			array('url' => '/admin', 'find' => '/name="login\[username\]"/i'),
			array('url' => '/', 'find' => '/mage\.cookies/i')
		),
		'files' => array(
			'/app/etc/config.xml' => '/<\?xml/',
			'/app/etc/local.xml' => '/<\?xml/'
		)
	);
	
	$sites["joomla"] = array(
		'check' => array(
			array('url' => '/administrator', 'find' => '/name="username"|Joomla/i'),
			array('url' => '/', 'find' => '/name="generator" content="Joomla/i')
		),
		'files' => array(
			'/configuration.php' => '/<\?/'
		)
	);
	
	$sites["wordpress"] = array(
		'check' => array(
			array('url' => '/wp-login.php', 'find' => '/name="log"/i'),
			array('url' => '/', 'find' => '/name="generator" content="WordPress/i')
		),
		'files' => array(
			'/wp-config.php' => '/<\?/'
		)
	);

	$sites["generic"] = array(
		'check' => array(),
		'files' => array(
			'/config.php' => '/<\?/',
			'/config.inc.php' => '/<\?/',
			'/config.xml' => '/<\?xml/',
			'/config.yml' => '/[a-z]\:/',
			'/settings.php' => '/<\?/',
			'/settings.inc.php' => '/<\?/',
			'/settings.xml' => '/<\?xml/',
			'/settings.yml' => '/[a-z]\:/',
			'/database.php' => '/<\?/',
			'/database.inc.php' => '/<\?/',
			'/database.xml' => '/<\?xml/',
			'/database.yml' => '/[a-z]\:/',
			'/include/config.php' => '/<\?/',
			'/include/config.inc.php' => '/<\?/',
			'/include/config.xml' => '/<\?xml/',
			'/include/config.yml' => '/[a-z]\:/',
			'/include/settings.php' => '/<\?/',
			'/include/settings.inc.php' => '/<\?/',
			'/include/settings.xml' => '/<\?xml/',
			'/include/settings.yml' => '/[a-z]\:/',
			'/include/database.php' => '/<\?/',
			'/include/database.inc.php' => '/<\?/',
			'/include/database.xml' => '/<\?xml/',
			'/include/database.yml' => '/[a-z]\:/',
			'/includes/config.php' => '/<\?/',
			'/includes/config.inc.php' => '/<\?/',
			'/includes/config.xml' => '/<\?xml/',
			'/includes/config.yml' => '/[a-z]\:/',
			'/includes/settings.php' => '/<\?/',
			'/includes/settings.inc.php' => '/<\?/',
			'/includes/settings.xml' => '/<\?xml/',
			'/includes/settings.yml' => '/[a-z]\:/',
			'/includes/database.php' => '/<\?/',
			'/includes/database.inc.php' => '/<\?/',
			'/includes/database.xml' => '/<\?xml/',
			'/includes/database.yml' => '/[a-z]\:/',
			'/config/config.php' => '/<\?/',
			'/config/config.inc.php' => '/<\?/',
			'/config/config.xml' => '/<\?xml/',
			'/config/config.yml' => '/[a-z]\:/',
			'/config/settings.php' => '/<\?/',
			'/config/settings.inc.php' => '/<\?/',
			'/config/settings.xml' => '/<\?xml/',
			'/config/settings.yml' => '/[a-z]\:/',
			'/config/database.php' => '/<\?/',
			'/config/database.inc.php' => '/<\?/',
			'/config/database.xml' => '/<\?xml/',
			'/config/database.yml' => '/[a-z]\:/'
		)
	);

	$transforms = array(
		"{F}",
		"{F}~",
		"#{F}#",
		"{F}.old",
		"{FO}.old",
		"{FO}-old.{E}",
		"{F}.save",
		"{FO}.save",
		"{F}.backup",
		"{FO}.backup",
		"{F}.swp",
		"{FO}.swp",
		"{F}.swo",
		"{FO}.swo"
	);

?>