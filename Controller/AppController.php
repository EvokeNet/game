<?php
/**
 * Application level Controller
 *
 * This file is application-wide controller file. You can put all
 * application-wide controller-related methods here.
 *
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.Controller
 * @since         CakePHP(tm) v 0.2.9
 */

App::uses('Controller', 'Controller');

// Facebook Config
session_start(); // para o SDK do Facebook funcionar
use Facebook\FacebookSession;
use Facebook\FacebookRedirectLoginHelper;

/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @package       app.Controller
 * @link          http://book.cakephp.org/2.0/en/controllers.html#the-app-controller
 */
class AppController extends Controller {

/**
 * Global Components
 *
 * @var array
 */

	public $components = array(
		'Session',
		'Permission',
            'BasicData',
		'Auth' => array(
            'loginAction' => array('controller' => 'pages', 'action' => 'display', 'home', 'admin' => false),
            'loginRedirect' => array('controller' => 'users', 'action' => 'login', 'admin' => false),
			'logoutRedirect' => array('controller' => 'users', 'action' => 'login', 'admin' => false),
				'authError' => 'Você não tem permissão para ver essa página'
		)
	);

	public $helpers = array(
		'Chosen.Chosen', 'Text'
	);

	public $user = null;
	public $lang = null;

      public $sex;
      public $languages;
      public $countries;


/**
* beforeFilter method
*
* @return void
*/
      public function beforeFilter() {

            // BASIC DATA CONFIG
            $this->initializeBasicData();

            //Determine language if not already determined
            $this->_checkBrowserLanguage();
            $this->language = $language = $this->getCurrentLanguage();

            //Info from the user that is currently logged in
            $this->set('loggedIn', $this->Auth->loggedIn());
            $cuser = $this->Auth->user();
            $loggedInUser = $this->Auth->user();

            $scores = $this->Permission->scores();

		$this->loadModel('Role');

		if(isset($loggedInUser)){
			$role = $this->Role->find('first', array('conditions' => array('id' => $loggedInUser['role_id'])))['Role']['score'];
			$loggedInUser['role'] = $role;
		}

		// CHECK IF USER TRIES TO ACCESS ADMIN PANEL
		if(isset($this->request->params['admin']) && $this->request->params['admin']){
			$options = array(
			'moderatorPrivilege' => false,
			'minimumRole' => 'ADMIN',
			'object' => null
			);

			if(!isset($loggedInUser) || !$this->Permission->hasPrivilege($options)){
				$this->redirect(array('controller' => 'users', 'action' => 'profile', $this->getUserId(),'admin' => false));
			}
		}

		//Check if the user has answered the assessment questionnaire and redirect to it, if not
		$this->loadModel('SuperheroIdentity');

		$superhero = $this->SuperheroIdentity->find('first', array(
			'conditions' => array(
				'id' => $cuser['superhero_identity_id']
			)
		));

		// check if the user has answered the asessment questionnaire and isn't doing it right now
		if(empty($superhero) && $this->request->params['action'] != 'matching'
							&& $this->request->params['action'] != 'login'  //also, if  the user is loging in or out
							&& $this->request->params['action'] != 'logout' // we have to allow it
							&& $this->request->params['action'] != 'register' // also if user is registering
                                          && $this->request->params['action'] != 'recover_password' // also if user is trying to recover password
                                          && $this->request->params['action'] != 'fbLogin' // also if user is trying to loging in by facebook
                                          && $this->request->params['action'] != 'googleLogin' // also if user is trying to loging in by google
                                          && $this->request->params['action'] != 'display' // also if user is registering
                                          && $this->request->params['action'] != 'terms' // also if user is registering
                                          && $this->request->params['action'] != 'recover_password' // also if user is trying to recover password
							&& $this->request->params['action'] != 'matching_results'){

			return $this->redirect(array('controller' => 'users', 'action' => 'matching', $this->getUserId(), 'admin' => false));
		}

            $this->set(compact('userNotifications', 'userPoints', 'userLevel', 'userNextLevel', 'userLevelPercentage', 'cuser', 'loggedInUser', 'language','scores'));
      }


/**
 * If no language was defined, read the browser language and sets the website language to it if available
 *
 */
      protected function _checkBrowserLanguage(){
            if (!$this->Session->check('Config.language')){
                  //Languages supported in Evoke
                  $supported_languages = Configure::read('Config.supported_languages');

                  //Language(s) registered in the user's browser
                  $languageHeader = $this->request->header('Accept-language');

                  $lang = 'en';
                  if ($languageHeader) {
                        //Get just 1st language
                        $languages = explode(',', $languageHeader);
                        if (count($languages) > 0) {
                              $lang = $languages[0];
                        }
                        else {
                              $lang = substr($languageHeader, 0, 2);
                        }
                  }

                  //Browser language if it is supported
                  if (in_array($lang, $supported_languages)) {
                        $this->Session->write('Config.language', $lang);
                  }
                  //Default: spanish (for the playtest)
                  else {
                        $this->Session->write('Config.language', 'en');
                  }
            }

            Configure::write('Config.language', $this->Session->read('Config.language'));
      }


/**
 * Return current language in the platform
 *
 * @return string Current language registered in CakeSession
 */
      public function getCurrentLanguage(){
            return CakeSession::read('Config.language');
      }

/**
 * Change current language in the platform
 *
 * @param string Language to be registered as current language in CakeSession
 */
      public function changeLanguage ($lang) {
            $this->autoRender = false;
            $this->Session->write('Config.language', $lang);

            $this->redirect($this->referer()); //in order to redirect the user to the page from which it was called
      }

      public function getNotificationsNumber($user_id){

            $this->loadModel('Notification');
            $all = $this->Notification->find('all', array(
                  'conditions' => array(
                        'Notification.user_id' => $user_id,
                        'Notification.status' => 0,
                  ),
                  'order' => array(
                        'Notification.created DESC'
                  )
            ));

            $count = array();

            foreach($all as $a => $n){
                  if(($n['Notification']['origin'] == 'like') || ($n['Notification']['origin'] == 'commentEvidence')
                        || ($n['Notification']['origin'] == 'commentEvokation') || ($n['Notification']['origin'] == 'voteEvokation')
                        || ($n['Notification']['origin'] == 'gritBadge')):
                        array_push($count, array('Notification.id' => $n['Notification']['id']));
                  endif;
            }

            return $count;

      }

      public function saveNotifications($notes, $user_id){
            $this->loadModel('Notification');

            $all = $this->Notification->find('all', array(
                  'conditions' => array(
                        'Notification.user_id' => $user_id,
                        'OR' => $notes
                  ),
                  'order' => array(
                        'Notification.created DESC'
                  )
            ));

            $count = array();

            foreach($all as $n){
                  $this->Notification->id = $n['Notification']['id'];
                  $this->Notification->saveField('status', 1);
            }

      }

      /**
       * Gets the total number of points of a user
       * Uses a function in the User model
       * @param int $user_id User id
       * @return int Number of points
       */
      public function getPoints($user_id){
            $this->loadModel('User');
            $userPoints = $this->User->getTotalPoints($user_id);
            return $userPoints;
      }

      /**
       * Gets the level (just the number) that corresponds to a certain number of points
       * @param int $userPoints Number of points
       * @return int Level
       */
      public function getLevel($userPoints){
            $this->loadModel('Level');
            $level = $this->Level->getLevel($userPoints);
            // return $level['Level']['level'];
      }

      /**
       * Gets the next level
       * @param int $userLevel Id of the current level
       * @return object Next level (if there is one - else null)
       */
      public function getNextLevel($userLevel){
            $this->loadModel('Level');

            $nextLevel = $this->Level->find('first', array('conditions' => array('Level.level' => $userLevel+1)));

            //There is a next level
            if (isset($nextLevel['Level']))
                  return $nextLevel['Level'];
            else
                  return null;
      }

      public function getUserImage($userid) {
            // TODO
      }

      public function getUserId() {
            $currentuser = $this->Auth->user();
            if(isset($currentuser['id'])) return $currentuser['id'];
            return $currentuser['User']['id'];
      }

      public function getUserName() {
            $currentuser = $this->Auth->user();
            if(isset($currentuser['name'])) return $currentuser['name'];
            return $currentuser['User']['name'];
      }

      public function getUserRole() {
            $currentuser = $this->Auth->user();
            if(isset($currentuser['role'])){

                  return $currentuser['role'];
            }

            $role_score = $this->Role->find('first',array('id' => $currentuser['role_id']))['Role']['score'];

            return $role_score;
      }

/**
* initializeBasicData method
*
* @return void
*
*
*/
function initializeBasicData(){
      if(empty($this->sex)){
            $this->sex = $this->BasicData->sex;
      }

      if(empty($this->languages)){
            $this->languages = $this->BasicData->languages;
      }

      if(empty($this->countries)){
            $this->countries = $this->BasicData->countries;
      }
}

/**
* getSex method
*
* @return array
*
* returns id related to sex
*
*/
  function getSex($sex){
      return array_search($sex, $this->sex);
  }      

/**
* getCountries method
*
* @return array
*
* returns short name related to country
*
*/
  function getCountry($country){
      return array_search($country, $this->countries);
  }

/**
* getCountries method
*
* @return array
*
* returns country related to its short name.
*
*/
  function getCountryValue($country){
      return $this->countries[$country];
  }

}
