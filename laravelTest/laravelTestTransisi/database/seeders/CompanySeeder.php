<?php

namespace Database\Seeders;

use App\Models\Company;
use App\Models\Employee;
use Illuminate\Database\Seeder;

class CompanySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Company::factory()->count(5)->create()
            ->each(function ($employee){
                $employee->employees()->saveMany(Employee::factory()->count(10)->make());
            });
    }
}
