<?php

use App\Http\Controllers\ImpressionController;
use App\Http\Controllers\MariageController;
use App\Models\Localite;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::view('/', 'login');

Route::get('/', function () {
    $title = "Login";
    return view('login', ['title' => $title]);
})->name('accueil');


Route::get('new_login', function () {
    $title = "New_Login";
    return view('new_login', ['title' => $title]);
});


Route::get('dashboard', 'homecontroller@index')->name('dashboard');

Route::get('dashboard/v2', function () {
    $title = "Dashboard v2";
    return view('dashboard_v2', ['title' => $title]);
});

Route::get('dashboard/v3', function () {
    $title = "Dashboard v3";
    return view('dashboard_v3', ['title' => $title]);
});

// FORM
Route::get('declarations/mariage', function () {
    $title = "mariage";
    return view('declarations.mariage', ['title' => $title]);
});
Route::get('formulaire/epoux', function () {
    $title = "epoux";
    return view('formulaire.epoux', ['title' => $title]);
});
Route::get('formulaire/epouse', function () {
    $title = "epouse";
    return view('formulaire.epouse', ['title' => $title]);
});
Route::get('formulaire/officier', function () {
    $title = "officier";
    return view('formulaire.officier', ['title' => $title]);
});
Route::get('formulaire/temoin', function () {
    $title = "temoin";
    return view('formulaire.temoin', ['title' => $title]);
});

Route::get('form/advanced', function () {
    $title = "Form Advanced";
    return view('form.advanced', ['title' => $title]);
});

Route::get('form/buttons', function () {
    $title = "Form Buttons";
    return view('form.buttons', ['title' => $title]);
});

Route::get('form/upload', function () {
    $title = "Form Upload";
    return view('form.upload', ['title' => $title]);
});

Route::get('form/wizard', function () {
    $title = "Form Wizard";
    return view('form.wizard', ['title' => $title]);
});

Route::get('form/validation', function () {
    $title = "Form Validation";
    return view('form.validation', ['title' => $title]);
});

// UI Element
Route::get('element', function () {
    $title = "General Elements";
    return view('elements.general', ['title' => $title]);
});

Route::get('element/media', function () {
    $title = "Media Gallery";
    return view('elements.media', ['title' => $title]);
});

Route::get('element/typography', function () {
    $title = "Typography";
    return view('elements.typography', ['title' => $title]);
});

Route::get('element/icons', function () {
    $title = "Icons";
    return view('elements.icons', ['title' => $title]);
});

Route::get('element/glyphicons', function () {
    $title = "Glyphicons";
    return view('elements.glyphicons', ['title' => $title]);
});

Route::get('element/widgets', function () {
    $title = "Widgets";
    return view('elements.widgets', ['title' => $title]);
});

Route::get('element/invoice', function () {
    $title = "Invoice";
    return view('elements.invoice', ['title' => $title]);
});

Route::get('element/inbox', function () {
    $title = "Inbox";
    return view('elements.inbox', ['title' => $title]);
});

Route::get('element/calendar', function () {
    $title = "Calendar";
    return view('elements.calendar', ['title' => $title]);
});

// Tables
Route::get('tables', function () {
    $title = "Tables";
    return view('tables.index', ['title' => $title]);
});

Route::get('tables/dynamic', function () {
    $title = "Table Dynamic";
    return view('tables.dynamic', ['title' => $title]);
});

// Charts
Route::get('chart', function () {
    $title = "Charts";
    return view('charts.index', ['title' => $title]);
});
Route::get('chart/v2', function () {
    $title = "Charts 2";
    return view('charts.chartjs2', ['title' => $title]);
});
Route::get('chart/moris', function () {
    $title = "Moris";
    return view('charts.moris', ['title' => $title]);
});
Route::get('chart/echarts', function () {
    $title = "e-Chart";
    return view('charts.echart', ['title' => $title]);
});
Route::get('chart/other', function () {
    $title = "Other";
    return view('charts.other', ['title' => $title]);
});

// Additional Page
Route::get('ecommerce', function () {
    $title = "E-Commerce";
    return view('pages.ecommerce', ['title' => $title]);
});
Route::get('project', function () {
    $title = "Project";
    return view('project.index', ['title' => $title]);
});
Route::get('project/detail', function () {
    $title = "Project Detail";
    return view('project.detail', ['title' => $title]);
});
Route::get('profile/contacts', function () {
    $title = "Contacts";
    return view('profile.contacts', ['title' => $title]);
});
Route::get('profile', function () {
    $title = "Profile";
    return view('profile.index', ['title' => $title]);
});

// Extra
Route::get('403', function () {
    $title = "403";
    return view('pages.403', ['title' => $title]);
});
Route::get('404', function () {
    $title = "404";
    return view('pages.404', ['title' => $title]);
});
Route::get('500', function () {
    $title = "500";
    return view('pages.500', ['title' => $title]);
});
Route::get('pages/pricing', function () {
    $title = "Pricing Tables";
    return view('pages.pricing_tables', ['title' => $title]);
});
//utilisateur
Route::post('/register', 'UtilisateurController@store');
Route::post('/login', 'UtilisateurController@connexion');
Route::get('/new_login/{id}', 'UtilisateurController@edite');
Route::post('/update_user', 'UtilisateurController@update_profile');
Route::post('/update_password', 'UtilisateurController@update_password');
Route::post('/logout', 'UtilisateurController@logout')->name('logout');
Route::resource('Listes_Utilisateurs', 'UtilisateurController');

Route::post('/ajout', 'MariageController@ajout');
Route::post('/ajoutEpoux', 'EpouxController@ajout');
Route::post('/ajoutEpouse', 'EpouseController@ajout');
Route::post('/ajoutTemoin', 'TemoinController@ajout');
Route::post('/ajoutOfficier', 'OfficierController@ajout');

Route::get('declarations/Mariage', 'MariageController@index1')->name('mariage_valide');
Route::get('/editnaisse/{id}', 'MariageController@edit');
Route::get('/editMariage/{id}', 'MariageController@editMariage');
Route::resource('validations_mariage', 'MariageController');

Route::get('formulaire/epoux', 'EpouxController@index1')->name('epoux_valide');
Route::get('/editEpoux/{id}', 'EpouxController@editEpoux');
Route::resource('validations_epoux', 'EpouxController');

Route::get('formulaire/epouse', 'EpouseController@index1')->name('epouse_valide');
Route::get('/editEpouse/{id}', 'EpouseController@editEpouse');
Route::resource('validations_epouse', 'EpouseController');

Route::get('formulaire/temoin', 'TemoinController@index1')->name('temoin_valide');
Route::get('/editTemoin/{id}', 'TemoinController@editTemoin');
Route::resource('validations_temoin', 'TemoinController');

Route::get('formulaire/officier', 'OfficierController@index1')->name('officier_valide');
Route::get('/editOfficier/{id}', 'OfficierController@editOfficier');
Route::resource('validations_officier', 'OfficierController');

Route::get('/statu/{id}', 'UtilisateurController@upStat')->name('upda');

Route::resource('impression_extrait_mariage', 'ImpressionController');
Route::get('declarations/volet/{id}', [MariageController::class, 'getPdf']);
Route::get('declarations/volet/{id}', [MariageController::class, 'getPdf']);
Route::get('impressions/{id}', [ImpressionController::class, 'getPdf']);
Route::get('declarations/mariage/{nin_epoux}', [MariageController::class, 'MariageByNin_epoux']);
Route::get('declarations/mariages/{nin_epouse}', [MariageController::class, 'MariageByNin_epouse']);
Route::get('register/{nin}', 'UtilisateurController@ChearchByNin_user');
Route::get('edit/{id}', 'UtilisateurController@edit');


