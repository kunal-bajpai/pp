<?php

class Admin extends User {
	protected static $tableName = 'admins';
	protected static $usernameField='username',$passwordField='password';
}
