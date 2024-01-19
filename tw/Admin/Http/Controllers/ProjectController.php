<?php

namespace Tw\Admin\Http\Controllers;

use Tw\Admin\Http\Requests\ProjectRequest;
use Tw\Admin\Repositories\interface\ProjectRepositoryInterface;
use Tw\Models\Project;

class ProjectController extends Controller
{
    public function __construct(protected ProjectRepositoryInterface $projectRepository)
    {
    }

    public function index()
    {
        return json_success($this->projectRepository->getProjectList());
    }

    public function store(ProjectRequest $request)
    {
        $data = $request->validated();

        $data['admin_id'] = request()->admin->id;
        $this->projectRepository->addProject($data);

        return json_success();

    }

}
