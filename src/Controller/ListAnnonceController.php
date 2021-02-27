<?php

namespace App\Controller;

use App\Entity\Annonces;
use App\Repository\AnnoncesRepository;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ListAnnonceController extends AbstractController
{
    /**
     * @Route("/liste-annonce", name="list_annonce")
     */
    public function index(AnnoncesRepository $annoncesRepository, PaginatorInterface $paginator, Request $request): Response
    {
        $data = $this->getDoctrine()->getRepository(Annonces::class)->findBy([],['created_at' => 'desc']);
        $pagination = $paginator->paginate(
            $data,
            $request->query->getInt('page', 1),
            12
        );

        return $this->render('list_annonce/index.html.twig', [
            'controller_name' => 'ListAnnonceController',
            'annonces' => $annoncesRepository->findAll(),
            'pagination' => $pagination
        ]);
    }
}
