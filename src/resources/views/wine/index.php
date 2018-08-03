<html>
	<head>
		<style>
			table {
			    font-family: arial, sans-serif;
			    border-collapse: collapse;
			    width: 100%;
			}

			td, th {
			    border: 1px solid #dddddd;
			    text-align: center;
			    padding: 8px;
			}

			table#wine_index tr:nth-child(even) {
			    background-color: #dddddd;
			}

			#btn_submit {
				float:right;
				margin-right: 20%;
				margin-top: 20px;
				width: 15%;
			}
		</style>
	</head>
	<body>
		<div style="width: 50%; float: left;">
			<table style="width: 90%; margin-top: 20px;" id="wine_index">
				<thead>
					<tr>
				     	<th>Id</th>
				     	<th>Name</th>
				     	<th>Price</th>
				     	<th>Brand</th>
				     	<th>created_at</th>
				     	<th>updated_at</th>
				  	</tr>
				</thead>
				<?php if(!empty($wines)): ?>
					<tbody>
						<?php foreach ($wines as $wine): ?>
							<tr>
								<td><?php echo $wine->id ?></td>
								<td><?php echo $wine->name ?></td>
								<td><?php echo $wine->price ?></td>
								<td><?php echo $wine->brand ?></td>
								<td><?php echo $wine->createdAt ?></td>
								<td><?php echo $wine->updatedAt ?></td>
								<td><button id="btn_delete_<?php echo $wine->id ?>">Delete</button></td>
							</tr>
						<?php endforeach; ?>
					</tbody>
				<?php endif;?>
			</table>
		</div>

		<div style="width: 50%; float: left">
			<table style="width: 80%;">
				<tr>
					<td style="width: 50%;">Name</td>
					<td><input type="text" id="name"></td>
				</tr>
				<tr>
					<td>Price</td>
					<td><input type="text" id="price"></td>
				</tr>
				<tr>
					<td>Brand</td>
					<td><input type="text" id="brand"></td>
				</tr>
			</table>
			<button type="submit" id="btn_submit">Add</button>
		</div>
	</body>

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script>
		$("#btn_submit").on('click', () => {
			data = {
				name: $("#name").val(),
				price: $("#price").val(),
				brand: $("#brand").val(),
			};

			$.ajax({
				url: '/store',
				type: 'post',
				data: data,
				success: function(response){
					result = JSON.parse(response);
					if (result.success == false) {
						alert(result.errors[0]);
					} else {
						data = result.data.record;
						row = `<tr><td>${data.id}</td><td>${data.name}</td><td>${data.price}</td>`
							+ `<td>${data.brand}</td><td>${data.createdAt}</td>`
							+ `<td>${data.updatedAt}</td></tr>`;
						$('#wine_index').append(row);
					}
				},
				error: function(response){
					console.log(response);
					alert("Unexpected Error");
				}
			});
		});

		$("button[id^='btn_delete_']").click((event) => {
			var warning =  confirm('Delete wine?');
			if (!warning) {
				return ;
			}

			id = +(event.currentTarget.attributes.id.value.replace('btn_delete_',''));
			$.ajax({
				url: '/delete',
				type: 'post',
				data: {
					id: id
				},
				success: response => {
					result = JSON.parse(response);
					if (result.success == true) {
						event.currentTarget.closest('tr').remove();
						alert("Delete success!");
					}
				},
				error: response => {
					console.log(response);
					alert("Unexpected Error");
				}
			});
		});
	</script>
</html>
