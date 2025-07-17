<?php

namespace App\Policies;

use App\Models\Course;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class CoursePolicy
{
    use HandlesAuthorization;

    public function view(User $user, Course $course)
    {
        return $user->isAdmin() || $user->id === $course->user_id;
    }

    public function update(User $user, Course $course)
    {
        return $user->isAdmin() || $user->id === $course->user_id;
    }

    public function delete(User $user, Course $course)
    {
        return $user->isAdmin() || $user->id === $course->user_id;
    }
}