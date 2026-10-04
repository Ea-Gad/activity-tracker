<?php

namespace App\Policies;

use App\Models\Activity;
use App\Models\User;

class ActivityPolicy
{
    public function viewAny(User $user): bool
    {
        return true;
    }

    public function view(User $user, Activity $activity): bool
    {
        return true;
    }

    public function create(User $user): bool
    {
        return $user->isAdmin();
    }

    public function update(User $user, Activity $activity): bool
    {
        return $user->isAdmin() || $activity->created_by === $user->id;
    }

    public function delete(User $user, Activity $activity): bool
    {
        return $user->isAdmin();
    }
}