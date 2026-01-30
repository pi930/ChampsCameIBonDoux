<?php

use Illuminate\Support\Facades\Route;

// Contrôleurs publics
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\LogoutController;
use App\Http\Controllers\ContactController;

// Contrôleurs utilisateur
use App\Http\Controllers\UserController;
use App\Http\Controllers\CommandeController;
use App\Http\Controllers\PanierController;
use App\Http\Controllers\RendezVousController;
use App\Http\Controllers\ProfileController;

// Contrôleurs admin
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\MessageController;
use App\Http\Controllers\Admin\ProduitCultiverController;
use App\Http\Controllers\Admin\SemisController;
use App\Http\Controllers\Admin\ProduitVendreController;
use App\Http\Controllers\Admin\AdminRendezVousController;
use App\Http\Controllers\PaiementController;

// Page d’accueil
Route::get('/', [HomeController::class, 'index'])->name('home');


// Page contact
Route::get('/contact', [ContactController::class, 'index'])->name('contact');
Route::post('/contact', [ContactController::class, 'send'])->name('contact.send');

// Routes utilisateur (auth obligatoire)
Route::middleware(['auth'])->group(function () {

    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit'); Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update'); Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Compte utilisateur
    Route::get('/compte', [UserController::class, 'index'])->name('compte');

    // Commandes utilisateur
    Route::get('/mes-commandes', [CommandeController::class, 'index'])->name('commandes.index');

    // Gestion paiement
      Route::get('/paiement', [PaiementController::class, 'index']) ->name('paiement');
        Route::post('/paiement', [PaiementController::class, 'process'])
    ->name('paiement.process');
    // Panier
   
    Route::post('/rendez-vous', [RendezVousController::class, 'choisir'])
    ->name('rendezvous.choisir');

    // Récapitulatif panier
    Route::get('/panier/construire', [PanierController::class, 'construire']) ->name('panier.construire');
    Route::post('/panier', [PanierController::class, 'store'])
    ->name('panier.store');
    Route::get('/panier', [PanierController::class, 'recap'])->name('panier.recap');

    // Validation commande
    Route::post('/commande/valider', [CommandeController::class, 'valider'])->name('commande.valider');

    // Paiement Stripe
    Route::get('/paiement', [CommandeController::class, 'paiement'])->name('paiement');
    Route::post('/paiement/stripe', [CommandeController::class, 'stripe'])->name('paiement.stripe');
    Route::get('/paiement/success', [CommandeController::class, 'success'])->name('paiement.success'); 
    Route::get('/paiement/cancel', [CommandeController::class, 'cancel'])->name('paiement.cancel');

    // Rendez-vous utilisateur
    Route::get('/rendezvous', [RendezVousController::class, 'index']) ->name('rendezvous.index');
});
// Routes admin
Route::middleware(['auth', 'is_admin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {

        // Dashboard
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

        // Messages utilisateurs
        Route::get('/messages', [MessageController::class, 'index'])->name('messages.index');
        Route::get('/messages/{id}', [MessageController::class, 'show'])->name('messages.show');
        Route::post('/messages/{id}/repondre', [MessageController::class, 'reply'])->name('messages.reply');

        // Produits à cultiver
        Route::get('/produits-cultiver', [ProduitCultiverController::class, 'index'])->name('produits.cultiver');
       // Route::post('/produits-cultiver', [ProduitCultiverController::class, 'store'])->name('produits.cultiver.store');

        // Semis
        Route::get('/semis', [SemisController::class, 'index'])->name('semis.index');
        Route::post('/semis', [SemisController::class, 'store'])->name('semis.store');

       // Produits à vendre
Route::get('/produits-vendre', [ProduitVendreController::class, 'index'])
    ->name('produits-vendre');

Route::post('/produits-vendre', [ProduitVendreController::class, 'store'])
    ->name('produits-vendre.store');

       

        // Gestion des rendez-vous
        Route::get('/rendez-vous', [AdminRendezVousController::class, 'index'])->name('rendezvous.index');
        Route::post('/rendez-vous', [AdminRendezVousController::class, 'store'])->name('rendezvous.store');

        // Récapitulatif commandes
        Route::get('/commandes', [DashboardController::class, 'commandes'])->name('commandes');
    });


require __DIR__.'/auth.php';
