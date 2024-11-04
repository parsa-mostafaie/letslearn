<?php

namespace App\Policies;

use App\Models\Course;
use App\Models\User;
use Illuminate\Auth\Access\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class CoursePolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(?User $user): bool
    {
        return true;
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(?User $user, Course $course): bool
    {
        return true;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(?User $user): bool
    {
        return true;
    }

    /**
     * Determine whether the user can create models.
     */
    public function enroll(?User $user, Course $course): bool
    {
        return $user?->isNot($course->author);
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(?User $user, Course $course): bool
    {
        return $user?->is($course->author);
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(?User $user, Course $course): bool
    {
        return $this->update($user, $course);
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(?User $user, Course $course): bool
    {
        return true;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(?User $user, Course $course): bool
    {
        return $this->delete($user, $course);
    }
}
