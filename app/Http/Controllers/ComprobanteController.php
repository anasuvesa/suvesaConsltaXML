<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreComprobanteRequest;
use App\Models\Cliente;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;
use App\Models\Comprobante;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\ValidationException;

use function PHPSTORM_META\elementType;

class ComprobanteController extends Controller
{
    /**
     * Show the profile for a given user.
     */
    public function show(string $clave)
    {
        if (strlen($clave) <> 50) {
            $respuesta = 'Numero de clave incorecta.';
            return view('solicitud', ['respuesta' => $respuesta]);
        } else {
            $comprobantes = Comprobante::where('clave', $clave)->first();
            if (is_null($comprobantes)) {
                DB::table('solicituds')->where('clave', $clave)->delete();
                DB::insert('insert into solicituds (clave, created_at) values (?,?)', [$clave, Carbon::now()]);
                $respuesta = 'No se encontro el comprobante electronico. Intentelo mas tarde.';
                return view('solicitud', ['respuesta' => $respuesta]);
            } else {

                //dd($comprobantes);

                $comprobantes['url_firmado'] = Storage::disk('public')->url($comprobantes->url_firmado);
                $comprobantes['url_respuesta'] = Storage::disk('public')->url($comprobantes->url_respuesta);
                $comprobantes['url_pdf'] = Storage::disk('public')->url($comprobantes->url_pdf);

                return view('comprobante', ['comprobantes' => $comprobantes]);
            }
        }
    }

    public function store(Request $request)
    {
        try {

            $request->validate([
                'clave' => 'required|string|max:50',
                'consecutivo' => 'required|string|max:20',
                'estado' => 'required|string|max:20',
                'cedula' => 'required|string|max:15',
                'nombre' => 'required|string|max:100',
                'firmado' => 'required|file|mimes:xml',
                'respuesta' => 'required|file|mimes:xml',
                'pdf' => 'required|file|mimes:pdf',
            ]);

            $clave = $request->clave;
            $cedula = $request->cedula;
            $fecha = Carbon::now(); // usa timezone del servidor
            $anio = $fecha->year;
            $mes = str_pad($fecha->month, 2, '0', STR_PAD_LEFT);

            // Carpeta ordenada: cedula/año/mes/clave
            $path = "comprobantes/{$cedula}/{$anio}/{$mes}/{$clave}";

            // Guardar archivos
            $urlFirmado = $request->file('firmado')->storeAs($path, 'firmado.xml', 'public');
            $urlRespuesta = $request->file('respuesta')->storeAs($path, 'respuesta.xml', 'public');
            $urlPdf = $request->file('pdf')->storeAs($path, 'comprobante.pdf', 'public');

            DB::beginTransaction();

            DB::table('comprobantes')
                ->where('clave', $request->get('clave'))
                ->delete();

            DB::table('solicituds')
                ->where('clave', $request->get('clave'))
                ->delete();

            if (DB::table('clientes')->where('cedula', $request->get('cedula'))->doesntExist()) {
                Cliente::create([
                    'cedula' => $request->get('cedula'),
                    'nombre' => $request->get('nombre')
                ]);
            }

            // Registrar en la base de datos
            $comprobante = Comprobante::create([
                'clave' => $clave,
                'consecutivo' => $request->consecutivo,
                'estado' => $request->estado,
                'cedula' => $cedula,
                'nombre' => $request->nombre,
                'url_carpeta' => '',
                'url_firmado' => $urlFirmado,
                'url_respuesta' => $urlRespuesta,
                'url_pdf' => $urlPdf,
            ]);

            DB::commit();
            //return response()->json('estado:"correcto"', 200);
            return response()->json([
                'message' => 'Comprobante almacenado correctamente',
                'data' => $comprobante
            ], 201);
        } catch (Exception $e) {
            DB::rollBack();
            return response()->json($e->getMessage(), 422);
        }
    }

    public function descargarWeb($clave, $tipo)
    {
        $comprobante = Comprobante::where('clave', $clave)->firstOrFail();

        $ruta = match ($tipo) {
            'firmado' => $comprobante->url_firmado,
            'respuesta' => $comprobante->url_respuesta,
            'pdf' => $comprobante->url_pdf,
            default => abort(404),
        };

        $path = storage_path('app/public/' . $ruta);

        if (!file_exists($path)) {
            abort(404, 'Archivo no encontrado.');
        }

        // Extrae el nombre del archivo para que se descargue con un nombre amigable
        $nombreDescarga = basename($ruta);

        return response()->download($path, $nombreDescarga);
    }
}
