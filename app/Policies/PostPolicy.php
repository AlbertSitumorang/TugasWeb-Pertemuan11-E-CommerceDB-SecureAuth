<?php

namespace App\Policies;

use App\Models\Post;
use App\Models\User;

class PostPolicy
{
    // Admin boleh edit/hapus SEMUA post.
    // Editor hanya boleh edit/hapus post MILIKNYA sendiri.
    // User biasa tidak boleh edit/hapus apapun.
    public function update(User $user, Post $post): bool
    {
        return $user->role === 'admin'
            || ($user->role === 'editor' && $user->id === $post->user_id);
    }

    public function delete(User $user, Post $post): bool
    {
        return $this->update($user, $post);
    }
}
