<?php
namespace App\Dao;

use App\Contracts\Dao\PostDaoInterface;
use App\Http\Requests\CsvUploadRequest;
use App\Imports\PostsImport;
use Illuminate\Support\Collection;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class PostDao implements PostDaoInterface
{
    /**
     * Create new post
     *
     * @param array $insertData
     * @return integer
     */
    public function insert(array $insertData): int
    {
        $post = DB::transaction(function () use ($insertData) {
            return Post::create($insertData);
        });

        return $post->id;
    }

    /**
     * Get all posts
     *
     * @return LengthAwarePaginator
     */
    public function getAllPost(): LengthAwarePaginator
    {
        $userIds = User::select('id')->get()->pluck('id');
        $posts = Post::whereIn('user_id', $userIds)->orderBy('id', 'DESC')->paginate(3);

        return $posts;
    }

    /**
     * Get post by id
     *
     * @param integer $postId
     * @return Post
     */
    public function getPostById(int $postId): Post
    {
        $post = DB::transaction(function () use ($postId) {
            return Post::where('id', $postId)->first();
        });

        return $post;
    }

    /**
     * Update post in database
     *
     * @param array $updateData
     * @param integer $postId
     * @return void
     */
    public function update(array $updateData, int $postId): void
    {
        DB::transaction(function () use ($updateData, $postId) {
            Post::where('id', $postId)->update($updateData);
        });
    }

    /**
     * Delete post
     *
     * @param int $id
     * @return void
     */
    public function delete(int $id): void
    {
        DB::transaction(function () use ($id) {
            Post::where('id', $id)->delete();
        });
    }

    /**
     * get public posts
     *
     * @return LengthAwarePaginator
     */
    public function getPublicPost(): LengthAwarePaginator
    {
        $userIds = User::select('id')->get()->pluck('id');
        $posts = Post::whereIn('user_id', $userIds)->orderBy('updated_at')->paginate(3);

        return $posts;
    }

    /**
     * Check if post exists
     *
     * @param Request $request
     * @return boolean
     */
    public function verifyPostExists(Request $request): bool
    {
        return Post::findOrFail($request->id) ? true : false;
    }

    /**
     * Import csv file
     *
     * @param CsvUploadRequest $request
     * @return boolean
     */
    public function csvImport(CsvUploadRequest $request): bool
    {
        DB::beginTransaction();
        $import = new PostsImport();
        $import->import($request->file('posts_csv'));
        $failures = $import->failures();
        if (count($failures) > 0) {
            DB::rollBack();
            return false;
        } else {
            DB::commit();
            return true;
        }
    }
}
