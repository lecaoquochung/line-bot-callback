<?php
namespace LineBotCallback\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * LineCallbacks Model
 *
 * @method \LineBotCallback\Model\Entity\LineCallback get($primaryKey, $options = [])
 * @method \LineBotCallback\Model\Entity\LineCallback newEntity($data = null, array $options = [])
 * @method \LineBotCallback\Model\Entity\LineCallback[] newEntities(array $data, array $options = [])
 * @method \LineBotCallback\Model\Entity\LineCallback|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \LineBotCallback\Model\Entity\LineCallback patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \LineBotCallback\Model\Entity\LineCallback[] patchEntities($entities, array $data, array $options = [])
 * @method \LineBotCallback\Model\Entity\LineCallback findOrCreate($search, callable $callback = null)
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class LineCallbacksTable extends Table
{

    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config)
    {
        parent::initialize($config);

        $this->table('line_callbacks');
        $this->displayField('id');
        $this->primaryKey('id');

        $this->addBehavior('Timestamp');
    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator)
    {
        $validator
            ->integer('id')
            ->allowEmpty('id', 'create');

        $validator
            ->requirePresence('result', 'create')
            ->notEmpty('result');

        $validator
            ->date('date')
            ->requirePresence('date', 'create')
            ->notEmpty('date');

        return $validator;
    }
}
