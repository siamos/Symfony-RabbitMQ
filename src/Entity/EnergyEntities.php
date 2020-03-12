<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\EnergyEntitiesRepository")
 */
class EnergyEntities
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $routing_key;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $energy_value;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $energy_timestamp;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getRoutingKey(): ?string
    {
        return $this->routing_key;
    }

    public function setRoutingKey(?string $routing_key): self
    {
        $this->routing_key = $routing_key;

        return $this;
    }

    public function getEnergyValue(): ?int
    {
        return $this->energy_value;
    }

    public function setEnergyValue(?int $energy_value): self
    {
        $this->energy_value = $energy_value;

        return $this;
    }

    public function getEnergyTimestamp(): ?string
    {
        return $this->energy_timestamp;
    }

    public function setEnergyTimestamp(?string $energy_timestamp): self
    {
        $this->energy_timestamp = $energy_timestamp;

        return $this;
    }
}
