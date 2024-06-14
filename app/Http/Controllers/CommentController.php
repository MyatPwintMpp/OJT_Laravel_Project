<?php

namespace App\Http\Controllers;

use App\Contracts\Services\CommentServiceInterface;
use App\Http\Requests\StoreCommentRequest;
use App\Models\Comment;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class CommentController extends Controller
{
    protected $commentService;

    public function __construct(CommentServiceInterface $commentService){
        $this->commentService = $commentService;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreCommentRequest $request
     * @return string
     */
    public function store(StoreCommentRequest $request): string
    {
        $this->commentService->insert($request);

        return redirect()->route('posts.index')->with('success', 'Comment created successfully');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param StoreCommentRequest $request
     * @param Comment $comment
     * @return string
     */
    public function update(StoreCommentRequest $request, Comment $comment): string
    {
        $this->commentService->update($request);

        return redirect()->route('posts.index')->with('success', 'Comment created successfully');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return View
     */
    public function edit(int $id): View
    {
        $comment = $this->commentService->getCommentById($id);

        return view('posts.commentEdit', ['comment' => $comment]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param integer $id
     * @return RedirectResponse
     */
    public function destroy(int $id): RedirectResponse
    {
        $this->commentService->delete($id);
        
        return back();
    }
}
