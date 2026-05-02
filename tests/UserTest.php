<?php
use PHPUnit\Framework\TestCase;

require_once __DIR__ . '/../models/DataBase.php';
require_once __DIR__ . '/../models/User.php';

class UserTest extends TestCase
{
    // PRUEBA 1 - Verificar que el nombre se asigna correctamente
    public function testSetAndGetUserName()
    {
        $user = new User();
        $user->setUserName('Juan');
        $this->assertEquals('Juan', $user->getUserName());
    }

    // PRUEBA 2 - Verificar que el apellido se asigna correctamente
    public function testSetAndGetUserLastName()
    {
        $user = new User();
        $user->setUserLastName('Perez');
        $this->assertEquals('Perez', $user->getUserLastName());
    }

    // PRUEBA 3 - Verificar que el email se asigna correctamente
    public function testSetAndGetUserEmail()
    {
        $user = new User();
        $user->setUserEmail('juan@correo.com');
        $this->assertEquals('juan@correo.com', $user->getUserEmail());
    }

    // PRUEBA 4 - Verificar que la contraseña se asigna correctamente
    public function testSetAndGetUserPass()
    {
        $user = new User();
        $user->setUserPass('123456');
        $this->assertEquals('123456', $user->getUserPass());
    }

    // PRUEBA 5 - Verificar que el estado se asigna correctamente
    public function testSetAndGetUserState()
    {
        $user = new User();
        $user->setUserState(1);
        $this->assertEquals(1, $user->getUserState());
    }

    // PRUEBA 6 - Verificar que el código de rol se asigna correctamente
    public function testSetAndGetRolCode()
    {
        $user = new User();
        $user->setRolCode('admin');
        $this->assertEquals('admin', $user->getRolCode());
    }

    // PRUEBA 7 - Verificar que el nombre de rol se asigna correctamente
    public function testSetAndGetRolName()
    {
        $user = new User();
        $user->setRolName('Administrador');
        $this->assertEquals('Administrador', $user->getRolName());
    }

    // PRUEBA 8 - Verificar que el ID se asigna correctamente
    public function testSetAndGetUserId()
    {
        $user = new User();
        $user->setUserId('123456789');
        $this->assertEquals('123456789', $user->getUserId());
    }
}