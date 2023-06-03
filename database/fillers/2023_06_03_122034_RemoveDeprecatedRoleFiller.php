<?php

declare(strict_types = 1);

use Illuminate\Support\Facades\DB;

return new class
{
    public function run(): void
    {
        DB::table('role_user')
            ->whereIn('role_id', [$this->getRoleId()])
            ->delete();

        DB::table('roles')
            ->where('id', $this->getRoleId())
            ->delete();
    }

    public function getRoleId(): int
    {
        $role = 'Guest';

        return (int) DB::table('roles')
            ->where('name', $role)
            ->first()
            ->id;
    }
};
