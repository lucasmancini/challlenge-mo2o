# Ejercicio de entrevista técnica para o2o

### Postulante: Lucas Mancini

## Requerimientos

Se deben crear 2 servicios utilizando Symfony 4:
* uno que permita buscar en base una cadena de búsqueda. El campo para filtrar será **food** y los datos a mostrar devolver serían: id, nombre y descripción.
* uno que retorne los datos necesarios para pintar una vista de detalle que indique los anteriores, pero además incluya: imagen, slogan (tagline) y cuando fue fabricada (first_brewed).

Para obtener los datos de las recetas se utilizará la API de [PunkApi].

Los servicios creados deben ser RESTful y tener como formato de salida JSON.
Elige los nombres para los endpoints, propiedades, etc que te parezcan más adecuados y fáciles de tratar para las aplicaciones.

La solución del ejercicio debe ser enviada en un repositorio de GitHub, GitLab o Bitbucket con el historial completo de git.

## Resolucion

### Setup:

1 - Crear un directorio y luego acceder a el mediante linea de comandos.

2 - Se debera clonar el proyecto mediante el comando de git .

    $ git clone https://github.com/lucasmancini/challlenge-mo2o.git

3 - Una vez clonado el repositorio en local, se deberae acceder al directorio donde se clono el proyecto 
y jecutar el siguiente comando.

    $ make init

Cabe aclarar que para realizar este paso se debe tener instalado Docker en la maquina,
como asi tambien el ejecutable del comando "make"

4 - Para probar los servicios se debera ingresar a las siguientes url's desde un explorador o desde un programa para
hacer llamadas a apis como Postman.

    Url base : http://localhost

    Endpoints:
        
    GET /api/v1/search/food/{param}
    
    GET /api/v1/search/food/{param}/details

    Donde {param} es el valor a enviar como filtro para la llamada a dichos endpoints, 
    por ejemplo "fish", "honey" etc..