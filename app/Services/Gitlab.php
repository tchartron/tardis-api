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

    public function saveGroups($groups) {
        if(is_array($groups) && !empty($groups)) {
            foreach ($groups as $group) {
                dd($group);
                $newGroup = new Group();
                // $newGroup->name = $group->name;
                // $newGroup->description = $group->description;
                $newGroup->save();
            }
        }
    }

    public function getIssuesFromGroup($groupId) {
        $responseBody = "";
        $res = $this->container->get('guzzle')->request('GET', "groups/$groupId/issues", []);
        $responseBody = json_decode($res->getBody());
        return $responseBody;
    }
}
