<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\UserType;
use App\Repository\AnnoncesRepository;
use App\Repository\UserRepository;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Twig\Profiler\Profile;

class ProfileController extends AbstractController
{
    /**
     * @Route("/profile ", name="profile")
     * @IsGranted("ROLE_USER")
     */
    public function index(AnnoncesRepository $annoncesRepository): Response
    {
        return $this->render('profile/index.html.twig', [
            'controller_name' => 'ProfileController',
            'user' => $this->getUser(),
            'annonces' => $annoncesRepository->findThreeLastEntityOfUser($this->getUser())
        ]);
    }

    /**
     * @Route("/profile/{username}/edit", name="profile_edit", methods={"GET","POST"})
     * @IsGranted("ROLE_USER")
     */
    public function edit(Request $request, User $user)
    {
        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('profile');
        }

        return $this->render('profile/edit.html.twig', [
            'user' => $user,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/profile/{username}", name="show_profile")
     *
     */
    public function show(User $user, AnnoncesRepository $annoncesRepository)
    {
        return $this->render('profile/show.html.twig', [
            'user' => $user,
            'annonces' => $annoncesRepository->findThreeLastEntityOfUser($user)
        ]);
    }
}
