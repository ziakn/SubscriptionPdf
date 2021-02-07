@extends('layouts.app')

@section('content')
asdasd {{$data}}
        <embed src="{{$data}}" type="application/pdf"   width="70%" height="500" frameborder="0"  download>
@endsection
