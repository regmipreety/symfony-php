<?php

namespace App\Controller;

use App\Entity\Article;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Doctrine\Persistence\ManagerRegistry;

class ArticleController extends AbstractController
{

    private $doctrine;


    public function __construct(ManagerRegistry $doctrine)
    {
        $this->doctrine = $doctrine;
    }

    public function index()
    {
        $article = new Article();
        $article->setTitle("My First Blog");
        $em = $this->doctrine->getManager();
        $em->persist($article);
        $em->flush();
        return new Response("Article saved successfully.");

    }

    public function show_all()
    {
        $em = $this->doctrine->getManager();
        $article = $em->getRepository(Article::class)->findAll();
        return $this->render('article/index.html.twig', [
            'articles' => $article
        ]);

    }

    public function show($id)
    {

        $em = $this->doctrine->getManager();
        $article = $em->getRepository(Article::class)->findOneBy([
            'id' => $id
        ]);

        return $this->render('article/index.html.twig', [
            'articles' => $article
        ]);

    }

    public function delete($id)
    {
        $em = $this->doctrine->getManager();
        $article = $em->getRepository(Article::class)->findOneBy([
            'id' => $id
        ]);

        $em->remove($article);
        $em->flush();
        return new Response("Article deleted successfully");

    }
}
