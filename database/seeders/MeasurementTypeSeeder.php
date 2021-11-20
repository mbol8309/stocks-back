<?php

namespace Database\Seeders;

use App\Models\MeasurementType;
use Illuminate\Database\Seeder;

class MeasurementTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $m = MeasurementType::where('name', 'Weight')->first();
        if (!$m){
            $m = new MeasurementType([
                'name' => 'Weight',
                'symbol' => 'W'
            ]);
            $m->save();
        }

        $m = MeasurementType::where('name', 'Volume')->first();
        if (!$m){
            $m = new MeasurementType([
                'name' => 'Volume',
                'symbol' => 'V'
            ]);
            $m->save();
        }

        $m = MeasurementType::where('name', 'Unit')->first();
        if (!$m){
            $m = new MeasurementType([
                'name' => 'Unit',
                'symbol' => 'U'
            ]);
            $m->save();
        }
        
    }
}
