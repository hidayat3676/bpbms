<?php

namespace App\Contracts\Repositories;

use App\Models\User;
use Illuminate\Database\Eloquent\Collection;

/**
 * Interface UserRepositoryInterface
 *
 * Single Responsibility: Data persistence for user accounts and officers.
 */
interface UserRepositoryInterface
{
    /**
     * Create a new District Officer user.
     */
    public function createDistrictOfficer(array $data): User;

    /**
     * Retrieve all District Officers.
     */
    public function getDistrictOfficers(): Collection;

    /**
     * Find a user by email.
     */
    public function findByEmail(string $email): ?User;

    /**
     * Find a user by ID.
     */
    public function findById(int $id): ?User;

    /**
     * Get count of active district officers.
     */
    public function countDistrictOfficers(): int;
}
