<?php

// Exit if accessed directly
if (!defined('ABSPATH'))
{
	exit();
}

function xfac_option_getWorkingMode()
{
	static $mode = false;

	if ($mode === false)
	{
		$mode = 'blog';

		if (is_multisite())
		{
			$plugins = get_site_option('active_sitewide_plugins');
			if (isset($plugins['xenforo-api-consumer/xenforo-api-consumer.php']))
			{
				// we should have used is_plugin_active_for_network
				// but that is only available in Dashboard...
				$mode = 'network';
			}
		}
	}

	return $mode;
}

function xfac_option_getConfig()
{
	$config = array();

	switch (xfac_option_getWorkingMode())
	{
		case 'network':
			$config['root'] = get_site_option('xfac_root');
			$config['clientId'] = get_site_option('xfac_client_id');
			$config['clientSecret'] = get_site_option('xfac_client_secret');
			break;
		case 'blog':
		default:
			$config['root'] = get_option('xfac_root');
			$config['clientId'] = get_option('xfac_client_id');
			$config['clientSecret'] = get_option('xfac_client_secret');
			break;
	}

	if (empty($config['root']) OR empty($config['clientId']) OR empty($config['clientSecret']))
	{
		return false;
	}

	return $config;
}
