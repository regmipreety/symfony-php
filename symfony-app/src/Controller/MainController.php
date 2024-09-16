<?php

namespace App\Controller;

use App\Repository\DishRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class MainController extends AbstractController
{
    public function index(DishRepository $dr): Response
    {
        $dishes = $dr->findAll();
        $random_dish = array_rand($dishes, 2);

       return $this->render('main/index.html.twig', [
        'dish1'=> $dishes[$random_dish[0]],
        'dish2'=> $dishes[$random_dish[1]],
       ]);
    }
}
