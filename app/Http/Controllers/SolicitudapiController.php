<?php

namespace App\Http\Controllers;

use App\Models\Solicitud;
use Illuminate\Http\Request;

class SolicitudapiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    
    public function index()
    {
        $solicitud = Solicitud::all();
        return response()->json($solicitud);
    }

}
