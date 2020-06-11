<?php

include 'autoload.php';

use classes\order;

if ($_POST)
{
	if (!empty($_POST['selected_ids'])) 
  {
  	foreach ($_POST['selected_ids'] as $id) {
  		order::delete($id);
  	}
  }
}

$data=order::loadAll();
include 'templates/admin.php';
