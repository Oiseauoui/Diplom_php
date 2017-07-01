<?php



class Router {

    function __construct($access = 'public'){
        // po defaultu access je postavljen na public
        // ako idemo na admin stranicu u admin.php je postavljeno da pravi objekat sa argumentom 'admin'

        $url = !empty($_GET['url']) ? $_GET['url'] : null;

		//var_dump($url); die();

        $url = rtrim($url,'/'); // uklanja kosu crtu sa desne strane stringa

		//$url = filter_var($url, FILTER_SANITIZE_URL); // uklanja sve ilegalne karaktere iz url-a

        $url = explode('/',$url);

        $Controller = !empty($url[0]) ? $url[0] : 'home';
        $Function = !empty($url[1]) ? $url[1] : '';
        $Parameter1 = !empty($url[2]) ? $url[2] : '';
        $Parameter2 = !empty($url[3]) ? $url[3] : '';


		//echo $Controller; проверка для запуска главной страницы http://oiseauoui.info/
		//echo $Function; - ничего

		// ispitujemo da li je public ili admin
        // ako je admin moramo da dodamo 'admin' u imenu fajlova koje pozivamo
        // admin fajlovi u svom nazivu imaju '_admin'
        $adminPrefix = $access == 'admin' ? '_admin' : '';


		//echo $adminPrefix; здесь _admin
		//echo $access; exit(); // проверяем роль public или admin

        // ako zahtevamo admin stranicu a sesija nije postavljena router nas vodi na login admin stranicu
        if ( $access == 'admin' && empty($_SESSION['user_id']) && $Function != 'login' && $Function != 'ulogujSe' ) {
			//header('Location: ' . ADMIN_URL . 'korisnici/login');
			// echo $access; exit(); die();



        }
        // ako zahtevamo admin stranicu a ulogovani smo kao public korisnik
        elseif ( $access == 'admin' && !empty($_SESSION['user_id']) && (empty($_SESSION['group_id']) || $_SESSION['group_id'] != 1) ) {
			unset($_SESSION);
			session_destroy();
			header('Location: ' . ADMIN_URL . 'korisnici/login');
            die();
        }

        $file = BASE_PATH . 'controllers/' . $Controller . $adminPrefix . '_controller.php';

        if (file_exists($file)) {
            require $file;

			//echo $file; exit();

           $controllerName = ucfirst($Controller) . $adminPrefix . '_controller';
           //$controllerName = Home_Controller();
            $controller = new $controllerName();
             //$controller = new Home_Controller();
            // ovaj objekat ima 2 svojstva (View i Model)
            // konstruktor i metodu loadModel
            $controller->loadModel($Controller);
            // loadModel je metoda definisana u Controller klasi
            // za parametar uzima ime sekcije koju pozivamo (home)
            // ova metoda pravi objekat iz klase Home_Model
            $controller->view->controllerName = $Controller;

        } else {
            if($access == 'admin'){
                require BASE_PATH . 'controllers/error_admin_controller.php';
                $controller = new Error_Admin_Controller();
                $controller->index();
            } else {
                require BASE_PATH . 'controllers/error_controller.php';
                $controller = new Error_Controller();
                $controller->index();
            }
        }

        if (!empty($Function)) {

			//echo $Function; exit(); здесь admmin

            if (!empty($Parameter1) && empty($Parameter2)) {
                $controller->$Function($Parameter1);
            }
            elseif (!empty($Parameter1) && !empty($Parameter2)){
                $controller->$Function($Parameter1, $Parameter2);

				//echo $controller; exit();
            }
            else {
                $controller->$Function();
            }
        } else {
            $controller->index();
        }


    }
}