<?php

namespace App\Http\Controllers;

use App\Services\ProductFileService;
use App\Services\ProductService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ProductFileController extends Controller
{
    public function __construct(
        private readonly ProductFileService $service
    ) {}

    public function index(): JsonResponse
    {
        return response()->json($this->service->listAll());
    }

    public function show(int $prodFileId): JsonResponse
    {
        $prodFileName = $this->service->findById($prodFileId);
        return response()->json($prodFileName);
    }

}
