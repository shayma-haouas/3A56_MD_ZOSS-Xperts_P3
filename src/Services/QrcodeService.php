<?php

namespace App\Services;

use Endroid\QrCode\Color\Color;
use Endroid\QrCode\ErrorCorrectionLevel;
use Endroid\QrCode\Label\Margin\Margin;
use Endroid\QrCode\Encoding\Encoding;
use Endroid\QrCode\Builder\BuilderInterface;
use Endroid\QrCode\ErrorCorrectionLevel\ErrorCorrectionLevelHigh;
use Endroid\QrCode\Label\Alignment\LabelAlignmentCenter;

class QrcodeService
{
    /**
     * @var BuilderInterface
     */
    protected $builder;

    public function __construct(BuilderInterface $builder)
    {
        $this->builder = $builder;
    }

    public function qrcode($query)
    {
        $url = 'https://www.google.com/search?q=';

        $objDateTime = new \DateTime('NOW');
        $dateString = $objDateTime->format('d-m-Y H:i:s');

        $path = dirname(__DIR__, 2) . '/public/assets/';

        // set qrcode
        $result = $this->builder
            ->data($url . $query)
            ->encoding(new Encoding('UTF-8'))

            ->size(190)
            ->margin(10)
            ->labelText($dateString)

            ->labelMargin(new Margin(15, 5, 5, 5))
            ->logoPath($path . 'img/logo.png')
            ->logoResizeToWidth('100')
            ->logoResizeToHeight('100')
            ->backgroundColor(new Color(221, 1, 3))
            ->build();

        // Générer un nom de fichier unique
        $namePng = uniqid('', '') . '.png';

        // Sauvegarder l'image en fichier PNG
        $filePath = $path . 'qr_code/' . $namePng;
        $success = $result->saveToFile($filePath);


       
        return $result->getDataUri();
    }
    
}
