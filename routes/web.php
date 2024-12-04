<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\App;
use Inertia\Inertia;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Route;

if (app()->isProduction()) {
    URL::forceScheme('https');
}

// Route Locale
Route::post('lang/{locale}', function ($locale) {
    session()->put('locale', $locale);
    if (in_array($locale, ['en', 'ar', 'ckb']))
        App::setLocale($locale);
})->name('lang');

// Dashboard routes
Route::middleware('auth')->group(function () {

    // dashboard route
    Route::get('/', function () {
        return Inertia::render('Dashboard');
    })->name('dashboard');

    // apps routes
    Route::prefix('apps')->group(function () {

        // mailbox route
        Route::get('/mailbox', function () {
            return Inertia::render('Apps/Mailbox');
        })->name('mailbox');

        // chat route
        Route::get('/chat', function () {
            return Inertia::render('Apps/Chat');
        })->name('chat');

        // todolist route
        Route::get('/todolist', function () {
            return Inertia::render('Apps/Todolist');
        })->name('todolist');

        // calendar route
        Route::get('/calendar', function () {
            return Inertia::render('Apps/Calendar');
        })->name('calendar');

        // invoice routes
        Route::prefix('invoice')->group(function () {

            Route::get('/add', function () {
                return Inertia::render('Apps/Invoice/Add');
            })->name('add');

            Route::get('/edit', function () {
                return Inertia::render('Apps/Invoice/Edit');
            })->name('edit');

            Route::get('/list', function () {
                return Inertia::render('Apps/Invoice/List');
            })->name('list');

            Route::get('/preview', function () {
                return Inertia::render('Apps/Invoice/Preview');
            })->name('preview');
        });
    });

    // components routes
    Route::prefix('components')->group(function () {

        Route::get('/accordions', function () {
            return Inertia::render('Components/Accordions');
        })->name('accordions');

        Route::get('/cards', function () {
            return Inertia::render('Components/Cards');
        })->name('cards');

        Route::get('/carousel', function () {
            return Inertia::render('Components/Carousel');
        })->name('carousel');

        Route::get('/countdown', function () {
            return Inertia::render('Components/Countdown');
        })->name('countdown');

        Route::get('/counter', function () {
            return Inertia::render('Components/Counter');
        })->name('counter');

        Route::get('/lightbox', function () {
            return Inertia::render('Components/Lightbox');
        })->name('lightbox');

        Route::get('/listgroup', function () {
            return Inertia::render('Components/ListGroup');
        })->name('listgroup');

        Route::get('/mediaobject', function () {
            return Inertia::render('Components/MediaObject');
        })->name('mediaobject');

        Route::get('/modals', function () {
            return Inertia::render('Components/Modals');
        })->name('modals');

        Route::get('/notifications', function () {
            return Inertia::render('Components/Notifications');
        })->name('notifications');

        Route::get('/pricingtable', function () {
            return Inertia::render('Components/PricingTable');
        })->name('pricingtable');

        Route::get('/sweetalert', function () {
            return Inertia::render('Components/Sweetalert');
        })->name('sweetalert');

        Route::get('/tabs', function () {
            return Inertia::render('Components/Tabs');
        })->name('tabs');

        Route::get('/timeline', function () {
            return Inertia::render('Components/Timeline');
        })->name('timeline');
    });

    // Element routes
    Route::prefix('elements')->group(function () {

        Route::get('/alerts', function () {
            return Inertia::render('Elements/Alerts');
        })->name('alerts');

        Route::get('/avatar', function () {
            return Inertia::render('Elements/Avatar');
        })->name('avatar');

        Route::get('/badges', function () {
            return Inertia::render('Elements/Badges');
        })->name('badges');

        Route::get('/breadcrumbs', function () {
            return Inertia::render('Elements/Breadcrumbs');
        })->name('breadcrumbs');

        Route::get('/buttons', function () {
            return Inertia::render('Elements/Buttons');
        })->name('buttons');

        Route::get('/button-group', function () {
            return Inertia::render('Elements/ButtonsGroup');
        })->name('button-group');

        Route::get('/color-library', function () {
            return Inertia::render('Elements/ColorLibrary');
        })->name('color-library');

        Route::get('/dropdown', function () {
            return Inertia::render('Elements/Dropdown');
        })->name('dropdown');

        Route::get('/infobox', function () {
            return Inertia::render('Elements/Infobox');
        })->name('infobox');

        Route::get('/jumbotron', function () {
            return Inertia::render('Elements/Jumbotron');
        })->name('jumbotron');

        Route::get('/loader', function () {
            return Inertia::render('Elements/Loader');
        })->name('loader');

        Route::get('/pagination', function () {
            return Inertia::render('Elements/Pagination');
        })->name('pagination');

        Route::get('/popovers', function () {
            return Inertia::render('Elements/Popovers');
        })->name('popovers');

        Route::get('/progressbar', function () {
            return Inertia::render('Elements/ProgressBar');
        })->name('progressbar');

        Route::get('/search', function () {
            return Inertia::render('Elements/Search');
        })->name('search');

        Route::get('/tooltips', function () {
            return Inertia::render('Elements/Tooltips');
        })->name('tooltips');

        Route::get('/treeview', function () {
            return Inertia::render('Elements/Treeview');
        })->name('treeview');

        Route::get('/typography', function () {
            return Inertia::render('Elements/Typography');
        })->name('typography');
    });

    // charts route
    Route::get('/charts', function () {
        return Inertia::render('Charts');
    })->name('charts');

    // widgets route
    Route::get('/widgets', function () {
        return Inertia::render('Widgets');
    })->name('widgets');

    // font icons route
    Route::get('/font-icons', function () {
        return Inertia::render('FontIcons');
    })->name('font-icons');

    // drag and drop route
    Route::get('/dragndrop', function () {
        return Inertia::render('Dragndrop');
    })->name('dragndrop');

    // tables route
    Route::get('/tables', function () {
        return Inertia::render('Tables');
    })->name('tables');

    // datatables routes
    Route::prefix('datatables')->group(function () {

        Route::get('/custom', function () {
            return Inertia::render('Datatables/Custom');
        })->name('custom');

        Route::get('/basic', function () {
            return Inertia::render('Datatables/Basic');
        })->name('datatable.basic');

        Route::get('/advanced', function () {
            return Inertia::render('Datatables/Advanced');
        })->name('advanced');

        Route::get('/skin', function () {
            return Inertia::render('Datatables/Skin');
        })->name('skin');

        Route::get('/order-sorting', function () {
            return Inertia::render('Datatables/OrderSorting');
        })->name('order-sorting');

        Route::get('/columns-filter', function () {
            return Inertia::render('Datatables/ColumnsFilter');
        })->name('columns-filter');

        Route::get('/multi-column', function () {
            return Inertia::render('Datatables/MultiColumn');
        })->name('multi-column');

        Route::get('/multiple-tables', function () {
            return Inertia::render('Datatables/MultipleTables');
        })->name('multiple-tables');

        Route::get('/alt-pagination', function () {
            return Inertia::render('Datatables/AltPagination');
        })->name('alt-pagination');

        Route::get('/checkbox', function () {
            return Inertia::render('Datatables/Checkbox');
        })->name('checkbox');

        Route::get('/range-search', function () {
            return Inertia::render('Datatables/RangeSearch');
        })->name('range-search');

        Route::get('/export', function () {
            return Inertia::render('Datatables/Export');
        })->name('export');

        Route::get('/sticky-header', function () {
            return Inertia::render('Datatables/StickyHeader');
        })->name('sticky-header');

        Route::get('/clone-header', function () {
            return Inertia::render('Datatables/CloneHeader');
        })->name('clone-header');

        Route::get('/column-chooser', function () {
            return Inertia::render('Datatables/ColumnChooser');
        })->name('column-chooser');
    });

    // form routes
    Route::prefix('form')->group(function () {

        // form basic route
        Route::get('/basic', function () {
            return Inertia::render('Form/Basic');
        })->name('form.basic');

        // form input_group route
        Route::get('/input_group', function () {
            return Inertia::render('Form/InputGroup');
        })->name('input_group');

        // form layouts route
        Route::get('/layouts', function () {
            return Inertia::render('Form/Layouts');
        })->name('layouts');

        // form validation route
        Route::get('/validation', function () {
            return Inertia::render('Form/Validation');
        })->name('validation');

        // form input_mask route
        Route::get('/input_mask', function () {
            return Inertia::render('Form/InputMask');
        })->name('input_mask');

        // form select route
        Route::get('/select', function () {
            return Inertia::render('Form/Select');
        })->name('select');

        // form touchspinroute
        Route::get('/touchspin', function () {
            return Inertia::render('Form/Touchspin');
        })->name('touchspin');

        // form checkbox-radio route
        Route::get('/checkbox-radio', function () {
            return Inertia::render('Form/CheckboxRadio');
        })->name('checkbox-radio');

        // form switches route
        Route::get('/switches', function () {
            return Inertia::render('Form/Switches');
        })->name('switches');

        // form file_upload route
        Route::get('/file_upload', function () {
            return Inertia::render('Form/FileUpload');
        })->name('file_upload');

        // form quill_editor route
        Route::get('/quill_editor', function () {
            return Inertia::render('Form/QuillEditor');
        })->name('quill_editor');

        // form markdown_editor route
        Route::get('/markdown_editor', function () {
            return Inertia::render('Form/MarkdownEditor');
        })->name('markdown_editor');

        // form daterange_picker route
        Route::get('/daterange_picker', function () {
            return Inertia::render('Form/DatePicker');
        })->name('daterange_picker');

        // form clipboard route
        Route::get('/clipboard', function () {
            return Inertia::render('Form/Clipboard');
        })->name('clipboard');

        // custom input route
        Route::get('/custom-input', function () {
            return Inertia::render('Form/Custom');
        })->name('custom-input');
    });

    // users routes
    Route::prefix('users')->group(function () {

        // account-settings route
        Route::get('/account-settings', function () {
            return Inertia::render('Users/AccountSettings');
        })->name('account-settings');

        // profile route
        Route::get('/profile', function () {
            return Inertia::render('Users/Profile');
        })->name('profile');
    });

    // pages routes
    Route::prefix('pages')->group(function () {

        // comming soon route
        Route::get('/coming-soon', function () {
            return Inertia::render('Pages/ComingSoon');
        })->name('coming-soon');

        // contact route
        Route::get('/contact', function () {
            return Inertia::render('Pages/Contact');
        })->name('contact');

        // error 404 route
        Route::get('/error/404', function () {
            return Inertia::render('Pages/Error404');
        })->name('error-404');

        // error 500 route
        Route::get('/error/500', function () {
            return Inertia::render('Pages/Error500');
        })->name('error-500');

        // error 503 route
        Route::get('/error/503', function () {
            return Inertia::render('Pages/Error503');
        })->name('error-503');

        // faq route
        Route::get('/faq', function () {
            return Inertia::render('Pages/Faq');
        })->name('faq');

        // knowledgebase route
        Route::get('/knowledgebase', function () {
            return Inertia::render('Pages/KnowledgeBase');
        })->name('knowledgebase');

        // maintenence route
        Route::get('/maintenence', function () {
            return Inertia::render('Pages/Maintenence');
        })->name('maintenence');
    });

    // logout route
    Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
});

// Auth routes
Route::middleware('guest')->group(function () {

    Route::get('/login', [AuthController::class, 'index'])->name('login');
    Route::post('/login', [AuthController::class, 'checkLogin'])->name('login');

    // Route::get('/register', function () {
    //     return Inertia::render('Auth/Register');
    // })->name('register');
});
