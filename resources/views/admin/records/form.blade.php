@extends('layouts.app')

@section('content')
<div class="container">
    @isset($record)
    <h1 class="mb-3">Редактирование пластинки "{{ $record->name }}"</h1>
    @else
    <h1 class="mb-3">Добавление новой пластинки</h1>
    @endisset

    <form class="ajax" name="record" action="{{ isset($record) ? route('admin.records.update', $record) : route('admin.records.store') }}" method="post">
        {{ csrf_field() }}
        @isset($record)
            @method('PUT')
        @endisset
        <input type="hidden" name="_list" value="{{ route('admin.records.index') }}">

        <div class="errors">
        @if ($errors->any())
            <div class="alert alert-danger">
                {!! implode("<br>\n", $errors->all()) !!}
            </div>
        @endif
        </div>

        <table class="table">
            <tr>
                <td>Название</td>
                <td>
                    <input class="form-control" type="text" name="name" value="{{ $record->name ?? '' }}">
                </td>
            </tr>
            <tr>
                <td>Описание</td>
                <td><textarea class="form-control" name="description" id="">{{ $record->description ?? '' }}</textarea></td>
            </tr>
        </table>

        <button class="btn btn-success" type="submit">Сохранить</button>
    </form>
</div>
@endsection