<?php

namespace Tw\Admin\Repositories\interface;

interface RoleRepositoryInterface
{
    public function getRoleList(array $data = []);

    public function getRoleById(int $id);

    public function createRole(array $data);

    public function updateRole(int $id, array $data);

    public function deleteRole(int $id);

    public function getRoleAll(array $column = ['*']);

    public function getRoleByIds(array $ids);

}
