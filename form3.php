<?php 
include 'autoload.php';

use classes\order;

$order = new order;

if ($_POST) {
	$order->fill($_POST);

	if ($order->validate())
	{ 
		if ($order->save())
		{
			$successMessage = 'Thank you the data has been saved!';
		}
	}
	else 
	{
		$errors = $order->getErrors();
	}
}
include 'templates/form.php';