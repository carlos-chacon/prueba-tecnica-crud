<?php
namespace App\Http\Helpers;

class FunctionHelper {

    /**
     *
        id: Identificador único del producto.
        name: Nombre del producto.
        description: Descripción detallada del producto.
        price: Precio del producto.
        quantity: Cantidad disponible en inventario.
        image: URL o ruta de la imagen del producto.
        category_id: ID de la categoría a la que pertenece el producto.
        brand: Marca del producto.
        sku: Código SKU del producto.
        weight: Peso del producto.
        dimensions: Dimensiones del producto.
        featured: Indicador de si el producto está destacado o no.
        on_sale: Indicador de si el producto está en oferta o no.
        created_at: Fecha de creación del producto.
        updated_at: Fecha de última actualización del producto.
     *
     * @return void
     */
    public static function requestValidationProduct(){
        return [
            "name" => "required|max:120",
            "description" => "required",
            "price" => "required|numeric",
            "quantity" => "required|integer",
            "image" => "nullable|url|max:500",
            "category" => "required|max:120",
            "brand" => "required|max:120",
            "sku" => "nullable|max:500",
            "weight" => "nullable|max:100",
            "dimensions" => "required|max:100",
            "featured" => "nullable|boolean",
            "on_sale" => "nullable|boolean",
        ];
    }

}
