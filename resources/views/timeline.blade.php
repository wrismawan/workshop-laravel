@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-6 col-md-offset-3">
            <!-- Form Create Quote -->
            <div class="panel panel-default">
                <div class="panel-heading">Let's share the inspirations</div>
                <div class="panel-body">
                    <form action="/quote/save" method="POST">
                        {!! csrf_field() !!}
                        <div class="form-group">
                            <textarea class="form-control" placeholder="Quote" name="content"></textarea>
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" placeholder="Author" name="author"/>
                        </div>
                        <div class="form-group">
                            <button class="btn btn-primary pull-right">Share</button>      
                        </div>
                    </form>
                </div>
            </div>

            @foreach($quotes as $quote)
            <div class="panel panel-default">

                <!-- Edit / Remove Control -->
                @if (\Auth::user()->id == $quote->user_id)
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="btn-group pull-right">
                                <a href="/quote/edit/{{$quote->id}}" class="btn btn-default btn-xs">
                                    <i class="glyphicon glyphicon-pencil"></i>
                                </a>
                                <a href="/quote/remove/{{$quote->id}}" class="btn btn-default btn-xs">
                                    <i class="glyphicon glyphicon-trash"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                @endif
            
                <div class="panel-body">
                    <h3>{{$quote->content}}</h3>
                    <h4 class="pull-right">--- {{$quote->author}}</h4>
                </div>
                <div class="panel-footer">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="pull-left">
                                <p><i class="glyphicon glyphicon-user"></i> {{ $quote->owner->name }}</p>
                            </div>

                            @if (\App\Quote::isUserLike($quote->id))
                                <div class="pull-right">
                                    <a href="/unlike/{{$quote->id}}">
                                        <i class="glyphicon glyphicon-thumbs-down"></i>
                                        {{ $quote->likes->count() }} Likes
                                    </a>

                                </div>
                            @else
                                <div class="pull-right">
                                    <a href="/like/{{$quote->id}}">
                                        <i class="glyphicon glyphicon-thumbs-up"></i>
                                        {{ $quote->likes->count() }} Likes
                                    </a>
                                </div>
                            @endif

                        </div>
                    </div>
                </div>
            </div>
            @endforeach


        </div>
    </div>
</div>
@endsection
