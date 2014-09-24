<?php

	class Customer extends User
	{
		protected static $tableName = 'customers', $usernameField = 'email', $passwordField = 'password';
	}
