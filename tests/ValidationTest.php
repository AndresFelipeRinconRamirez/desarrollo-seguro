<?php
use PHPUnit\Framework\TestCase;

require_once __DIR__ . '/../models/Validator.php';

class ValidationTest extends TestCase
{
    // =============================================
    // PARTICIÓN EQUIVALENTE - NOMBRE
    // =============================================

    // CLASE VÁLIDA - nombre correcto con letras
    public function testNombreValido()
    {
        $this->assertTrue(Validator::validateName('Juan'));
    }

    // CLASE INVÁLIDA - nombre con números
    public function testNombreConNumeros()
    {
        $this->assertFalse(Validator::validateName('Juan123'));
    }

    // CLASE INVÁLIDA - nombre con caracteres especiales
    public function testNombreConCaracteresEspeciales()
    {
        $this->assertFalse(Validator::validateName('J@an#'));
    }

    // VALOR LÍMITE - nombre con exactamente 15 caracteres (válido)
    public function testNombreExactamente15Caracteres()
    {
        $this->assertTrue(Validator::validateName('Juancarlosalber'));
    }

    // VALOR LÍMITE - nombre con 16 caracteres (inválido)
    public function testNombreMasDe15Caracteres()
    {
        $this->assertFalse(Validator::validateName('Juancarlosalbero'));
    }

    // CLASE INVÁLIDA - nombre vacío
    public function testNombreVacio()
    {
        $this->assertFalse(Validator::validateName(''));
    }

    // =============================================
    // PARTICIÓN EQUIVALENTE - APELLIDO
    // =============================================

    // CLASE VÁLIDA - apellido correcto
    public function testApellidoValido()
    {
        $this->assertTrue(Validator::validateLastName('Perez'));
    }

    // CLASE INVÁLIDA - apellido con números
    public function testApellidoConNumeros()
    {
        $this->assertFalse(Validator::validateLastName('Perez123'));
    }

    // CLASE INVÁLIDA - apellido con caracteres especiales
    public function testApellidoConCaracteresEspeciales()
    {
        $this->assertFalse(Validator::validateLastName('Per@z#'));
    }

    // VALOR LÍMITE - apellido mayor a 15 caracteres
    public function testApellidoMasDe15Caracteres()
    {
        $this->assertFalse(Validator::validateLastName('Rodriguezgonzalez'));
    }

    // CLASE INVÁLIDA - apellido vacío
    public function testApellidoVacio()
    {
        $this->assertFalse(Validator::validateLastName(''));
    }

    // =============================================
    // PARTICIÓN EQUIVALENTE - EMAIL
    // =============================================

    // CLASE VÁLIDA - email correcto
    public function testEmailValido()
    {
        $this->assertTrue(Validator::validateEmail('juan@correo.com'));
    }

    // CLASE INVÁLIDA - email sin @
    public function testEmailSinArroba()
    {
        $this->assertFalse(Validator::validateEmail('juancorreo.com'));
    }

    // CLASE INVÁLIDA - email sin dominio
    public function testEmailSinDominio()
    {
        $this->assertFalse(Validator::validateEmail('juan@'));
    }

    // CLASE INVÁLIDA - email vacío
    public function testEmailVacio()
    {
        $this->assertFalse(Validator::validateEmail(''));
    }

    // CLASE INVÁLIDA - solo texto sin formato
    public function testEmailSoloTexto()
    {
        $this->assertFalse(Validator::validateEmail('juancorreo'));
    }

    // =============================================
    // PARTICIÓN EQUIVALENTE - CONTRASEÑA
    // =============================================

    // CLASE VÁLIDA - contraseña correcta
    public function testPasswordValida()
    {
        $this->assertTrue(Validator::validatePassword('12345'));
    }

    // CLASE INVÁLIDA - contraseña muy corta
    public function testPasswordMuyCorta()
    {
        $this->assertFalse(Validator::validatePassword('123'));
    }

    // CLASE INVÁLIDA - contraseña vacía
    public function testPasswordVacia()
    {
        $this->assertFalse(Validator::validatePassword(''));
    }

    // =============================================
    // PARTICIÓN EQUIVALENTE - ID USUARIO
    // =============================================

    // CLASE VÁLIDA - ID numérico positivo
    public function testUserIdValido()
    {
        $this->assertTrue(Validator::validateUserId('1234567890'));
    }

    // CLASE INVÁLIDA - ID con letras
    public function testUserIdConLetras()
    {
        $this->assertFalse(Validator::validateUserId('ABC123'));
    }

    // CLASE INVÁLIDA - ID negativo
    public function testUserIdNegativo()
    {
        $this->assertFalse(Validator::validateUserId('-123'));
    }

    // CLASE INVÁLIDA - ID vacío
    public function testUserIdVacio()
    {
        $this->assertFalse(Validator::validateUserId(''));
    }

    // =============================================
    // PARTICIÓN EQUIVALENTE - ESTADO USUARIO
    // =============================================

    // CLASE VÁLIDA - estado activo (1)
    public function testEstadoActivo()
    {
        $this->assertTrue(Validator::validateUserState(1));
    }

    // CLASE VÁLIDA - estado inactivo (0)
    public function testEstadoInactivo()
    {
        $this->assertTrue(Validator::validateUserState(0));
    }

    // CLASE INVÁLIDA - estado con valor no permitido
    public function testEstadoInvalido()
    {
        $this->assertFalse(Validator::validateUserState(5));
    }

    // =============================================
    // SEGURIDAD - INYECCIÓN SQL
    // =============================================

    // CLASE INVÁLIDA - intento de inyección SQL
    public function testInyeccionSQL()
    {
        $this->assertFalse(Validator::validateNoSQLInjection("' OR '1'='1"));
    }

    // CLASE INVÁLIDA - DROP TABLE
    public function testInyeccionSQLDrop()
    {
        $this->assertFalse(Validator::validateNoSQLInjection('DROP TABLE USERS'));
    }

    // CLASE VÁLIDA - texto normal sin inyección
    public function testTextoNormalSinInyeccion()
    {
        $this->assertTrue(Validator::validateNoSQLInjection('Juan Perez'));
    }

    // =============================================
    // SEGURIDAD - XSS
    // =============================================

    // CLASE INVÁLIDA - intento de XSS con script
    public function testXSSConScript()
    {
        $this->assertFalse(Validator::validateNoXSS('<script>alert("xss")</script>'));
    }

    // CLASE INVÁLIDA - intento de XSS con etiqueta img
    public function testXSSConImg()
    {
        $this->assertFalse(Validator::validateNoXSS('<img src="x" onerror="alert(1)">'));
    }

    // CLASE VÁLIDA - texto normal sin XSS
    public function testTextoNormalSinXSS()
    {
        $this->assertTrue(Validator::validateNoXSS('Juan Perez'));
    }
}