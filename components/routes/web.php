<?php
use App\Models\Admin\Page;
use App\Models\Admin\PageTranslation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Livewire\Admin\Profile;
use Illuminate\Support\Facades\App;
use App\Http\Controllers\Frontend\SitemapController;
use App\Http\Controllers\Frontend\PagesController;
use App\Http\Controllers\Frontend\BlogController;
use App\Http\Controllers\Frontend\JsonController;
use Illuminate\Support\Facades\Cookie;
use App\Models\Admin\Languages;
use App\Models\Admin\General;

Config::set('livewire.asset_url', url('/') );

try {
	
	$langData = Languages::get(['code'])->toArray();

	if (!empty($langData)) {

		$locales = array();

		foreach ($langData as $value) {
		    array_push( $locales, $value['code'] );
		}

		Config::set('localization.supported-locales', $locales);

		Config::set('translatable.locales', $locales);

		if ( General::first()->automatic_language_detection == true ) {

			Config::set('localization.accept-language-header', true);
			Config::set('localization.hide-default-in-url', false);

		} else {

			$default = Languages::where('default', true)->first()->code;
			Config::set('app.locale', $default);
			Config::set('localization.hide-default-in-url', true);
		}
	}


} catch (\Exception $e) {
	
}

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

//Sitemap
Route::get('/sitemap.xml', [SitemapController::class, 'index']);

//Json
Route::get('/json', [JsonController::class, 'index']);

//Install
Route::group(['middleware' => 'swinstall', 'prefix' => 'install'], function () {

	Route::get('/', function () {
	    return view('frontend.install');
	})->name('sw_install');

	Route::get('/requirements', function () {
	    return view('frontend.install');
	})->name('sw_requirements');

	Route::get('/database', function () {
	    return view('frontend.install');
	})->name('sw_database');

	Route::get('/admin', function () {
	    return view('frontend.install');
	})->name('sw_admin');

	Route::get('/import', function () {
	    return view('frontend.install');
	})->name('sw_import');

	Route::get('/finished', function () {
	    return view('frontend.install');
	})->name('sw_finished');

});

//Cookie
Route::get('/cookies/accept', function(){
    Cookie::queue('cookies', time(), 43200);
});

Route::localizedGroup(function () {

	//Home
	Route::get('/', [PagesController::class, 'home'])->name('home');

	//Blog
	Route::get('/blog', [BlogController::class, 'index'])->name('blog');

	//Page
	Route::get('/{slug}', [PagesController::class, 'index'])->where('slug', '^((?!logout|temp|admin.*).)*$')->name('page');

	//Download
	Route::post('/download/action', function () {
	    return view('frontend.download');
	})->name('download');

	//Admin Dashboard
	Route::group(['prefix' => 'admin', 'middleware' => 'auth'], function() {

			Route::get('/' , function(){
			      return redirect()->back();
			})->name('admin');

			Route::get('/dashboard', function () {
			    return view('admin.dashboard');
			})->name('dashboard');

			Route::get('/pages', function () {
			    return view('admin.pages');
			})->name('pages');

			Route::get('/pages/{page_id}/translations', function () {
			    return view('admin.pages');
			})->name('page-translations');

			Route::get('/pages/create/{page_id}/translations', function () {
			    return view('admin.pages');
			})->name('create-page-translations');

			Route::get('/pages/edit/translations/{trans_id}', function () {
			    return view('admin.pages');
			})->name('edit-page-translations');

			Route::get('/settings', function () {
			    return view('admin.settings');
			})->name('settings');

			Route::get('/supported-sites', function () {
			    return view('admin.supported-sites');
			})->name('supported-sites');

			Route::get('/report', function () {
			    return view('admin.report');
			})->name('report');

			Route::get('/downloads', function () {
			    return view('admin.downloads');
			})->name('downloads');

			Route::get('/cache', function () {
			    return view('admin.cache');
			})->name('cache');
				
			Route::get('/about', function () {
			    return view('admin.about');
			})->name('about');
			
			Route::group(['prefix' => 'settings'], function () {

				Route::get('/general', function () {
				    return view('admin.general');
				})->name('general');

				Route::get('/menu', function () {
				    return view('admin.menu');
				})->name('menu');

				Route::get('/header', function () {
				    return view('admin.header');
				})->name('header');

				Route::get('/footer', function () {
				    return view('admin.footer');
				})->name('footer');

				Route::get('/footer/create/translations', function () {
				    return view('admin.footer');
				})->name('create-footer-translations');

				Route::get('/footer/edit/translations/{trans_id}', function () {
				    return view('admin.footer');
				})->name('edit-footer-translations');

				Route::get('/api-keys', function () {
				    return view('admin.api-keys');
				})->name('api-keys');

				Route::get('/json', function () {
				    return view('admin.json');
				})->name('json');

				Route::get('/gdpr', function () {
				    return view('admin.gdpr');
				})->name('gdpr');

				Route::get('/advertisement', function () {
				    return view('admin.advertisement');
				})->name('advertisement');

				Route::get('/smtp', function () {
				    return view('admin.smtp');
				})->name('smtp');

				Route::get('/proxy', function () {
				    return view('admin.proxy');
				})->name('proxy');

				Route::get('/translations', function () {
				    return view('admin.translations');
				})->name('translations');

				Route::get('/translations/edit/{lang_id}', function () {
				    return view('admin.translations');
				})->name('edit-translations');

				Route::get('/redirects', function () {
				    return view('admin.redirects');
				})->name('redirects');

				Route::get('/advanced', function () {
				    return view('admin.advanced');
				})->name('advanced');

			});

			Route::group(['prefix' => 'user'], function () {

				Route::get('/profile', function () {
				    return view('admin.profile');
				})->name('profile');

				Route::get('/logout', [Profile::class, 'onLogout'])->name('logout');

			});

	});

});

Route::group(['prefix' => 'filemanager', 'middleware' => ['web', 'auth']], function () {
 \UniSharp\LaravelFilemanager\Lfm::routes();
});