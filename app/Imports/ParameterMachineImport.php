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
        $exists = ParameterSetting::where('parameter_name', $row['license_authorized']) // ตัวสแกนก่อนเลย
                                  ->exists();
        if ($exists) return null;

        $cleanLines = [];
        if (!empty($row['line'])) {
            // ตัดด้วยคอมม่า -> ลบช่องว่างหัวท้ายของทุกคำ -> กรองเอาค่าว่างออก (ถ้าเผลอพิมพ์คอมม่าเกินมา)
            $cleanLines = array_filter(array_map('trim', explode(',', $row['line'])));
            // จัดเรียง index ของ array ใหม่ให้สวยงาม เริ่มจาก 0, 1, 2...
            $cleanLines = array_values($cleanLines);
        }

        return new ParameterSetting([
            'parameter_name' => $row['license_authorized'], //เอาค่าเข้าตามหัวcolumn
            'active' => 'y',
            'line'   => $cleanLines
        ]);
    }
}
