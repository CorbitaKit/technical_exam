<?php

namespace App\Repositories;

use App\Models\Store;

class StoreRepository
{
    public function get(int $user_id): object
    {
        return Store::where('user_id', $user_id)->get();
    }

    public function create(array $storeData): object
    {
        return Store::create($storeData);
    }

    public function update(array $updatedData, int $store_id): bool
    {
        $store = Store::findOrFail($store_id);
        return $store->update($updatedData);
    }

    public function delete(int $store_id): bool
    {
        $store = Store::findOrFail($store_id);
        return $store->delete();
    }
}
