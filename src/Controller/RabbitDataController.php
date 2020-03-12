<?php

namespace App\Controller;
require_once __DIR__ . '/../../vendor/autoload.php';

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use PhpAmqpLib\Connection\AMQPStreamConnection;
use PhpAmqpLib\Message\AMQPMessage;
use App\Service\DataBaseService;
use App\Entity\EnergyEntities;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Routing\Annotation\Route;


class RabbitDataController extends AbstractController
{
    /**
     * @Route("/product", name = "create_product")
     * This function consumes the data from rabbitmq and save them to database
     */
    public function listen()
    {
        $queue = 'cand_oziq_results';
        $totalConsumes = 0;
        $dataFiltering = new FilterDataController();
        $connection    = $dataFiltering->getConnection();
        $channel       = $connection->channel();
        $channel->queue_declare($queue, true, false, false, false);

        //callback function when message have been consume from rabbitmq queue
        echo "Waiting for data to fetch..."."<br/>";
        $callback = function ($msg) {
            if ($msg->body) {
                $entityManager = $this->getDoctrine()->getManager();
                if ($entityManager) {
                    $databaseService = new DataBaseService($entityManager);
                }
                //call the database service to save the data
                $productId = $databaseService->createEnergyProduct($msg->body);
                if ($productId) {
                    $totalConsumes += 1;
                }
            }
        };

        $channel->basic_qos(0, 10, false);
        $channel->basic_consume($queue, '', false, true, false, false, $callback);

        // Loop as long as the channel has callbacks registered
        $counter = 0;
        while (count($channel->callbacks) && $connection->isConnected()) {
            try {
                $channel->wait();
                //solves the broke pipe problem
                if ($counter == 100) {
                    $this->close($channel, $connection);
                }
                $counter +=1;
            } catch (Exception $e) {
                echo $e->getMessage();
                $this->close($channel, $connection);
                exit();
            }
        }
        return new Response(
            "<html><body> {$totalConsumesFiles} Energy values saved successfully, return to the home page: <a href='/' > RETURN TO HOME </a>"."</body></html>"
        );
    }
    /**
     * Gets the connection parameters and closes the connection to stream
     * @param $channel
     * @param $connection
     */
    function close($channel, $connection)
    {
        $channel->close();
        $connection->close();
    }
}
