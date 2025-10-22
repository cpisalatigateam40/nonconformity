<?php

namespace Database\Seeders;

use App\Models\Department;
use App\Models\Plant;
use App\Models\User;
use App\Models\UserPlant;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $QC = Department::firstWhere('abbrivation', 'QC');
        $PGA = Department::firstWhere('abbrivation', 'PGA');
        $FP = Department::firstWhere('abbrivation', 'FP');
        $SP = Department::firstWhere('abbrivation', 'SP');
        $BC = Department::firstWhere('abbrivation', 'BC');
        $SH = Department::firstWhere('abbrivation', 'SH');
        $WH = Department::firstWhere('abbrivation', 'WH');
        $ENG = Department::firstWhere('abbrivation', 'ENG');

        $user1 = User::create([
            'uuid' => Str::uuid(),
            'username' => 'superadmin',
            'name' => 'superadmin',
            'email' => 'superadmin@cp.co.id',
            'email_verified_at' => now(),
            'password' => bcrypt('cpi12345'),
            'department_uuid' => $QC->uuid,
        ]);
        $user2 = User::create([
            'uuid' => Str::uuid(),
            'username' => 'yosi.pratama',
            'name' => 'Yosi Pratama',
            'email' => 'yosi.pratama@cp.co.id',
            'email_verified_at' => now(),
            'password' => bcrypt('cpi12345'),
            'department_uuid' => $QC->uuid,
        ]);
        $user3 = User::create([
            'uuid' => Str::uuid(),
            'username' => 'user',
            'name' => 'user',
            'email' => 'user@cp.co.id',
            'email_verified_at' => now(),
            'password' => bcrypt('usera123'),
            'department_uuid' => $SH->uuid,
        ]);
        $user4 = User::create([
            'uuid' => Str::uuid(),
            'username' => 'manager',
            'name' => 'Manager',
            'email' => 'manager@cp.co.id',
            'email_verified_at' => now(),
            'password' => bcrypt('manager123'),
            'department_uuid' => $SH->uuid,
        ]);
        $BCU = User::create([
            'uuid' => Str::uuid(),
            'username' => 'BC',
            'name' => 'BC',
            'email' => 'BC@cp.co.id',
            'email_verified_at' => now(),
            'password' => bcrypt('bc123'),
            'department_uuid' => $BC->uuid,
        ]);
        $FPU = User::create([
            'uuid' => Str::uuid(),
            'username' => 'FP',
            'name' => 'FP',
            'email' => 'FP@cp.co.id',
            'email_verified_at' => now(),
            'password' => bcrypt('fp123'),
            'department_uuid' => $FP->uuid,
        ]);
        $WHU = User::create([
            'uuid' => Str::uuid(),
            'username' => 'WH',
            'name' => 'WH',
            'email' => 'WH@cp.co.id',
            'email_verified_at' => now(),
            'password' => bcrypt('wh123'),
            'department_uuid' => $WH->uuid,
        ]);
        $QCU = User::create([
            'uuid' => Str::uuid(),
            'username' => 'QC',
            'name' => 'QC',
            'email' => 'QC@cp.co.id',
            'email_verified_at' => now(),
            'password' => bcrypt('qc123'),
            'department_uuid' => $QC->uuid,
        ]);
        $SHU = User::create([
            'uuid' => Str::uuid(),
            'username' => 'SH',
            'name' => 'SH',
            'email' => 'SH@cp.co.id',
            'email_verified_at' => now(),
            'password' => bcrypt('sh123'),
            'department_uuid' => $SH->uuid,
        ]);
        $SPU = User::create([
            'uuid' => Str::uuid(),
            'username' => 'SP',
            'name' => 'SP',
            'email' => 'SP@cp.co.id',
            'email_verified_at' => now(),
            'password' => bcrypt('sp123'),
            'department_uuid' => $SP->uuid,
        ]);
        $ENGU = User::create([
            'uuid' => Str::uuid(),
            'username' => 'ENG',
            'name' => 'ENG',
            'email' => 'ENG@cp.co.id',
            'email_verified_at' => now(),
            'password' => bcrypt('eng123'),
            'department_uuid' => $ENG->uuid,
        ]);
        $PGAU = User::create([
            'uuid' => Str::uuid(),
            'username' => 'PGA',
            'name' => 'PGA',
            'email' => 'PGA@cp.co.id',
            'email_verified_at' => now(),
            'password' => bcrypt('pga123'),
            'department_uuid' => $SH->uuid,
        ]);



        $user1->syncRoles('Superadmin');
        $user2->syncRoles('Superadmin');
        $user3->syncRoles('Auditor');
        $user4->syncRoles('Manager');
        $BCU->syncRoles('Auditee');
        $FPU->syncRoles('Auditee');
        $SPU->syncRoles('Auditee');
        $SHU->syncRoles('Auditee');
        $ENGU->syncRoles('Auditee');
        $QCU->syncRoles('Auditee');
        $PGAU->syncRoles('Auditee');
        $WHU->syncRoles('Auditee');
    }
}
