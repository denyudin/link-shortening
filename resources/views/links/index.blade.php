@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard <a href="{{ URL::to('links/create') }}" class="float-right">create new link</a></div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif
                    @if (Session::has('message'))
                        <div class="alert alert-info">{{ Session::get('message') }}</div>
                    @endif

                    <table class="table table-striped table-bordered">
                        <thead>
                        <tr>
                            <td>ID</td>
                            <td>Url</td>
                            <td>Count</td>
                            <td>short url</td>
                            <td></td>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($links as $key => $value)
                            <tr>
                                <td>{{ $value->id }}</td>
                                <td>{{ $value->url }}</td>
                                <td>{{ $value->count }}</td>
                                <td><a href="/{{ $value->short_url }}">{{ $value->short_url }}</a></td>
                                <td>
                                    {{ Form::open(array('url' => 'links/' . $value->id, 'class' => 'pull-right')) }}
                                    {{ Form::hidden('_method', 'DELETE') }}
                                    {{ Form::submit('Delete this link', array('class' => 'btn btn-warning')) }}
                                    {{ Form::close() }}
                                </td>
                            </tr>
                        @endforeach
                        {{ $links->links() }}
                        </tbody>
                    </table>
            </div>
        </div>
    </div>
</div>
@endsection
