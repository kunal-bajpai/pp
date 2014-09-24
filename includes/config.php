<?php
//define constants used later
!defined('SITE_ROOT')?define('SITE_ROOT',$_SERVER['DOCUMENT_ROOT']):NULL;
!defined('LIB_PATH')?define('LIB_PATH',SITE_ROOT.'/includes/'):NULL;
!defined('HOST')?define('HOST','localhost'):NULL;
!defined('USER')?define('USER','ppadmin'):NULL;
!defined('PASS')?define('PASS','ppadmin'):NULL;
!defined('DB')?define('DB','pp'):NULL;
!defined('READABLE_LOG_FILE')?define('READABLE_LOG_FILE',LIB_PATH."log_readable"):NULL;
!defined('EDITOR_LOGIN_PAGE')?define('EDITOR_LOGIN_PAGE',"/editSignin.php"):NULL;
!defined('ADMIN_LOGIN_PAGE')?define('ADMIN_LOGIN_PAGE',"/admin/index.php"):NULL;
!defined('UPLOAD_DIR')?define('UPLOAD_DIR',"../pictures/"):NULL;
!defined('DEFAULT_IMAGE')?define('DEFAULT_IMAGE',"default.png"):NULL;
!defined('BASIC_PRICE')?define('BASIC_PRICE',19):NULL;
!defined('ADVANCED_PRICE')?define('ADVANCED_PRICE',29):NULL;
!defined('EDITOR_BASIC_PRICE')?define('EDITOR_BASIC_PRICE',10):NULL;
!defined('EDITOR_ADVANCED_PRICE')?define('EDITOR_ADVANCED_PRICE',20):NULL;
