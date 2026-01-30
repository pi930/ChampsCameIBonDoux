<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProduitVendre;
use App\Models\ProduitCultiver;
use App\Models\Semi;

class HomeController extends Controller
{
    public function index()
    {
        // Produits mis en avant (exemple)
        $produitsVendre = ProduitVendre::take(6)->get();

        // Produits cultivés
        $produitsCultiver = ProduitCultiver::take(6)->get();

        // Semis récents
        $semis = Semi::orderBy('created_at', 'desc')->take(6)->get();

        return view('home.index', compact('produitsVendre', 'produitsCultiver', 'semis'));

    }
}
