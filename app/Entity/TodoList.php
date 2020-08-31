<?php

namespace App\Entity;

use Illuminate\Database\Eloquent\Model;

class TodoList extends Model
{
    protected $table = 'todo_lists';

    protected $fillable = ['id','title', 'content', 'deadline', 'user_id', 'status'];

    protected $append = ['time_remain'];

    public function users(){
        return $this->hasMany('App\Entity\UserHasTodo', 'todo_id', 'id');
    }

    public function getTimeRemainAttribute(){
        return $this->getRemainTime($this->deadline);
    }
    
    private function getRemainTime($deadline){
        $now = new \DateTime();
        $future_date = new \DateTime($deadline);

        $interval = $future_date->diff($now);
            
        $formats = ['%y year secondary', '%m month secondary', '%a day primary', '%h hour info', '%i min danger', '%s second'];

        foreach($formats as $key=>$format){
            $time = $interval->format($format);
            //echo $time;
            $ex = explode(' ', $time);
            if((int)$ex[0] > 0){
                $res = [
                    'time' => (int)$ex[0],
                    'ext' => $ex[1],
                    'style' => $ex[2]
                ];
                if($key == 2){
                    if((int)$ex[0] < 7)
                        $res['style'] = 'success';
                    if((int)$ex[0] == 1)
                        $res['style'] = 'warning';
                }
                if((int)$ex[0] > 1)
                    $res['ext'] .= 's';
                break;
            }
        }

        return (object)$res;

    }
}
