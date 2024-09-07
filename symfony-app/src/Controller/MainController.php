<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class MainController extends AbstractController
{
    public function index(): Response
    {
        $tag = date("l");
        $user = [
            'name'=> 'udemy',
            'role'=>'dev',
        ];
        return $this->render('main/index.html.twig', [
            'd' => $tag,
            'user'=> $user
            
        ]);
    }
}
