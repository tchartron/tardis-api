<?php

namespace App\Services;

// use League\Container\Container;
use App\Group;
use App\Task;
use GuzzleHttp\Client;

class Gitlab {

    // protected $container;
    protected $client;

    public function __construct() {
        // $this->setContainer($container);
        // $this->container->add('guzzle', \GuzzleHttp\Client::class)->addArgument([
        //     'base_uri' => env('GITLAB_URI'),
        //     'headers' => ['private-token' => env('GITLAB_TOKEN')],
        //     'debug' => env('GITLAB_DEBUG')
        // ]);
        $this->client = new Client([
            'base_uri' => env('GITLAB_URI'),
            'headers' => ['private-token' => env('GITLAB_TOKEN')],
            'debug' => env('GITLAB_DEBUG')
        ]);
    }

    // private function setContainer($container) {
    //     $this->container = $container;
    // }

    public function getGroups() {
        // $queryParams = ["private_token" => env('GITLAB_TOKEN')];
        // $res = $this->container->get('guzzle')->request('GET', 'groups', [
        //     // 'query' => $queryParams
        // ]);
        $res = $this->client->request('GET', 'groups', []);
        $groups = json_decode($res->getBody());
        if(is_array($groups) && !empty($groups)) {
            foreach ($groups as $group) {
                $createdGroup = Group::firstOrCreate(
                    ['name' => $group->full_name],
                    ['description' => $group->description]
                );
                $this->getIssuesFromGroup($group->id, $createdGroup->id);
            }
        }
        return $groups;
    }

    // public function findOrCreateGroups($groups) {
    //     if(is_array($groups) && !empty($groups)) {
    //         foreach ($groups as $group) {
    //             // if(!Group::where('name', '=', $group->full_name)->exists()) {
    //             //     Group::create(['name' => $group->full_name, 'description' => $group->description, 'gitlab_id' => $group->id]);
    //             // }
    //             //firestOrCreate
    //         }
    //     }
    // }

    public function getIssuesFromGroup($gitlabGroupId, $createdGroupId) {
        $params = ['state' => "opened"];
        // $group = Group::where('id', '=', $groupId)->first();
        // $res = $this->container->get('guzzle')->request('GET', "groups/$group->gitlab_id/issues", [
        //     "query" => $params
        // ]);
        $res = $this->client->request('GET', "groups/$gitlabGroupId/issues", [
            "query" => $params
        ]);
        $issues = json_decode($res->getBody());
        // dd($issues);
        if(is_array($issues) && !empty($issues)) {
            foreach ($issues as $issue) {
                Task::unguard(); //Disable mass assignment guards
                Task::firstOrCreate(
                    ['title' => $issue->title, 'group_id' => $createdGroupId],
                    ['description' => $issue->description, 'completed' => ($issue->state === "opened") ? 0 : 1]
                );
                Task::reguard(); //Re-enable mass assignment guards
            }
        }
        return $issues;
    }

    // public function findOrCreateIssues($issues) {
    //     if(is_array($issues) && !empty($issues)) {
    //         foreach ($issues as $issue) {
    //             if(!Task::where('title', '=', $issue->title)->exists()) {
    //                 // Task::create(['title' => $issue->title, 'description' => $issue->description, 'gitlab_id' => $issue->id]); //no mass assignment for owner id don"t want to add it.
    //                 $task = new Task();
    //                 $task->owner_id = 0; // Owner 0 is gitlab
    //                 $task->group_id = $issue->milestone->group_id ?? 0;
    //                 $task->title = $issue->title;
    //                 $task->description = $issue->description;
    //                 $task->gitlab_id = $issue->id;
    //                 $task->save();
    //             }
    //         }
    //     }
    // }

}
