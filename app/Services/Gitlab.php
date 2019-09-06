<?php

namespace App\Services;

use League\Container\Container;
use App\Group;

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
        return $responseBody;
    }

    public function findOrCreateGroups($groups) {
        if(is_array($groups) && !empty($groups)) {
            foreach ($groups as $group) {
                if(!Group::where('name', '=', $group->full_name)->exists()) {
                    Group::create(['name' => $group->full_name, 'description' => $group->description]);
                }
            }
        }
    }

    public function getIssuesFromGroup($groupId) {
        $responseBody = "";
        $params = ['state' => "opened"];
        $res = $this->container->get('guzzle')->request('GET', "groups/$groupId/issues", [
            "query" => $params
        ]);
        $responseBody = json_decode($res->getBody());
        return $responseBody;
    }
}
