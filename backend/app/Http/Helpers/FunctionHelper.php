<?php
namespace App\Http\Helpers;

class FunctionHelper {

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
