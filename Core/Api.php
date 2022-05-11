<?php

class Api
{

    private $dataEngine;
    private bool $status = true;
    private int $code = 200;
    private array $data = [];


    public function makeJson(): string
    {
        return json_encode([
            'status' => $this->status,
            'code' => $this->code,
            'data' => $this->data,
        ]);
    }


    public function getResponse(string $sMethod): string
    {

        switch ($sMethod) {

            case 'GET':
                $this->data = $this->dataEngine->get();
                if(empty($this->data)) {
                    $this->status = false;
                    $this->code = 500;
                    $this->data[] = ['message' => "No data in data source"];
                }
                break;

            case 'DELETE':

                $input = json_decode(file_get_contents("php://input"), true);
                // TODO сделать проверку на наличие ключа в массиве

                if(!$this->dataEngine->delete($input['key'])) {
                    $this->status = false;
                    $this->code = 500;
                    $this->data[] = ['message' => "No data on the key: {$input['key']}"];
                }
            break;

            default:
                $this->status = false;
                $this->code = 500;
                $this->data[] = ['message' => 'Non-existent request method'];

        }

        http_response_code($this->code);
        return $this->makeJson();

    }


    public function setDataEngine(string $dataEngine): bool
    {

        switch ($dataEngine) {

            case 'redis':
                $this->dataEngine = Core::getClientRedis();
                return true;

            case 'memcached':
                $this->dataEngine = Core::getClientMemcached();
                return true;

                default:
                    return false;

        }

    }


}