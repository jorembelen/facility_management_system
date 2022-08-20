<?php

namespace App\Imports;

use App\Models\Schedule;
use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class ScheduleImport implements ToModel, WithHeadingRow
{
    public function transformDate($value, $format = 'Y/m/d')
    {
        try {
            return Carbon::instance(\PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($value));
        } catch (\ErrorException $e) {
            return Carbon::createFromFormat($format, $value);
        }
    }

    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Schedule([
            'work_category_id'     => $row['work_category'],
            // 'date'     => $row['date'],
            'date'     => $this->transformDate($row['date']),
            'time'     => $row['time'],
            'slot'     => $row['slot'],
        ]);
    }



}
