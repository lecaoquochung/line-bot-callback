<?php
namespace LineBotCallback\Controller;

use LineBotCallback\Controller\AppController;
use Cake\Event\Event;
use Cake\Network\Http\Client;
use Cake\Core\Configure;
/**
 * LineCallbacks Controller
 *
 * @property \LineBotCallback\Model\Table\LineCallbacksTable $LineCallbacks
 */
class LineCallbacksController extends AppController
{
    /**
     * beforeFilter method
     *
     * @return void Redirects on successful beforeFilter, renders view otherwise.
     */
    public function beforeFilter(Event $event) {
        parent::beforeFilter($event);
        $this->Auth->allow(['callbacks','replyCallbacks']);
    }
	
    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $lineCallbacks = $this->paginate($this->LineCallbacks);

        $this->set(compact('lineCallbacks'));
        $this->set('_serialize', ['lineCallbacks']);
    }

    /**
     * View method
     *
     * @param string|null $id Line Callback id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $lineCallback = $this->LineCallbacks->get($id, [
            'contain' => []
        ]);

        $this->set('lineCallback', $lineCallback);
        $this->set('_serialize', ['lineCallback']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $lineCallback = $this->LineCallbacks->newEntity();
        if ($this->request->is('post')) {
            $lineCallback = $this->LineCallbacks->patchEntity($lineCallback, $this->request->data);
            if ($this->LineCallbacks->save($lineCallback)) {
                $this->Flash->success(__('The line callback has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The line callback could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('lineCallback'));
        $this->set('_serialize', ['lineCallback']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Line Callback id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $lineCallback = $this->LineCallbacks->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $lineCallback = $this->LineCallbacks->patchEntity($lineCallback, $this->request->data);
            if ($this->LineCallbacks->save($lineCallback)) {
                $this->Flash->success(__('The line callback has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The line callback could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('lineCallback'));
        $this->set('_serialize', ['lineCallback']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Line Callback id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $lineCallback = $this->LineCallbacks->get($id);
        if ($this->LineCallbacks->delete($lineCallback)) {
            $this->Flash->success(__('The line callback has been deleted.'));
        } else {
            $this->Flash->error(__('The line callback could not be deleted. Please, try again.'));
        }
        return $this->redirect(['action' => 'index']);
    }
	
	public function callbacks(){
		$this->autoRender = false;
		$requestBodyString = file_get_contents('php://input');
		if(!empty($requestBodyString)){
			$lineCallback = $this->LineCallbacks->newEntity();
			$data['result'] = $requestBodyString;
			$data['date'] = date('Y-m-d');
			$lineCallback = $this->LineCallbacks->patchEntity($lineCallback, $data);
			$this->LineCallbacks->save($lineCallback);
			
			$this->replyCallbacks($requestBodyString);
		}
	}
	
	public function replyCallbacks($requestBodyString){
		$requestBodyObject = json_decode($requestBodyString);
		$requestContent = $requestBodyObject->result{0}->content;
		$requestText = $requestContent->text;
		$requestFrom = $requestContent->from;
		$toType = $requestContent->toType;
		$contentType = $requestContent->contentType;
		$eventType = $requestBodyObject->result{0}->eventType;
		$fromChannel = $requestBodyObject->result{0}->fromChannel;

		  // LINE BOT API 経由でユーザに渡すことになるJSONデータを作成。
		  // to にはレスポンス先ユーザの MID を配列の形で指定。
		  // toChannel、eventTypeは固定の数値・文字列を指定。
		  // contentType は、テキストを返す場合は 1。
		  // toType は、ユーザへのレスポンスの場合は 1。
		  // text には、ユーザに返すテキストを指定。
		
		// LINE BOT API へのリクエストを作成して実行
		$configLineBot = Configure::read('LineBot');		
		$responseMessage = json_encode([
				'to' => [$requestFrom],
				'toChannel' => $fromChannel,
				'eventType' => $eventType,
				'content' => [
					'contentType' => $contentType,
					'toType' => $toType,
					'text' => "はじめまして。\nよろしくお願いします。"
				]
			]);
			

		$http = new Client();
		$response = $http->post(
			'https://trialbot-api.line.me/v1/events',
			$responseMessage,
			[
				'headers' => [
					'Content-Type' => 'application/json; charset=UTF-8',
					'X-Line-ChannelID'=> $configLineBot['channelId'],
					'X-Line-ChannelSecret' => $configLineBot['channelSecret'],
					'X-Line-Trusted-User-With-ACL' => $configLineBot['mid']
				]
			]
		);
	}
}
