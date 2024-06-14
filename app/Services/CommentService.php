<?php

namespace App\Services;

use App\Models\Comment;
use App\Contracts\Dao\CommentDaoInterface;
use App\Contracts\Services\CommentServiceInterface;
use App\Http\Requests\StoreCommentRequest;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;

class CommentService implements CommentServiceInterface
{

    protected $commentDao;
    public function __construct(CommentDaoInterface $commentDao)
    {
        $this->commentDao = $commentDao;
    }

    /**
     * Get comment by post id
     *
     * @param integer $postId
     * @return Collection
     */
    public function getCommentByPostId(int $postId): Collection
    {
        return $this->commentDao->getCommentByPostId($postId);
    }

    /**
     * Get comment by user id
     *
     * @param integer $userId
     * @return Collection
     */
    public function getCommentByUserId(int $userId): Collection
    {
        return $this->commentDao->getCommentByUserId($userId);
    }

    /**
     * Insert new comment into table
     *
     * @param StoreCommentRequest $request
     * @return Comment
     */
    public function insert(StoreCommentRequest $request): Comment
    {
        $insertArray = [
            'comment' => $request->comment,
            'user_id' => $request->user_id,
            'post_id' => $request->post_id
        ];
   
        return  $this->commentDao->insert($insertArray);
    }

    /**
     * Delete comment
     *
     * @param integer $id
     * @return void
     */
    public function delete(int $id): void
    {
        $this->commentDao->delete($id);
    }

    /**
     * Update comment
     *
     * @param StoreCommentRequest $request
     * @return void
     */
    public function update(StoreCommentRequest $request): void
    {
        $this->commentDao->update($request->id, ["comment" => $request->comment]);
    }

    /**
     * get comment by id
     *
     * @param integer $id
     * @return Comment
     */
    public function getCommentById(int $id): Comment
    {
        return $this->commentDao->getCommentById($id);
    }
}
