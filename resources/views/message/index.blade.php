@extends('layouts.app')

@section('content')
<div class="container">
	<h1>Messages</h1>
	<h1>{{ now()->format('Y/m/d H:i:s') }}</h1>
	<div class="row">
		<div class="col-sm-8">
			<canvas id="chart"></canvas>
		</div>
		<div class="col-sm-4"></div>
	</div>

	<script type="module">
		let id = 'chart';
		let labels = @json($keys);
		let temperatures = @json($temperatures);
		let humidities = @json($humidities);
		make_chart(id, labels, temperatures, humidities);
	</script>
	<table class="table">
		<thead>
			<tr>
				<th scope="col">#</th>
				<th scope="col">Temperatura</th>
				<th scope="col">Umidade</th>
				<th scope="col">Data</th>
			</tr>
		</thead>
		<tbody>
			@foreach($messages as $message)
				<tr>
					<th scope="row">{{ $message->id }}</th>
					<td>{{ $message->content['temperature'] }}</td>
					<td>{{ $message->content['humidity'] }}</td>
					<td>{{ $message->created_at->format('Y/m/d H:i:s') }}</td>
				</tr>
			@endforeach
		</tbody>
	</table>
	{{ $messages->links() }}
</div>
@endsection
