<?php
// src/Controller/FilterDataController.php
namespace App\Controller;

require_once __DIR__ . '/../../vendor/autoload.php';
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpClient\HttpClient;
use PhpAmqpLib\Connection\AMQPStreamConnection;
use PhpAmqpLib\Message\AMQPMessage;
use Doctrine\ORM\EntityManagerInterface;

class FilterDataController
{
    /**
     * return the json encoded values from amazon url
     */
    public function getAmazonDataByUrl()
    {
        $client        = HttpClient::create();
        $dataFiltering = new FilterDataController();
        $response = $client->request('GET', 'https://j8a44btxhb.execute-api.eu-west-1.amazonaws.com/dev/results');
        //if we need it, $statusCode = 200
        $statusCode = $response->getStatusCode();
    
        //if we need it, $contentType = 'application/json'
        $contentType = $response->getHeaders()['content-type'][0];
        $content     = $response->getContent();
        $content     = $response->toArray();
        //make the correct formating of the values from hec to dec
        $decValues = $dataFiltering->hexToDec($content);

        return json_encode($decValues);
    }
    /**
     * formating the data so they can be send to rabbitmq
     * @param Array $data
     * @return $result 
     */
    public function formatingDataForRabbitMQ(Array $data)
    {
        $sendValue = '';
        $result    = [];
        foreach ($data as $values) {
            foreach ($values as $keys => $dataKeys) {
                if ($keys != 'value' && $keys != 'timestamp') {
                    $sendValue.= ($keys != 'attributeId')? $dataKeys."." : $dataKeys;
                } else {
                    $result[$keys] = $dataKeys;
                }
            }
        }
        $result['routing_key'] = $sendValue;
    
        return $result;
    }
    /**
     * connect to rabbitmq instance and send the formating data to the exchange
     * @param Array $payload
     * @param $connection
     * @param $channel
     * @return $dataTobeSend
     */
    public function sendDataToRabbitMQ(Array $payload, $connection, $channel)
    {   
        $exchange = 'cand_oziq';
        if (empty($payload)) {
            return false;
        }
        $dataTobeSend = $this->formatingDataForRabbitMQ($payload);
        $channel->exchange_declare($exchange, 'direct', true);

        $msg = new AMQPMessage(json_encode($dataTobeSend), ['content_type' => 'application/json', 'delivery_mode' => 2]);
        $channel->basic_publish($msg, $exchange);

        return $dataTobeSend;
    }

    /**
     * function that return the correct formating of the response values
     * from hex to dec
     * @param Array $payload
     * @return $result
     */
    public function hexToDec(Array $payload)
    {   
        $result = [];
        if (empty($payload)){
            return false;
        }
        foreach ($payload as $keys => $values) {
            $result[] = [$keys =>($keys != 'value' && $keys != 'timestamp')? hexdec($values) : $values];
        }
        return $result;
    }
    /**
     * Connect to the rabbimq server and return the connection
     * @return $connection
     */
    public function getConnection()
    {
        $host  = 'candidatemq.n2g-dev.net';
        $port  = 5672;
        $user  = 'cand_oziq';
        $pass  = 'ByVOkcn91YL1SMuv';
        $vhost = '/';
        $insist = false;
        $login_method = 'AMQPLAIN';
        $login_response = null;
        $locale = 'en_US';
        $connection_timeout = 3;
        $read_write_timeout = 3;
        $context = null;
        $keepalive = false;
        $heartbeat = 0;

        $connection = new AMQPStreamConnection($host, $port, $user, $pass,
        $vhost, $insist, $login_method, $login_response,
        $locale, $connection_timeout, $read_write_timeout, $context,
        $keepalive, $heartbeat);

        return $connection;
    }
}