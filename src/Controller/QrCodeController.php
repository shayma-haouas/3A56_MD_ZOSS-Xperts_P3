<?php



namespace App\Controller;

use App\Form\SearchType;
use App\Services\QrcodeService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class QrCodeController extends AbstractController
{
    #[Route('/qr/code', name: 'app_qr_code')]
    public function index(Request $request, QrcodeService $qrcodeService): Response
    {
        $qrCode = null;
        $form = $this->createForm(SearchType::class, null);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $data = $form->getData();
            $query = $data['email'] . ' ' . $data['firstname'] . ' ' . $data['lastname'];
            $qrCode = $qrcodeService->qrcode($query);
 
        }

        return $this->render('qr_code/index.html.twig', [
            'form' => $form->createView(),
            'qrCode' => $qrCode
        ]);
    }
}