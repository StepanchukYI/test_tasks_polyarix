@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                @foreach($users as $userItem)
                    <div>
                        <div>Email: {{$userItem->email}}</div>
                        @if($userItem->name)
                        <div>Name: {{$userItem->name}}</div>
                        @endif
                        @if($userItem->last_name)
                        <div>Last name: {{$userItem->last_name}}</div>
                        @endif
                        @if($userItem->image)
                            <img style="height: 80px; width: 80px" src="{{$userItem->image}}"/>
                        @endif
                        @if(Auth::user()->role->id == \App\Models\UserRole::ADMIN)
                            @if(count($userItem->comment))
                                <div>Admin comment: {{$userItem->comment->comment}}</div>
                            @endif
                        @endif
                    </div>
                    @if(!$loop->last)
                    <hr>
                    @endif
                @endforeach
            </div>
        </div>
    </div>
</div>
@endsection
