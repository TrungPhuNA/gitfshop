<?php
	session_start();
?>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title> Shopping Cart </title>

	<!-- Bootstrap CSS -->
	<link rel="stylesheet" href="/public/app/css/bootstrap.min.css?<?= rand(1,9999) ?>">
	<link rel="stylesheet" href="/public/app/css/base.css?<?= rand(1,9999) ?>">
</head>
<?php  if(isset($_SESSION['cart'])) : ?>
	<h2 class="text-center"> Shopping Cart <a href="/"> Tro ve</a></h2>
	<?php if (isset($_SESSION['success'])) :?>
		<p class="text-danger text-center"> <?= $_SESSION['success'] ?></p>

	<?php endif ; unset($_SESSION['success']) ?>
	<div class="container">
		<div class="row">
			<table class="table table-hover">
				<thead>
					<tr>
						<th>STT</th>
						<th>Name </th>
						<th> Qty </th>
						<th>
							Action
						</th>
					</tr>
				</thead>
				<tbody>
					<?php foreach($_SESSION['cart'] as $key => $val ) :?>
					<tr>
						<td><?= $key ?></td>
						<td> <?= $val['name'] ?> </td>
						<td> 
							<input type="number" name="qty" id="qty" value="<?= $val['qty'] ?>" min="0" class="form-control"  style="width: 100px;">
						</td>
						<td>
							<a href="javascript:void(0)" class="btn btn-xs btn-info update"> Update </a>
							<a href="remove.php?key=<?= $key ?>" class="btn btn-xs btn-danger"> Remove </a>
						</td>
					</tr>
				<?php endforeach ; ?>
				</tbody>
			</table>
		</div>
	</div>
	
<?php else :?>
	<p> Khong ton tai gio hang </p>
<?php endif; ?>