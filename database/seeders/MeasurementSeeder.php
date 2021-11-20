<?php

namespace Database\Seeders;

use App\Models\Measurement;
use App\Models\MeasurementType;
use Illuminate\Database\Seeder;

class MeasurementSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $m = MeasurementType::where('name', 'Weight')->first();
        if ($m){
            $mm = Measurement::where('symbol','kg')->first();
            if (!$mm){
                $mm = new Measurement([
                    'name' => 'Kilogram',
                    'symbol' => 'kg',
                    'base_multiplier' => 1000,
                    'measurementtype_id' => $m->id
                ]);
            }
            $mm->save();

            $mm = Measurement::where('symbol','g')->first();
            if (!$mm){
                $mm = new Measurement([
                    'name' => 'Gram',
                    'symbol' => 'g',
                    'base_multiplier' => 1,
                    'measurementtype_id' => $m->id
                ]);
            }
            $mm->save();

            $mm = Measurement::where('symbol','lb')->first();
            if (!$mm){
                $mm = new Measurement([
                    'name' => 'Pound',
                    'symbol' => 'lb',
                    'base_multiplier' => 0.00220462,
                    'measurementtype_id' => $m->id
                ]);
            }
            $mm->save();
        }

        $m = MeasurementType::where('name', 'Volume')->first();
        if ($m){
            $mm = Measurement::where('symbol','L')->first();
            if (!$mm){
                $mm = new Measurement([
                    'name' => 'Liters',
                    'symbol' => 'L',
                    'base_multiplier' => 1000,
                    'measurementtype_id' => $m->id
                ]);
            }
            $mm->save();

            $mm = Measurement::where('symbol','mm^3')->first();
            if (!$mm){
                $mm = new Measurement([
                    'name' => 'Cubic Milimeters',
                    'symbol' => 'mm^3',
                    'base_multiplier' => 1,
                    'measurementtype_id' => $m->id
                ]);
            }
            $mm->save();

            $mm = Measurement::where('symbol','m^3')->first();
            if (!$mm){
                $mm = new Measurement([
                    'name' => 'Cubic meters',
                    'symbol' => 'm^3',
                    'base_multiplier' => 1000000000,
                    'measurementtype_id' => $m->id
                ]);
            }
            $mm->save();
        }

        $m = MeasurementType::where('name', 'Unit')->first();
        if ($m){
            $mm = Measurement::where('symbol','One')->first();
            if (!$mm){
                $mm = new Measurement([
                    'name' => 'One',
                    'symbol' => 'One',
                    'base_multiplier' => 1,
                    'measurementtype_id' => $m->id
                ]);
            }
            $mm->save();

            $mm = Measurement::where('symbol','pqt')->first();
            if (!$mm){
                $mm = new Measurement([
                    'name' => 'Packet',
                    'symbol' => 'pqt',
                    'base_multiplier' => 12,
                    'measurementtype_id' => $m->id
                ]);
            }
            $mm->save();

            $mm = Measurement::where('symbol','box')->first();
            if (!$mm){
                $mm = new Measurement([
                    'name' => 'Box',
                    'symbol' => 'box',
                    'base_multiplier' => 48,
                    'measurementtype_id' => $m->id
                ]);
            }
            $mm->save();
        }
    }
}
