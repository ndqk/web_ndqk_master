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
        $deadline = new \DateTime($deadline);
        $tmp = date('Y-m-d H:i:s');
        $current = new \DateTime($tmp);
                      
        $timeRemain = $deadline->diff($current);

        $formats = ['y', 'm', 'd', 'h', 'm'];

        foreach($formats as $format){
            $time = $timeRemain->$format;
            if($time){
                switch($format){
                    case 'y':
                        $style = 'secondary';
                        $ext = 'year';
                        break;
                    case 'm':
                        $style = 'secondary';
                        $ext = 'month';
                        break;
                    case 'd':
                        $ext = 'day';
                        if($time > 7){
                            $style = 'primary';
                        }
                        else{
                            if($time == 1){
                                $style = 'warning';
                            }
                            else
                                $style = 'success';
                        }
                        break;
                    case 'h':
                        $style = 'info';
                        $ext = 'hour';
                        break;
                    case 'm':
                        $style = 'danger';
                        $ext = 'minute';
                        break;
                    default:
                        break;
                }
            break;
            }
        }
        if($time > 1) 
            $ext  .= 's';
        return (object)['time' => $time, 'style' => $style, 'ext' => $ext];

    }
}
