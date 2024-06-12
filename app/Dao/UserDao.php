<?php
namespace App\Dao;

use App\Contracts\Dao\UserDaoInterface;
use App\Models\User;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Hash;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Support\Str;

class UserDao implements UserDaoInterface
{
    /**
     * Insert Data
     *
     * @param array $insertData
     * @return void
     */
    public function insert(array $insertData): void
    {
        DB::transaction(function () use ($insertData) {
            User::create($insertData);
        });
    }

    /**
     * Get Users By Id
     *
     * @param int $id
     * @return User|null
     */
    public function getUserById(int $id): User|null
    {
        return DB::transaction(function () use ($id) {
            $data = User::where('id', $id)->first();

            return $data;
        });
    }

    /**
     * Delete User
     *
     * @param int $id
     * @return void
     */
    public function delete(int $id): void
    {
        DB::transaction(function () use ($id) {
            User::where('id', $id)->delete();
        });
    }

    /**
     * Update User
     *
     * @param array $updateData
     * @param integer $id
     * @return void
     */
    public function update(array $updateData, int $id): void
    {
        DB::transaction(function () use ($updateData, $id) {
            $user = User::find($id);
            $user->update($updateData);
        });
    }

    /**
     * Get All User
     *
     * @return LengthAwarePaginator
     */
    public function getAllUser(): LengthAwarePaginator
    {
        $users = DB::table('users')->orderBy('id','asc')->paginate(5);
        return $users;
    }

     /**
     * Store changed password
     *
     * @param Request $request
     * @param User $auth
     * @return void
     */
    public function storeChangedPassword(string $password, int $id): void
    {
        $user = User::where('id', $id)->first();

        $user->password = Hash::make($password);
        $user->save();
    }

    /**
     * Store reset password
     *
     * @param Request $request
     * @return void
     */
    public function storeResetPassword(Request $request): void
    {
        Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function (User $user, string $password) {
                $user->forcefill([
                    'password' => Hash::make($password)
                ])->setRememberToken(Str::random(60));

                $user->save();

                event(new PasswordReset($user));
            }
        );
    }
}
