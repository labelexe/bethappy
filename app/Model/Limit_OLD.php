<?php

class Limit extends AppModel {

    /**
     * Model name
     * @var $name string
     */
    public $name = 'Limit';
    public $useTable = 'limits';
    public $belongsTo = array('User', 'Country', 'Currency', '');

    /**
     * Model schema
     * @var $_schema array
     */
    protected $_schema = array(
        'id' => array(
            'type' => 'int',
            'length' => 11,
            'null' => false
        ),
        'limit_type' => array(
            'type' => 'string',
            'length' => 10,
            'null' => false
        ),
        'country_id' => array(
            'type' => 'int',
            'length' => 11,
            'null' => false
        ),
        'currency_id' => array(
            'type' => 'int',
            'length' => 11,
            'null' => false
        ),
        'provider_id' => array(
            'type' => 'int',
            'length' => 11,
            'null' => false
        ),
        'user_id' => array(
            'type' => 'int',
            'length' => 11,
            'null' => false
        ),
        'min' => array(
            'type' => 'int',
            'length' => 11,
            'null' => false
        ),
        'max' => array(
            'type' => 'int',
            'length' => 11,
            'null' => false
        ),
        'daily' => array(
            'type' => 'int',
            'length' => 11,
            'null' => false
        ),
        'weekly' => array(
            'type' => 'int',
            'length' => 11,
            'null' => false
        ),
        'monthly' => array(
            'type' => 'int',
            'length' => 11,
            'null' => false
        ),
        'created' => array(
            'type' => 'string',
            'length' => 255,
            'null' => false
        ),
        'modified' => array(
            'type' => 'string',
            'length' => 255,
            'null' => false
        )
    );

//     public function getPagination() {
//
//        $options['recursive'] = 1;
//        $pagination = array(
//            'limit' => Configure::read('Settings.itemsPerPage'),
//            'order' => array('Limit.created' => 'DESC'),
//            //'recursive' => 0
//        );
//
//        if (!empty($options)) {
//            $pagination['conditions'] = $options['conditions'];
//        }
//
//        return $pagination;
//    }

    public function getPagination($options = array()) {
        //var_dump($options);
        $pagination = array(
            'limit' => Configure::read('Settings.itemsPerPage'),
            'order' => array('UserLog.date' => 'DESC'),
            'recursive' => 0
        );

        if (!empty($options)) {
            $pagination['conditions'] = $options['conditions'];
        }
        //var_dump($pagination);
        return $pagination;
    }

//    public function getIndex(){       
//       $data =  $this->find('all');
//       $Countries = ClassRegistry::init('Country');
//       $Currencies = ClassRegistry::init('Currency');
//       $Users = ClassRegistry::init('User');
//      
//       foreach ($data as $key => $value) {
//
//           if($value['Limit']['country_id'] != null){
//            $data[$key] +=  $Countries->find('first', array(
//                'conditions' => array('Country.id' => $value['Limit']['country_id']
//             )));
//        }
//       
//         if($value['Limit']['currency_id'] != null){
//            $data[$key] += $Currencies->find('first', array(
//                'conditions' => array('Currency.id' => $value['Limit']['currency_id']
//             )));
//        }
//        
//        if($value['Limit']['user_id'] != null){
//           $data[$key] += $Users->find('first', array(
//          'conditions' => array('User.ID' => $value['Limit']['user_id']
//        )));
//      }
//       }
// 
//       return $data;
//    }

    public function getLimit($id, $session_key = null) {
        if ($session_key == null) {
            $options['conditions']['Limit.id'] = $id;
        }
        $options['recursive'] = 0;
        $limit = $this->find('first', $options);

        return $limit;
    }

    public function getView($id) {
        $data = parent::getView($id);

        $Countries = ClassRegistry::init('Country');
        $Currencies = ClassRegistry::init('Currency');
        $Users = ClassRegistry::init('User');

        if ($data['Limit']['country_id'] != null) {
            $data['Limit'] += $Countries->find('first', array(
                'conditions' => array('Country.id' => $data['Limit']['country_id']
            )));
        }

        if ($data['Limit']['currency_id'] != null) {
            $data['Limit'] += $Currencies->find('first', array(
                'conditions' => array('Currency.id' => $data['Limit']['currency_id']
            )));
        }

        if ($data['Limit']['user_id'] != null) {
            $data['Limit'] += $Users->find('first', array(
                'conditions' => array('User.ID' => $data['Limit']['user_id']
            )));
        }

        return $data;
    }

    public function getActions() {
        return array(
            0 => array(
                'name' => __('View', true),
                'action' => 'view',
                'controller' => 'Limits',
                'class' => 'btn btn-sm btn-success'
            ),
            1 => array(
                'name' => __('Edit', true),
                'action' => 'edit',
                'controller' => 'Limits',
                'class' => 'btn btn-sm btn-warning'
            ),
            2 => array(
                'name' => __('Delete', true),
                'controller' => 'Limits',
                'action' => 'delete',
                'class' => 'btn btn-sm btn-danger'
            ), //     
        );
    }

}
