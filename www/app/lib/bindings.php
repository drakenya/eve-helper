<?php

App::bind('pheal', function ($app, $params = [])
{
	$keyId = isset($params[0]) ? $params[0] : null;
	$vCode = isset($params[1]) ? $params[1] : null;
	$scope = isset($params[2]) ? $params[2] : 'account';

	$cacheType = Config::get('pheal.cache', null);
	if ($cacheType !== null)
	{
		$cacheType = "\\Pheal\\Cache\\$cacheType";
		$phealCacheDirectory = Config::get('pheal.cache_base_path', false);
		\Pheal\Core\Config::getInstance()->cache = new $cacheType($phealCacheDirectory);
	}

	\Pheal\Core\Config::getInstance()->access = new \Pheal\Access\StaticCheck();

	return new \Pheal\Pheal($keyId, $vCode, $scope);
});
