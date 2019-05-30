<?php

namespace App\Imports;

use App\Address;
use App\addressPoint;
use App\PlaceBranch;
use App\PlaceDetails;
use Illuminate\Database\QueryException;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\ToModel;

class PlaceBranches implements ToCollection
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    protected $place_id;
    public function __construct($place_id)
    {
        $this->place_id = $place_id;
    }

//    public function model(array $row)
//    {
////        dd($row);
//        try {
//
//            return new PlaceBranch([
//                'name_en' => $row[4],
//                'name_ar' => $row[4],
//                'place_id' => $this->place_id,
//            ]);
//
//        } catch (\ErrorException $e){
//            $e->getMessage();
//        }
//    }
    public function collection(Collection $rows)
    {
        try{
            foreach ($rows as $row)
            {
                if($row[0] != 'Num') {
                    $branch = PlaceBranch::create([
                        'name_en' => $row[4],
                        'name_ar' => $row[4],
                        'place_id' => $this->place_id,
                    ]);
                    $address = Address::create([
                        'type' => 'marker',
                        'addressable_type' => 'App\PlaceBranch',
                        'addressable_id' => $branch->id,
                        'city_id' => $row[8],
                        'detailed_address' => $row[7],
                    ]);
                    $point = addressPoint::create([
                        'address_id' => $address->id,
                        'lat' => $row[5],
                        'lng' => $row[6],
                    ]);
                    for($i=9;$i<count($row);$i++) {
                        PlaceDetails::create([
                            'property_en' => $rows[0][$i],
                            'value_en' => $row[$i],
                            'property_ar' => $rows[0][$i],
                            'value_ar' => $row[$i],
                            'branch_id' => $branch->id,
                        ]);
                    }
                }
            }
        } catch (\ErrorException $e){
            $e->getMessage();
        }
    }
}
