<?php

namespace App\Repositories;

use App\Contracts\Repositories\UserRepositoryInterface;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Hash;

/**
 * Class UserRepository
 *
 * Implements user data access and persistence for BPBMS.
 */
class UserRepository implements UserRepositoryInterface
{
    public function __construct(
        protected User $model
    ) {}

    /**
     * Create a new District Officer user.
     */
    public function createDistrictOfficer(array $data): User
    {
        return $this->model->create([
            'name' => trim($data['name']),
            'email' => strtolower(trim($data['email'])),
            'password' => Hash::make($data['password']),
            'role' => 'district_officer',
            'district' => trim($data['district']),
            'phone' => !empty($data['phone']) ? trim($data['phone']) : null,
            'designation' => !empty($data['designation']) ? trim($data['designation']) : 'District Livestock Officer (DLO)',
        ]);
    }

    /**
     * Retrieve all District Officers.
     */
    public function getDistrictOfficers(): Collection
    {
        return $this->model->where('role', 'district_officer')->orderBy('district')->get();
    }

    /**
     * Find a user by email.
     */
    public function findByEmail(string $email): ?User
    {
        return $this->model->where('email', strtolower(trim($email)))->first();
    }

    /**
     * Find a user by ID.
     */
    public function findById(int $id): ?User
    {
        return $this->model->find($id);
    }

    /**
     * Get count of active district officers.
     */
    public function countDistrictOfficers(): int
    {
        return $this->model->where('role', 'district_officer')->count();
    }
}
