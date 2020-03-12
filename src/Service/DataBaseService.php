<?php
// src/Service/DataBaseService.php
namespace App\Service;

use App\Entity\EnergyEntities;
use Doctrine\ORM\EntityManagerInterface;

class DataBaseService
{
    /**
     * @param EntityManagerInterface
     */
    private $em;

    /**
     * @param EntityManagerInterface $em
     */
    public function __construct(EntityManagerInterface $em)
    {
           $this->em = $em;
    }

    /**
     * Gets a json payload and uses doctrine functionality to save data to database
     * @param $payload
     * @return $productId
     */
    public function createEnergyProduct($payload = null)
    {
        if (empty($payload)) {
            return false;
        }
        $payload = json_decode($payload);
        $energyProduct = new EnergyEntities();
        //set the values with doctrine using entities
        $energyProduct->setEnergyValue($payload->value);
        $energyProduct->setRoutingKey($payload->routing_key);
        $energyProduct->setEnergyTimestamp($payload->timestamp);

        // tell doctrine to save the values of the product
        $this->em->persist($energyProduct);

        // execute the insert method
        $this->em->flush();

        return $energyProduct->getId();
    }
}