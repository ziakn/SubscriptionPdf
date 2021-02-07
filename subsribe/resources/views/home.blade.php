@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{ __('You are logged in!') }}

                    <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>Name</th>
                            <th>Source link</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                    @php
                  
                 @endphp
                        @foreach($data as $item)
                        <tr >
                            <td>{{ $item->id }}</td>
                            <td>{{ $item->name }}</td>
                            <td>{{ $item->src }}</td>
                          
                            <td>
                                <form action="{{url('showpdf')}}" method="post">
                                 @csrf
                                {{-- <a href="{{ route('home.show', $item->id) }}" class="btn btn-primary">View News</a> --}}
                                <input hidden type="text" name="id" value="{{$item->id}}"/>
                                <input class="btn btn-primary" type="submit" value="view news">
                                </form>
                            </td>
                            
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
