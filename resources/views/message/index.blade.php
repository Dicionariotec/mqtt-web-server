@extends('layouts.app')

@section('content')
<h1>Messages</h1>
@foreach($messages as $message)
	<p>{{ $message->content }}</p>
@endforeach
@endsection
