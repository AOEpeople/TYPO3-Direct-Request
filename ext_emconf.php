<?php

########################################################################
# Extension Manager/Repository config file for ext "directrequest".
#
# Auto generated 05-05-2010 13:22
#
# Manual updates:
# Only the data in the array - everything else is removed by next
# writing. "version" and "dependencies" must not be touched!
########################################################################

$EM_CONF[$_EXTKEY] = array(
	'title' => 'Direct Request',
	'description' => 'Extension the fake an HTTP request and perform a direct request to the frontend triggered by the backend',
	'category' => 'misc',
	'author' => 'AOE media',
	'author_email' => 'dev@aoemedia.de',
	'shy' => '',
	'dependencies' => '',
	'conflicts' => '',
	'priority' => '',
	'module' => '',
	'state' => 'beta',
	'internal' => '',
	'uploadfolder' => 0,
	'createDirs' => '',
	'clearCacheOnLoad' => 0,
	'lockType' => '',
	'author_company' => 'AOE media GmbH',
	'version' => '0.0.5',
	'constraints' => array(
		'depends' => array(
			'typo3' => '4.3.0-0.0.0',
		),
		'conflicts' => array(
		),
		'suggests' => array(
		),
	),
	'_md5_values_when_last_written' => 'a:7:{s:9:"ChangeLog";s:4:"bd3d";s:16:"ext_autoload.php";s:4:"e869";s:21:"ext_conf_template.txt";s:4:"d67d";s:17:"ext_localconf.php";s:4:"ae1f";s:14:"ext_tables.php";s:4:"9c67";s:42:"classes/class.tx_directrequest_manager.php";s:4:"f92b";s:15:"cli/request.php";s:4:"0bdb";}',
	'suggests' => array(
	),
);

?>