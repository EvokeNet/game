<?php
/**
 * Picture Helper class file
 *
 * Methods used to handle user pictures, group pictures etc
 */

App::uses('AppHelper', 'View/Helper');

class PictureHelper extends AppHelper {
	public $helpers = array('Html');

	/**
	 * Returns an absolute path of a picture for a given user. If he/she doesn't have one, a default picture is given.
	 * 
	 * @param User $user User whose picture will be found. If null, default is currently logged in user
	 * @return string Absolute path of a picture
	 */
	public function getUserPictureAbsolutePath($user = null) {
		//Default: logged in user
		if (is_null($user)) {
			$user = AuthComponent::user();
		}

		//Default picture if the user doesn't have one
		$pic = $this->webroot.'webroot/img/user_avatar.jpg';

		if (!is_null($user)) {
			//No picture uploaded
			if($user['photo_attachment'] == null) {
				//Facebook picture
				if($user['facebook_id'] != null) {
					$pic = "https://graph.facebook.com/". $user['facebook_id'] ."/picture?type=large";
				}
			}
			//Uploaded picture
			else {
				$pic = $this->webroot.'files/attachment/attachment/'.$user['photo_dir'].'/'.$user['photo_attachment'];
			}
		}
		
		return $pic;
	}

	/**
	 * Returns an absolute path of a picture for a given group. If it doesn't have one, a default picture is given.
	 * 
	 * @param Group $group Group whose picture will be found. If null, an empty string is returned
	 * @return string Absolute path of a picture
	 */
	public function getGroupPictureAbsolutePath($group = null) {
		if (is_null($group)) {
			return '';
		}

		//Default picture if the group doesn't have one
		$pic = $this->webroot.'webroot/img/user_avatar.jpg';

		if (!is_null($group)) {
			//No picture uploaded
			if($group['photo_attachment'] == null) {
				//Facebook picture
				if($group['facebook'] != null) {
					$pic = "https://graph.facebook.com/". $group['facebook'] ."/picture?type=large";
				}
			}
			//Uploaded picture
			else {
				$pic = $this->webroot.'files/attachment/attachment/'.$group['photo_dir'].'/'.$group['photo_attachment'];
			}
		}
		
		return $pic;
	}
}