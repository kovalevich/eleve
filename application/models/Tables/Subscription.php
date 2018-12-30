<?php

class Models_Tables_Subscription extends Models_Table
{
    public function __construct()
    {
    	parent::__construct('subscription');
    }

    protected $_referenceMap    = array(
        'Casting' => array(
            'columns'           => array('casting_id'),
            'refTableClass'     => 'Models_Castings_Table',
            'refColumns'        => array('id')
        ),
        'User' => array(
            'columns'           => array('user_id'),
            'refTableClass'     => 'Models_Users_Table',
            'refColumns'        => array('id')
        )
    );

}

?>