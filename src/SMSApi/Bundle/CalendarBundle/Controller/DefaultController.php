<?php

namespace SMSApi\Bundle\CalendarBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use SMSApi\Bundle\CalendarBundle\Entity\EventEntity;

class DefaultController extends Controller
{
    public function indexAction()
    {
    	$model = $this->get('sms_api_calendar.model.event');

    	/*$eventEntity = new EventEntity();
    	$eventEntity->setEventName("Testowy event #" . rand(0, 9999));
    	$eventEntity->setDateStart(new \DateTime());
    	$eventEntity->setDateStop(new \DateTime("+2 hours"));

    	$model->save($eventEntity);*/

    	$start = new \DateTime("2014-06-26 08:00:00");
    	$stop = new \DateTime("2014-06-27 08:00:00");
    	$result = $model->getEventsBetweenDates($start, $stop);
    	var_dump($result);exit;

        return $this->render('SMSApiCalendarBundle:Default:index.html.twig', array('name' => 'dupa'));
    }
}
