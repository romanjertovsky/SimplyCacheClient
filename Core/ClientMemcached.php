<?php


class ClientMemcached implements iDataClient
{

    private Memcached $oMemcached;


    public function __construct()
    {
        $this->oMemcached = new Memcached();
        $this->oMemcached->addServer(env('memcached_host'), env('memcached_port'));
        if($this->oMemcached->getStats() === false)
            die("Memcached server - connection error.\n");
    }


    public function get(string $key = null): array
    {

        if (is_null($key)) {

            $result = [];
            $aKeys = $this->oMemcached->getAllKeys();

            foreach ($aKeys as $sKey)
                $result[$sKey] = $this->oMemcached->get($sKey);

            return $result;

        } else {

            return [$key => $this->oMemcached->get($key)];

        }

    }


    public function add(string $key, string $value): bool
    {

        if ($this->oMemcached->add($key, $value, env('memcached_ttl')))
            return true;

        else
            return false;

    }


    public function delete(string $key): bool
    {

        if($this->oMemcached->delete($key))
            return true;
        else
            return false;

    }



}