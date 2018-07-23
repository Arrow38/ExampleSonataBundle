->add('client.datenaissance', 'doctrine_orm_callback', array(
                    // 'operator_type' => 'sonata_type_filter_number', don't work
                   
                   'operator_type' => NumberType::class, //Custom numbertype of this folder
                    
                    'callback' => function($queryBuilder, $alias, $field, $value) {
                    if (!$value['value']) {
                        return;
                    }
                    $operators = array(
                        NumberType::TYPE_EQUAL            => '=',
                        NumberType::TYPE_GREATER_EQUAL    => '>=',
                        NumberType::TYPE_GREATER_THAN     => '>',
                        NumberType::TYPE_LESS_EQUAL       => '<=',
                        NumberType::TYPE_LESS_THAN        => '<',
                    );
                    var_dump($value);
                    $operator = '>=';
                    if (array_key_exists('type',$value)){
                        if ($value['type']['type']){
                    $operator = $operators[$value['type']['type']];}}
                    

                    $currentyear = date("Y");
                    
                    
                    $queryBuilder->andWhere('('.$currentyear.' - YEAR(o.datenaissance) ) '.$operator.' '.intval($value['value']));
                    
                    return true;
                },'field_type' => 'number'
                
          ))
