<?php

require APP.'Vendor'.DS.'facebook'.DS.'php-sdk'.DS.'src'.DS.'facebook.php';

App::uses('AppController', 'Controller');

/**
 * Users Controller
 *
 * @property User $User
 * @property PaginatorComponent $Paginator
 */
class UsersController extends AppController {

/**
 * Components
 *
 * @var array
 */
	public $components = array('Paginator');

	public $uses = array('User', 'Friend');

	public $user = null;

	public $helpers = array('Menu');

/**
*
* beforeFilter method
*
* @return void
*/
	public function beforeFilter() {
        parent::beforeFilter();
        $this->Auth->allow('add', 'logout', 'register');        
    }


/**
 * login method
 *
 * @return void
 */
	public function login() {
		//debug($this->Auth);
		$facebook = new Facebook(array(
			'appId' => Configure::read('fb_app_id'),
			'secret' => Configure::read('fb_app_secret'),
			'allowSignedRequest' => false,
			
		));

		if(isset($this->params['url']['code'])) {

			$token = $facebook->getAccessToken();

			if (!empty($token)) {

				$userFbData = $facebook->getUser();
				$user_profile = '';

				try {
					$user_profile = $facebook->api('/me');
				} catch (FacebookApiException $e) {
					error_log($e);
					$userFbData = null;
				}

				$user = $this->User->find('first', array('conditions' => array('facebook_id' => $user_profile['id'])));

				if(empty($user)) {

					// User does not exist in DB, so we are going to create

					$this->User->create();
					$user['User']['facebook_id'] = $user_profile['id'];
					$user['User']['facebook_token'] = $token;
					$user['User']['name'] = $user_profile['name'];
					$user['User']['sex'] = $user_profile['gender'];
					$user['User']['login'] = $user_profile['username'];
					$user['User']['facebook'] = $user_profile['link'];
					$user['User']['role_id'] = 3;

					if($this->User->save($user)) {
						$user['User']['id'] = $this->User->id;
						$this->Auth->login($user);
						// $this->Session->write('Auth.User.id', $this->User->getLastInsertID());
						//return $this->redirect(array('action' => 'dashboard'));
						return $this->redirect(array('action' => 'edit', $this->User->id));
					} else {
						$this->Session->setFlash(__('There was some interference in your connection.'), 'error');
						return $this->redirect(array('action' => 'login'));
					}

				} else {

					// User exists, so we just force login
					// TODO: check if any data changed since last Facebook login, then update in our table

					// We need to update the Facebook token, once web tokens are short-term only
					$this->User->id = $user['User']['id'];
					$this->User->set('facebook_token', $token);
					$this->User->save();

					$user['User']['id'] = $this->User->id;
					$this->Auth->login($user);
					// $this->Session->write('Auth.User.id', $user['User']['id']);
					return $this->redirect(array('action' => 'dashboard', $this->User->id));

				}
				
			}

		} else if ($this->Auth->login()) {

			return $this->redirect(array('action' => 'dashboard', $this->User->id));

		} else {
			$fbLoginUrl = $facebook->getLoginUrl();
			$this->set(compact('fbLoginUrl'));
		}
	}


/**
 * logout method
 *
 * @return void
 */
	public function logout() {
		$this->redirect($this->Auth->logout());
	}

/**
*
 * index method
 *
 * @return void
 */
	public function index() {
		$this->User->recursive = 0;
		$this->set('users', $this->Paginator->paginate());
	}

/**
 *
 * register method
 *
 * @return void
 */
	public function register() {
		//check to see if logged in
		if(!is_null($this->Auth->user())) 
			return $this->redirect(array('action' => 'dashboard', $this->User->id));
		
		if ($this->request->is('post')) {
			$this->User->create();
			$this->request->data['User']['role_id'] = 3;//sets user as a common user
			if ($this->User->save($this->request->data)) {
				$user = $this->User->save($this->request->data);
				$this->Session->setFlash(__('The user has been saved.'));
				$user['User']['id'] = $this->User->id;
				$user['User']['role_id'] = $this->User->role_id;
				$this->Auth->login($user);
				return $this->redirect(array('action' => 'edit', $this->User->id));
				//return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The user could not be saved. Please, try again.'));
			}
		}
		$roles = $this->User->Role->find('list');		
		$this->set(compact("roles"));
	}

/**
 *
 * dashboard method
 *
 * @return void
 */
	public function dashboard($id = null) {
		$me = $this->getUserId();
		if(is_null($id)){
			//send him to his on dashboard
			$id = $me;
		}
		if (!$this->User->exists($id)) {
			throw new NotFoundException(__('Invalid user'));
		}

		$user = $this->User->find('first', array('conditions' => array('User.id' => $id)));

		$users = $this->User->find('first', array('conditions' => array('User.id' => $this->getUserId())));

		$myPoints = $this->User->Point->find('all', array('conditions' => array('Point.user_id' => $this->getUserId())));

		$sumMyPoints = $this->getPoints($this->getUserId());
		
		$myLevel = $this->getLevel($sumMyPoints);

		$this->loadModel('Level');

		$thisLevel = $this->Level->find('first', array('conditions' => array('Level.level' => $myLevel+1)));

		if(!empty($thisLevel))
			$percentage = round(($sumMyPoints / $thisLevel['Level']['points']) * 100);
		else
			$percentage = 0;

		$points = $this->User->Point->find('all', array('conditions' => array('Point.user_id' => $id)));

		$sumPoints = $this->getPoints($id);

		$level = $this->getLevel($sumPoints);

		$otherLevel = $this->Level->find('first', array('conditions' => array('Level.level' => $level+1)));

		if(!empty($thisLevel))
			$percentageOtherUser = round(($sumPoints / $otherLevel['Level']['points']) * 100);
		else
			$percentageOtherUser = 0;

		$is_friend = $this->User->UserFriend->find('first', array('conditions' => array('UserFriend.user_id' => $this->getUserId(), 'UserFriend.friend_id' => $id)));

		$allies = array();

		$friends = $this->User->UserFriend->find('all', array('conditions' => array('UserFriend.user_id' => $id))); //this->getUserId()

		$are_friends = array();
		//$allies = array();

		foreach($friends as $friend){
			array_push($are_friends, array('User.id' => $friend['UserFriend']['friend_id']));
		}

		$this->loadModel('Notification');

		if(!empty($are_friends)){
			$allies = $this->User->find('all', array(
				'conditions' => array(
					'OR' => $are_friends
			)));

			$notifies = $this->Notification->find('all', array(
				'conditions' => array(
					'OR' => $are_friends
				), 'order' => array(
					'Notification.created DESC'
				)));
		} else{
			$allies = array();
			$notifies = array();
		}

		$evidence = $this->User->Evidence->find('all', array(
			'order' => array(
				'Evidence.created DESC'
			)
		));

		$myevidences = $this->User->Evidence->find('all', array(
			'order' => array(
				'Evidence.created DESC'
			),
			'conditions' => array(
				'Evidence.user_id' => $id
			)
		));

		$this->loadModel('Evokation');
		$evokations = $this->Evokation->find('all', array(
			'order' => array(
				'Evokation.created DESC'
			),
			'conditions' => array(
				'Evokation.sent' => 1
			)
		));

		$evokationsFollowing = $this->User->EvokationFollower->find('all', array(
			'conditions' => array(
				'EvokationFollower.user_id' => $this->getUserId()
			)
		));

		$myEvokations = array();
		foreach ($evokations as $evokation) {
			$mine = false;
			if($evokation['Group']['user_id'] == $id)
				$mine = true;

			$this->loadModel('Group');
			$group_evokation = $this->Group->GroupsUser->find('first', array(
				'conditions' => array(
					'GroupsUser.group_id' => $evokation['Group']['id'],
					'GroupsUser.user_id' => $id
				)
			));
			
			if(!empty($group_evokation))
				$mine = true;

			if($mine){
				array_push($myEvokations, $evokation);
			}	
		}

		//$this->loadModel('Group');
		// $groups = $this->Group->find('all', array('joins' => array(
	 //        array(
	 //            'table' => 'groups_users',
	 //            'alias' => 'GroupsUsers',
	 //            'type' => 'INNER',
	 //            'conditions' => array(
	 //                'GroupsUsers.user_id' => $id
	 //            )
	 //        ), array(
	 //            'table' => 'groups',
	 //            'alias' => 'Groups',
	 //            'type' => 'INNER',
	 //            'conditions' => array(
	 //                'Groups.id = GroupsUsers.group_id'
	 //            )
	 //        )
	 //    )));
	    

		$this->loadModel('Mission');
		$missions = $this->Mission->find('all', array(
			'order' => array('Mission.created')
		));

		$mission_ids = array();
		foreach ($missions as $mission) {
			// $mission_ids[] = array('Attachment.foreign_key' => $mission['Mission']['id'], 'Attachment.model' => 'Mission');

			if($mission['Mission']['basic_training'] == 1)
				$basic_training = $mission;
		}

		$missionIssues = $this->Mission->MissionIssue->find('all');
		$issues = $this->Mission->MissionIssue->Issue->find('all');



		//getting leaderboard data:
			//getting user power points
			$powerpoints_users = array(); // will contain [pp_id][user_id] = total of that pp

			$points_users = array(); // will contain [points][][user]

			$allusers = $this->User->find('all');

			$this->loadModel('PowerPoint');
			$power_points = $this->PowerPoint->find('all');

			$this->loadModel('Point');
			//$points = $this->Point->find('all');
			
			foreach ($allusers as $usr) {
				$points = $this->Point->find('all', array(
					'conditions' => array(
						'Point.user_id' => $usr['User']['id']
					)
				));
				$usrpoints = 0;
				foreach ($points as $point) {
					$usrpoints += $point['Point']['value'];
				}

				$usr['User']['level'] = $this->getLevel($usrpoints);
				$points_users[$usrpoints][] = $usr['User'];



				$powerpoints_user = $this->User->UserPowerPoint->find('all', array(
					'conditions' => array(
						'UserPowerPoint.user_id' => $usr['User']['id']
					)
				));

				$tmp = array();
				foreach ($powerpoints_user as $powerpoint_user) {
					if(isset($tmp[$powerpoint_user['UserPowerPoint']['power_points_id']])) {

						$tmp[$powerpoint_user['UserPowerPoint']['power_points_id']] += $powerpoint_user['UserPowerPoint']['quantity'];
					} else {

						$tmp[$powerpoint_user['UserPowerPoint']['power_points_id']] = $powerpoint_user['UserPowerPoint']['quantity'];
					}
				}
				
				foreach ($power_points as $pp) {
					$qtdUser = 0;
					if(isset($tmp[$pp['PowerPoint']['id']]))
						$qtdUser = $tmp[$pp['PowerPoint']['id']];
					
					$powerpoints_users[$pp['PowerPoint']['id']][$qtdUser][] = $usr['User'];
				}
			}

			foreach ($power_points as $pp) {
				
				krsort($powerpoints_users[$pp['PowerPoint']['id']]);
				
			}
			krsort($points_users);


		//ended leader board data

		//admin notifications check:
		$this->loadModel('AdminNotification');
		
		if(isset($user['AdminNotificationsUser'][0])) {
			//holds the last notification directed to this user
			//debug($user['AdminNotificationsUser']);	
			$last = $user['AdminNotificationsUser'][count($user['AdminNotificationsUser']) - 1];
			//$last['id'] = 0;
		} else {
			$last['admin_notification_id'] = 0;
		}
		
		//get all newer than that one
		$adminNotifications = $this->AdminNotification->find('all', array(
			'conditions' => array(
				'AdminNotification.id >' => $last['admin_notification_id']
			)
		));
		
		foreach ($adminNotifications as $not) {
			//he sees it..
			$insert['AdminNotificationsUser']['user_id'] = $user['User']['id'];
			$insert['AdminNotificationsUser']['admin_notification_id'] = $not['AdminNotification']['id'];

			$this->User->AdminNotificationsUser->create();
			$this->User->AdminNotificationsUser->save($insert);


			$event = new CakeEvent('Controller.AdminNotificationsUser.show', $this, array(
	            'entity_id' => $not['AdminNotification']['id'],
	            'user_id' => $this->getUserId(),
	            'entity' => 'showNotification'
	        ));

	        $this->getEventManager()->dispatch($event);
	        break;
		}
		
		$this->loadModel('Badge');
		$badges = $this->Badge->find('all');

		$this->set(compact('user', 'users', 'is_friend', 'evidence', 'myevidences', 'evokations', 'evokationsFollowing', 'myEvokations', 'missions', 
			'missionIssues', 'issues', 'imgs', 'sumPoints', 'sumMyPoints', 'level', 'myLevel', 'allies', 'allusers', 'powerpoints_users', 
			'power_points', 'points_users', 'percentage', 'percentageOtherUser', 'basic_training', 'notifies',  'badges'));
		//'groups', 'my_photo', 'user_photo',

		if($id == $this->getUserId())
			$this->render('dashboard');
		else
			$this->render('dashboard_alternative');
	}

/**
 *
 * dashboard issue
 * @throws NotFoundException
 * @param string $id
 * @param string $user_id
 *
 * @return void
 */
	public function dashboardByIssue($user_id = null, $id = null) {
		if (!$this->User->exists($user_id)) {
			throw new NotFoundException(__('Invalid user'));
		}

		$user = $this->User->find('first', array('conditions' => array('User.id' => $user_id)));

		$user_data = $this->getUserData();
		$users = $this->User->find('first', array('conditions' => array('User.id' => $user_data['id'])));

		$is_friend = $this->User->UserFriend->find('first', array('conditions' => array('UserFriend.user_id' => $id, 'UserFriend.friend_id' => $user_data['id'])));

		$evidence = $this->User->Evidence->find('all', array('order' => array('Evidence.created DESC')));

		$this->loadModel('Mission');
		$missions = $this->Mission->find('all');
		$issue = $this->Mission->MissionIssue->Issue->find('first', array('conditions' => array('Issue.id' => $id)));
		$missionIssues = $this->Mission->MissionIssue->find('all');
		$missionIssue = $this->Mission->MissionIssue->find('all', array('conditions' => array('MissionIssue.issue_id' => $id)));

		$this->set(compact('user', 'users', 'is_friend', 'evidence', 'issue', 'missions', 'missionIssues', 'missionIssue'));

	}

/**
 *
 * leaderboard
 *
 * @return void
 */
	public function leaderboard() {
		$userid = $this->getUserId();

		$username = explode(' ', $this->getUserName());

		//getting leaderboard data:
			//getting user power points
			$powerpoints_users = array(); // will contain [pp_id][user_id] = total of that pp

			$points_users = array(); // will contain [points][][user]

			$allusers = $this->User->find('all');

			$this->loadModel('PowerPoint');
			$power_points = $this->PowerPoint->find('all');

			$this->loadModel('Point');
			//$points = $this->Point->find('all');
			
			foreach ($allusers as $usr) {
				$points = $this->Point->find('all', array(
					'conditions' => array(
						'Point.user_id' => $usr['User']['id']
					)
				));
				$usrpoints = 0;
				foreach ($points as $point) {
					$usrpoints += $point['Point']['value'];
				}

				$usr['User']['level'] = $this->getLevel($usrpoints);
				$points_users[$usrpoints][] = $usr['User'];



				$powerpoints_user = $this->User->UserPowerPoint->find('all', array(
					'conditions' => array(
						'UserPowerPoint.user_id' => $usr['User']['id']
					)
				));

				$tmp = array();
				foreach ($powerpoints_user as $powerpoint_user) {
					if(isset($tmp[$powerpoint_user['UserPowerPoint']['power_points_id']])) {

						$tmp[$powerpoint_user['UserPowerPoint']['power_points_id']] += $powerpoint_user['UserPowerPoint']['quantity'];
					} else {

						$tmp[$powerpoint_user['UserPowerPoint']['power_points_id']] = $powerpoint_user['UserPowerPoint']['quantity'];
					}
				}
				
				foreach ($power_points as $pp) {
					$qtdUser = 0;
					if(isset($tmp[$pp['PowerPoint']['id']]))
						$qtdUser = $tmp[$pp['PowerPoint']['id']];
					
					$powerpoints_users[$pp['PowerPoint']['id']][$qtdUser][] = $usr['User'];
				}
			}

			foreach ($power_points as $pp) {
				
				krsort($powerpoints_users[$pp['PowerPoint']['id']]);
				
			}
			krsort($points_users);

		$user = $this->User->find('first', array(
			'conditions' => array(
				'User.id' => $this->getUserId()
			)
		));

		$myPoints = $this->User->Point->find('all', array('conditions' => array('Point.user_id' => $this->getUserId())));

		$sumMyPoints = 0;
		
		foreach($myPoints as $point){
			$sumMyPoints += $point['Point']['value'];
		}
		
		$this->set(compact('userid', 'username', 'user', 'users', 'powerpoints_users', 'power_points', 'points_users', 'sumMyPoints'));
	}

/**
 * add_friend method
 *
 * We are using here the HABTM relationship (Has And Belongs To Many, N <-> N approach), in which
 * we created a relationship from model User to itselft, using friends table as join table,
 * which holds two user's id and the DATETIME created to keep track of a friendship start.
 *
 * @return void
 */
	public function add_friend($user_to = null) {

		
		$this->request->data['User']['id'] = $this->getUserId();
		$this->request->data['Friend']['id'] = $user_to;

		if($result = $this->User->saveAll($this->request->data)) {
			$this->redirect(array('action' => 'view', $user_to));
		} else {
			$this->redirect(array('action' => 'view', $user_to));
		}

	}

/**
 * remove_friend method
 *
 * @return void
 */
	public function remove_friend($user_to = null) {

		$user_from = $this->getUserId();

		if($this->User->FriendsUser->deleteAll(array('FriendsUser.user_from' => $user_from, 'FriendsUser.user_to' => $user_to))) {
			$this->redirect(array('action' => 'view', $user_to));
		} else {
			$this->redirect(array('action' => 'view', $user_to));
		}

	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		$flags = array(
			'_self' => false,
			'_friended' => false
		);


		$user_from = $this->getUserId();

		if (!$this->User->exists($id)) {
			throw new NotFoundException(__('Invalid user'));
		}

		$user = $this->User->read(null, $id);


		//check if it's myself, if it is, send to dashboard
		if($user_from == $id) {
			$this->redirect(array('action' => 'dashboard', $id));
		}

		$username = explode(' ', $this->getUserName());

		$this->set(compact('username'));

		$userFriends = $this->User->find('first', array(
			'conditions' => array(
				'User.id' => $user_from
			),
			'contain' => array(
				'Friend' => array(
					'conditions' => array(
						'user_from' => $user_from,
						'user_to' => $id
					)
				)
			)
		));

		$friendship = $userFriends['Friend'];

		if($user['User']['id'] == $user_from) {
			$flags['_self'] = true;
		} else if(isset($friendship) && !empty($friendship)) {
			$flags['_friended'] = true;
		}

		$this->set(compact('user', 'flags'));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->User->create();
			if ($this->User->save($this->request->data)) {
				$this->Session->setFlash(__('The user has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The user could not be saved. Please, try again.'));
			}
		}
		
		$roles = $this->User->Role->find('list');		
		$this->set(compact("roles"));

	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if(is_null($id)){
			$id = $this->getUserId();
		}

		if (!$this->User->exists($id)) {
			throw new NotFoundException(__('Invalid user'));
		}


		//check to see if user is an admin
		//if so, he can edit whoever he likes
		//otherwise, you are not allowed to edit agents but
		// yourself and will be redirected home
		
		if($this->getUserRole() != 1) {
			if($id != $this->getUserId()) {
				$this->Session->setFlash(__("You can't edit other users. Permission denied."), 'flash_message');	
				$this->redirect(array('action' => 'edit', $this->getUserId()));
			}
		}


		$options = array('conditions' => array('User.' . $this->User->primaryKey => $id));
		$user = $this->User->find('first', $options);
		//$this->set(compact('user'));

		$user_photo = $this->User->Attachment->find('first', array(
			'order' => array(
				'Attachment.id DESC'
			),
			'conditions' => array(
				'Attachment.model' => 'User',
				'Attachment.foreign_key' => $id
			)
		));

		$myPoints = $this->User->Point->find('all', array('conditions' => array('Point.user_id' => $this->getUserId())));

		$sumMyPoints = 0;
		
		foreach($myPoints as $point){
			$sumMyPoints += $point['Point']['value'];
		}

		//$this->loadModel('UserIssue');

		$issues = $this->User->UserIssue->Issue->find('list');
		//$this->set(compact('user', 'issues'));

		$selectedIssues = $this->User->UserIssue->find('list', array('fields' => array('UserIssue.issue_id'), 'conditions' => array('UserIssue.user_id' => $id)));
		
		$this->set(compact('user', 'issues', 'selectedIssues', 'sumMyPoints', 'user_photo'));

		if ($this->request->is(array('post', 'put'))) {
			// debug($this->request->data);
			// die();
			if (!empty($this->request->data)) {
				$this->request->data['User']['role_id'] = $user['User']['role_id'];


				$userid = $this->request->data['User']['id'];

				$this->User->UserIssue->deleteAll(array('UserIssue.user_id' => $userid), false);

				if(is_array($this->request->data['UserIssue']['issue_id'])) {
					foreach ($this->request->data['UserIssue']['issue_id'] as $a) {	  
				        $insertData = array('user_id' => $id, 'issue_id' => $a);

				        $exists = $this->User->UserIssue->find('first', array('conditions' => array('UserIssue.user_id' => $id, 'UserIssue.issue_id' => $a)));
				        if(!$exists) $this->User->UserIssue->saveAssociated($insertData);
				    }
				}
			    
			    if ($this->User->createWithAttachments($this->request->data, true, $id)) {

			    	$this->Auth->login($user);
			    	//$this->Session->setFlash(__('The user has been saved.'));
			    	$this->Session->setFlash(__('Your informations were succefully saved'), 'flash_message');
					return $this->redirect(array('action' => 'dashboard', $id));

				} 
		        
			} else $this->Session->setFlash(__('The user could not be saved. Please, try again.'));

		} else {
			$options = array('conditions' => array('User.' . $this->User->primaryKey => $id));
			$this->request->data = $this->User->find('first', $options);
		}
	}


/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		if(is_null($id)){
			$id = $this->getUserId();
		}

		//check to see if user is an admin
		//if so, he can delete whoever he likes
		//otherwise, you are not allowed to edit agents but
		// yourself and will be redirected home
		if($this->getUserRole() != 1) {
			if($id != $this->getUserId()) {
				$this->Session->setFlash(__("You can't delete other users. Permission denied."));	
				$this->redirect($this->referer());
			}
		}

		$this->User->id = $id;
		if (!$this->User->exists()) {
			throw new NotFoundException(__('Invalid user'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->User->delete()) {
			$this->Session->setFlash(__('The user has been deleted.'));
		} else {
			$this->Session->setFlash(__('The user could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}

/**
 * admin_index method
 *
 * @return void
 */
	public function admin_index() {
		$this->User->recursive = 0;
		$this->set('users', $this->Paginator->paginate());
	}

/**
 * admin_view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_view($id = null) {
		if (!$this->User->exists($id)) {
			throw new NotFoundException(__('Invalid user'));
		}
		$options = array('conditions' => array('User.' . $this->User->primaryKey => $id));
		$this->set('user', $this->User->find('first', $options));
	}

/**
 * admin_add method
 *
 * @return void
 */
	public function admin_add() {
		if ($this->request->is('post')) {
			$this->User->create();
			if ($this->User->save($this->request->data)) {
				$this->Session->setFlash(__('The user has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The user could not be saved. Please, try again.'));
			}
		}
	}

/**
 * admin_edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_edit($id = null) {
		if (!$this->User->exists($id)) {
			throw new NotFoundException(__('Invalid user'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->User->save($this->request->data)) {
				$this->Session->setFlash(__('The user has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The user could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('User.' . $this->User->primaryKey => $id));
			$this->request->data = $this->User->find('first', $options);
		}
	}

/**
 * admin_delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_delete($id = null) {
		$this->User->id = $id;
		if (!$this->User->exists()) {
			throw new NotFoundException(__('Invalid user'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->User->delete()) {
			$this->Session->setFlash(__('The user has been deleted.'));
		} else {
			$this->Session->setFlash(__('The user could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}
}
