<?php

namespace App\Controller;


use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class ProfileController extends Controller
{
    /**
     * @Route("/profile", name="profile")
     */
    public function index()
    {
        $user = $this->getUser();
      if($user == null ){
          return $this->redirectToRoute('login');
      }


        return $this->render('profile/index.html.twig', [
            'controller_name' => 'ProfileController',
                        'user' => $user
        ]);
    }

    /**
     * @Route("/profile/edit", name="profile_edit")
     */
    public function edit(Request $request,
                            EntityManagerInterface $em)
    {
        $userLogin = $this->getUser();

        $id = $userLogin->getId();

        $form = $this->createFormBuilder()
            ->add('username', TextType::class, array(
                'data' =>$userLogin->getUsername(),
                'attr' => array(
                    'disabled' => 'disabled')))
            ->add('email', EmailType::class, array(
                'data' =>$userLogin->getEmail(),
                'attr' => array(
                    'disabled' => 'disabled')))
           ->add('firstname', TextType::class, array(
                    'data' => $userLogin->getFirstname()))
            ->add('lastname', TextType::class, array(
              'data' => $userLogin->getLastname()))

            ->getForm();

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $userbd = $em->getRepository(User::class)->find($id);
            $dataform = $form->getData();

            $userbd->setFirstName($dataform['firstname']);
            $userbd->setLastName($dataform['lastname']);


            $em->persist($userbd);
            $em->flush();


            return $this->render('profile/edit_save.html.twig', [
                'controller_name' => 'ProfileController',

            ]);

        }


        return $this->render('profile/edit.html.twig', [
            'controller_name' => 'ProfileController',
            'form' => $form->createView()
        ]);
    }
}
