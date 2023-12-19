<?php

declare(strict_types=1);

namespace App\Entity;

use App\Repository\ReferenceRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: ReferenceRepository::class)]
class Reference
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 50)]
    #[Assert\NotBlank]
    private ?string $name = null;

    #[ORM\OneToOne(mappedBy: 'reference', cascade: ['persist', 'remove'])]
    private ?Product $product = null;

    public function __toString(): string
    {
        return $this->name;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function getProduct(): ?Product
    {
        return $this->product;
    }

    public function setProduct(Product $product): static
    {
        // set the owning side of the relation if necessary
        if ($product->getReference() !== $this) {
            $product->setReference($this);
        }

        $this->product = $product;

        return $this;
    }
}
