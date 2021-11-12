<?php

use LearnKit\Entree\Models\Settings;

// config for LearnKit/EntreeArpService
return [
    'api_key' => Settings::get('arp_service_api_key', env('ENTREE_ARP_API_KEY', '')),

    'arp_service_url' => env('ENTREE_ARP_SERVICE_URL', 'https://arpservice.entree.kennisnet.nl/v1/arp/'),
];
