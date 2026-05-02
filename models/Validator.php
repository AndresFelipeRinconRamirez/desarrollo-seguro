<?php
class Validator {

    // Valida que el nombre solo tenga letras y máximo 15 caracteres
    public static function validateName($name) {
        if (empty($name)) return false;
        if (strlen($name) > 15) return false;
        if (!preg_match('/^[a-zA-ZáéíóúÁÉÍÓÚñÑ ]+$/', $name)) return false;
        return true;
    }

    // Valida que el apellido solo tenga letras y máximo 15 caracteres
    public static function validateLastName($lastname) {
        if (empty($lastname)) return false;
        if (strlen($lastname) > 15) return false;
        if (!preg_match('/^[a-zA-ZáéíóúÁÉÍÓÚñÑ ]+$/', $lastname)) return false;
        return true;
    }

    // Valida formato de email
    public static function validateEmail($email) {
        if (empty($email)) return false;
        return filter_var($email, FILTER_VALIDATE_EMAIL) !== false;
    }

    // Valida que la contraseña tenga mínimo 5 caracteres
    public static function validatePassword($password) {
        if (empty($password)) return false;
        if (strlen($password) < 5) return false;
        return true;
    }

    // Valida que el ID sea numérico y positivo
    public static function validateUserId($id) {
        if (empty($id)) return false;
        if (!is_numeric($id)) return false;
        if ($id <= 0) return false;
        return true;
    }

    // Valida que el estado sea 0 o 1
    public static function validateUserState($state) {
        return $state === 0 || $state === 1;
    }

    // Detecta posible inyección SQL
    public static function validateNoSQLInjection($value) {
        $sqlPatterns = ["'", "\"", ";", "--", "DROP", "SELECT", "INSERT", "DELETE", "UPDATE"];
        foreach ($sqlPatterns as $pattern) {
            if (stripos($value, $pattern) !== false) return false;
        }
        return true;
    }

    // Detecta posible XSS
    public static function validateNoXSS($value) {
        if (strip_tags($value) !== $value) return false;
        return true;
    }
}
?>