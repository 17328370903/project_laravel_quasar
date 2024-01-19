<?php

namespace Tw\Admin\Repositories\interface;

interface AdminRepositoryInterface
{
    public function getAdminById(int $id);

    public function getAdminByEmail(string $email);

    public function update(int $id, array $data);

    public function getAdminList(array $filter = []);

    public function createAdmin(array $data);

    public function deleteAdmin(int $id);


}
