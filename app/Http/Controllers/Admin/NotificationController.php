<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;

class NotificationController extends Controller
{
    public function allNotificationS(){
        $allNotification = Auth::user()->notifications;
        $data = "";
        foreach($allNotification as $notification){
            $unread = $notification->read_at ? '' : 'un-read-notification';
            $time = $this->getRemainTime($notification->created_at);
            $data .= '<div class="notification-item '.$unread.'">
                        <div class="dropdown-divider"></div>
                        <a href="'.route('notification.detail', $notification->id).'" class="dropdown-item">
                        <i class="'.$notification->data['icon'].' mr-2"></i>'
                        . $notification->data['title'].
                        '<span class="float-right text-muted text-sm">'.$time.'</span>
                        </a>
                    </div>';
        }
        return $data;
    }

    public function listNotifications(){
        $notifications = Auth::user()->notifications->sortByDesc('created_at')->take(5)->all();
        $data = '';
        // return $notifications;
        foreach($notifications as $notification){
            $unread = $notification->read_at ? '' : 'un-read-notification';
            $time = $this->getRemainTime($notification->created_at);
            $data .= '<div class="notification-item '.$unread.'">
                        <div class="dropdown-divider"></div>
                        <a href="'.route('notification.detail', $notification->id).'" class="dropdown-item">
                            <i class="'.$notification->data['icon'].' mr-2"></i>
                            '. $notification->data['title'].'
                            <span class="float-right text-muted text-sm">'.$time.'</span>
                        </a>
                    </div>';
        }
        return $data;
    }

    public function detail($id){
        $notifications = Auth::user()->notifications->keyBy('id');
        $detailNotification = $notifications->get($id);
        
        $detailNotification->markAsRead();

        return redirect($detailNotification->data['link']);
    }

    public function getRemainTime($created_at){
        $now = new \DateTime();
        $future_date = new \DateTime($created_at);

        $interval = $future_date->diff($now);
            
        $formats = ['%a day', '%h hour', '%i min', '%s second'];
        foreach($formats as $format){
            $time = $interval->format($format);
            //echo $time;
            if((int)explode(' ', $time)[0] > 0){
                if((int)explode(' ', $time)[0] > 1)
                    $time .= 's';
                break;
            }
        }

        return $time;
    }
}
