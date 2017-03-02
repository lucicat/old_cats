<?php

namespace App\Controllers;
use Respect\Validation\Validator as v;
use App\Models\MessageModel;
use App\Pagination\Pagination;
use App\Models\DiscussionModel;


class MessageController extends Controller
{
    /**
     * get all the messages from current chat
     * @param  [type] $request  [description]
     * @param  [type] $response [description]
     * @param  [type] $args     [description]
     * @return [type]           [description]
     */
    public function getMessages($request, $response, $args)
    {
        $theme = $args['theme'];
        $messages = MessageModel::where('messages.discussion', $theme)
                                ->join('cats', 'cats.idcats', '=', 'messages.cat')
                                ->select('messages.*', 'cats.name', 'cats.idcats')
                                ->get();
        $discussion = DiscussionModel::where('iddiscussions', $theme)
                                     ->select('title')
                                     ->first();

        $count_messages = $messages->count();
        $messages = $messages ? $messages : false;
        $this->view->getEnvironment()->addGlobal('theme', $theme);
        $this->view->getEnvironment()->addGlobal('discussion', $discussion);
        $this->view->getEnvironment()->addGlobal('time', time());
        $this->view->getEnvironment()->addGlobal('checkAuth', $this->auth->check());
        $this->view->getEnvironment()->addGlobal('count_messages', $count_messages);
        $this->view->getEnvironment()->addGlobal('messages', $messages); 
        return $this->view->render($response, 'conversation/messages.twig');
    }


    public function addMessage($request, $response, $args)
    {
        $theme = $args['theme'];
        $oldtime = $args['timestamp'];
        $timecreated = time();
        $message = $request->getQueryParam('message');
        MessageModel::create([
            'content'       => $message,
            'discussion'    => $theme,
            'cat'           => $_SESSION['user'],
            'created_at'    => $timecreated,
        ]);

        $messages = MessageModel::where('messages.created_at', '>', $oldtime)
                                ->where('messages.discussion', $theme)
                                ->select('messages.*', 'cats.name', 'cats.idcats')
                                ->join('cats', 'cats.idcats', '=', 'messages.cat')
                                ->get();
        $messages = $messages ? $messages : false;
        return json_encode([$messages, $timecreated]);
    }

    public function refreshData($request, $response, $args)
    {

        $theme = $args['theme'];
        $time = $args['timestamp'];
        $messages = MessageModel::where('messages.created_at', '>', $time)
                                ->where('messages.discussion', $theme)
                                ->select('messages.*', 'cats.name')
                                ->join('cats', 'cats.idcats', '=', 'messages.cat')
                                ->get();
        $messages = $messages ? $messages : false;
        return json_encode([$messages, time()]);
    }

}