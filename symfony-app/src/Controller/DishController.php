<?php

namespace App\Controller;

use App\Entity\Dish;
use App\Form\DishType;
use App\Repository\DishRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class DishController extends AbstractController
{

    private $doctrine;


    public function __construct(ManagerRegistry $doctrine)
    {
        $this->doctrine = $doctrine;
    }
    public function index(DishRepository $dishRepository)
    {
        $dishes = $dishRepository->findAll();
        return $this->render('dish/index.html.twig', [
            'dishes' => $dishes,
        ]);
    }

    public function create(Request $request)
    {
        $dish = new Dish();
        $form = $this->createForm(DishType::class, $dish);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            //EntityManager
            $em = $this->doctrine->getManager();
            $image = $form->get('image')->getData();
            if ($image) {
                $originalFilename = pathinfo($image->getClientOriginalName(), PATHINFO_FILENAME);
                $newFilename = $originalFilename . '-' . uniqid() . '.' . $image->guessExtension();
                $filename = md5(uniqid()) . '.' . $image->getClientOriginalExtension();
            }
            try {
                $image->move(
                    $this->getParameter('images'),
                    $filename
                );
            } catch (\Exception $e) {
                $this->addFlash('error', 'Image file could not be uploaded.');

                return $this->redirect($this->generateUrl('dish'));
            }

            $dish->setImage($filename);
            $em->persist($dish);
            $em->flush();
            $this->addFlash('success', 'Dish added successfully.');

            return $this->redirect($this->generateUrl('dish'));
        }

        return $this->render('dish/create.html.twig', [
            'create' => $form->createView(),
        ]);

    }
    /**
    * @Entity("dish", expr="repository.find(id)")
    */
    public function show(Dish $dish){
        return $this->render('dish/show.html.twig', [
            'dish' => $dish,
        ]);

    }

    public function delete($id, DishRepository $dr)
    {
        $em = $this->doctrine->getManager();
        $dish = $dr->find($id);
        $em->remove($dish);
        $em->flush();
        $this->addFlash('success', 'Dish deleted successfully.');
        return $this->redirect($this->generateUrl('dish'));
    }
}
