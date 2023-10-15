<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ApiDetailsController extends Controller
{
    public function index()
    {
        return response()->json([
            'Conexão com Banco de dados:' => $this->get_database_connection_status(),
            'Uso de memória' => round(memory_get_peak_usage() / 1024 / 1024, 2) . ' MB'
        ]);
    }

    public function get_database_connection_status(): string
    {
        try {
            DB::connection()->getPdo();
            return 'Connection OK; waiting to send.';
        } catch (\Exception $e) {
            return 'Error: ' . $e->getMessage();
        }
    }
}
