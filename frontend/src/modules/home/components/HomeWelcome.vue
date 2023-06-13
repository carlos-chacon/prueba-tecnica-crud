<template>
    <div class="">
        <h3 class="text-center mb-2 text-lg font-semibold text-gray-900">Prueba PHP Laravel</h3>
        <ul class="max-w-md space-y-1 text-gray-900 list-disc list-inside dark:text-gray-400">
            <li>Desarrollar un crud; Consumiendo un ApiRest (cualquiera).</li>
            <li>Crear un servicio web y consumirlo con Js (Vuejs o ReactJs).</li>
        </ul>

        <div class="mb-5 mt-5">
            <h3 class="text-center mb-2 text-lg font-semibold text-gray-900">Funcionalidad del proyecto</h3>
            <ul class="space-y-1 text-gray-900 list-disc list-inside dark:text-gray-400 w-60">
                <li>Creación de api rest de productos y consumo de los servicios desde vue.js</li>
                <li>Modulo o pantalla de producto. (Ver menu superior)</li>
                <li>En el modulo o pantalla de productos esta las opciones para:
                    <ul class="list-disc list-inside pl-10">
                        <li><span class="font-bold">Listar todo los producto: </span> Al ingresar a la pagina mostrar una tabla con los productos registrado</li>
                        <li><span class="font-bold">Crear: </span> Un botón que se redirige a una nueva pantalla donde se muestra el formulario y los campos de registro</li>
                        <li><span class="font-bold">Mostrar y Actualizar: </span> En la tabla de listado de producto, se muestra un botón de color azul que al dar oprimir nos llevara a la pantalla para actualizar los campos.</li>
                        <li><span class="font-bold">Borrar: </span> En el listado de productos se muestra un botón de color rojo que tiene la funcionalidad de borrar el producto, con un evento de confirmación </li>
                    </ul>
                </li>
                <li>La pantalla de productos tiene opción de paginación y un buscador global </li>
                <li>Los datos se guardan en base de datos MySQL</li>
            </ul>
        </div>
    </div>
</template>