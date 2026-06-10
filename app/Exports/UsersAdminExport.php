<?php

namespace App\Exports;

use App\Models\Company;
use App\Models\Users;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;


class UsersAdminExport implements FromCollection, WithHeadings
{
    protected $users;

    public function __construct($users)
    {
        $this->users = $users;
    }

    public function collection()
    {
        return Users::join('profiles', 'profiles.user_id', '=', 'users.id')
            ->where('users.status', '1')
            ->orderBy('users.id', 'ASC')
            ->select(
                'users.id',
                'users.username',
                \DB::raw("CONCAT(tbl_profiles.firstname, ' ', tbl_profiles.lastname) as fullname"), // Combine first and last names
                'users.email',
                'profiles.advisor_email1',
                \DB::raw("CASE WHEN tbl_users.online_status = 1 THEN 'User Active' ELSE 'User Inactive' END as online_status"), // Conditional logic for online_status
                'users.create_at',
                'users.lastvisit_at',
                \DB::raw("CASE WHEN tbl_users.status = 1 THEN 'เปิดการใช้งาน' ELSE 'ปิดการใช้งาน' END as status"),
                'users.last_ip',
                'users.last_activity'
            )
            ->get();
    }


    public function headings(): array
    {
        return [
            'ID',
            'Username',
            'ชื่อ นามสกุล',
            'Email',
            'advisor_email1',
            'Online_Status',
            'Create_at',
            'Lastvisit_at',
            'Status',
            'Last_ip',
            'Last_activity',
        ];
    }
}
