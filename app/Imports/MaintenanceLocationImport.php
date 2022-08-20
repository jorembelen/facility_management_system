<?php

namespace App\Imports;

use App\Models\MaintenanceLocation;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class MaintenanceLocationImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new MaintenanceLocation([
            'work_category_id'     => $row['work_category_id'],
            'location'     => $row['location'],
        ]);
    }
}
