<?php
namespace App\Contracts\Dao;

use Illuminate\Http\Request;
use App\Http\Requests\CsvUserUploadRequest;

interface UserDaoInterface
{
    public function insert(array $insertData);
    public function getUserById(int $id);
    public function delete(int $id);
    public function update(array $updateData, int $id);
    public function getAllUser();
    public function storeChangedPassword(string $password, int $id);
    public function storeResetPassword(Request $request);
    public function csvImport(CsvUserUploadRequest $request);
}
