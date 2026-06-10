<?php

namespace App\Enums;

enum LessonStatus: string
{
    case Success = 'pass';
    case Learning = 'learning';
    case NotLearning = 'Not-Learning';
}
