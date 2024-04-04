## Integrantes:
- Juan David Avendaño
- Valentina Salazar

## Base de datos
![WhatsApp Image 2024-04-03 at 22 09 41_11efab6c](https://github.com/JuandAvendanog/microservice/assets/141972525/919c4e70-b0ba-4d3e-b30e-01b50d176af3)

## Tecnologías:
- php
- laravel
- mysql
  
### Recetas:
* Rice with meat:
2  rice
1  meat
2  cheese
2  onion
1  potato

* Rice with chicken:

2 rice
1 chicken
1 cheese
1 ketchup

* Cheese with onion:

2 chicken
2 cheese
1 lettuce
2 potato

* Meat with cheese:

2 meet
3 cheese
1 potato
1 rice

* Rice fried:

3 rice
2 potato
1 onion
2 lemon

* Boom:

2 tomato
3 lemon
1 potato
2 rice
1 ketchup
1 lettuce
2 onion
3 cheese
1 meat
1 chicken

## Funcionamiento:
* se debe tener un servidor de aplicaciones swamp o xamp, otros.
* se debe correr apache y mysql
* Se debe ingresar al servicio de *Management_service*
* se deben ejecutar las migraciones "php artisan migrate"
* una vez hechas la migraciones se debe ejecutar el comando "php artisan queue:work"
* ya que se tienen estas configuraciones echas, se debe ingresar al navegador entrar a localhost con la ruta del proyecto
* Ej: http://localhost/Microservice_arq/Management_service/public/place-order
* una vez en la ventana, cada vez que se recargue o se haga un peticion esta creara una receta aleatoria la cual se ira acumulando en el callstack de laravel
* no tiene interfaz grafica
* *notas* si se desea probar los servicios de manera independiente las rutas son las siguientes:
* warehouse_service: http://localhost/Microservice_arq/Warehouse_service/public/prueba/{ingrediente}  
* kitchen_service: http://localhost/Microservice_arq/Kitchen_service/public/prueba/boom retorna 1 si fue exitoso y 0 si no fue exitoso
