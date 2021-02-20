<?php

namespace App\Controller;

use App\Repository\AnnoncesRepository;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ListAnnonceController extends AbstractController
{
    /**
     * @Route("/listeannonce", name="list_annonce")
     */
    public function index(AnnoncesRepository $annoncesRepository, PaginatorInterface $paginator, Request $request): Response
    {
        $pagination = $paginator->paginate(
            $annoncesRepository->findAll(),
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
