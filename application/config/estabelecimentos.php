<?php

$config['status'] = array(
    1 => "Ativo",
    0 => "Inativo"
);

$config['regras'] = array(
    array(
        'field' => 'razao_social',
        'label' => 'razao_social',
        'rules' => 'required'
    ),
    array(
        'field' => 'CNPJ',
        'label' => 'CNPJ',
        'rules' => 'required'
    )
);

