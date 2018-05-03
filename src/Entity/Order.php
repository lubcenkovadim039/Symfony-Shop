<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\OrderRepository")
 * @ORM\Table(name="orders")
 */
class Order
{

    const STATUS_DRAFT = 0;
    const STATUS_ORDERED = 1;
    const STATUS_SENT = 2;
    const STATUS_DONE = 3;

    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $createAt;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $status;

    /**
     * @ORM\Column(type="boolean", options={"default": false})
     */
    private $isPaid;


    /**
     * @ORM\Column(type="decimal", precision=10,scale=2, nullable=true)
     */
    private $amout;

    /**
     * @var OrderItem[]
     *
     * @ORM\OneToMany(targetEntity="App\Entity\OrderItem", mappedBy="orders")
     */
    private $items;


    /**
     * @var User[]
     *
     * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="order")
     * @ORM\JoinColumn()
     */
    private $user;

    public function __construct()
    {

        $this->status = self::STATUS_DRAFT;
        $this->createAt = new \DateTime();
        $this->isPaid = false;
        $this->amout = 0;
        $this->items = new ArrayCollection();

    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCreateAt(): ?\DateTimeInterface
    {
        return $this->createAt;
    }

    public function setCreateAt(?\DateTimeInterface $createAt): self
    {
        $this->createAt = $createAt;

        return $this;
    }

    public function getStatus(): ?string
    {
        return $this->status;
    }

    public function setStatus(?string $status): self
    {
        $this->status = $status;

        return $this;
    }

    public function getIsPaid(): ?bool
    {
        return $this->isPaid;
    }

    public function setIsPaid(bool $isPaid): self
    {
        $this->isPaid = $isPaid;

        return $this;
    }

    public function getAmout()
    {
        return $this->amout;
    }

    public function setAmout($amout): self
    {
        $this->amout = $amout;

        return $this;
    }

    /**
     * @return Collection|OrderItem[]
     */
    public function getItems(): Collection
    {
        return $this->items;
    }

    public function addItem(OrderItem $item): self
    {
        if (!$this->items->contains($item)) {
            $this->items[] = $item;
            $item->setOrders($this);
            $this->updateAmount();
        }

        return $this;
    }

    public function removeItem(OrderItem $item): self
    {
        if ($this->items->contains($item)) {
            $this->items->removeElement($item);

            // set the owning side to null (unless already changed)
            if ($item->getOrders() === $this) {
                $item->setOrders(null);
            }
            $this->updateAmount();
        }

        return $this;
    }

    public function updateAmount()
    {
        $total = 0;

        foreach ($this->items as $item) {
            $total += $item->getTotal();
        }
        $this->amout = $total;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }

    public function getProductsCount()
    {
        $count = 0;

        foreach ($this->items as $item) {
            $count += $item->getQuantityOfOrder();
        }
        return $count;
    }
}
