<?php

namespace App\Controller;

use App\Entity\Dish;
use App\Entity\Order;
use App\Repository\DishRepository;
use App\Repository\OrderRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class OrderController extends AbstractController
{
    private $doctrine;
    public function __construct(ManagerRegistry $doctrine)
    {
        $this->doctrine = $doctrine;
    }

    public function index(OrderRepository $orderRepository): Response
    {
        $orders = $orderRepository->findBy(
            ['table_no' => 'table1']
        );
        return $this->render('order/index.html.twig', [
            'orders' => $orders,
        ]);
    }

    public function order(Dish $dish)
    {
        $order = new Order();
        $order->setTableNo("table1");
        $order->setName($dish->getName());
        $order->setOrderNo($dish->getId());
        $order->setPrice($dish->getPrice());
        $order->setStatus("Open");
        $order->setTotal(0);

        $em = $this->doctrine->getManager();
        $em->persist($order);
        $em->flush();

        $this->addFlash("success", $dish->getName() . " was added to the order");
        return $this->redirect($this->generateUrl("menu"));

    }

    public function status($id, $status){
        $em = $this->doctrine->getManager();
        $order = $em->getRepository(Order::class)->find($id);
        $order->setStatus($status);
        $em->flush();

        return $this->redirect($this->generateUrl("order"));
    }

    public function delete($id, OrderRepository $orderRepository){
        $em = $this->doctrine->getManager();
        $order = $orderRepository->find($id);
        $em->remove($order);
        $em->flush();

        $this->addFlash("success","Order: ".$order->getName() ." has been removed.");
        return $this->redirect($this->generateUrl("order"));
    }
}
