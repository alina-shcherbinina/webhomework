<?php 
include 'autoload.php';

use classes\order;

$order = new order;

if (isset($_SESSION['successMessage'])) {
	$successMessage = $_SESSION['successMessage'];
	unset($_SESSION['successMessage']);
}

if ($_POST) {
	$order->fill($_POST);

	if ($order->validate())
	{ 
		if ($order->save())
		{
			$_SESSION['successMessage'] = 'Thank you the data has been saved!';
			header('Location: /form3.php');
			exit;
		}
	}
	else 
	{
		$errors = $order->getErrors();
	}
}
include 'templates/form.php';