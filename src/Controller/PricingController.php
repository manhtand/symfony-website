<?php

namespace App\Controller;

use App\Entity\PricingPlan;
use App\Entity\PricingPlanFeature;
use ContainerJZVZaQl\getPricingPlanRepositoryService;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class PricingController extends AbstractController
{
    #[Route('/pricing', name: 'pricing')]
    public function index(ManagerRegistry $doctrine): Response
    {
        $pricingPlans = $doctrine
            ->getRepository(PricingPlan::class)
            ->findAll();

        $features = $doctrine
            ->getRepository(PricingPlanFeature::class)
            ->findAll();

        return $this->render('pricing/index.html.twig', [
            'pricing_plans' => $pricingPlans,
            'features' => $features
        ]);
    }
}
