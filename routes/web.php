<?php

use App\Http\Controllers\SectionImageController;
use App\Http\Controllers\SettingController;
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
Route::resource('media', \App\Http\Controllers\MediaController::class);
Route::get('/settings', [SettingController::class, 'edit'])->name('settings.edit');
Route::post('/settings', [SettingController::class, 'update'])->name('settings.update');
Route::post('/upload-chunk', [SettingController::class, 'upload'])->name('upload.chunk');
Route::post('/settings/delete-media', [SettingController::class, 'deleteMedia'])->name('settings.deleteMedia');
Route::get('/project_sections/{section}/images', [\App\Http\Controllers\ProjectSectionController::class, 'images'])->name('project_sections.images');
Route::get('/section_images/create', [SectionImageController::class, 'create'])->name('section_images.create');
