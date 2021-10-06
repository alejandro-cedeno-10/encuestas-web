<?php

namespace App\Http\Controllers;
use App\EncuestaModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Exports\EncuestaExport;
use Maatwebsite\Excel\Facades\Excel;


class EncuestaController extends Controller
{

    public function index(){
        try {
            $encuestas = EncuestaModel::orderBy('nombre')->get();

            return $encuestas;

        }catch (\Exception $exception){
            return $exception;
        }
    }

    public function store(Request $request){
        DB::beginTransaction();
        try {
            EncuestaModel::create(
                [
                    'nombre' => $request->nombre,
                    'genero' => $request->genero,
                    'hobby' => $request->hobby,
                    'dedicacion' => $request->dedicacion
                ]
            );
            DB::commit();
            return 'success';
        }catch (\Exception $exception){
            DB::rollBack();
            return $exception;
        }

    }

    public function getCountByGenero(){
        try {
            $countByGeneros = EncuestaModel::
                select('genero', DB::raw('count(*) as numero'))
                ->groupBy('genero')->orderBy('genero')->get();

            return $countByGeneros;

        }catch (\Exception $exception){
            return $exception;
        }

    }

    public function getCountByName(){
        try {
            $countByNames = EncuestaModel::
                select('nombre', DB::raw('count(*) as numero'))
                ->groupBy('nombre')->orderBy('nombre')->get();

            return $countByNames;

        }catch (\Exception $exception){
            return $exception;
        }
    }

    public function getCountByHobby(){
        try {
            $countByHobby = EncuestaModel::
                select('hobby', DB::raw('count(*) as numero'))
                ->groupBy('hobby')->orderBy('hobby')->get();

            return $countByHobby;

        }catch (\Exception $exception){
            return $exception;
        }
    }

    public function getCountByDedicacion(){
        try {
            $countByDedicacion = EncuestaModel::
                select('dedicacion', DB::raw('count(*) as numero'))
                ->groupBy('dedicacion')->orderBy('dedicacion')->get();

            return $countByDedicacion;

        }catch (\Exception $exception){
            return $exception;
        }
    }

    public function downloadExcel(){
        try {

            return Excel::download(new EncuestaExport, 'Encuesta.xls');

        }catch (\Exception $exception){
            return $exception;
        }
    }
}
