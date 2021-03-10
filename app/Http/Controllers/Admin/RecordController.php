<?php

namespace App\Http\Controllers\Admin;

use App\Record;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\RecordRequest;
use Illuminate\Validation\ValidationException;

class RecordController extends Controller
{
    /**
     * @var integer Items count on page
     */
    private $paginate = 10;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.records.list', [
            'records' => Record::paginate($this->paginate),
        ]);
    }

    /**
     * Redirect to records list with success message.
     *
     * @param  string  $message message for success alert notice.
     * @return \Illuminate\Http\Response
     */
    private function success($message)
    {
        return redirect()
            ->route('admin.records.index')
            ->with(['success-message' => $message]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.records.form', [
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(RecordRequest $request)
    {
        $record = Record::create($request->all());

        return $this->success(sprintf('Пластинка "%s" добавлена.', $record->name));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // @todo
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $record = Record::findOrFail($id);

        return view('admin.records.form', [
            'record' => $record,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  Record  $record
     * @return \Illuminate\Http\Response
     */
    public function update(RecordRequest $request, Record $record)
    {
        $recordOldName = $record->name;
        $record->update($request->all());

        return $this->success(sprintf('Пластинка "%s" обновлена.', $recordOldName));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Record  $record
     * @return \Illuminate\Http\Response
     */
    public function destroy(Record $record)
    {
        $record->delete();

        return $this->success(sprintf('Пластинка "%s" удалена.', $record->name));
    }
}
