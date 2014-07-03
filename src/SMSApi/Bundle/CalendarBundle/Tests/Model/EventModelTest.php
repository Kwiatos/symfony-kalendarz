<?php

namespace SMSApi\Bundle\CalendarBundle\Model;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

use SMSApi\Bundle\CalendarBundle\Entity\EventEntity;

class EventModelTest extends WebTestCase
{
	private $container;

	private $modelEvent;

	private $event1;

	protected function setUp() {
		$client = static::createClient();

		$this->container = $client->getContainer();

		$this->modelEvent = $this->container->get('sms_api_calendar.model.event');

		$this->deleteAllEventsFromDb();

		$event = new EventEntity();
		$event->setDateStart(new \DateTime('2014-07-02 00:00:00'));
		$event->setDateStop(new \DateTime('2014-07-04 00:00:00'));
		$event->setEventName('Ev1');
		$this->modelEvent->save($event);

		$this->event1 = $event;
	}
	protected function tearDown() {
		$this->deleteAllEventsFromDb();
	}

	private function deleteAllEventsFromDb() {
		$results = $this->modelEvent->getRepository()->findAll();
		foreach ($results as $key => $value) {
			$this->modelEvent->remove($value);
		}
	}

    public function testFetchEventInTheMiddle()
    {
    	$start = new \DateTime('2014-07-01 00:00:00');
    	$stop = new \DateTime('2014-07-05 00:00:00');
        $results = $this->modelEvent->getEventsBetweenDates($start, $stop);

        $this->assertEquals(
        	1, count($results),
        	"Only one event should be returned"
        );
        $this->assertTrue(
        	$results[0]->getId() == $this->event1->getId(),
        	"Invalid event returned"
        );
    }

    public function testFetchEventOverflow()
    {
    	$start = new \DateTime('2014-07-01 00:00:00');
    	$stop = new \DateTime('2014-07-06 12:00:00');
        $results = $this->modelEvent->getEventsBetweenDates($start, $stop);

        $this->assertEquals(
        	1, count($results),
        	"No event should be returned"
        );
        $this->assertTrue(
        	$results[0]->getId() == $this->event1->getId(),
        	"Invalid event returned"
        );
    }

    public function testFetchEventAtTheBegining()
    {
    	$start = new \DateTime('2014-07-01 00:00:00');
    	$stop = new \DateTime('2014-07-03 00:00:00');
        $results = $this->modelEvent->getEventsBetweenDates($start, $stop);

        $this->assertEquals(
        	1, count($results),
        	"Only one event should be returned"
        );
        $this->assertTrue(
        	$results[0]->getId() == $this->event1->getId(),
        	"Invalid event returned"
        );
    }

    public function testFetchEventAtTheBeginingOuterTheBound()
    {
    	$start = new \DateTime('2014-06-26 00:00:00');
    	$stop = new \DateTime('2014-07-01 00:00:00');
        $results = $this->modelEvent->getEventsBetweenDates($start, $stop);

        $this->assertEquals(
        	0, count($results),
        	"No event should be returned"
        );
    }

    public function testFetchEventOnTheEnd()
    {
    	$start = new \DateTime('2014-07-03 00:00:00');
    	$stop = new \DateTime('2014-07-05 00:00:00');
        $results = $this->modelEvent->getEventsBetweenDates($start, $stop);

        $this->assertEquals(
        	1, count($results),
        	"Only one event should be returned"
        );
        $this->assertTrue(
        	$results[0]->getId() == $this->event1->getId(),
        	"Invalid event returned"
        );
    }

    public function testFetchEventOnTheEndOuterTheBound()
    {
    	$start = new \DateTime('2014-07-05 00:00:00');
    	$stop = new \DateTime('2014-07-06 00:00:00');
        $results = $this->modelEvent->getEventsBetweenDates($start, $stop);

        $this->assertEquals(
        	0, count($results),
        	"No event should be returned"
        );
    }
}
