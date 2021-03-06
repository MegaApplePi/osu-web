<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace Tests\Models;

use App\Models\User;
use Tests\TestCase;

class UserTest extends TestCase
{
    public function testEmailLoginDisabled()
    {
        config()->set('osu.user.allow_email_login', false);
        factory(User::class)->create([
            'username' => 'test',
            'user_email' => 'test@example.org',
        ]);

        $this->assertNull(User::findForLogin('test@example.org'));
    }

    public function testEmailLoginEnabled()
    {
        config()->set('osu.user.allow_email_login', true);
        $user = factory(User::class)->create([
            'username' => 'test',
            'user_email' => 'test@example.org',
        ]);

        $this->assertTrue($user->is(User::findForLogin('test@example.org')));
    }

    public function testUsernameAvailableAtForDefaultGroup()
    {
        config()->set('osu.user.allowed_rename_groups', ['default']);
        $allowedAtUpTo = now()->addYears(5);
        $user = factory(User::class)->create(['group_id' => app('groups')->byIdentifier('default')->getKey()]);

        $this->assertLessThanOrEqual($allowedAtUpTo, $user->getUsernameAvailableAt());
    }

    public function testUsernameAvailableAtForNonDefaultGroup()
    {
        config()->set('osu.user.allowed_rename_groups', ['default']);
        $allowedAt = now()->addYears(10);
        $user = $this->createUserWithGroup('gmt', ['group_id' => app('groups')->byIdentifier('default')->getKey()]);

        $this->assertGreaterThanOrEqual($allowedAt, $user->getUsernameAvailableAt());
    }
}
