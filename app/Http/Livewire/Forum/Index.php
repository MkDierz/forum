<?php

namespace App\Http\Livewire\Forum;

use App\Models\Reply;
use App\Models\Tag;
use App\Models\Thread;
use Livewire\Component;

class Index extends Component
{
    //thread vars
    public $threads;
    public $ThreadModalStatus = false;
    public $DeleteThreadModalStatus = false;
    public $thread, $threadId, $threadTitle, $threadContent, $threadDate, $threadTag;
    //tags vars
    public $tags;
    public $TagModalStatus = false;
    public $DeleteTagModalStatus = false;
    public $tag, $tagId, $tagTitle, $tagDesc;
    //reps tags
    public $replies;
    public $ReplyModalStatus = false;
    public $DeleteReplyModalStatus = false;
    public $reply, $replyId, $replyTitle, $replyContent, $replyThread;

    public $filter = false;
    public $filterTag, $filterThread;

    public function resetAll()
    {
        $this->reset();
    }

    public function render()
    {
        $this->threads = Thread::all()->sortByDesc('created_at');
        $this->tags = Tag::all();
        return view('livewire.forum.index');
    }

    public function filter($id)
    {
        $this->filter = true;
        $this->filterTag = Tag::find($id);
        $this->filterThread = Thread::where('tag_id', $id)->get();
    }
    /**
     *
     * THREAD CRUD
     *
     */

    public function deleteThread()
    {
        $this->thread->delete();
        $this->resetThread();
    }

    public function updateThreadShow($id)
    {
        $this->threadId = $id;
        $this->loadThread();
        $this->ThreadModalStatus = true;
    }

    public function loadThread()
    {
        $this->thread = Thread::find($this->threadId);
        $this->threadTag = $this->thread->tag_id;
        $this->threadTitle = $this->thread->title;
        $this->threadContent = $this->thread->content;
    }

    public function threadData()
    {
        return [
            'thread_id' => $this->threadTag,
            'title' => $this->threadTitle,
            'content' => $this->threadContent,
        ];
    }

    public function saveThread($id = 0)
    {
        if ($this->thread) {
            $this->thread->update($this->threadData());
            if ($this->thread->tag_id != $this->threadTag) {
                $this->thread->update(['tag_id' => $this->threadTag]);
            }
        } else {
            // dd($this->threadData());
            $thread = new Thread($this->threadData());
            $tag = Tag::find($this->threadTag);
            $tag->Thread()->save($thread);
            // dd($tag->Thread());
        }
        $this->reset();
    }
    /**
     *
     * END THREAD CRUD
     *
     */


    /**
     *
     * TAG CRUD
     *
     */
    public function deleteTag()
    {
        $this->tag->delete();
        $this->TagModalStatus = false;
        $this->DeleteTagModalStatus = false;
        $this->resetTag();
    }

    public function updateTagShow($id)
    {
        $this->tagId = $id;
        $this->loadTag();
        $this->TagModalStatus = true;
    }

    public function loadTag()
    {
        $this->tag = Tag::find($this->tagId);
        $this->tagTitle = $this->tag->title;
        $this->tagDesc = $this->tag->desc;
    }

    public function tagData()
    {
        return [
            'desc' => $this->tagDesc,
            'title' => $this->tagTitle,
        ];
    }

    public function saveTag()
    {
        if ($this->tag) {
            $this->tag->update($this->tagData());
            $this->filterTag = $this->tag;
        } else {
            Tag::create($this->tagData());
        }
        $this->TagModalStatus = false;
        $this->reset();
    }
    /**
     *
     * END TAG CRUD
     *
     */

    /**
     *
     * REPLY CRUD
     *
     */
    public function deleteReply()
    {
        $this->reply->delete();
        $this->ReplyModalStatus = false;
        $this->DeleteReplyModalStatus = false;
        $this->reset([
            'reply',
            'replyId',
            'replyTitle',
            'replyContent',
            'replyThread',
        ]);
    }
    public function updateReplyShow($id)
    {
        $this->replyId = $id;;
        $this->loadReply();
        $this->ReplyModalStatus = true;
    }

    public function loadReply()
    {
        $this->reply = Reply::find($this->replyId);
        $this->replyTitle = $this->reply->title;
        $this->replyContent =  $this->reply->content;
        $this->replyThread =  $this->reply->thread_id;
    }

    public function replyData()
    {
        return [
            'title' => $this->replyTitle,
            'content' => $this->replyContent,
            'thread_id' => $this->replyThread,
        ];
    }
    public function saveReply()
    {
        if ($this->reply) {
            $this->reply->update($this->replyData());
        } else {
            Reply::create($this->replyData());
        }
        $this->ReplyModalStatus = false;
        $this->reset();
    }
}
