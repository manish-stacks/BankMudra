<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $permissions = [
             // Category
            'create-Category',
            'edit-Category',
            'delete-Category',
            'view-Category',
            'status-Category',
            'show-home-Category',

             // Student
             'create-student',
             'edit-student',
             'delete-student',
             'view-student',
             'view-result',
 
             // Subject
             'create-subject',
             'edit-subject',
             'delete-subject',
             'view-subject',
             'change-status',
 
             // Instruction
             'create-instruction',
             'edit-instruction',
             'delete-instruction',
             'view-instruction',
 
             // Question Paper
             'create-question-papper',
             'edit-question-papper',
             'delete-question-papper',
             'view-question-papper',
 
             // Previous Paper
             'create-previous-paper',
             'edit-previous-paper',
             'delete-previous-paper',
             'view-previous-paper',
 
             // Syllabus
             'create-syllabus',
             'edit-syllabus',
             'delete-syllabus',
             'view-syllabus',
 
             // Question Bank
             'create-question-bank',
             'edit-question-bank',
             'delete-question-bank',
             'view-question-bank',
 
             // Question Level
             'create-question-level',
             'edit-question-level',
             'delete-question-level',
             'view-question-level',
 
             // Product
             'create-product',
             'edit-product',
             'delete-product',
             'view-product',
 
             // Blogs
             'create-blogs',
             'edit-blogs',
             'delete-blogs',
             'view-blogs',
 
             // Study Materials
             'view-study-materials',
             'delete-study-materials',
 
             // Orders
             'view-orders',
             'delete-orders',
 
             // Notes Orders
             'view-notes-orders',
             'delete-notes-orders',
 
             // Transactions
             'view-transactions',
             'delete-transactions',
 
             // Coupons
             'create-coupons',
             'edit-coupons',
             'delete-coupons',
             'view-coupons',
 
             // Shipping Rule
             'create-shipping-rule',
             'edit-shipping-rule',
             'delete-shipping-rule',
             'view-shipping-rule',
 
             // General Settings
             'view-general-settings',
             'update-general-settings',
 
             // Payment Settings
             'view-payment-settings',
             'update-payment-settings',
 
             // Pages
             'create-pages',
             'edit-pages',
             'delete-pages',
             'view-pages',
 
             // Sliders
             'create-sliders',
             'edit-sliders',
             'delete-sliders',
             'view-sliders',
 
             // Current Links
             'create-current-links',
             'edit-current-links',
             'delete-current-links',
             'view-current-links',
 
             // Shared Status Permission
             'change-status',
        ];

        foreach ($permissions as $perm) {
            Permission::firstOrCreate([
                'name' => $perm,
                'guard_name' => 'admin',
            ]);
        }
    }
}
