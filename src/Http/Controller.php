<?php

namespace Neo\NepLocation\Http;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Neo\NepLocation\Models\AdministrativeAreaName;
use Neo\NepLocation\Models\AdministrativeAreaType;
use Neo\NepLocation\Models\District;
use Neo\NepLocation\Models\Province;

class Controller
{
    public function feedData(Request $req)
    {
        $res = Http::get('https://raw.githubusercontent.com/sagautam5/local-states-nepal/refs/heads/master/dataset/alldataset/en.json');

        if (!$res->ok()) {
            return response()->json(['error' => 'Failed to fetch data'], 500);
        }

        $data = $res->json();

        AdministrativeAreaType::updateOrCreate(['name' => 'Metropolitan']);
        AdministrativeAreaType::updateOrCreate(['name' => 'Sub-Metropolitan']);
        AdministrativeAreaType::updateOrCreate(['name' => 'Municipality']);
        AdministrativeAreaType::updateOrCreate(['name' => 'Rural Municipality']);

        foreach ($data as $state) {
            $stateModel = Province::updateOrCreate(
                ['name' => $state['name']],
                [
                    'name' => $state['name'],
                ]
            );

            foreach ($state['districts'] as $district) {
                $districtModel = District::updateOrCreate(
                    [
                        'name' => $district['name'],
                        'province_id' => $stateModel->id,
                    ],
                    [
                        'province_id' => $stateModel->id,
                        'name' => $district['name'],
                    ]
                );

                foreach ($district['municipalities'] as $municipality) {
                    AdministrativeAreaName::updateOrCreate(
                        [
                            'name' => $municipality['name']
                        ],
                        [
                            'area_type_id' => $municipality['category_id'],
                            'district_id' => $districtModel->id,
                            'name' => $municipality['name'],
                        ]
                    );
                }
            }
        }

        return response()->json(['message' => 'Data imported successfully']);
    }
}
