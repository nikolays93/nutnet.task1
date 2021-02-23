@extends('layouts.app')

@section('content')
    <div class="container">
        @if(session()->has('success-message'))
            <div class="alert alert-success">
                {{ session()->get('success-message') }}
            </div>
        @endif

        <table class="table records records_table">
            <thead>
            <tr>
                <td>ID</td>
                <td>Название</td>
                <td>Дата создания</td>
                <td>Дата обновления</td>
                <td>Описание</td>
                <td></td>
                <td></td>
            </tr>
            </thead>
            <tbody>
            @foreach ($records as $record)
                <tr>
                    <td>{{ $record->id }}</td>
                    <td>{{ $record->name }}</td>
                    <td>{{ $record->created_at }}</td>
                    <td>{{ $record->updated_at }}</td>
                    <td>{{ $record->description }}</td>
                    <td><a href="{{ route('record.update', ['id' => $record->id]) }}" title="Изменить">Изменить</a></td>
                    <td><a href="{{ route('record.delete', ['id' => $record->id]) }}" title="Удалить">Удалить</a></td>
                </tr>
            @endforeach
            </tbody>
        </table>

        {{ $records->links() }}
    </div>
@endsection
