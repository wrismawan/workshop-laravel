@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-6 col-md-offset-3">
                <!-- Form Create Quote -->
                <div class="panel panel-default">
                    <div class="panel-heading">Let's share the inspirations</div>
                    <div class="panel-body">
                        <form action="/quote/update/{{$quote->id}}" method="POST">
                            {!! csrf_field() !!}
                            <div class="form-group">
                                <textarea class="form-control"
                                          name="content">{{$quote->content}}</textarea>
                            </div>
                            <div class="form-group">
                                <input type="text"
                                       class="form-control"
                                       name="author"
                                       value="{{$quote->author}}"
                                />
                            </div>
                            <div class="form-group">
                                <button class="btn btn-primary pull-right">Update</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
