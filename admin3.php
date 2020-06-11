<?php
mb_internal_encoding('UTF-8');
include 'autoload.php';

use classes\order;

if ($_POST)
{
	if (!empty($_POST['selected_ids'])) 
  {
		$contents = file_get_contents('data.txt');
		$contents = trim($contents);

		$items = explode("\n", $contents);

		$new_contents = [];

		foreach ($items as $item)
		{
			$shouldBeDeleted = false;
			foreach ($_POST['selected_ids'] as $id) 
			{
				$item=trim($item);
				$cols=explode('||', $item);
				if ($cols[0]===$id)
        {
					$shouldBeDeleted=true;
				}
			}
			if (!$shouldBeDeleted) 
			{
				$new_contents[]=$item;
			}
		}
		file_put_contents('data.txt', implode("\n", $new_contents) . "\n");
	}
}

$order= new order;

$data= $order->getData('data.txt');

include 'templates/admin.php';

