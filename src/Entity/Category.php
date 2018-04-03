<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CategoryRepository")
 * @ORM\Table(name="category")
 */
class Category
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @var Product[]
     *
     * @ORM\OneToMany(targetEntity="App\Entity\Product", mappedBy="category")
     */
    private $products;

    /**
     * @var Category
     *
     * @ORM\ManyToOne(targetEntity="App\Entity\Category", inversedBy="subcategories")
     * @ORM\JoinColumn(name="parent_id", nullable=true)
     */
    private $parent;

    /**
     * @var Category
     *
     * @ORM\OneToMany(targetEntity="App\Entity\Category", mappedBy="parent" )
     */
    private $subcategories;


    public function __construct()
    {
        $this->products = new ArrayCollection();
        $this->subcategory = new ArrayCollection();
    }

    public function getId()
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return Collection|Product[]
     */
    public function getProducts(): Collection
    {
        return $this->products;
    }

    public function addProduct(Product $product): self
    {
        if (!$this->products->contains($product)) {
            $this->products[] = $product;
            $product->setCategory($this);
        }

        return $this;
    }

    public function removeProduct(Product $product): self
    {
        if ($this->products->contains($product)) {
            $this->products->removeElement($product);
            // set the owning side to null (unless already changed)
            if ($product->getCategory() === $this) {
                $product->setCategory(null);
            }
        }

        return $this;
    }

    public function getParent(): ?self
    {
        return $this->parent;
    }

    public function setParent(?self $parent): self
    {
        $this->parent = $parent;

        return $this;
    }

    /**
     * @return Collection|Category[]
     */
    public function getSubcategories(): Collection
    {
        return $this->subcategories;
    }

    public function addSubcategories(Category $subcategories): self
    {
        if (!$this->subcategories->contains($subcategories)) {
            $this->subcategories[] = $subcategories;
            $subcategories->setParent($this);
        }

        return $this;
    }

    public function removeSubcategoryies(Category $subcategories): self
    {
        if ($this->subcategories->contains($subcategories)) {
            $this->subcategories->removeElement($subcategories);
            // set the owning side to null (unless already changed)
            if ($subcategories->getParent() === $this) {
                $subcategories->setParent(null);
            }
        }

        return $this;
    }
}
