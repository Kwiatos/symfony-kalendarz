<?php

namespace SMSApi\Bundle\CalendarBundle\Model;

use SMSApi\Common\ModelBundle\Model\BaseDoctrineEntityModel;

use Selly\WebappLandingNewsletterBundle\Entity\NewsletterEntry;

use DateTime;

class EventModel extends BaseDoctrineEntityModel {
	
	public function getEventsBetweenDates(DateTime $start, DateTime $stop) {
		$q = $this->getRepository()->createQueryBuilder('item');

		$q->where(
			$q->expr()->orX(
				// case in middle
				// ---[---######---]---
				$q->expr()->andX(
					$q->expr()->gte('item.dateStart', $q->expr()->literal($start->format("Y-m-d H:i:s"))),
					$q->expr()->lte('item.dateStop', $q->expr()->literal($stop->format("Y-m-d H:i:s")))
				),

				// case on end
				// --###[##---]---
				$q->expr()->andX(
					$q->expr()->lte('item.dateStart', $q->expr()->literal($start->format("Y-m-d H:i:s"))),
					$q->expr()->gte('item.dateStop', $q->expr()->literal($start->format("Y-m-d H:i:s"))),

					$q->expr()->lte('item.dateStart', $q->expr()->literal($stop->format("Y-m-d H:i:s"))),
					$q->expr()->lte('item.dateStop', $q->expr()->literal($stop->format("Y-m-d H:i:s")))
				),

				// case at begin
				// ---[---##]##---
				$q->expr()->andX(
					$q->expr()->gte('item.dateStart', $q->expr()->literal($start->format("Y-m-d H:i:s"))),
					$q->expr()->gte('item.dateStop', $q->expr()->literal($start->format("Y-m-d H:i:s"))),

					$q->expr()->lte('item.dateStart', $q->expr()->literal($stop->format("Y-m-d H:i:s"))),
					$q->expr()->gte('item.dateStop', $q->expr()->literal($stop->format("Y-m-d H:i:s")))
				),

				// case overflow
				// ---###[####]##---
				$q->expr()->andX(
					$q->expr()->lte('item.dateStart', $q->expr()->literal($start->format("Y-m-d H:i:s"))),
					$q->expr()->gte('item.dateStop', $q->expr()->literal($stop->format("Y-m-d H:i:s")))
				)
			)
		);

		return $q->getQuery()->getResult();
	}
}
