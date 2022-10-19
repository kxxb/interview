<?php

class Concept
{

    const FILE_TOKEN_STORAGE = 'file';

    const DB_TOKEN_STORAGE = 'db';

    const CACHE_TOKEN_STORAGE = 'cache';


    private $client;

    private $conf;

    public function __construct()
    {
        $this->conf   = env('TOKEN_STORAGE');
        $this->client = new \GuzzleHttp\Client();
    }

    public function getUserData()
    {
        $params = [
            'auth'  => ['user', 'pass'],
            'token' => $this->getSecretKey()
        ];

        $request = new \Request('GET', 'https://api.method', $params);
        $promise = $this->client->sendAsync($request)->then(function ($response) {
            $result = $response->getBody();
        });

        $promise->wait();
    }

    /**
     * @return string
     */
    private function getSecretKey():string
    {
        switch ($this->conf) {
            case self::FILE_TOKEN_STORAGE:
                return (new FileTokenStorage())->getToken();
            case self::CACHE_TOKEN_STORAGE:
                return (new CacheTokenStorage())->getToken();
            case self::DB_TOKEN_STORAGE:
                return (new DbTokenStorage())->getToken();
            default:
                return (new NullStorage())->getToken();
        }
    }

}

interface TokenStorageInterface
{
    public function getToken(): string;

    public function setToken(string $token): bool;
}

class NullStorage implements TokenStorageInterface
{
    public function getToken(): string
    {
        return 'secret';
    }

    public function setToken(string $token): bool
    {
        return true;
    }
}

class FileTokenStorage implements TokenStorageInterface
{
    public function getToken(): string
    {
        return 'secret';
    }

    public function setToken(string $token): bool
    {
        return true;
    }
}


class DbTokenStorage implements TokenStorageInterface
{

    public function getToken(): string
    {
        return 'secret';
    }

    public function setToken(string $token): bool
    {
        return true;
    }
}


class CacheTokenStorage implements TokenStorageInterface
{

    public function getToken(): string
    {
        return 'secret';
    }

    public function setToken(string $token): bool
    {
        return true;
    }
}


