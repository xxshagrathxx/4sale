<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ProviderResource;
use App\Models\Provider;
use Illuminate\Http\Request;

class ProviderController extends Controller
{
    public function index(Request $request)
    {
        $limit = $request->limit ?? 10;
        $provider = $request->provider ?? null;
        $statusCode = $request->statusCode ?? null;
        $balanceMin = $request->balanceMin ?? null;
        $balanceMax = $request->balanceMax ?? null;
        $currency = $request->currency ?? null;

        $data = new Provider();

        if($provider) {
            $data = $data->where('reference', $provider);
        }

        if($currency) {
            $data = $data->where('currency', $currency);
        }

        if($statusCode) {
            $data = $data->where('status', $statusCode);
        }

        if($balanceMin && $balanceMax) {
            $data = $data->where('balance', '>=', $balanceMin)->where('balance', '<=', $balanceMax);
        }

        $data = ProviderResource::collection($data->paginate($limit));

        return response()->json([
            'data' => $data,
            'meta' => [
                'total' => $data->total(),
                'per_page' => $data->perPage(),
                'current_page' => $data->currentPage(),
                'last_page' => $data->lastPage(),
                'first_page_url' => $data->url(1),
                'last_page_url' => $data->url($data->lastPage()),
                'next_page_url' => $data->nextPageUrl(),
                'prev_page_url' => $data->previousPageUrl(),
                'path' => $data->path(),
                'from' => $data->firstItem(),
                'to' => $data->lastItem(),
            ],
        ], 200);
    }
}
