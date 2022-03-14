<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use DB;

class AccountTypeSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $accountType = array(
            ['name' => 'Talent Hunter'],
            ['name' => 'Creative Talent']
        );
        $types = DB::table('account_types')->get();

        if(count($types) == 0)
            DB::table('account_types')->insert($accountType);
    }
}
