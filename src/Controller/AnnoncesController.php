<?php

namespace App\Controller;

use App\Entity\Annonces;
use App\Entity\Comment;
use App\Entity\User;
use App\Form\AnnoncesType;
use App\Form\CommentType;
use App\Repository\AnnoncesRepository;
use App\Repository\CommentRepository;
use App\Repository\UserRepository;
use Knp\Component\Pager\PaginatorInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/annonces")
 */
class AnnoncesController extends AbstractController
{
    /**
     * @Route("/", name="annonces_index", methods={"GET"})
     * @IsGranted("ROLE_USER")
     */
    public function index(AnnoncesRepository $annoncesRepository, PaginatorInterface $paginator, Request $request): Response
    {
        $data = $annoncesRepository->findBy(['author' => $this->getUser()->getId()]);
        $pagination = $paginator->paginate(
        $data,
        $request->query->getInt('page', 1),
        20
        );

        return $this->render('annonces/index.html.twig', [
            'annonceuser' => $data,
            'pagination' => $pagination
        ]);
    }

    /**
     * @Route("/new", name="annonces_new", methods={"GET","POST"})
     * @IsGranted("ROLE_USER")
     */
    public function new(Request $request): Response
    {
        $annonce = new Annonces();
        $date = new \DateTime('NOW');
        $date->format('d/m/Y');
        $annonce->setCreatedAt($date);
        $user = $this->getUser();
        $annonce->setAuthor($user);
        $form = $this->createForm(AnnoncesType::class, $annonce);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($annonce);
            $entityManager->flush();

            return $this->redirectToRoute('annonces_index');
        }

        return $this->render('annonces/new.html.twig', [
            'annonce' => $annonce,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="annonces_show", methods={"GET","POST"})
     */
    public function show(Annonces $annonce, Request $request): Response
    {
        $comments = $annonce->getComments();

        $newComment = new Comment();
        $date = new \DateTime('NOW');
        $date->format('d/m/Y');
        $newComment->setCreatedAt($date);
        $user = $this->getUser();
        $newComment->setAuthor($user);
        $newComment->setAnnonces($annonce);
        $commentForm = $this->createForm(CommentType::class, $newComment);
        $commentForm->handleRequest($request);

        if ($commentForm->isSubmitted() && $commentForm->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($newComment);
            $entityManager->flush();

            return $this->redirectToRoute('annonces_show', ['id' => $annonce->getId()]);
        }

        return $this->render('annonces/show.html.twig', [
            'annonce' => $annonce,
            'comments' => $comments,
            'commentForm' => $commentForm->createView()
        ]);
    }

    /**
     * @Route("/{id}/edit", name="annonces_edit", methods={"GET","POST"})
     * @IsGranted("ROLE_USER")
     */
    public function edit(Request $request, Annonces $annonce): Response
    {
        $form = $this->createForm(AnnoncesType::class, $annonce);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('annonces_index');
        }

        return $this->render('annonces/edit.html.twig', [
            'annonce' => $annonce,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="annonces_delete", methods={"DELETE"})
     * @IsGranted("ROLE_USER")
     */
    public function delete(Request $request, Annonces $annonce): Response
    {
        if ($this->isCsrfTokenValid('delete'.$annonce->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $comments = $annonce->getComments();
            foreach($comments as $comment){
                $entityManager->remove($comment);
            }
            $entityManager->remove($annonce);
            $entityManager->flush();
        }

        return $this->redirectToRoute('annonces_index');
    }
}
