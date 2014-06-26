<?php

namespace SMSApi\Common\ModelBundle\Model;

use SMSApi\Common\ModelBundle\Repository\BaseDoctrineEntityRepository;

class BaseDoctrineEntityModel {
	
	/**
	 * @var \SMSApi\Common\ModelBundle\Repository\BaseDoctrineEntityRepository
	 */
	public $entityRepository;
	
	/**
	 * @param $entityRepository \SMSApi\Common\ModelBundle\Repository\BaseDoctrineEntityRepository
	 */
	public function setRepository(BaseDoctrineEntityRepository $entityRepository) {
		$this->entityRepository = $entityRepository;
	}
	
	/**
	 * @return \SMSApi\Common\ModelBundle\Repository\BaseDoctrineEntityRepository
	 */
	public function getRepository() {
		return $this->entityRepository;
	}
	
	public function save($entity) {
		$this->getRepository()->save ( $entity );
		$this->flush ();
	}
	
	public function merge($entity) {
		$this->getRepository()->merge ( $entity );
		$this->flush ();
	}
	
	public function remove($entity) {
		$this->getRepository()->remove ( $entity );
		$this->flush ();
	}
	
	public function refresh($entity) {
		$this->getRepository()->refresh ( $entity );
		$this->flush ();
	}
	
	public function flush() {
		return $this->getRepository()->flush ();
	}
	
	public function transactionStart() {
		return $this->getRepository()->transactionStart ();
	}
	
	public function transactionCommit() {
		return $this->getRepository()->transactionCommit ();
	}
	
	public function transactionRollback() {
		return $this->getRepository()->transactionRollback ();
	}
	
	public function __call($method, $args) {
		return call_user_func_array(array($this->entityRepository, $method), $args);
	}
}
