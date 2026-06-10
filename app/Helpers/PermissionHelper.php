<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Auth;
use App\Models\Permission;

class PermissionHelper
{
    public static function can($menuKey)
    {
        if (!Auth::check()) return false;

        $user = Auth::user();

        if ($user->superuser == 1) return true;

        if($user->teacher_status == 1 && in_array($menuKey,[9,10,11,12,13])){
            return true;
        }

        static $userPermissions = null;
        if (is_null($userPermissions)) {
            $userPermissions = Permission::where('group_id', $user->group_id)
                ->where('active', 1)
                ->pluck('group_parent_id')
                ->toArray();
        }

        return in_array($menuKey, $userPermissions);
    }
}
