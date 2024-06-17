<?php

namespace App\Http\Controllers;

use App\Contracts\Services\AdminServiceInterface;
use App\Contracts\Services\PostServiceInterface;
use App\Contracts\Services\UserServiceInterface;
use App\Http\Requests\AdminFormRequest;
use App\Http\Requests\CsvUploadRequest;
use App\Http\Requests\CsvUserUploadRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class AdminController extends Controller
{
    protected $postService;
    protected $userService;
    protected $adminService;
    public function __construct(PostServiceInterface $postService, UserServiceInterface $userService, AdminServiceInterface $adminService)
    {
        $this->postService = $postService;
        $this->userService = $userService;
        $this->adminService = $adminService;
    }

    /**
     * Show blade for downloading/uploading csv files
     *
     * @return void
     */
    public function csvShow(): View
    {
        return view('admin.file');
    }

    /**
     * Download posts table as csv file
     *
     * @return BinaryFileResponse
     */
    public function postCsvDownload(): BinaryFileResponse
    {
        return $this->adminService->postCsvDownload();
    }

    /**
     * Insert uploaded csv in post table and return rows that cannot be inserted.
     *
     * @param CsvUploadRequest $request
     * @return RedirectResponse
     */
    public function postCsvUpload(CsvUploadRequest $request): RedirectResponse
    {
        $status = $this->adminService->postCsvUpload($request);
        if ($status) {
            return back()->with('success', 'Successfully uploaded');
        } else {
            return back()->with('failed', 'Somehting went wrong.');
        }
    }

    /**
     * Download posts table as csv file
     *
     * @return BinaryFileResponse
     */
    public function userCsvDownload(): BinaryFileResponse
    {
        return $this->adminService->userCsvDownload();
    }

    /**
     * Insert uploaded csv in post table and return rows that cannot be inserted.
     *
     * @param CsvUserUploadRequest $request
     * @return RedirectResponse
     */
    public function userCsvUpload(CsvUserUploadRequest $request): RedirectResponse
    {
        $status = $this->adminService->userCsvUpload($request);
        if ($status) {
            return back()->with('success', 'Successfully uploaded');
        } else {
            return back()->with('failed', 'Something went wrong.');
        }
    }

}
