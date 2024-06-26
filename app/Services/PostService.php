<?php
namespace App\Services;

use App\Contracts\Dao\PostDaoInterface;
use App\Contracts\Services\PostServiceInterface;
use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;
use Illuminate\Http\Request;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Collection;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class PostService implements PostServiceInterface
{
    protected $postDao;

    public function __construct(PostDaoInterface $postDao)
    {
        $this->postDao = $postDao;
    }

    /**
     * Store new post
     *
     * @param StorePostRequest $request
     * @return integer
     */
    public function insert(StorePostRequest $request): int
    {
        $insertData = [
            'title' => $request->title,
            'description' => $request->description,
            'user_id' => $request->user_id,
        ];

        return $this->postDao->insert($insertData);
    }

    /**
     * Get all posts
     *
     * @return LengthAwarePaginator
     */
    public function getAllPost(): LengthAwarePaginator
    {
        if (Auth::check()) {
            $posts = $this->postDao->getAllPost();
        } else {
            $posts = $this->postDao->getPublicPost();
        }
        
        return $posts;
    }

    /**
     * Get post by id
     *
     * @param integer $post_id
     * @return Post
     */
    public function getPostById(int $post_id): Post
    {
        return $this->postDao->getPostById($post_id);
    }

    /**
     * Update Post
     *
     * @param UpdatePostRequest $request
     * @return void
     */
    public function update(UpdatePostRequest $request): void
    {
        $post_id = $request->id;
        $updateData = [
            'title' => $request->title,
            'description' => $request->description,
        ];

        $this->postDao->update($updateData, $post_id);
    }

    /**
     * Delete post
     *
     * @param int $id
     * @return void
     */
    public function delete(int $id): void
    {
        $this->postDao->delete($id);
    }

    /**
     * Check if post exists
     *
     * @param Request $request
     * @return boolean
     */
    public function verifyPostExists(Request $request): bool
    {
        return $this->postDao->verifyPostExists($request);
    }
    
}
