<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CalendarController extends AbstractController
{
       
     #Route("/clnd", name="main")
    
    public function index(CalendarRepository $calendar)
{
    $events = $calendar->findAll();

    $rdvs = [];

    foreach($events as $event){
        $rdvs[] = [
            'id' => $event->getId(),
            'start' => $event->getStart()->format('Y-m-d H:i:s'),
            'end' => $event->getEnd()->format('Y-m-d H:i:s'),
            'title' => $event->getTitle(),
            'description' => $event->getDescription(),
            'backgroundColor' => $event->getBackgroundColor(),
            'borderColor' => $event->getBorderColor(),
            'textColor' => $event->getTextColor(),
            'allDay' => $event->getAllDay(),
        ];
    }

    $data = json_encode($rdvs);

    return $this->render('main/index.html.twig', ['data'=> $data]);
}

}








