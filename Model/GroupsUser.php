<?php
App::uses('AppModel', 'Model');
/**
 * GroupsUser Model
 *
 * @property User $User
 * @property Group $Group
 */
class GroupsUser extends AppModel {


	public function getGroupAndUsers($group_id = null) {
		return $this->Group->find('first', array(
			'conditions' => array(
				'Group.id' => $group_id
			)
		));
	}

/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
		'User' => array(
			'className' => 'User',
			'foreignKey' => 'user_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Group' => array(
			'className' => 'Group',
			'foreignKey' => 'group_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
}