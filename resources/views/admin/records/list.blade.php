@extends('layouts.app')

@section('content')
    <div class="container">
        @if(session()->has('success-message'))
            <div class="alert alert-success">
                {{ session()->get('success-message') }}
            </div>
        @endif

        <p class="text-right">
            <a class="btn btn-primary" href="{{ route('admin.records.create') }}">Добавить</a>
        </p>

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
                <tr class="record-row">
                    <td class="record-row-id">{{ $record->id }}</td>
                    <td class="record-row-name">{{ $record->name }}</td>
                    <td class="record-row-created_at">{{ $record->created_at }}</td>
                    <td class="record-row-updated_at">{{ $record->updated_at }}</td>
                    <td class="record-row-description">{{ $record->description }}</td>
                    <td class="record-row-edit">
                        <a class="btn btn-warning" href="{{ route('admin.records.edit', ['id' => $record->id]) }}">Изменить</a>
                    </td>
                    <td class="record-row-destroy">
                        <form action="{{ route('admin.records.destroy', ['id' => $record->id]) }}" method="POST">
                            {{ csrf_field() }}
                            @method('DELETE')
                            <button class="btn btn-danger" type="submit">Удалить</button>
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>

        {{ $records->links() }}
    </div>
@endsection
