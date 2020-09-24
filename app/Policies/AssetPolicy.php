<?php

namespace App\Policies;

use App\Models\Asset;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class AssetPolicy
{
    use HandlesAuthorization;

    public function update(User $user, Asset $asset)
    {
        return $user->isAdmin() || $user->id === $asset->user->id;
    }

    public function delete(User $user, Asset $asset)
    {
        return $user->isAdmin() || $user->id === $asset->user->id;
    }
}
