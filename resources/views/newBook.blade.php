@extends('layout')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Boek toevoegen</div>

                <div class="panel-body">
                    <form class="form-horizontal" method="POST" action="/ouders/boeken/toevoegen">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
                            <label for="title" class="col-md-4 control-label">Titel van het boek</label>

                            <div class="col-md-6">
                                <input id="title" type="text" class="form-control" name="title" value="{{ old('title') }}" required autofocus>

                                @if ($errors->has('title'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('title') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('author') ? ' has-error' : '' }}">
                            <label for="author" class="col-md-4 control-label">Auteur van het boek</label>

                            <div class="col-md-6">
                                <input id="author" type="text" class="form-control" name="author" value="{{ old('author') }}" required autofocus>

                                @if ($errors->has('author'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('author') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('shortDescription') ? ' has-error' : '' }}">
                            <label for="shortDescription" class="col-md-4 control-label">Korte beschrijving</label>

                            <div class="col-md-6">
                                <input id="shortDescription" type="text" class="form-control" name="shortDescription" value="{{ old('shortDescription') }}" required autofocus>

                                @if ($errors->has('shortDescription'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('shortDescription') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('numberOfPages') ? ' has-error' : '' }}">
                            <label for="numberOfPages" class="col-md-4 control-label">Aantal bladzijden</label>

                            <div class="col-md-6">
                                <input id="numberOfPages" type="number" class="form-control" name="numberOfPages" value="{{ old('numberOfPages') }}" required autofocus>

                                @if ($errors->has('numberOfPages'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('numberOfPages') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    Voeg boek toe
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection