<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreRequest;
use Illuminate\Http\Request;
use App\Services\StoreService;

class StoreController extends Controller
{
    protected $storeService;

    public function __construct(StoreService $storeService)
    {
        $this->storeService = $storeService;
    }

    public function index($user_id)
    {
        return $this->storeService->doGet($user_id);
    }

    public function create(StoreRequest $request)
    {
        $storeData = $request->only('name', 'address', 'user_id');
        return $this->storeService->doCreate($storeData);
    }

    public function update(Request $request, $store_id)
    {
        return $this->storeService->doUpdate($request->only('name', 'address'), $store_id);
    }

    public function delete($store_id)
    {
        return $this->storeService->doDelete($store_id);
    }
}
