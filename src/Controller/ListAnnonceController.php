<?php

namespace App\Controller;

use App\Data\SearchData;
use App\Entity\Annonces;
use App\Form\SearchForm;
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
        $searchData = new SearchData();
        $searchData->page = $request->get('page', 1);
        $form = $this->createForm(SearchForm::class, $searchData);
        $form->handleRequest($request);
        $annonces = $annoncesRepository->findSearch($searchData);

        $data = $this->getDoctrine()->getRepository(Annonces::class)->findBy([],['created_at' => 'desc']);


        return $this->render('list_annonce/index.html.twig', [
            'controller_name' => 'ListAnnonceController',
            'annonces' => $annonces,
            'form' => $form->createView()
        ]);
    }
}
