<!DOCTYPE html>
<html>
<head>
	<title></title>
  <style>
   @import url('https://fonts.googleapis.com/css2?family=Jost&display=swap');
      body {
        font-family: 'Jost', sans-serif;
      }
    table {
  border-collapse: collapse;
  width: 100%;
}

th, td {
  text-align: left;
  padding: 8px;
}

tr:nth-child(even){background-color: #f2f2f2}

th {
  background-color: #4CAF50;
  color: white;
}
  </style>
</head>
<body>
	<h1>Admin Zone</h1>
	<form method="POST">
		<table border="1">
			<thead>
				<th>id</th>
				<th>date</th>
				<th>name</th>
				<th>last name</th>
				<th>email</th>
				<th>phone</th>
				<th>conference</th>
				<th>pay</th>
				<th>message</th>
				<th>recieve mail</th>
			</thead>
			<tbody>
				<?php foreach ($data as $id => $item) : ?>
				<tr>
				<td>
							<input type="checkbox" name="selected_ids[]" value="<?= $item->id ?>">
                            <strong> <?= $item->id ?> </strong>
				</td>
          <td><?= $item->date?></td>
				<td><?= $item->username?></td>
				<td><?= $item->lastname?></td>
				<td><?= $item->email?></td>
				<td><?= $item->phone?></td>
				<td><?= $item->conf?></td>
				<td><?= $item->pay?></td>
				<td><?= $item->message?></td>
				<td><?= $item->post?></td>
				</tr>
				<?php endforeach ?>	
			</tbody>
		</table>
		<button type="submit"> Delete Selected</button>
	</form>
</body>
</html>
