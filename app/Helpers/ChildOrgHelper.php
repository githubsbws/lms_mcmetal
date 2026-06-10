<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Auth;
use App\Models\Orgchart;

class ChildOrgHelper
{
    public static function getAllChildOrgIds($parentIds)
    {
        $all = Orgchart::where('active', 'y')
            ->select('id', 'parent_id')
            ->get();

        $parentIds = collect($parentIds);
        $result = collect();

        while ($parentIds->isNotEmpty()) {

            $children = $all->whereIn('parent_id', $parentIds)
                            ->pluck('id');

            if ($children->isEmpty()) break;

            $result = $result->merge($children);
            $parentIds = $children;
        }

        return $result->unique()->values();
    }
}
