<?php

namespace App\Http\Controllers\Incidence;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Incidence\IncidenceState;

class IncidenceStateController extends Controller
{
    public function list(){

        $incidenceStates = IncidenceState::all();

        foreach ($incidenceStates as $incidenceState) {
            $data[] = [
                'label' => $incidenceState->name,
                'value' => $incidenceState->id
            ];
        }

        return response()->json($data);
    }
}
