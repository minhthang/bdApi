<?php
class bdApiConsumer_Installer {

	/* Start auto-generated lines of code. Change made will be overwriten... */

	protected static $_tables = array();
	protected static $_patches = array(
		array(
			'table' => 'xf_user_profile',
			'field' => 'bdapiconsumer_unused',
			'showColumnsQuery' => 'SHOW COLUMNS FROM `xf_user_profile` LIKE \'bdapiconsumer_unused\'',
			'alterTableAddColumnQuery' => 'ALTER TABLE `xf_user_profile` ADD COLUMN `bdapiconsumer_unused` VARCHAR(255)',
			'alterTableDropColumnQuery' => 'ALTER TABLE `xf_user_profile` DROP COLUMN `bdapiconsumer_unused`'
		)
	);

	public static function install() {
		$db = XenForo_Application::get('db');

		foreach (self::$_tables as $table) {
			$db->query($table['createQuery']);
		}
		
		foreach (self::$_patches as $patch) {
			$existed = $db->fetchOne($patch['showColumnsQuery']);
			if (empty($existed)) {
				$db->query($patch['alterTableAddColumnQuery']);
			}
		}
		
		self::installCustomized();
	}
	
	public static function uninstall() {
		$db = XenForo_Application::get('db');
		
		foreach (self::$_patches as $patch) {
			$existed = $db->fetchOne($patch['showColumnsQuery']);
			if (!empty($existed)) {
				$db->query($patch['alterTableDropColumnQuery']);
			}
		}
		
		foreach (self::$_tables as $table) {
			$db->query($table['dropQuery']);
		}
		
		self::uninstallCustomized();
	}

	/* End auto-generated lines of code. Feel free to make changes below */
	
	private static function installCustomized() {
		// customized install script goes here
	}
	
	private static function uninstallCustomized() {
		// customized uninstall script goes here
	}
	
}