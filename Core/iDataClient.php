<?php


interface iDataClient
{

    public function get(string $key = null): array;

    public function add(string $key, string $value): bool;

    public function delete(string $key): bool;

}