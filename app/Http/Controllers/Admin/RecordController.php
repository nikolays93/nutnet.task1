<?php

namespace App\Http\Controllers\Admin;

use App\Record;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Validation\ValidationException;

class RecordController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('admin/records', [
            'records' => Record::paginate(10),
        ]);
    }

    private function editForm($record)
    {
        return view('admin/record-update', [
            'record' => $record,
        ]);
    }

    private function createForm()
    {
        return view('admin/record-update', [
            'record' => new Record(),
        ]);
    }

    public function updateForm(Request $request, Record $record)
    {
        $requestId = intval($request->get('id'));

        if ($requestId > 0) {
            return $this->editForm($record::find($requestId));
        }

        return $this->createForm();
    }

    public function update(Request $request, Record $record)
    {
        $this->validate($request, [
            'name' => 'required',
        ]);

        $requestId = intval($request->get('id'));

        if ($requestId > 0) {
            $record = $record::find($requestId);
            $successMessage = 'Пластинка "%s" обновлена.';
        } else {
            $successMessage = 'Пластинка "%s" добавлена.';
        }

        $record->name = $request->input('name');
        $record->description = $request->input('description');

        $record->save();

        return redirect()
            ->route('records')
            ->with(['success-message' => sprintf($successMessage, $record->name)]);
    }

    public function delete(Request $request)
    {
        $requestId = intval($request->get('id'));
        $message = [];

        if ($requestId > 0) {
            $record = Record::find($requestId);

            if ($record) {
                $record->delete();
                $message['success-message'] = 'Пластинка ' . $record->name . ' удалена.';
            }
        }

        return redirect()
            ->route('records')
            ->with($message);
    }
}
