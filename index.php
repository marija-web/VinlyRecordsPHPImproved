<?php
    session_start();
    include "config/connection.php";
	include "modals/functions.php";

  	if(isset($_GET['page']) && $_GET['page']!="adminPanel"){
		include "views/fixed/vinylSite/head.php";
		include "views/fixed/vinylSite/header.php";
		if(isset($_GET['page'])){
			switch($_GET['page']){
				case 'shop':
					include "views/pages/vinylSite/shop.php";
					break;
				case 'cart':
					include "views/pages/vinylSite/cart.php";
				break;
				case 'contact':
					include "views/pages/vinylSite/contact.php";
				break;
				case 'register':
					include "views/pages/vinylSite/register.php";
				break;
				case 'login':
					include "views/pages/vinylSite/login.php";
				break;
				case 'logOut':
					include "modals/vinylSite/logOut.php";
				break;
				case 'showProduct':
					include "views/pages/vinylSite/showProduct.php";
				break;
				default: 
				include "views/pages/vinylSite/mainPage.php";
				break;
			}
		}
		else{
			include "views/pages/mainPage.php";
		}
		include "views/fixed/vinylSite/footer.php";
  	}
	else{
		include "views/fixed/adminPanel/headAdmin.php";
		include "views/fixed/adminPanel/headerAdmin.php";
		if(isset($_GET['page']) && $_GET['page']=="adminPanel"){
			if(isset($_GET['adminPanel'])){
				switch($_GET['adminPanel']){
					case 'adminPage':
						include "views/pages/adminPanel/adminPage.php";
					break;
					case 'messagesSurvey':
						include "views/pages/adminPanel/messagesSurvey.php";
					break;
					case 'menuTable':
						include "views/pages/adminPanel/menuTable.php";
					break;
					case 'categoryTable':
						include "views/pages/adminPanel/categoryTable.php";
					break;
					case 'artistTable':
						include "views/pages/adminPanel/artistTable.php";
					break;
					case 'priceTable':
						include "views/pages/adminPanel/priceTable.php";
					break;
					case 'usersTable':
						include "views/pages/adminPanel/usersTable.php";
					break;
					case 'rolesTable':
						include "views/pages/adminPanel/rolesTable.php";
					break;
					case 'productsTable':
						include "views/pages/adminPanel/productsTable.php";
					break;
					default: 
						include "views/pages/adminPanel/adminPanel.php";
					break;
					case 'calculatePages':
						include "views/pages/adminPanel/calculatePages.php";
					break;
				}
			}
			else{
				include "views/pages/adminPanel/adminPanel.php";
			}
		}
		include "views/fixed/adminPanel/footerAdmin.php";
	}
?>