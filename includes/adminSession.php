<?php
class AdminSession extends Session {
	
	protected static $userClass='Admin', $userTable='admins', $sessionVar='admin_id', $loginPage=ADMIN_LOGIN_PAGE, $userField='username';
}
