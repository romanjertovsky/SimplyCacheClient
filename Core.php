<?php


class Core
{


    private static array $aInstances;


    private static function getInstance($sClass)
    {

        if(empty(self::$aInstances[$sClass]))
            self::$aInstances[$sClass] = new $sClass;

        return self::$aInstances[$sClass];

    }


    public static function getApp(): App
    {
        return self::getInstance('App');
    }


    public static function getClientMemcached(): ClientMemcached
    {
        return self::getInstance('ClientMemcached');
    }


    public static function getClientRedis(): ClientRedis
    {
        return self::getInstance('ClientRedis');
    }


    public static function getRouter(): Router
    {
        return self::getInstance('Router');
    }

    public static function getApi(): Api
    {
        return self::getInstance('Api');
    }


}