<?php

namespace App\Entity;

use App\Repository\EntradaRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: EntradaRepository::class)]
class Entrada
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $user_id = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $fecha_entrada = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $ocurrencia = null;

    /**
     * @var Collection<int, EntradaItem>
     */
    #[ORM\OneToMany(targetEntity: EntradaItem::class, mappedBy: 'entrada', cascade: ['persist', 'remove'])]
    private Collection $entradaItems;

    public function __construct()
    {
        $this->entradaItems = new ArrayCollection();
    }

    

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUserId(): ?int
    {
        return $this->user_id;
    }

    public function setUserId(int $user_id): static
    {
        $this->user_id = $user_id;

        return $this;
    }

    public function getFechaEntrada(): ?\DateTimeInterface
    {
        return $this->fecha_entrada;
    }

    public function setFechaEntrada(\DateTimeInterface $fecha_entrada): static
    {
        $this->fecha_entrada = $fecha_entrada;

        return $this;
    }

    public function getOcurrencia(): ?string
    {
        return $this->ocurrencia;
    }

    public function setOcurrencia(?string $ocurrencia): static
    {
        $this->ocurrencia = $ocurrencia;

        return $this;
    }

    /**
     * @return Collection<int, EntradaItem>
     */
    public function getEntradaItems(): Collection
    {
        return $this->entradaItems;
    }

    public function addEntradaItem(EntradaItem $entradaItem): static
    {
        if (!$this->entradaItems->contains($entradaItem)) {
            $this->entradaItems->add($entradaItem);
            $entradaItem->setEntrada($this);
        }

        return $this;
    }

    public function removeEntradaItem(EntradaItem $entradaItem): static
    {
        if ($this->entradaItems->removeElement($entradaItem)) {
            // set the owning side to null (unless already changed)
            if ($entradaItem->getEntrada() === $this) {
                $entradaItem->setEntrada(null);
            }
        }

        return $this;
    }

    
}
