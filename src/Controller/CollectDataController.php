<?php
// src/Controller/CollectDataController.php
namespace App\Controller;
require_once __DIR__ . '/../../vendor/autoload.php';

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpClient\HttpClient;
use PhpAmqpLib\Connection\AMQPStreamConnection;


class CollectDataController
{
    /**
     * return the data to ui for testing usage
     */
    public function getData()
    {
        $dataFiltering = new FilterDataController();
        $connection    = $dataFiltering->getConnection();
        $channel       = $connection->channel();
        $counter = 0;
        while ($counter <= 100) {
            $data   = $dataFiltering->getAmazonDataByUrl();
            $rabbit = $dataFiltering->sendDataToRabbitMQ(json_decode($data), $connection, $channel);
            $counter += 1;
        }
        $channel->close();
        $connection->close();
        return new Response(
            "<html><body>Amazon data recieved and uploaded to RabbitMQ.<br/>Send data to Database: <a href='/product' > SEND </a>"."</body></html>"
        );
    }
}