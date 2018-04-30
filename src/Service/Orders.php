<?php


namespace App\Service;


use App\Entity\Order;
use App\Entity\OrderItem;
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
        $orderItem = null;

        foreach ($order->getItems() as $item){
            if($item->getProduct()->getId() == $product->getId()){
                $orderItem = $item;
                break;
                }
        }

        if (!$orderItem){
            $orderItem = new OrderItem();
            $orderItem->setProduct($product);
            $this->em->persist($orderItem);
            $order->addItem($orderItem);
        }

        $orderItem->setQuantityOfOrder($orderItem->getQuantityOfOrder() + $quantity);
        $this->em->flush();

        return $order;
    }

    public function getToCart()
    {

        $orderId = $this->session->get(self::CARD_ID);

        $order = null;

        if($orderId !== null){
            $result = [];
            $orderItem = $this->em->getRepository(OrderItem::class)->findBy(['orders' => $orderId]);


            foreach ($orderItem as $item){
                $value['number'] = $orderId;
                $value['price'] = $item->getPrice();
                $value['quantity'] = $item->getQuantityOfOrder();
                $value['total'] = $item->getTotal();

                $prId = $item->getProduct()->getId();
                $value['product'] = $this->em->getRepository(Product::class)->find($prId)->getTitle();

                $result[] = $value;
        }
        }else {
            return $order;
        }



        return $result;
    }



}
