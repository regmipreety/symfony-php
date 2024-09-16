<?php

namespace App\Controller;

use App\Repository\CategoryRepository;
use App\Repository\DishRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class MenuController extends AbstractController
{
    public function menu(DishRepository $dr, CategoryRepository $cr)
    {
        $dishes = $dr->findAll();
        $categories = $cr->findAll();
        return $this->render('menu/index.html.twig', [
            'dishes' => $dishes,
            'categories'=> $categories
        ]);
    }
}
