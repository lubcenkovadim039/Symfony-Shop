<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\OrderItemRepository")
 * @ORM\Table(name="orderitem")
 *
 */
class OrderItem
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @var Product
     *
     * @ORM\ManyToOne(targetEntity="App\Entity\Product", inversedBy="orderItems")
     * @ORM\JoinColumn()
     */
    private $product;

    /**
     * @ORM\Column(type="integer")
     */
    private $quantityOfOrder;

    /**
     * @ORM\Column(type="decimal", precision=10,scale=2, nullable=true)
     */
    private $price;

    /**
     * @ORM\Column(type="decimal", precision=10,scale=2, nullable=true)
     */
    private $total;

    /**
     * @var Order
     *
     * @ORM\ManyToOne(targetEntity="App\Entity\Order", inversedBy="items")
     * @ORM\JoinColumn(nullable=true, onDelete="CASCADE")
     */
    private $orders;

    public function getId()
    {
        return $this->id;
    }

    public function getProduct(): ?Product
    {
        return $this->product;
    }

    public function setProduct(?Product $product): self
    {
        $this->product = $product;
        $this->setPrice($product->getPrice());

        return $this;
    }

    public function getQuantityOfOrder(): ?int
    {
        return $this->quantityOfOrder;
    }

    public function setQuantityOfOrder(int $quantityOfOrder): self
    {
        $this->quantityOfOrder = $quantityOfOrder;
        $this->updateTotal();


        return $this;
    }

    public function getPrice()
    {
        return $this->price;
    }

    public function setPrice($price): self
    {
        $this->price = $price;
        $this->updateTotal();

        return $this;
    }

    public function getTotal()
    {
        return $this->total;
    }



    public function getOrders(): ?Order
    {
        return $this->orders;
    }

    public function setOrders(?Order $orders): self
    {
        $this->orders = $orders;

        return $this;
    }

    private function updateTotal()
    {
        $this->total = round($this->price * $this->quantityOfOrder, 2);

        if ($this->orders) {
            $this->orders->updateAmount();
            }
    }
}
