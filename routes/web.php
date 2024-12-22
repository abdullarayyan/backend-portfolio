<?php

use App\Http\Controllers\SkillsSectionController;
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

Route::get('/', function () {
    return view('welcome');  // Ensure you have a welcome.blade.php or adjust as needed
});

// Resource routes
//Route::resource('hero-sections', HeroSectionController::class);
//Route::resource('about-sections', AboutSectionController::class);
//Route::resource('experiences', ExperienceController::class);
//Route::resource('skills', SkillController::class);
//Route::resource('projects', ProjectController::class);

Route::resource('homepages', \App\Http\Controllers\HomepageController::class);
Route::resource('homepage_images', \App\Http\Controllers\HomepageImageController::class);
Route::resource('about', \App\Http\Controllers\AboutController::class);
Route::resource('marquee_items', \App\Http\Controllers\MarqueeItemController::class);
Route::resource('experiences', \App\Http\Controllers\ExperienceController::class);
Route::resource('skills', \App\Http\Controllers\SkillController::class);
Route::resource('projects', \App\Http\Controllers\ProjectController::class);
Route::resource('project_sections', \App\Http\Controllers\ProjectSectionController::class);
Route::resource('section_images', \App\Http\Controllers\SectionImageController::class);
//Route::resource('section_images', 'SectionImageController');
Route::resource('skills_sections', SkillsSectionController::class);
