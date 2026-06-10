<?php

namespace App\Imports;

use App\Models\ParameterSetting;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\SkipsEmptyRows;

class ParameterMachineImport implements ToModel,WithHeadingRow,SkipsEmptyRows
{
    public function model(array $row)
    {
        // เช็คซ้ำก่อน ถ้ามีแล้วคืน null → ข้ามไปเลย
        $exists = ParameterSetting::where('parameter_name', $row['parameter_name']) // ตัวสแกนก่อนเลย
                                  ->exists();
        if ($exists) return null;

        return new ParameterSetting([
            'parameter_name' => $row['parameter_name'], //เอาค่าเข้าตามหัวcolumn
            'active' => 'y'
        ]);
    }
}
