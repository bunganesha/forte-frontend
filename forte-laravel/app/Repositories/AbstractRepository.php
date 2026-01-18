<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

/**
 * AbstractRepository: Base class untuk semua repository
 * Mengimplementasikan Repository Pattern
 */
abstract class AbstractRepository
{
    protected Model $model;

    /**
     * Constructor
     */
    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    /**
     * Get all records
     */
    public function getAll(): Collection
    {
        return $this->model->all();
    }

    /**
     * Get records dengan pagination
     */
    public function paginate(int $perPage = 15): LengthAwarePaginator
    {
        return $this->model->paginate($perPage);
    }

    /**
     * Find record by id
     */
    public function findById(int $id): ?Model
    {
        return $this->model->find($id);
    }

    /**
     * Find record atau throw exception
     */
    public function findOrFail(int $id): Model
    {
        return $this->model->findOrFail($id);
    }

    /**
     * Create record baru
     */
    public function create(array $data): Model
    {
        return $this->model->create($data);
    }

    /**
     * Update record
     */
    public function update(Model $model, array $data): Model
    {
        $model->update($data);
        return $model->refresh();
    }

    /**
     * Delete record
     */
    public function delete(Model $model): bool
    {
        return $model->delete();
    }

    /**
     * Find record dengan condition
     */
    public function findBy(string $column, $value): ?Model
    {
        return $this->model->where($column, $value)->first();
    }

    /**
     * Find multiple records dengan condition
     */
    public function findManyBy(string $column, $value): Collection
    {
        return $this->model->where($column, $value)->get();
    }

    /**
     * Count total records
     */
    public function count(): int
    {
        return $this->model->count();
    }
}
