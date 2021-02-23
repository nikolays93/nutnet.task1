<?php

use App\Record;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class RecordSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Record::class, 50)->create()->each(function ($record) {
            $record->save((array) factory(Record::class)->make());
        });
    }
}
