@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard <a href="{{ URL::to('links') }}" class="float-right">view all Links</a></div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                        <h1>Create a link</h1>

                        <!-- if there are creation errors, they will show here -->
                        {{ HTML::ul($errors->all()) }}

                        {{ Form::open(array('url' => 'links')) }}

                        <div class="form-group">
                            {{ Form::label('name', 'Url') }}
                            {{ Form::text('url', Input::old('url'), array('class' => 'form-control')) }}
                        </div>

                        {{ Form::submit('Create new link', array('class' => 'btn btn-primary')) }}

                        {{ Form::close() }}

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
