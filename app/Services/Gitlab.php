<?php

namespace App\Services;

use League\Container\Container;

class Gitlab {

    protected $container;

    public function __construct(Container $container) {
        $this->setContainer($container);
        $this->container->add('guzzle', \GuzzleHttp\Client::class)->addArgument([
            'base_uri' => env('GITLAB_URI'),
            'headers' => ['private-token' => env('GITLAB_TOKEN')],
            'debug' => env('GITLAB_DEBUG')
        ]);
    }

    private function setContainer($container) {
        $this->container = $container;
    }

    public function getGroups() {
        $responseBody = "";
        // $queryParams = ["private_token" => env('GITLAB_TOKEN')];
        $res = $this->container->get('guzzle')->request('GET', 'groups', [
            // 'query' => $queryParams
        ]);
        $responseBody = json_decode($res->getBody());
        // dd($responseBody);
        // foreach ($json as $json_group) {
        //     if (!preg_match('|/|', $json_group->full_path)) {
        //     }
        // }
        return $responseBody;
    }
}
