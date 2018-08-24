<?php

use Phinx\Seed\AbstractSeed;

class UserSeed extends AbstractSeed
{
    public function run()
    {
        $resources = [
            [
                'name' => 'users',
                'description' => 'Usuários',
            ],
            [
                'name' => 'roles',
                'description' => 'Papéis',
            ],
            [
                'name' => 'roles',
                'description' => 'Grupos',
            ],
            [
                'name' => 'products',
                'description' => 'Produtos',
            ],
            [
                'name' => 'customers',
                'description' => 'Clientes',
            ],
            [
                'name' => 'salesman',
                'description' => 'Vendedor',
            ],
            [
                'name' => 'sales',
                'description' => 'Venda',
            ]
        ];

        $resourcesData = array_map(function ($resource) {
            return [
                'name' => $resource['name'],
                'description' => $resource['description'],
                'created_at' => date('Y-m-d H:i:s'),
            ];
        }, $resources);

        $resourceTable = $this->table('resources');
        $resourceTable->insert($resourcesData)
            ->save();

        $roleData = [
            'name' => 'admin',
            'created_at' => date('Y-m-d H:i:s'),
        ];

        $roleTable = $this->table('roles');
        $roleTable->insert($roleData)
            ->save();

        $roleQuery = $this->query(
            'SELECT id FROM roles WHERE name="'.$roleData['name'].'" LIMIT 1'
        );
        $roleId = $roleQuery->fetch(PDO::FETCH_ASSOC)['id'];

        $userData = [
            'email' => 'misabitencourt@gmail.com',
            'password' => password_hash('admin123', PASSWORD_BCRYPT),
            'name' => 'admin',
            'created_at' => date('Y-m-d H:i:s'),
            'role_id' => $roleId,
        ];

        $usersTable = $this->table('users');
        $usersTable->insert($userData)
            ->save();

        $resourcesIds = array_map(function ($resource) {
            $query = $this->query('SELECT id FROM resources WHERE name="'.$resource['name'].'" LIMIT 1');

            return $query->fetch(PDO::FETCH_ASSOC)['id'];
        }, $resources);

        $permissions = array_map(function ($resourceId) {
            return [
                'create' => true,
                'update' => true,
                'read' => true,
                'delete' => true,
                'resource_id' => (int) $resourceId,
            ];
        }, $resourcesIds);

        $permissionsData = array_map(function ($permission) use ($roleId) {
            $permission['role_id'] = (int) $roleId;

            return $permission;
        }, $permissions);

        $permissionsTable = $this->table('permissions');
        $permissionsTable->insert($permissionsData)
            ->save();
    }
}
