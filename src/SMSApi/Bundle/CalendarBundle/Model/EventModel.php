<?php

namespace SMSApi\Bundle\CalendarBundle\Model;

use SMSApi\Common\ModelBundle\Model\BaseDoctrineEntityModel;

use Selly\WebappLandingNewsletterBundle\Entity\NewsletterEntry;

use DateTime;

class EventModel extends BaseDoctrineEntityModel {
	
	public function getEventsBetweenDates(DateTime $start, DateTime $stop) {
		$q = $this->getRepository()->createQueryBuilder('item');

		$q->where($q->expr()->gt('item.dateStart', $start->format("Y-m-d H:i:s")));
		$q->where($q->expr()->lt('item.dateStop', $start->format("Y-m-d H:i:s")));

		return $q->getQuery()->getResult();
	}
}
