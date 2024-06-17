<?php
namespace App\Services;

use App\Contracts\Dao\PostDaoInterface;
use App\Contracts\Dao\UserDaoInterface;
use App\Contracts\Services\AdminServiceInterface;
use App\Exports\PostsExport;
use App\Exports\UsersExport;
use App\Http\Requests\CsvUploadRequest;
use App\Http\Requests\CsvUserUploadRequest;
use Maatwebsite\Excel\Facades\Excel;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class AdminService implements AdminServiceInterface
{
    protected $userDao;
    protected $postDao;

    public function __construct(UserDaoInterface $userDao, PostDaoInterface $postDao)
    {
        $this->userDao = $userDao;
        $this->postDao = $postDao;
    }

    /**
     * Download csv file
     *
     * @return BinaryFileResponse
     */
    public function postCsvDownload(): BinaryFileResponse
    {
        return Excel::download(new PostsExport, 'posts_' . time() . '.csv');
    }

    /**
     * Csv upload for user
     *
     * @param CsvUploadRequest $request
     * @return bool
     */
    public function postCsvUpload(CsvUploadRequest $request): bool
    {
        return $this->postDao->csvImport($request);
    }

        /**
     * Download csv file
     *
     * @return BinaryFileResponse
     */
    public function userCsvDownload(): BinaryFileResponse
    {
        return Excel::download(new UsersExport, 'users_' . time() . '.csv');
    }

    /**
     * Csv upload for user
     *
     * @param CsvUserUploadRequest $request
     * @return bool
     */
    public function userCsvUpload(CsvUserUploadRequest $request): bool
    {
        return $this->userDao->csvImport($request);
    }
    
}
