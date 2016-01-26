<?php

namespace Panic\Notifications\Http;

use App\Http\Controllers\Controller;
use Panic\Notifications\MailSender;
use Panic\Notifications\Notification;
use App\Models\User;

class NotificationsController extends Controller {

    public function index()
    {
        $notification = new Notification();

        $data['user'] = User::find(1);
        //dd($data['user']);

        $notification->send($data, new MailSender);
    }

}