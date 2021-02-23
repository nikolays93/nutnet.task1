@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-3">{{ $record->name ?: 'Новая пластинка' }}</h1>

    @if ($errors->any())
        <div class="alert alert-danger">
            {!! implode("<br>\n", $errors->all()) !!}
        </div>
    @endif


    <form action="" method="post">
        {{ csrf_field() }}

        <table class="table">
            <tr>
                <td>Название</td>
                <td><input class="form-control" type="text" name="name" value="{{ $record->name }}"></td>
            </tr>
            <tr>
                <td>Описание</td>
                <td><textarea class="form-control" name="description" id="">{{ $record->description }}</textarea></td>
            </tr>
        </table>

        <button class="btn btn-success" type="submit">Сохранить</button>
    </form>
</div>
@endsection
