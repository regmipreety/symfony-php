<?php

namespace App\Controller;

use App\Entity\User;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Attribute\Route;

class RegistrationController extends AbstractController
{
    private $doctrine;
    public function __construct(ManagerRegistry $doctrine)
    {
        $this->doctrine = $doctrine;
    }
    public function register(Request $request, UserPasswordHasherInterface $passEncoder)
    {
        $registrationForm = $this->createFormBuilder()
            ->add('username', TextType::class, [
                'label' => 'Employee'])
            ->add('password', RepeatedType::class, [
                'type' => PasswordType::class,
                'required' => true,
                'first_options' => ['label' => 'Password'],
                'second_options' => ['label' => 'Password Confirmation']
                ])
            ->add('registrationForm', SubmitType::class)
            ->getForm();

            $registrationForm->handleRequest($request);
            if($registrationForm->isSubmitted() && $registrationForm->isValid()){
                $data = $registrationForm->getData();

                $user = new User();
                $user->setUsername($data['username']);
                $user->setPassword(
                    $passEncoder->hashPassword($user, $data['password'])
                );

                $em = $this->doctrine->getManager();
                $em->persist($user);
                $em->flush();

                return $this->redirect($this->generateUrl('main'));
            }
        return $this->render('registration/index.html.twig', [
            'regform'=> $registrationForm->createView()
        ]);
    }
}
