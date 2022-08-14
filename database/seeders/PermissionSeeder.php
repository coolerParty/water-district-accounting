<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // create permissions
			$permissions = [
				'dashboard-access',
				'role-create',
				'role-edit',
				'role-show',
				'role-delete',
				'permission-create',
				'permission-edit',
				'permission-show',
				'permission-delete',
                'user-create',
				'user-edit',
				'user-show',
				'user-delete',
                'bank-create',
				'bank-edit',
				'bank-show',
				'bank-delete',
                'account-group-create',
				'account-group-edit',
				'account-group-show',
				'account-group-delete',
                'account-chart-create',
				'account-chart-edit',
				'account-chart-show',
				'account-chart-delete',
                'beginning-balance-create',
				'beginning-balance-edit',
				'beginning-balance-show',
				'beginning-balance-delete',
                'annual-budget-create',
				'annual-budget-edit',
				'annual-budget-show',
				'annual-budget-delete',
                'general-journal-create',
				'general-journal-edit',
				'general-journal-show',
				'general-journal-delete',
				'general-journal-jev',
				'general-journal-report',
                'disbursement-journal-create',
				'disbursement-journal-edit',
				'disbursement-journal-show',
				'disbursement-journal-delete',
				'disbursement-journal-jev',
				'disbursement-journal-report',
                'material-journal-create',
				'material-journal-edit',
				'material-journal-show',
				'material-journal-delete',
				'material-journal-jev',
				'material-journal-report',
                'billing-create',
				'billing-edit',
				'billing-show',
				'billing-delete',
				'billing-jev',
				'billing-report',
                'cash-receipt-journal-create',
				'cash-receipt-journal-edit',
				'cash-receipt-journal-show',
				'cash-receipt-journal-delete',
				'cash-receipt-journal-jev',
				'cash-receipt-journal-report',
                'all-journal-show',

			];

			foreach($permissions as $permission){
				Permission::create([
					'guard_name' => 'web',
					'name' => $permission
				]);
			}

            // gets all permissinos via Gate::before rule; see AuthServiceProvider
			Role::create(['name'=>'super-admin']);

            // Admin Normal Role Start
			$roleAdmin = Role::create(['guard_name' => 'web', 'name' => 'admin']);

			$adminPermissions = [
				'dashboard-access',
				'role-create',
				'role-edit',
				'role-show',
				'role-delete',
				'permission-show',
                'user-create',
				'user-edit',
				'user-show',
				'user-delete',
                'bank-create',
				'bank-edit',
				'bank-show',
				'bank-delete',
                'account-group-create',
				'account-group-edit',
				'account-group-show',
				'account-group-delete',
                'account-chart-create',
				'account-chart-edit',
				'account-chart-show',
				'account-chart-delete',
                'beginning-balance-create',
				'beginning-balance-edit',
				'beginning-balance-show',
				'beginning-balance-delete',
                'annual-budget-create',
				'annual-budget-edit',
				'annual-budget-show',
				'annual-budget-delete',
                'cash-receipt-journal-create',
				'cash-receipt-journal-edit',
				'cash-receipt-journal-show',
				'cash-receipt-journal-delete',
				'cash-receipt-journal-jev',
				'cash-receipt-journal-report',
                'billing-create',
				'billing-edit',
				'billing-show',
				'billing-delete',
				'billing-jev',
				'billing-report',
                'material-journal-create',
				'material-journal-edit',
				'material-journal-show',
				'material-journal-delete',
				'material-journal-jev',
				'material-journal-report',
                'disbursement-journal-create',
				'disbursement-journal-edit',
				'disbursement-journal-show',
				'disbursement-journal-delete',
				'disbursement-journal-jev',
				'disbursement-journal-report',
                'general-journal-create',
				'general-journal-edit',
				'general-journal-show',
				'general-journal-delete',
				'general-journal-jev',
				'general-journal-report',
                'all-journal-show',
			];

			foreach($adminPermissions as $permission){
				$roleAdmin->givePermissionTo($permission);
			}
			// Admin Normal Role End
    }
}
