<?php

namespace App\Livewire;

use App\Models\CulturalHeritage;
use Dipesh79\LaravelNepalAddressSeeder\Models\District;
use Livewire\Component;

class ShowHome extends Component
{
    public function render()
    {
        return view('livewire.show-home');
    }

    public function festival($district = null)
    {
        if ($district) {
            // dd($district);
            $district_name = District::where('name', $district)->first();
            // dd($district_name);
            if ($district_name) {

                // Fetch all festivals for the given district
                $festivals = CulturalHeritage::where('district_id', $district_name->id)->get();
                if ($festivals->isEmpty()) {
                    return response()->json(['festival' => 'No festival data']);
                } else {
                    return response()->json(['festivals' => $festivals]);
                }
            }else{
                return response()->json(['festival' => 'No festival data']);
            }
        } else {
            return response()->json(['festival' => 'District not specified'], 400);
        }
    }
}
