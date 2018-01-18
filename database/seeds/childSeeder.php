<?php

use Illuminate\Database\Seeder;
use App\Child;
class childSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('children')->delete();
        $children = [
            ['firstName' => 'Nick', 'lastName' => 'Verstocken','gender' => 'Male', 'dateOfBirth'=> '1991-12-19', 'parent_id' => 1 ],
            ['firstName' => 'Eveline', 'lastName' => 'Verhoeven','gender' => 'Female','dateOfBirth'=> '1992-10-22', 'parent_id' => 1 ],
        ];
        foreach ($children as $child) {
            Child::create($child);
        }
    }
}
