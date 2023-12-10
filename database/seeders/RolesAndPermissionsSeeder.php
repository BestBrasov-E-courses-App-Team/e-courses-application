<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolesAndPermissionsSeeder extends Seeder
{
    private $modules = [
        'courses',
        'courses.view',
        'courses.create',
        'courses.edit',
        'courses.delete',
        
        'comments',
        'comments.view',
        'comments.create',
        'comments.edit',
        'comments.delete',

        'users',
        'users.view',
        'users.create',
        'users.edit',
        'users.delete',

        'lessons',
        'lessons.view',
        'lessons.create',
        'lessons.edit',
        'lessons.delete',
    ];
    private $roles = [
        'teacher',
        'student',
        'auditor',
        'content-manager',
        'admin',
    ];
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Reset cached roles and permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        DB::beginTransaction();
        try {
            foreach ($this->modules as $module) {
                Permission::firstOrCreate(['name' => $module]);
            }

            foreach ($this->roles as $role) {
                $role = Role::firstOrCreate(['name' => $role]);
            }
            Role::whereName('student')->first()->givePermissionTo(['lessons.view', 'courses.view']);
            Role::whereName('teacher')->first()->givePermissionTo(['courses', 'lessons', 'courses.view', 'lessons.view', 'courses.edit', 'lessons.edit', 'courses.create', 'lessons.create', 'courses.edit', 'lessons.edit', 'courses.delete', 'lessons.delete']);
            Role::whereName('auditor')->first()->givePermissionTo(['courses.view', 'lessons.view', 'courses.edit', 'lessons.edit']);
            Role::whereName('content-manager')->first()->givePermissionTo(['courses.view', 'lessons.view', 'courses.edit', 'lessons.edit','courses.create', 'lessons.create']);
            Role::whereName('admin')->first()->givePermissionTo(Permission::all());

            $email = 'admin@gmail.com';
            $superUser = \App\Models\User::where('email', $email)->first();

            if (!$superUser) {
                $superUser = \App\Models\User::factory()->create([
                    'name' => 'Super Admin',
                    'email' => $email,
                ]);
            }

            $student_email = 'student@gmail.com';
            $student = \App\Models\User::where('email', $student_email)->first();

            if (!$student) {
                $student = \App\Models\User::factory()->create([
                    'name' => 'Daniel Student',
                    'email' => $student_email,
                ]);
            }
            $superUser->syncRoles(['admin']);
            $student->syncRoles(['student']);

            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();
            throw $th;
        }
    }
}
