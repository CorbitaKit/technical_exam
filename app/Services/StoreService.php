<?php

namespace App\Services;

use App\Repositories\StoreRepository;

class StoreService
{
    protected $storeRepo;

    public function __construct(StoreRepository $storeRepo)
    {
        $this->storeRepo = $storeRepo;
    }

    public function doGet(int $user_id): object
    {
        return $this->storeRepo->get($user_id);
    }

    public function doCreate(array $storeData): object
    {
        return $this->storeRepo->create($storeData);
    }

    public function doUpdate(array $updatedData, int $store_id): bool
    {
        return $this->storeRepo->update($updatedData, $store_id);
    }

    public function doDelete(int $store_id): bool
    {
        return $this->storeRepo->delete($store_id);
    }
}
