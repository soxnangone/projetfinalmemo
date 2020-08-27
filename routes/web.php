<?php

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
});

Route::get('/login', function () {
    $title = "Login";
    return view('login', ['title' => $title]);
});

Route::get('dashboard', function () {
    $title = "Dashboard";
    return view('dashboard', ['title' => $title]);
});

Route::get('dashboard/v2', function () {
    $title = "Dashboard v2";
    return view('dashboard_v2', ['title' => $title]);
});

Route::get('dashboard/v3', function () {
    $title = "Dashboard v3";
    return view('dashboard_v3', ['title' => $title]);
});

// FORM
Route::get('form', function () {
    $title = "Form";
    return view('form.index', ['title' => $title]);
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