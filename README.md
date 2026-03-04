# Se utilizo PHPUnit 11.5 para hacer los test, instalar antes de utilizar -> composer install seguido de .vendor\bin\phpunit --testdox para iniciar el testing



# Patrones utilizados en el proyecto

## Patron MVC:
Se utilizo este patron para la estructura de carpetas y el como se comunican las 3 capas.
Model: Se comunica con la base de datos y usa los procedimientos almacenados
Controller: Recibe la accion del usuario, llama al modelo para aplicar la accion(funcion) requerida y decide que vista cargar o a donde redirigir
View: Se muestran los html al usuario ya sea la tabla de los productos o los form de Agregar o editar

## Singleton:
Este se utilizo en la conexion para la base de datos en la carpeta Model en el archivo database.php en el se encuentra la clase DatabaseConnection. Garantiza una única instancia de la conexión a la base de datos.

## Front Controller:
Se utiliza como punto de entrada unico para toda la aplicacion. Todas las peticiones pasan por este archivo y haciendo uso de un switch junto a la variable action despacha al metodo correspondiente del controlador
