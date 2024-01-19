<?php

namespace Tw\Admin\Repositories;

use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Tw\Admin\Repositories\interface\ProjectRepositoryInterface;
use Tw\Models\Project;

class ProjectRepository implements ProjectRepositoryInterface
{

    public function getProjectList(array $data = []): LengthAwarePaginator
    {
        $list = Project::query()->with(['creator'])->paginate(pageSize());
        return $list;
    }

    public function addProject(array $data)
    {
        return Project::query()->create($data);
    }

    public function updateProject(int $id, array $data)
    {
        // TODO: Implement updateProject() method.
    }

    public function delProject(int $id)
    {
        // TODO: Implement delProject() method.
    }

    public function getProjectById(int $id)
    {
        // TODO: Implement getProjectById() method.
    }
}
