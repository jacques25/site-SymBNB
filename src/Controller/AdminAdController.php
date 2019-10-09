<?php

namespace App\Controller;

use App\Entity\Ad;
use App\Form\AdType;
use App\Repository\AdRepository;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;


class AdminAdController extends AbstractController
{
    /**
     * @Route("/admin/ads", name="admin_ads_index")
     */
    public function index(AdRepository $repo)
    {

        return $this->render('admin/ad/index.html.twig', [
            'ads' => $repo->findAll()
        ]);
    }

    /**
     * Permet d'editer une annonce
     * @Route("/admin/ad/{id}/edit", name="admin_ad_edit")
     * @param ObjectManager $manager
     * @param Ad $ad
     * @return Response
     */
    public function edit(Ad $ad, Request $request, ObjectManager $manager)
    {

        $form = $this->createForm(AdType::class, $ad);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $manager->persist($ad);
            $manager->flush();
            $this->addFlash('success', "L'annonce a bien été corrigée");
        }
        return $this->render('admin/ad/edit.html.twig', [
            'form' => $form->createView(),
            'ad' => $ad
        ]);
    }
    /**
     * Permet de supprimer une annonce
     * 
     * @Route("/admin/ad/{id}/delete", name="admin_ad_delete")
     * 
     * @param Ad $ad
     * @param ObjectManager $manager
     * @return Response
     */

    public function delete(Ad $ad, ObjectManager $manager)
    {
        if (count($ad->getBookings()) > 0) {
            $this->addFlash(
                'warning',
                "Vous ne pouvez pas supprimer l'annonce <strong>{$ad->getTitle()}</strong> car elle possède des réservations."
            );
        } else {
            $manager->remove($ad);
            $manager->flush();
            $this->addFlash("success", "L'annonce <strong>{$ad->getTitle()}</strong> a bien été supprimmée.");
        }
        return $this->redirectToRoute('admin_ads_index');
    }
}