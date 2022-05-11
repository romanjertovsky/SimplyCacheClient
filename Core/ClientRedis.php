<?php


class ClientRedis implements iDataClient
{

    private Redis $oRedis;


    public function __construct()
    {

        try {
            $this->oRedis = new Redis();
            $this->oRedis->connect(env('redis_host'), env('redis_port'));
        } catch (RedisException $e) {
            die($e . PHP_EOL);
        }

    }


    public function get(string $key = null): array
    {

        if (is_null($key)) {

            $result = [];
            $aKeys = $this->oRedis->keys('*');

            foreach ($aKeys as $sKey)
                $result[$sKey] = $this->oRedis->get($sKey);

            return $result;

        } else {

            return [$key => $this->oRedis->get($key)];

        }

    }


    public function add(string $key, string $value): bool
    {
        if ($this->oRedis->setex($key, env('redis_ttl'), $value))
            return true;
        else
            return false;
    }


    public function delete(string $key): bool
    {
        if ($this->oRedis->del($key))
            return true;
        else
            return false;
    }


}