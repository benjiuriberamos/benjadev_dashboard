<?php

namespace App\Entity;

use App\Repository\ProductoRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ProductoRepository::class)]
class Producto
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $nombre = null;

    #[ORM\Column(length: 400, nullable: true)]
    private ?string $descripcion = null;

    #[ORM\Column(type: Types::DECIMAL, precision: 20, scale: 2)]
    private ?string $precio = null;

    #[ORM\Column]
    private ?int $stock = null;

    /**
     * @var Collection<int, Categoria>
     */
    #[ORM\ManyToMany(targetEntity: Categoria::class, inversedBy: 'productos')]
    private Collection $categorias;

    /**
     * @var Collection<int, EntradaItem>
     */
    #[ORM\OneToMany(targetEntity: EntradaItem::class, mappedBy: 'producto')]
    private Collection $entradaItems;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $slug = null;

    public function __construct()
    {
        $this->categorias = new ArrayCollection();
        $this->entradaItems = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNombre(): ?string
    {
        return $this->nombre;
    }

    public function setNombre(string $nombre): static
    {
        $this->nombre = $nombre;

        return $this;
    }

    public function getDescripcion(): ?string
    {
        return $this->descripcion;
    }

    public function setDescripcion(?string $descripcion): static
    {
        $this->descripcion = $descripcion;

        return $this;
    }

    public function getPrecio(): ?string
    {
        return $this->precio;
    }

    public function setPrecio(string $precio): static
    {
        $this->precio = $precio;

        return $this;
    }

    public function getStock(): ?int
    {
        return $this->stock;
    }

    public function setStock(int $stock): static
    {
        $this->stock = $stock;

        return $this;
    }

    /**
     * @return Collection<int, Categoria>
     */
    public function getCategorias(): Collection
    {
        return $this->categorias;
    }

    public function addCategoria(Categoria $categoria): static
    {
        if (!$this->categorias->contains($categoria)) {
            $this->categorias->add($categoria);
        }

        return $this;
    }

    public function removeCategoria(Categoria $categoria): static
    {
        $this->categorias->removeElement($categoria);

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
            $entradaItem->setProducto($this);
        }

        return $this;
    }

    public function removeEntradaItem(EntradaItem $entradaItem): static
    {
        if ($this->entradaItems->removeElement($entradaItem)) {
            // set the owning side to null (unless already changed)
            if ($entradaItem->getProducto() === $this) {
                $entradaItem->setProducto(null);
            }
        }

        return $this;
    }

    public function getSlug(): ?string
    {
        return $this->slug;
    }

    public function setSlug(?string $slug): static
    {
        $this->slug = $slug;

        return $this;
    }
}
