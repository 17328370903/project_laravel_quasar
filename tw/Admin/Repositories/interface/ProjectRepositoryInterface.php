<?php

namespace Tw\Admin\Repositories\interface;

interface ProjectRepositoryInterface
{
    public function getProjectList(array $data = []);

    public function addProject(array $data);

    public function updateProject(int $id, array $data);

    public function delProject(int $id);

    public function getProjectById(int $id);
}
