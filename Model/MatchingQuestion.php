<?php
App::uses('AppModel', 'Model');
/**
 * MatchingQuestion Model
 *
 * @property UsersMatchingAnswer $UsersMatchingAnswer
 */
class MatchingQuestion extends AppModel {

/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'description';

/**
 * Behaviors
 *
 * @var array
 */
	public $actsAs = array('Containable');

/**
 * hasMany associations
 *
 * @var array
 */
	public $hasMany = array(
		'MatchingAnswer' => array(
			'className' => 'MatchingAnswer',
			'foreignKey' => 'matching_question_id',
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
		'UserMatchingAnswer' => array(
			'className' => 'UserMatchingAnswer',
			'foreignKey' => 'matching_question_id',
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
