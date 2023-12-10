<?php

namespace App\Policies;

use App\Models\SectionLesson;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class SectionLessonPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->can('lessons.view');
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, SectionLesson $sectionLesson): bool
    {
        return $user->can('lessons.view');
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->can('lessons.create');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, SectionLesson $sectionLesson): bool
    {
        return $user->can('lessons.edit');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, SectionLesson $sectionLesson): bool
    {
        return $user->can('lessons.delete');
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, SectionLesson $sectionLesson): bool
    {
        return $user->can('lessons.delete');
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, SectionLesson $sectionLesson): bool
    {
        return $user->can('lessons.delete');
    }
}
