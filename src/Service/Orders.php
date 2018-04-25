<?php


namespace App\Service;


use App\Entity\Order;
use App\Entity\Product;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

class Orders
{
    const CARD_ID = 'cart';

    /**
     * @var SessionInterface
     */
    private $session;

    /**
     * @var EntityManagerInterface
     */
    private $em;

    public function __construct(SessionInterface $session, EntityManagerInterface $em)
    {
        $this->session = $session;
        $this->em = $em;
    }

    public function hasCart()
    {
       return  $cart = $this->session->has(self::CARD_ID);
    }

    public function getCard( ): Order
    {

        $orderId = $this->session->get(self::CARD_ID);

        $order = null;

        if($orderId !== null){
            $order = $this->em->find(Order::class, $orderId);
        }

        if($order === null){
            $order = new Order();
            $this->em->persist($order);
            $this->em->flush();
        }

        $this->session->set(self::CARD_ID, $order->getId());

        return $order;
    }

    public function addToCart(Product $product, $quantity)
    {
        $order = $this->getCard();
        $existingItem = null;

        foreach ($order->getItems() as $item){
            if($item->getProduct()->getId() == $product->getId()){
                $existingItem = $item;
                break;
                }
        }

    }
}
