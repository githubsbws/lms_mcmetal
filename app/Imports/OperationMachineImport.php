<?php

namespace App\Imports;

use App\Models\OperationMachine;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\SkipsEmptyRows;

class OperationMachineImport implements ToModel,WithHeadingRow,SkipsEmptyRows
{
    public function model(array $row)
    {
        // เช็คซ้ำก่อน ถ้ามีแล้วคืน null → ข้ามไปเลย
        $exists = OperationMachine::where('operation_name', $row['operation_name']) // ตัวสแกนก่อนเลย
                                  ->exists();
        if ($exists) return null;

        return new OperationMachine([
            'operation_name' => $row['operation_name'], //เอาค่าเข้าตามหัวcolumn
            'active' => 'y'
        ]);
    }


}
