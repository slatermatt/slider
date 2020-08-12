@extends('layouts/app')

@section('content')
	<type-a
		:items="{{ json_encode($model['items']) }}"
		:options="{{ json_encode($model['options']) }}"
	></type-a>
@endsection
