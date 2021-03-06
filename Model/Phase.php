<?php
App::uses('AppModel', 'Model');
/**
 * Phase Model
 *
 * @property Mission $Mission
 * @property Evidence $Evidence
 * @property Quest $Quest
 */
class Phase extends AppModel {

/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'name';


	//The Associations below have been created with all possible keys, those that are not needed can be removed

	public function getNextPhase($phase, $id) {

		$mps = $this->Mission->Phase->find('all', array(
			'conditions' => array(
				'Phase.mission_id' => $id
		)));

		if($phase['Phase']['position'] == count($mps))
			return null;

		foreach($mps as $key => $mp):
			if($mp['Phase']['position'] == $phase['Phase']['position'] + 1):
				return $mp;
				break;
			endif;
		endforeach;

	}

	public function getPrevPhase($phase, $id) {

		if($phase['Phase']['position'] == 1)
			return null;

		$mps = $this->Mission->Phase->find('all', array(
			'conditions' => array(
				'Phase.mission_id' => $id
		)));

		foreach($mps as $key => $mp):
			if($mp['Phase']['position'] == $phase['Phase']['position'] - 1):
				return $mp;
				break;
			endif;
		endforeach;

	}

/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
		'Mission' => array(
			'className' => 'Mission',
			'foreignKey' => 'mission_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);

/**
 *
 * hasMany associations
 *
 * @var array
 */
	public $hasMany = array(
		'Evidence' => array(
			'className' => 'Evidence',
			'foreignKey' => 'phase_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		),
		'Quest' => array(
			'className' => 'Quest',
			'foreignKey' => 'phase_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		)
	);

}
