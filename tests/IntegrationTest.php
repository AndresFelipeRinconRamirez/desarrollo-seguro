<?php
use PHPUnit\Framework\TestCase;

require_once __DIR__ . '/../models/DataBase.php';
require_once __DIR__ . '/../models/User.php';

class IntegrationTest extends TestCase
{
    // PRUEBA INTEGRACIÓN 1 - Verificar conexión a la base de datos
    public function testDatabaseConnection()
    {
        $db = DataBase::connection();
        $this->assertNotNull($db);
    }

    // PRUEBA INTEGRACIÓN 2 - Consultar roles de la base de datos
    public function testReadRoles()
    {
        $user = new User();
        $roles = $user->read_roles();
        $this->assertIsArray($roles);
        $this->assertGreaterThan(0, count($roles));
    }

    // PRUEBA INTEGRACIÓN 3 - Consultar usuarios de la base de datos
    public function testReadUsers()
    {
        $user = new User();
        $users = $user->read_users();
        $this->assertIsArray($users);
        $this->assertGreaterThan(0, count($users));
    }

    // PRUEBA INTEGRACIÓN 4 - Crear y eliminar un rol
    public function testCreateAndDeleteRol()
    {
        $rol = new User();
        $rol->setRolCode(null);
        $rol->setRolName('rol_test');
        $rol->create_rol();

        $roles = new User();
        $roles = $roles->read_roles();
        $found = false;
        $rolCode = null;
        foreach ($roles as $r) {
            if ($r->getRolName() == 'rol_test') {
                $found = true;
                $rolCode = $r->getRolCode();
            }
        }
        $this->assertTrue($found);

        // Eliminar el rol creado
        $delRol = new User();
        $delRol->delete_rol($rolCode);
    }

    // PRUEBA INTEGRACIÓN 5 - Verificar que el usuario admin existe
    public function testAdminUserExists()
    {
        $user = new User();
        $users = $user->read_users();
        $found = false;
        foreach ($users as $u) {
            if ($u->getUserEmail() == 'profealbeiro2020@gmail.com') {
                $found = true;
            }
        }
        $this->assertTrue($found);
    }
}