<?php

    require_once 'shared.php';
    
    echo json_encode(
        [
            'publicKey' => $config['stripe_publishable_key'], 
            'unitAmount' => 20, 
            'currency' => "usd"
        ]
    );
?>