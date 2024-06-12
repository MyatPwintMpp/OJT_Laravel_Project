<?php
namespace App\Services;

use App\Contracts\Services\UserServiceInterface;
use App\Contracts\Dao\UserDaoInterface;
use App\Models\User;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Hash;

class UserService implements UserServiceInterface
{
    protected $userDao;

    public function __construct(UserDaoInterface $userDaoInterface)
    {
        $this->userDao = $userDaoInterface;
    }

    /**
     * insert user
     *
     * @param Request $request
     * @return void
     */
    public function insert(Request $request): void
    {
        $encrypted = Hash::make($request->password);

        $insertData = [
            'name' => $request->name,
            'email' => $request->email,
            'password' => $encrypted,
            'role' => $request->role = 2,  // registered all persons will become Member,Use seeder can create Admin
            'img' => $request->img,
        ];

        $this->userDao->insert($insertData);
    }

    /**
     * get user by Id
     *
     * @param int $id
     * @return User
     */
    public function getUserById(int $id): User
    {
        $data = $this->userDao->getUserById($id);

        return $data;
    }

    /**
     * Delete user
     *
     * @param int $id
     * @return void
     */
    public function delete(int $id): void
    {
        $this->userDao->delete($id);
    }

    /**
     * update user
     *
     * @param Request $request
     * @return void
     */
    public function update(Request $request): void
    {
        $updateData = $request->only(['name', 'email', 'role', 'img']);
        $this->userDao->update($updateData, $request->id);
    }

    /**
     * Get all user
     *
     * @return LengthAwarePaginator
     */
    public function getAllUser(): LengthAwarePaginator
    {
        return $this->userDao->getAllUser();
    }
}
