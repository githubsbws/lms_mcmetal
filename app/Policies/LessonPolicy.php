<?php

namespace App\Policies;

use App\Models\Lesson;
use App\Models\Users;
use App\Services\OrgAuthorizationService;

class LessonPolicy
{
    /**
     * Create a new policy instance.
     */
    public function __construct()
    {
        //
    }

    public function view(Users $user, Lesson $lesson)
    {
        // เรียกใช้ Service ที่เราสร้างไว้
        $authService = app(OrgAuthorizationService::class);
        $canAccess = $authService->canAccessLesson($user, $lesson);
        return $canAccess;
    }
}
