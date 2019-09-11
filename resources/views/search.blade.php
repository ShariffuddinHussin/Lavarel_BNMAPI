
@extends('main')

@section('content')

<body>
	<div class="container">
		<form action="/check" method="POST">
			<div class="input-group">
				<input type="text" class="form-control" name="name"
					placeholder="Search users"> <span class="input-group-btn">
					<button type="submit" class="btn btn-secondary">
						Search
					</button>
				</span>
				</div>
		</form>
	</div>
	
	<div class ="container">
		<table>
		<tr>
			<th>Company Name</th>
			<th>Registration Number</th>
			<th>Added Date</th>
			<th>Websites</th>
		</tr>
		
		<tr>
		<td>{{ name }}</td>
		<td>{{ reg_num }} </td>
		<td>{{ d }}</td>
		<td>{{ web }}</td>
		</tr>
			</table>
	</div>
</body>
@endsection
