<?php

namespace App\Controller;

use App\Entity\RedeemCode;
use App\Form\RedeemCodeFormType;
use Doctrine\ORM\EntityManagerInterface;
use phpDocumentor\Reflection\Types\This;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class RedeemCodeController extends AbstractController
{
    private EntityManagerInterface $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }


    #[Route('/redeem', name: 'redeem-code', methods: ['POST'])]
    public function handleRedeemCode(Request $request): Response {
        $formData = $request->request->all();
        $code = $formData['redeem_code_form']['code'];
        $redeemCode = $this->entityManager->getRepository(RedeemCode::class)->findOneBy(['code' => $code]);

        if ($redeemCode) {
            $message = $this->checkCodeValid($redeemCode);
            $value = $this->getCodeValue($redeemCode);
            return $this->json(['redeemCode' => $message, 'redeemValue' => $value]);
        }

        return $this->json(['redeemCode' => $code]);
    }

    private function checkCodeValid(RedeemCode $redeemCode): string {
        if ($redeemCode->isValid()) {
            return $redeemCode->getCode();
        } else {
            return "Invalid Code";
        }
    }

    private function getCodeValue(RedeemCode $redeemCode): int {
        return $redeemCode->getValue();
    }
}