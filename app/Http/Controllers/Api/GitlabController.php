<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Group;
use App\Services\Gitlab;
use League\Container\Container;

class GitlabController extends Controller
{
    private $gitlabService;

    public function __construct(Container $container) {
        if($this->gitlabService === null) {
            $this->gitlabService = new Gitlab($container);
        }
    }

    public function getGroups()
    {
        $groups = $this->gitlabService->getGroups();
        $this->gitlabService->findOrCreateGroups($groups);
        return response()->json($groups);
    }

    public function getIssuesFromGroup($groupId)
    {
        $issues = $this->gitlabService->getIssuesFromGroup($groupId);
        return response()->json($issues);
    }
}
