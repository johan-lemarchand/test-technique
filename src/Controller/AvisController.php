<?php

namespace App\Controller;

use App\Data\SearchData;
use App\Entity\Avis;
use App\Entity\Product;
use App\Form\AvisType;
use App\Form\SearchType;
use App\Repository\AvisRepository;
use App\Service\FileUploader;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Twig\NodeVisitor\SafeAnalysisNodeVisitor;

class AvisController extends AbstractController
{
    /**
     * @Route("/avis", name="avis")
     * @param AvisRepository $avisRepository
     * @param Request $request
     * @return Response
     */
    public function index(AvisRepository $avisRepository, Request $request)
    {
        $data = new SearchData();
        $form = $this->createForm( SearchType::class, $data);
        $form->handleRequest($request);
        $avis = $avisRepository->findSearch($data);
        return $this->render('avis/list.html.twig', [
            'avis' => $avis,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/avis/add/{id}", name="avis_add", requirements={"id": "\d+"})
     * @param Product $product
     * @param Request $request
     * @param FileUploader $fileUploader
     * @return RedirectResponse|Response
     */
    public function add(Product $product,Request $request, FileUploader $fileUploader)
    {
        $avis = new Avis();
        $form = $this->createForm(AvisType::class, $avis);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $avis -> setProduct($product);
            $imageFile = $form['picture']->getData();

            if ($imageFile) {

                $imageFileName = $fileUploader->uploadAvatar($imageFile);
                $avis->setPicture($imageFileName);
            }
            // On récupère l'entity manager
            $em = $this->getDoctrine()->getManager();

            $em->persist($avis);
            $em->flush();
            $this->addFlash(
                'success',
                "le commentaire est posté"
            );


            // On redirige l'utilisateur
            return $this->redirectToRoute('product');
        }
            return $this->render('avis/form.html.twig', [
                'form' => $form->createView(),

            ]);

    }
}

