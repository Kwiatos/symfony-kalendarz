<?php

namespace SMSApi\Common\ModelBundle\Repository;

use Doctrine\ORM\EntityRepository;

use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;

class BaseDoctrineEntityRepository extends EntityRepository {
	
	public function save($entity) {
		$this->_em->persist ( $entity );
		$this->flush ();
	}
	
	public function merge($entity) {
		$this->_em->merge ( $entity );
		$this->flush ();
	}
	
	public function remove($entity) {
		$this->_em->remove ( $entity );
		$this->flush ();
	}
	
	public function refresh($entity) {
		$this->_em->refresh ( $entity );
		$this->flush ();
	}
	
	public function flush() {
		return $this->_em->flush ();
	}
	
	public function transactionStart() {
		return $this->_em->beginTransaction ();
	}
	
	public function transactionCommit() {
		return $this->_em->commit ();
	}
	
	public function transactionRollback() {
		return $this->_em->rollback ();
	}
}