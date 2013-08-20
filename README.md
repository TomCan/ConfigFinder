ConfigFinder
============
This script will try to locate publicly accessible config files of known or generic website applications. It will also try common alternatives like vi/vim/nano temporary files or human-renamed files (eg. config.old).

Disclaimer
==========
The aim of this script is to check your own websites for a specific type of security issue. Obviously, this can also be used on someone elses website. If you use the script, you are responsible for whatever it causes.

Requirements
============
- PHP5 enabled webserver
- PHP cURL extension

How to use
==========
- copy index.php and files.php inside your webserver documentroot
- open the page through your browser
- enter the URL of the website you want to scan
- if known, select the type of the website
- click the Check button

After some time (depending on the type of website and responsiveness of the website), the script will dump the result of the scan (yes, this needs work). 

Config
======
files.php contains the definition of the website types.

eg.
	$sites["drupal"] = array(
		'check' => array(
			array('url' => '/', 'find' => '#sites/[^/]+/files/css#i'),
			array('url' => '/user', 'find' => '/value="user_login"/i')
		),
		'files' => array(
			'/sites/default/settings.php' => '/<\?/'
		)
	);
	
This means that for a site to be recognized as a drupal, the script will fetch the URL / and look for sites/<whatever>/files/css in the source of the webpage (which is quite common for Drupal). 
If no match is found, the script will check the /user url and looks for value="user_login" in the source.
If a match is found, it will try to download the files defined in the files array (in this case /sites/default/settings.php)
The script will do one request for every element in the $transforms array, using placeholders for special values.
- {F} filname
- {FO} filename without extension
- {E} extension
The transformation is only applied to the filename part, not the path
eg. {FO}.old on /sites/default/settings.php will result in /sites/default/settings.old

WARNING: at the time of writing, the "generic" config contains 48 files to check and 14 transformations. This gives a total of 672 request that will be made to the website, so that might take a while (and put some stress on the webserver).
