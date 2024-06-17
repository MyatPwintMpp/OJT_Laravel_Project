<?php
namespace App\Contracts\Services;

use App\Http\Requests\AdminPasswordStoreRequest;
use App\Http\Requests\CsvUploadRequest;
use App\Http\Requests\CsvUserUploadRequest;

interface AdminServiceInterface
{
    public function postCsvDownload();
    public function postCsvUpload(CsvUploadRequest $request);
    public function userCsvDownload();
    public function userCsvUpload(CsvUserUploadRequest $request);
}
