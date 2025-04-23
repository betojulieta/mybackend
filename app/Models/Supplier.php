<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\SoftDeletes;

class Supplier extends Model
{
    use SoftDeletes;
    protected $dates = ['deleted_at'];
    /*
    protected $fillable=[
        'fecha',
        'cliente',
        'producto',
        'debe',
        'abono',
        'costo',
        'costoProveedor',
        'proveedorCarne',
        'costoCarne',
        'proveedorQueso',
        'costoQueso',
        ];*/
        protected $guarded=[];  
    
                      //campo cliente
    protected function proveedorCarne () :Attribute {
            return Attribute::make(
                            //metodo mutador, por que altera texto del formulario, que se almacenara en la BBDD.
                            set:function ($value) {
                                return strtolower($value) ;
                            },
                           //metodo accesor, este no altera el valor de la BBDD, sin enbargo si altera el texto que se vera en la pagina web.
                           get:function ($value) {
                                  return strtolower($value);
                                  // return strtoupper($value);
                           }
       );
    }

             //campo producto
             protected function proveedorQueso () :Attribute {
                return Attribute::make(
                    //metodo mutador, por que altera texto del formulario, que se almacenara en la BBDD.
                    set:function ($value) {
                        return strtolower($value) ;
                    },
                   //metodo accesor, este no altera el valor de la BBDD, sin enbargo si altera el texto que se vera en la pagina web.
                   get:function ($value) {
                      return strtolower($value);
                      //return strtoupper($value);
                   }
                );
             }
            // Conversión de tipos
            protected $casts = [
                #'debe' => 'float',
                #'abono' => 'float',
                #'costo' => 'float',
                #"costoProveedor"=>"float",
                "costoCarne"=>"float",
                "costoQueso"=>"float"
              ];  
}
