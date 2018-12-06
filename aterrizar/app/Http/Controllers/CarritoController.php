<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CarritoController extends Controller
{
    public function search()
    {
      $transaction = new Transaction;
      $transaction = (array)$transaction->where('status','en Carrito');
      
    }
}
