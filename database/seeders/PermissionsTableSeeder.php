<?php

namespace Database\Seeders;

use App\Models\Permission;
use Illuminate\Database\Seeder;

class PermissionsTableSeeder extends Seeder
{
    public function run()
    {
        $permissions = [
            [
                'id'    => 1,
                'title' => 'user_management_access',
            ],
            [
                'id'    => 2,
                'title' => 'permission_create',
            ],
            [
                'id'    => 3,
                'title' => 'permission_edit',
            ],
            [
                'id'    => 4,
                'title' => 'permission_show',
            ],
            [
                'id'    => 5,
                'title' => 'permission_delete',
            ],
            [
                'id'    => 6,
                'title' => 'permission_access',
            ],
            [
                'id'    => 7,
                'title' => 'role_create',
            ],
            [
                'id'    => 8,
                'title' => 'role_edit',
            ],
            [
                'id'    => 9,
                'title' => 'role_show',
            ],
            [
                'id'    => 10,
                'title' => 'role_delete',
            ],
            [
                'id'    => 11,
                'title' => 'role_access',
            ],
            [
                'id'    => 12,
                'title' => 'user_create',
            ],
            [
                'id'    => 13,
                'title' => 'user_edit',
            ],
            [
                'id'    => 14,
                'title' => 'user_show',
            ],
            [
                'id'    => 15,
                'title' => 'user_delete',
            ],
            [
                'id'    => 16,
                'title' => 'user_access',
            ],
            [
                'id'    => 17,
                'title' => 'expense_management_access',
            ],
            [
                'id'    => 18,
                'title' => 'expense_category_create',
            ],
            [
                'id'    => 19,
                'title' => 'expense_category_edit',
            ],
            [
                'id'    => 20,
                'title' => 'expense_category_show',
            ],
            [
                'id'    => 21,
                'title' => 'expense_category_delete',
            ],
            [
                'id'    => 22,
                'title' => 'expense_category_access',
            ],
            [
                'id'    => 23,
                'title' => 'income_category_create',
            ],
            [
                'id'    => 24,
                'title' => 'income_category_edit',
            ],
            [
                'id'    => 25,
                'title' => 'income_category_show',
            ],
            [
                'id'    => 26,
                'title' => 'income_category_delete',
            ],
            [
                'id'    => 27,
                'title' => 'income_category_access',
            ],
            [
                'id'    => 28,
                'title' => 'expense_create',
            ],
            [
                'id'    => 29,
                'title' => 'expense_edit',
            ],
            [
                'id'    => 30,
                'title' => 'expense_show',
            ],
            [
                'id'    => 31,
                'title' => 'expense_delete',
            ],
            [
                'id'    => 32,
                'title' => 'expense_access',
            ],
            [
                'id'    => 33,
                'title' => 'income_create',
            ],
            [
                'id'    => 34,
                'title' => 'income_edit',
            ],
            [
                'id'    => 35,
                'title' => 'income_show',
            ],
            [
                'id'    => 36,
                'title' => 'income_delete',
            ],
            [
                'id'    => 37,
                'title' => 'income_access',
            ],
            [
                'id'    => 38,
                'title' => 'expense_report_create',
            ],
            [
                'id'    => 39,
                'title' => 'expense_report_edit',
            ],
            [
                'id'    => 40,
                'title' => 'expense_report_show',
            ],
            [
                'id'    => 41,
                'title' => 'expense_report_delete',
            ],
            [
                'id'    => 42,
                'title' => 'expense_report_access',
            ],
            [
                'id'    => 43,
                'title' => 'task_management_access',
            ],
            [
                'id'    => 44,
                'title' => 'task_status_create',
            ],
            [
                'id'    => 45,
                'title' => 'task_status_edit',
            ],
            [
                'id'    => 46,
                'title' => 'task_status_show',
            ],
            [
                'id'    => 47,
                'title' => 'task_status_delete',
            ],
            [
                'id'    => 48,
                'title' => 'task_status_access',
            ],
            [
                'id'    => 49,
                'title' => 'task_tag_create',
            ],
            [
                'id'    => 50,
                'title' => 'task_tag_edit',
            ],
            [
                'id'    => 51,
                'title' => 'task_tag_show',
            ],
            [
                'id'    => 52,
                'title' => 'task_tag_delete',
            ],
            [
                'id'    => 53,
                'title' => 'task_tag_access',
            ],
            [
                'id'    => 54,
                'title' => 'task_create',
            ],
            [
                'id'    => 55,
                'title' => 'task_edit',
            ],
            [
                'id'    => 56,
                'title' => 'task_show',
            ],
            [
                'id'    => 57,
                'title' => 'task_delete',
            ],
            [
                'id'    => 58,
                'title' => 'task_access',
            ],
            [
                'id'    => 59,
                'title' => 'tasks_calendar_access',
            ],
            [
                'id'    => 60,
                'title' => 'profile_password_edit',
            ],
        ];

        Permission::insert($permissions);
    }
}
