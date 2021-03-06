<?php 

  /* Main redirection of the default login page */
	function redirect_login_page() {
		$login_page = home_url('/login');
		$page_viewed = basename($_SERVER['REQUEST_URI']);

		if($page_viewed == "wp-login.php" && $_SERVER['REQUEST_METHOD'] == 'GET') {
			wp_redirect($login_page);
			exit;
		}
	}
	add_action('init','redirect_login_page');

	/* Where to go if a login failed */
	function custom_login_failed() {
		$login_page = home_url('/login');
		wp_redirect($login_page . '?login=failed');
		exit;
	}
	add_action('wp_login_failed', 'custom_login_failed');

	/* What to do on logout */
	function logout_redirect() {
		$login_page = home_url('/login');
		wp_redirect($login_page . "?login=false");
		exit;
	}
  add_action('wp_logout', 'logout_redirect');

?>