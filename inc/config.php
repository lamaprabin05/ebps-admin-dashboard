<?php 
	define('SITE_URL', 'http://127.0.0.1/ebps/');
	define('ADMIN_URL' , SITE_URL.'admin/');

	define('ASSETS_URL' ,ADMIN_URL.'assets/');

	define('CSS_URL', ASSETS_URL.'css/');
	define('JS_URL', ASSETS_URL.'js/');
	define('FONT_AWESOME_URL', ASSETS_URL.'font-awesome/');
	define('IMAGES_URL',ASSETS_URL.'images/');

	define('DB_HOST','localhost');
	define('DB_USER','root');
	define('DB_PASSWORD','');
	define('DB_NAME','db_ebps');	

	define('INC_PATH', $_SERVER['DOCUMENT_ROOT'].'/ebps/admin/');
	
?>
