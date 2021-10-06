<?php

namespace App\Exports;

use App\EncuestaModel;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class EncuestaExport implements FromView
{
    /**
    * @return \Illuminate\Support\FromView
    */

    public function view(): View
    {
        return view('exports.encuestas', [
            'encuestas' => EncuestaModel::select('nombre', 'genero', 'hobby', 'dedicacion')->orderBy('nombre')->get()
        ]);
    }
}
