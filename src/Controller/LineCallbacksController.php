<?php
namespace LineBotCallback\Controller;

use LineBotCallback\Controller\AppController;

/**
 * LineCallbacks Controller
 *
 * @property \LineBotCallback\Model\Table\LineCallbacksTable $LineCallbacks
 */
class LineCallbacksController extends AppController
{

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
}
