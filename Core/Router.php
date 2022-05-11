<?php

class Router
{

    public function routeCLI()
    {

        global $argc, $argv;


        // ENGINE
        if(!isset($argv[1]))
            print view(
                'cli_message_error',
                ['message' => 'No data engine specified, use redis or memcached']);

        switch ($argv[1]) {

            case 'redis':
                $oClient = Core::getClientRedis();
                break;

            case 'memcached':
                $oClient = Core::getClientMemcached();
                break;

            default:
                print view(
                    'cli_message_error',
                    ['message' => 'Engine name is incorrect, use redis or memcached']);

        }


        // METHOD
        if(!isset($argv[2]))
            print view(
                'cli_message_error',
                ['message' => 'No method specified, use: add, get or delete']);

        switch ($argv[2]) {

            case 'get':

                // Если не указан ключ запрашиваю все ключи
                print view(
                    'cli_array',
                    ['array' => $oClient->get(($argv[3] ?? null))]);
                break;

            case 'add':

                // Не указан ключ и значение
                if ($argc < 5)
                    print view(
                        'cli_message_error',
                        ['message' => "Specify key and value: ./command {$argv[1]} add {key} {value}."]);

                if ($oClient->add($argv[3], $argv[4]))
                    print view(
                        'cli_message',
                        ['message' => 'added']);
                else
                    print view(
                        'cli_message',
                        ['message' => 'don\'t added']);

                break;

            case 'delete':

                // Не указан ключ
                if ($argc < 4)
                    print view(
                        'cli_message_error',
                        ['message' => "Specify key: ./command {$argv[1]} delete {key}"]);

                if ($oClient->delete($argv[3]))
                    print view(
                        'cli_message',
                        ['message' => 'deleted']);
                else
                    print view(
                        'cli_message',
                        ['message' => 'don\'t deleted']);

                break;

            default:

                print view(
                    'cli_message_error',
                    ['message' => "Method {$argv[2]} don't exist."]);
                break;

        }


    }


    public function routeWEB()
    {

        $sUrl = $_SERVER['QUERY_STRING'];
        $aUrl = explode('/', $sUrl);
        $sMethod = $_SERVER['REQUEST_METHOD']; // GET | DELETE


        switch ($aUrl[0]) {

            case '':
                print view('web_index');
                break;

            case 'api':

                $oApi = Core::getApi();
                if($oApi->setDataEngine(($aUrl[1] ?? '')))
                    print view(
                        'api_json',
                        ['json' => $oApi->getResponse($sMethod)]);
                else
                    print view('404');

                break;

            default:
                print view('404');

        }

    }


}