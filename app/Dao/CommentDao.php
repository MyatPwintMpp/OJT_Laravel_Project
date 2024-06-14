<?php

namespace App\Dao;

use App\Contracts\Dao\CommentDaoInterface;
use App\Models\Comment;
use App\Models\Post;
use App\Models\User;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class CommentDao implements CommentDaoInterface
{
    /**
     * Get comment by post id
     *
     * @param integer $postId
     * @return Collection
     */
    public function getCommentByPostId(int $postId): Collection
    {
        return DB::transaction(function () use ($postId) {
            $comments = Post::find($postId)->comments;
            return $comments;
        });
    }

    /**
     * Get comment by user id
     *
     * @param integer $userId
     * @return Collection
     */
    public function getCommentByUserId(int $userId): Collection
    {
        return DB::transaction(function () use ($userId) {
            $user = User::find($userId);
            $comments = $user->comments()->get()->groupBy('post_id');
            return $comments;
        });
    }

    /**
     * get comment by comment id
     *
     * @param integer $id
     * @return Comment
     */
    public function getCommentById(int $id): Comment
    {
        return DB::transaction(function () use ($id) {
            return Comment::where('id', $id)->first();
        });
    }

    /**
     * Insert new comment into table
     *
     * @param array $insertData
     * @return Comment
     */
    public function insert(array $insertData): Comment
    {
        return DB::transaction(function () use ($insertData) {
            $comment = Comment::create($insertData);
            return $comment;
        });
    }

    /**
     * Delete comment
     *
     * @param integer $id
    * @return void
     */
    public function delete(int $id): void
    {
        DB::transaction(function () use ($id) {
            Comment::where('id', $id)->delete();
        });
    }

    /**
     * Update comment
     *
     * @param integer $id
     * @param array $updateData
     * @return int
     */
    public function update(int $id, array $updateData): int
    {
        return DB::transaction(function () use ($id, $updateData) {
            return Comment::where('id', $id)->update($updateData);
        });
    }
    
}
