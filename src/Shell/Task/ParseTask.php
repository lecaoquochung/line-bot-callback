<?php
namespace LineBotCallback\Shell\Task;

use Cake\Console\Shell;
use Cake\Core\Configure;
use Cake\Event\Event;
use Cake\Network\Http\Client;

/**
 * RankYjpTask shell command.
 */
class ParseTask extends Shell
{
     /**
      * initialize() method.
      *
      * @return void
      */
    public function initialize()
    {
        parent::initialize();
        $this->loadModel('LineBotCallback.LineCallbacks');
		$this->loadModel('LineBotCallback.Messages');
    }
    
     /**
       * main() method.
       *
       * @return void
       */
    public function main()
    {
        $start_time = date('Ymd H:i:s');
        $this -> out($start_time);

        $list_message = $this->Messages->find('list',['keyField'=>'line_callback_id','valueField'=>'line_callback_id'])->toArray();

		if(count($list_message) > 0){
			$lineCallbacks = $this->LineCallbacks->find('all')
				->select(['id','result','date'])
				->where(['id NOT IN'=>$list_message]);			
		}else{
			$lineCallbacks = $this->LineCallbacks->find('all')
				->select(['id','result','date']);			
		}

		$count = 0;
        foreach ($lineCallbacks as $lineCallback) :
            $time_start = microtime(true);
			$count++;
			
			// parse
			$result = json_decode($lineCallback->result,true);
			$data = [];
			$message = $this->Messages->newEntity();
			$data['channel_id'] = 0;
			$data['line_callback_id'] = $lineCallback->id;
			$data['eventType'] = $result['result'][0]['eventType'];
			$data['contentType'] = $result['result']{0}['content']['contentType'];
			$data['toType'] = $result['result']{0}['content']['contentType'];
			$data['text'] = $result['result']{0}['content']['text'];			
			$data['toChannel'] = $result['result']{0}['toChannel'];
			$data['fromChannel'] = $result['result']{0}['fromChannel'];
			$data['type'] = 1;
			$data['user_id'] = 1;
			$data['line_user_id'] = $result['result']{0}['content']['id'];
			$data['read'] = 0;
			$data['check'] = 0;
			$data['reply'] = 0;

			$message = $this->Messages->patchEntity($message, $data);

			if ($this->Messages->save($message)) {
				$this->out('Saved Message by callback id: ' .$lineCallback->id);
			} else {
				$this->out('Error Message by callback id: ' .$lineCallback->id);
			}

            // one rsses
            $time_end = microtime(true);
            $execution_time = $time_end - $time_start;
            $this->out($count .' ' .date('H:i:s') .' ' . $lineCallback->id .' ' .$execution_time .'s');
        endforeach;
        
		// all
        $this -> out('-----------------------------DONE------------------------------');
        $end_time = date('Ymd h:i:s');
        $this -> out('Start time:	' .$start_time);
        $this -> out('End time:	' .$end_time);
        $this -> out('---------------------------------------------------------------');
    }

}
