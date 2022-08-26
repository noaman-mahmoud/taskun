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

header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Headers: Cache-Control, 'max-age=100', Content-Type, Accept");
header("Access-Control-Allow-Headers: Cache-Control, max-age=31536000");

Route::group(['prefix' => 'admin', 'namespace' => 'Admin', 'as' => 'admin.'], function () {

    Route::get('/lang/{lang}'          , 'AuthController@SetLanguage');
    Route::get('login'                 , 'AuthController@showLoginForm')->name('show.login');
    Route::post('login'                , 'AuthController@login')->name('login');
    Route::get('logout'                , 'AuthController@logout')->name('logout');
    Route::post('getCities'            , 'CityController@getCities')->name('getCities');

    Route::group(['middleware' => ['admin', 'check-role','admin-lang']], function () {

        /*------------ start Of Dashboard----------*/
            Route::get('dashboard', [
                'uses'      => 'HomeController@dashboard',
                'as'        => 'dashboard',
                'icon'      => '<i class="feather icon-home"></i>',
                'title'     => 'الرئيسيه',
                'type'      => 'parent'
            ]);
        /*------------ end Of dashboard ----------*/

        /*------------ start Of intro site ----------*/
        /***********  Update V2 make website and comment Introductory site   *************/

//            Route::get('intro-site', [
//                'as'        => 'intro_site',
//                'icon'      => '<i class="feather icon-map"></i>',
//                'title'     => 'الموقع التعريفي',
//                'type'      => 'parent',
//                'sub_route' => true,
//                'child'     => [
//                    'intro_settings.index','introsliders.index','introsliders.store', 'introsliders.update', 'introsliders.delete' ,'introsliders.deleteAll','introsliders.create','introsliders.edit',
//                    'introservices.index','introservices.create','introservices.store','introservices.edit', 'introservices.update', 'introservices.delete' ,'introservices.deleteAll',
//                    'introfqscategories.index','introfqscategories.store','introfqscategories.create','introfqscategories.edit', 'introfqscategories.update', 'introfqscategories.delete' ,'introfqscategories.deleteAll' ,
//                    'introfqs.index','introfqs.store', 'introfqs.update', 'introfqs.delete' ,'introfqs.deleteAll','introfqs.edit', 'introfqs.create',
//                    'introparteners.index','introparteners.store', 'introparteners.update', 'introparteners.delete' ,'introparteners.deleteAll' ,
//                    'intromessages.index', 'intromessages.delete' ,'intromessages.deleteAll','intromessages.show',
//                    'introsocials.index','introsocials.store', 'introsocials.update', 'introsocials.delete' ,'introsocials.deleteAll','introsocials.edit','introsocials.create',
//                    'introhowworks.index','introhowworks.store', 'introhowworks.update', 'introhowworks.delete' ,'introhowworks.deleteAll','introhowworks.create','introhowworks.edit',
//                ]
//            ]);


            Route::get('intro-settings', [
                'uses'      => 'IntroSetting@index',
                'as'        => 'intro_settings.index',
                'title'     => 'اعدادات الموقع التعريفي',
                'icon'      => '<i class="feather icon-settings"></i>',
            ]);

            /*------------ start Of introsliders ----------*/
                Route::get('introsliders', [
                    'uses'      => 'IntroSliderController@index',
                    'as'        => 'introsliders.index',
                    'title'     => 'بنرات الاسلايدر',
                    'icon'      => '<i class="feather icon-image"></i>',
                ]);

                 # socials store
                Route::get('introsliders/create', [
                    'uses'  => 'IntroSliderController@create',
                    'as'    => 'introsliders.create',
                    'title' => ' صفحة اضافة بنر'
                ]);


                # introsliders store
                Route::post('introsliders/store', [
                    'uses'  => 'IntroSliderController@store',
                    'as'    => 'introsliders.store',
                    'title' => ' اضافة بنر'
                ]);

                # socials update
                Route::get('introsliders/{id}/edit', [
                    'uses'  => 'IntroSliderController@edit',
                    'as'    => 'introsliders.edit',
                    'title' => 'صفحه تحديث بنر'
                ]);

                # introsliders update
                Route::put('introsliders/{id}', [
                    'uses'  => 'IntroSliderController@update',
                    'as'    => 'introsliders.update',
                    'title' => 'تحديث بنر'
                ]);

                # introsliders delete
                Route::delete('introsliders/{id}', [
                    'uses'  => 'IntroSliderController@destroy',
                    'as'    => 'introsliders.delete',
                    'title' => 'حذف بنر'
                ]);

                #delete all introsliders
                Route::post('delete-all-introsliders', [
                    'uses'  => 'IntroSliderController@destroyAll',
                    'as'    => 'introsliders.deleteAll',
                    'title' => 'حذف مجموعه من بنرات'
                ]);
            /*------------ end Of introsliders ----------*/

            /*------------ start Of introservices ----------*/
                Route::get('introservices', [
                    'uses'      => 'IntroServiceController@index',
                    'as'        => 'introservices.index',
                    'title'     => 'خدماتنا',
                    'icon'      => '<i class="la la-map"></i>',
                ]);

                # socials store
                Route::get('introservices/create', [
                    'uses'  => 'IntroServiceController@create',
                    'as'    => 'introservices.create',
                    'title' => ' صفحة اضافة خدمة'
                ]);
                # introservices store
                Route::post('introservices/store', [
                    'uses'  => 'IntroServiceController@store',
                    'as'    => 'introservices.store',
                    'title' => ' اضافة خدمه'
                ]);

                # socials update
                Route::get('introservices/{id}/edit', [
                    'uses'  => 'IntroServiceController@edit',
                    'as'    => 'introservices.edit',
                    'title' => 'صفحه تحديث خدمة'
                ]);

                # introservices update
                Route::put('introservices/{id}', [
                    'uses'  => 'IntroServiceController@update',
                    'as'    => 'introservices.update',
                    'title' => 'تحديث خدمه'
                ]);

                # introservices delete
                Route::delete('introservices/{id}', [
                    'uses'  => 'IntroServiceController@destroy',
                    'as'    => 'introservices.delete',
                    'title' => 'حذف خدمه'
                ]);

                #delete all introservices
                Route::post('delete-all-introservices', [
                    'uses'  => 'IntroServiceController@destroyAll',
                    'as'    => 'introservices.deleteAll',
                    'title' => 'حذف مجموعه من خدماتنا'
                ]);
            /*------------ end Of introservices ----------*/

            /*------------ start Of introfqscategories ----------*/
                Route::get('introfqscategories', [
                    'uses'      => 'IntroFqsCategoryController@index',
                    'as'        => 'introfqscategories.index',
                    'title'     => 'اقسام الاسئله الشائعة',
                    'icon'      => '<i class="la la-list"></i>',
                ]);
                # socials store
                Route::get('introfqscategories/create', [
                    'uses'  => 'IntroFqsCategoryController@create',
                    'as'    => 'introfqscategories.create',
                    'title' => ' صفحة اضافة قسم'
                ]);
                # introfqscategories store
                Route::post('introfqscategories/store', [
                    'uses'  => 'IntroFqsCategoryController@store',
                    'as'    => 'introfqscategories.store',
                    'title' => ' اضافة قسم'
                ]);
                # introfqscategories update
                Route::get('introfqscategories/{id}/edit', [
                    'uses'  => 'IntroFqsCategoryController@edit',
                    'as'    => 'introfqscategories.edit',
                    'title' => 'صفحه تحديث قسم'
                ]);
                # introfqscategories update
                Route::put('introfqscategories/{id}', [
                    'uses'  => 'IntroFqsCategoryController@update',
                    'as'    => 'introfqscategories.update',
                    'title' => 'تحديث قسم'
                ]);

                # introfqscategories delete
                Route::delete('introfqscategories/{id}', [
                    'uses'  => 'IntroFqsCategoryController@destroy',
                    'as'    => 'introfqscategories.delete',
                    'title' => 'حذف قسم'
                ]);

                #delete all introfqscategories
                Route::post('delete-all-introfqscategories', [
                    'uses'  => 'IntroFqsCategoryController@destroyAll',
                    'as'    => 'introfqscategories.deleteAll',
                    'title' => 'حذف مجموعه من الاقسام '
                ]);
            /*------------ end Of introfqscategories ----------*/

            /*------------ start Of introfqs ----------*/

                 # socials store
                 Route::get('introfqs/create', [
                    'uses'  => 'IntroFqsController@create',
                    'as'    => 'introfqs.create',
                    'title' => ' صفحة اضافة سؤال'
                ]);

                # introfqs store
                Route::post('introfqs/store', [
                    'uses'  => 'IntroFqsController@store',
                    'as'    => 'introfqs.store',
                    'title' => ' اضافة سؤال'
                ]);
                # introfqscategories update
                Route::get('introfqs/{id}/edit', [
                    'uses'  => 'IntroFqsController@edit',
                    'as'    => 'introfqs.edit',
                    'title' => 'صفحه تحديث سؤال'
                ]);

                # introfqs update
                Route::put('introfqs/{id}', [
                    'uses'  => 'IntroFqsController@update',
                    'as'    => 'introfqs.update',
                    'title' => 'تحديث سؤال'
                ]);

                # introfqs delete
                Route::delete('introfqs/{id}', [
                    'uses'  => 'IntroFqsController@destroy',
                    'as'    => 'introfqs.delete',
                    'title' => 'حذف سؤال'
                ]);

                #delete all introfqs
                Route::post('delete-all-introfqs', [
                    'uses'  => 'IntroFqsController@destroyAll',
                    'as'    => 'introfqs.deleteAll',
                    'title' => 'حذف مجموعه من الاسئله الشائعه'
                ]);
            /*------------ end Of introfqs ----------*/

            /*------------ start Of introparteners ----------*/
                Route::get('introparteners', [
                    'uses'      => 'IntroPartenerController@index',
                    'as'        => 'introparteners.index',
                    'title'     => 'شركاء النجاح',
                    'icon'      => '<i class="la la-list"></i>',
                ]);

                # socials store
                Route::get('introparteners/create', [
                    'uses'  => 'IntroPartenerController@create',
                    'as'    => 'introparteners.create',
                    'title' => ' صفحة اضافة شريك'
                ]);

                # introparteners store
                Route::post('introparteners/store', [
                    'uses'  => 'IntroPartenerController@store',
                    'as'    => 'introparteners.store',
                    'title' => ' اضافة شريك'
                ]);

                # introparteners update
                Route::get('introparteners/{id}/edit', [
                    'uses'  => 'IntroPartenerController@edit',
                    'as'    => 'introparteners.edit',
                    'title' => 'صفحه تحديث شريك'
                ]);

                # introparteners update
                Route::put('introparteners/{id}', [
                    'uses'  => 'IntroPartenerController@update',
                    'as'    => 'introparteners.update',
                    'title' => 'تحديث شريك'
                ]);

                # introparteners delete
                Route::delete('introparteners/{id}', [
                    'uses'  => 'IntroPartenerController@destroy',
                    'as'    => 'introparteners.delete',
                    'title' => 'حذف شريك'
                ]);

                #delete all introparteners
                Route::post('delete-all-introparteners', [
                    'uses'  => 'IntroPartenerController@destroyAll',
                    'as'    => 'introparteners.deleteAll',
                    'title' => 'حذف مجموعه من شركاء النجاح'
                ]);
            /*------------ end Of introparteners ----------*/

            /*------------ start Of intromessages ----------*/
                Route::get('intromessages', [
                    'uses'      => 'IntroMessagesController@index',
                    'as'        => 'intromessages.index',
                    'title'     => 'رسائل العملاء',
                    'icon'      => '<i class="la la-envelope-square"></i>',
                ]);

                # socials update
                Route::get('intromessages/{id}', [
                    'uses'  => 'IntroMessagesController@show',
                    'as'    => 'intromessages.show',
                    'title' => 'صفحه عرض الرسالة'
                ]);

                # intromessages delete
                Route::delete('intromessages/{id}', [
                    'uses'  => 'IntroMessagesController@destroy',
                    'as'    => 'intromessages.delete',
                    'title' => 'حذف رسالة'
                ]);

                #delete all intromessages
                Route::post('delete-all-intromessages', [
                    'uses'  => 'IntroMessagesController@destroyAll',
                    'as'    => 'intromessages.deleteAll',
                    'title' => 'حذف مجموعه من رسائل العملاء'
                ]);
            /*------------ end Of intromessages ----------*/

            /*------------ start Of introsocials ----------*/
                Route::get('introsocials', [
                    'uses'      => 'IntroSocialController@index',
                    'as'        => 'introsocials.index',
                    'title'     => 'وسائل التواصل',
                    'icon'      => '<i class="la la-facebook"></i>',
                ]);


                # introsocials store
                Route::get('introsocials/create', [
                    'uses'  => 'IntroSocialController@create',
                    'as'    => 'introsocials.create',
                    'title' => ' صفحة اضافة وسيلة تواصل'
                ]);

                # introsocials store
                Route::post('introsocials/store', [
                    'uses'  => 'IntroSocialController@store',
                    'as'    => 'introsocials.store',
                    'title' => ' اضافة وسيلة'
                ]);

                # introsocials update
                Route::get('introsocials/{id}/edit', [
                    'uses'  => 'IntroSocialController@edit',
                    'as'    => 'introsocials.edit',
                    'title' => 'صفحه تحديث وسيلة تواصل'
                ]);

                # introsocials update
                Route::put('introsocials/{id}', [
                    'uses'  => 'IntroSocialController@update',
                    'as'    => 'introsocials.update',
                    'title' => 'تحديث وسيلة'
                ]);

                # introsocials delete
                Route::delete('introsocials/{id}', [
                    'uses'  => 'IntroSocialController@destroy',
                    'as'    => 'introsocials.delete',
                    'title' => 'حذف وسيلة'
                ]);

                #delete all introsocials
                Route::post('delete-all-introsocials', [
                    'uses'  => 'IntroSocialController@destroyAll',
                    'as'    => 'introsocials.deleteAll',
                    'title' => 'حذف مجموعه من وسائل التواصل'
                ]);
            /*------------ end Of introsocials ----------*/

            /*------------ start Of introhowworks ----------*/
                Route::get('introhowworks', [
                    'uses'      => 'IntroHowWorkController@index',
                    'as'        => 'introhowworks.index',
                    'title'     => 'كيف نعمل',
                    'icon'      => '<i class="la la-calendar-check-o"></i>',
                ]);

                # introhowworks store
                Route::get('introhowworks/create', [
                    'uses'  => 'IntroHowWorkController@create',
                    'as'    => 'introhowworks.create',
                    'title' => ' صفحة اضافة طريقة عمل'
                ]);


                # introhowworks update
                Route::get('introhowworks/{id}/edit', [
                    'uses'  => 'IntroHowWorkController@edit',
                    'as'    => 'introhowworks.edit',
                    'title' => 'صفحه تحديث  طريقة عمل'
                ]);

                # introhowworks store
                Route::post('introhowworks/store', [
                    'uses'  => 'IntroHowWorkController@store',
                    'as'    => 'introhowworks.store',
                    'title' => ' اضافة خطوه'
                ]);

                # introhowworks update
                Route::put('introhowworks/{id}', [
                    'uses'  => 'IntroHowWorkController@update',
                    'as'    => 'introhowworks.update',
                    'title' => 'تحديث خطوه'
                ]);

                # introhowworks delete
                Route::delete('introhowworks/{id}', [
                    'uses'  => 'IntroHowWorkController@destroy',
                    'as'    => 'introhowworks.delete',
                    'title' => 'حذف خطوه'
                ]);

                #delete all introhowworks
                Route::post('delete-all-introhowworks', [
                    'uses'  => 'IntroHowWorkController@destroyAll',
                    'as'    => 'introhowworks.deleteAll',
                    'title' => 'حذف مجموعه من كيف نعمل'
                ]);
            /*------------ end Of introhowworks ----------*/

        /*------------ end Of intro site ----------*/

        /*------------ start Of users Controller ----------*/
//        'clients.active','clients.notActive', 'clients.notBlocked',
            Route::get('users', [
                'as'        => 'users',
                'icon'      => '<i class="feather icon-users"></i>',
                'title'     => 'الاعضاء',
                'type'      => 'parent',
                'sub_route' => true,
                'child'     => ['clients.index','clients.offices','clients.marketers',
                                'clients.blocked','clients.store','clients.update','clients.delete','clients.notify',
                                'clients.deleteAll','clients.create','clients.edit']
            ]);

            /************ Clients ************/
                #user
                Route::get('clients', [
                    'uses'  => 'ClientController@index',
                    'as'    => 'clients.index',
                    'title' => 'الملاك',
                    'icon'  => '<i class="la la-user"></i>',

                ]);

                #user
                Route::get('offices', [
                    'uses'  => 'ClientController@index',
                    'as'    => 'clients.offices',
                    'title' => 'المكاتب',
                    'icon'  => '<i class="la la-user"></i>',

                ]);

                #user
                Route::get('marketers', [
                    'uses'  => 'ClientController@index',
                    'as'    => 'clients.marketers',
                    'title' => 'المسوقين',
                    'icon'  => '<i class="la la-user"></i>',

                ]);

                #index
                Route::get('clients/active', [
                    'uses'  => 'ClientController@active',
                    'as'    => 'clients.active',
                    'title' => 'المستخدمين النشطين',
                    'icon'  => '<i class="feather icon-user-check"></i>',

                ]);

                #index
                Route::get('clients/not-active', [
                    'uses'  => 'ClientController@notActive',
                    'as'    => 'clients.notActive',
                    'title' => 'المستخدمين الغير نشطين',
                    'icon'  => '<i class="feather icon-user-minus"></i>',

                ]);
                #index
                Route::get('clients/block', [
                    'uses'  => 'ClientController@block',
                    'as'    => 'clients.blocked',
                    'title' => 'المستخدمين المحظورين',
                    'icon'  => '<i class="la la-user"></i>',

                ]);
                #index
                Route::get('clients/not-block', [
                    'uses'  => 'ClientController@notBlock',
                    'as'    => 'clients.notBlocked',
                    'title' => 'المستخدمين الغير المحظورين',
                    'icon'  => '<i class="la la-user"></i>',

                ]);

                # clients store
                Route::get('clients/create', [
                    'uses'  => 'ClientController@create',
                    'as'    => 'clients.create','clients.edit',
                    'title' => ' صفحة اضافة عميل'
                ]);

                # clients update
                Route::get('clients/{id}/edit', [
                    'uses'  => 'ClientController@edit',
                    'as'    => 'clients.edit',
                    'title' => 'صفحه تحديث عميل'
                ]);
                #store
                Route::post('clients/store', [
                    'uses'  => 'ClientController@store',
                    'as'    => 'clients.store',
                    'title' => 'اضافة عميل'
                ]);

                #update
                Route::put('clients/{id}', [
                    'uses'  => 'ClientController@update',
                    'as'    => 'clients.update',
                    'title' => 'تعديل عميل'
                ]);

                #delete
                Route::delete('clients/{id}', [
                    'uses'  => 'ClientController@destroy',
                    'as'    => 'clients.delete',
                    'title' => 'حذف عميل'
                ]);

                #delete
                Route::post('delete-all-clients', [
                    'uses'  => 'ClientController@destroyAll',
                    'as'    => 'clients.deleteAll',
                    'title' => 'حذف مجموعه من العملاء'
                ]);

                #notify
                Route::post('admins/clients/notify', [
                    'uses'  => 'ClientController@notify',
                    'as'    => 'clients.notify',
                    'title' => 'ارسال اشعار للعملاء'
                ]);
            /************ #Clients ************/
        /*------------ end Of users Controller ----------*/

        /*------------ start Of providers ----------*/


        #perovider
        Route::get('active-providers', [
            'uses'  => 'ProviderController@index',
            'as'    => 'providers.active',
            'title' => 'المقدمين المفعلين',
            'icon'  => '<i class="la la-user"></i>',

        ]);

        #perovider
        Route::get('pending-providers', [
            'uses'  => 'ProviderController@index',
            'as'    => 'providers.pending',
            'title' => 'مقدمين  قيد الموافقة',
            'icon'  => '<i class="la la-user"></i>',
        ]);

        # providers store
        Route::get('providers/create', [
            'uses'  => 'ProviderController@create',
            'as'    => 'providers.create',
            'title' => ' صفحة اضافة المقدم'
        ]);


        # providers store
        Route::post('providers/store', [
            'uses'  => 'ProviderController@store',
            'as'    => 'providers.store',
            'title' => ' اضافة المقدم'
        ]);

        # providers update
        Route::get('providers/{id}/edit', [
            'uses'  => 'ProviderController@edit',
            'as'    => 'providers.edit',
            'title' => 'صفحه تحديث المقدم'
        ]);

        # providers update
        Route::put('providers/{id}', [
            'uses'  => 'ProviderController@update',
            'as'    => 'providers.update',
            'title' => 'تحديث المقدم'
        ]);

        # providers delete
        Route::delete('providers/{id}', [
            'uses'  => 'ProviderController@destroy',
            'as'    => 'providers.delete',
            'title' => 'حذف المقدم'
        ]);

        #notify
        Route::post('admins/providers/notify', [
            'uses'  => 'ProviderController@notify',
            'as'    => 'providers.notify',
            'title' => 'ارسال اشعار للمقدمين'
        ]);

        #delete all providers
        Route::post('delete-all-providers', [
            'uses'  => 'ProviderController@destroyAll',
            'as'    => 'providers.deleteAll',
            'title' => 'حذف مجموعه من المقدمين'
        ]);
        /*------------ end Of providers ----------*/


        /************ Admins ************/
            #index
            Route::get('admins', [
                'uses'  => 'AdminController@index',
                'as'    => 'admins.index',
                'title' => 'المشرفين',
                'icon'  => '<i class="feather icon-users"></i>',
                'type'      => 'parent',
                'child'     => [
                    'admins.index', 'admins.store', 'admins.update','admins.edit', 'admins.delete','admins.deleteAll','admins.create','admins.edit','admins.notifications','admins.notifications.delete',
                    ]
            ]);

            # admins store
            Route::get('show-notifications', [
                'uses'  => 'AdminController@notifications',
                'as'    => 'admins.notifications',
                'title' => 'صفحة الاشعارات'
            ]);

            # admins store
            Route::post('delete-notifications', [
                'uses'  => 'AdminController@deleteNotifications',
                'as'    => 'admins.notifications.delete',
                'title' => 'حذف الاشعارات'
            ]);

            # admins store
            Route::get('admins/create', [
                'uses'  => 'AdminController@create',
                'as'    => 'admins.create',
                'title' => ' صفحة اضافة مشرف'
            ]);

            #store
            Route::post('admins/store', [
                'uses'  => 'AdminController@store',
                'as'    => 'admins.store',
                'title' => 'اضافة مشرف'
            ]);

            # admins update
            Route::get('admins/{id}/edit', [
                'uses'  => 'AdminController@edit',
                'as'    => 'admins.edit',
                'title' => 'صفحه تحديث مشرف'
            ]);
            #update
            Route::put('admins/{id}', [
                'uses'  => 'AdminController@update',
                'as'    => 'admins.update',
                'title' => 'تعديل مشرف'
            ]);

            #delete
            Route::delete('admins/{id}', [
                'uses'  => 'AdminController@destroy',
                'as'    => 'admins.delete',
                'title' => 'حذف مشرف'
            ]);

            #delete
            Route::post('delete-all-admins', [
                'uses'  => 'AdminController@destroyAll',
                'as'    => 'admins.deleteAll',
                'title' => 'حذف مجموعه من المشرفين'
            ]);

        /************ #Admins ************/


        /*------------ start Of banks ----------*/
        Route::get('Bank-accounts', [
            'uses'      => 'BankController@index',
            'as'        => 'banks.index',
            'title'     => 'الحسابات البنكية',
            'icon'      => '<i class="feather icon-file-minus"></i>',
            'type'      => 'parent',
            'sub_route' => false,
            'child'     => ['banks.create', 'banks.store','banks.edit', 'banks.update', 'banks.delete'  ,'banks.deleteAll' ,]
        ]);

        # banks store
        Route::get('banks/create', [
            'uses'  => 'BankController@create',
            'as'    => 'banks.create',
            'title' => ' صفحة اضافة حساب'
        ]);

        # banks store
        Route::post('banks/store', [
            'uses'  => 'BankController@store',
            'as'    => 'banks.store',
            'title' => ' اضافة حساب'
        ]);

        # banks update
        Route::get('banks/{id}/edit', [
            'uses'  => 'BankController@edit',
            'as'    => 'banks.edit',
            'title' => 'صفحه تحديث حساب'
        ]);

        # banks update
        Route::put('banks/{id}', [
            'uses'  => 'BankController@update',
            'as'    => 'banks.update',
            'title' => 'تحديث الحساب'
        ]);

        # banks delete
        Route::delete('banks/{id}', [
            'uses'  => 'BankController@destroy',
            'as'    => 'banks.delete',
            'title' => 'حذف الحساب'
        ]);
        #delete all banks
        Route::post('delete-all-banks', [
            'uses'  => 'BankController@destroyAll',
            'as'    => 'banks.deleteAll',
            'title' => 'حذف مجموعه من الحسابات'
        ]);

        /*------------ end Of banks ----------*/

        /*------------ start Of estates ----------*/
        Route::get('estates', [
            'uses'      => 'EstateController@index',
            'as'        => 'estates.index',
            'title'     => 'العقارات',
            'icon'      => '<i class="feather icon-home"></i>',
            'type'      => 'parent',
            'sub_route' => false,
            'child'     => ['estates.create', 'estates.store','estates.edit', 'estates.update', 'estates.delete'  ,'estates.deleteAll' ,]
        ]);

        # estates store
        Route::get('estates/create', [
            'uses'  => 'EstateController@create',
            'as'    => 'estates.create',
            'title' => ' صفحة اضافة عقار'
        ]);


        # estates store
        Route::post('estates/store', [
            'uses'  => 'EstateController@store',
            'as'    => 'estates.store',
            'title' => ' اضافة عقار'
        ]);

        # estates update
        Route::get('estates/{id}/edit', [
            'uses'  => 'EstateController@edit',
            'as'    => 'estates.edit',
            'title' => 'صفحه تحديث عقار'
        ]);

        # estates update
        Route::put('estates/{id}', [
            'uses'  => 'EstateController@update',
            'as'    => 'estates.update',
            'title' => 'تحديث عقار'
        ]);

        # estates delete
        Route::delete('estates/{id}', [
            'uses'  => 'EstateController@destroy',
            'as'    => 'estates.delete',
            'title' => 'حذف عقار'
        ]);
        #delete all estates
        Route::post('delete-all-estates', [
            'uses'  => 'EstateController@destroyAll',
            'as'    => 'estates.deleteAll',
            'title' => 'حذف مجموعه من عقارات'
        ]);
        /*------------ end Of estates ----------*/

        /*------------ start Of features ----------*/
        Route::get('features', [
            'uses'      => 'FeatureController@index',
            'as'        => 'features.index',
            'title'     => 'المميزات',
            'icon'      => '<i class="feather icon-award"></i>',
            'type'      => 'parent',
            'sub_route' => false,
            'child'     => ['features.create','features.store','features.edit', 'features.update',
                            'features.delete','features.deleteAll','features.add_option','features.delete_option']
        ]);

        # estates store
        Route::get('features/create', [
            'uses'  => 'FeatureController@create',
            'as'    => 'features.create',
            'title' => ' صفحة اضافة الميزة'
        ]);


        # estates store
        Route::post('features/store', [
            'uses'  => 'FeatureController@store',
            'as'    => 'features.store',
            'title' => ' اضافة الميزة'
        ]);


        # add option
        Route::post('features/add_option', [
            'uses'  => 'FeatureController@add_option',
            'as'    => 'features.add_option',
            'title' => ' اضافة خيارات'
        ]);

        # delete option
        Route::post('features/delete_option', [
            'uses'  => 'FeatureController@delete_option',
            'as'    => 'features.delete_option',
            'title' => ' حذف خيار'
        ]);

        # estates update
        Route::get('features/{id}/edit', [
            'uses'  => 'FeatureController@edit',
            'as'    => 'features.edit',
            'title' => 'صفحه تحديث الميزة'
        ]);

        # estates update
        Route::put('features/{id}', [
            'uses'  => 'FeatureController@update',
            'as'    => 'features.update',
            'title' => 'تحديث الميزة'
        ]);

        # estates delete
        Route::delete('features/{id}', [
            'uses'  => 'FeatureController@destroy',
            'as'    => 'features.delete',
            'title' => 'حذف الميزة'
        ]);
        #delete all estates
        Route::post('delete-all-features', [
            'uses'  => 'FeatureController@destroyAll',
            'as'    => 'features.deleteAll',
            'title' => 'حذف مجموعه من الممميزات'
        ]);

        /*------------ end Of FeatureController ----------*/

        /*------------ start Of additions ----------*/
        Route::get('additions', [
            'uses'      => 'AdditionController@index',
            'as'        => 'additions.index',
            'title'     => 'الاضافات',
            'icon'      => '<i class="feather icon-check-square"></i>',
            'type'      => 'parent',
            'sub_route' => false,
            'child'     => ['additions.create', 'additions.store','additions.edit', 'additions.update', 'additions.delete'  ,'additions.deleteAll' ,]
        ]);

        # additions store
        Route::get('additions/create', [
            'uses'  => 'AdditionController@create',
            'as'    => 'additions.create',
            'title' => ' صفحة اضافة الاضافه'
        ]);


        # additions store
        Route::post('additions/store', [
            'uses'  => 'AdditionController@store',
            'as'    => 'additions.store',
            'title' => ' اضافة الاضافه'
        ]);

        # additions update
        Route::get('additions/{id}/edit', [
            'uses'  => 'AdditionController@edit',
            'as'    => 'additions.edit',
            'title' => 'صفحه تحديث الاضافه'
        ]);

        # additions update
        Route::put('additions/{id}', [
            'uses'  => 'AdditionController@update',
            'as'    => 'additions.update',
            'title' => 'تحديث الاضافه'
        ]);

        # additions delete
        Route::delete('additions/{id}', [
            'uses'  => 'AdditionController@destroy',
            'as'    => 'additions.delete',
            'title' => 'حذف الاضافه'
        ]);
        #delete all additions
        Route::post('delete-all-additions', [
            'uses'  => 'AdditionController@destroyAll',
            'as'    => 'additions.deleteAll',
            'title' => 'حذف مجموعه من الاضافات'
        ]);
        /*------------ end Of additions ----------*/

        /*------------ start Of offers ----------*/

        # offers store
        Route::get('offers/create', [
            'uses'  => 'OfferController@create',
            'as'    => 'offers.create',
            'title' => ' صفحة اضافة العروض'
        ]);


        # offers store
        Route::post('offers/store', [
            'uses'  => 'OfferController@store',
            'as'    => 'offers.store',
            'title' => ' اضافة العروض'
        ]);

        # offers update
        Route::get('offers/{id}/edit', [
            'uses'  => 'OfferController@edit',
            'as'    => 'offers.edit',
            'title' => 'صفحه تحديث العروض'
        ]);

        # offers update
        Route::put('offers/{id}', [
            'uses'  => 'OfferController@update',
            'as'    => 'offers.update',
            'title' => 'تحديث العروض'
        ]);

        # offers delete
        Route::delete('offers/{id}', [
            'uses'  => 'OfferController@destroy',
            'as'    => 'offers.delete',
            'title' => 'حذف العروض'
        ]);
        #delete all offers
        Route::post('delete-all-offers', [
            'uses'  => 'OfferController@destroyAll',
            'as'    => 'offers.deleteAll',
            'title' => 'حذف مجموعه من عرض'
        ]);
        /*------------ end Of offers ----------*/


        /*------------ start Of cities ----------*/
            Route::get('cities', [
                'uses'      => 'CityController@index',
                'as'        => 'cities.index',
                'title'     => 'المدن',
                'icon'      => '<i class="feather icon-globe"></i>',
                'type'      => 'parent',
                'sub_route' => false,
                'child'     => ['cities.create', 'cities.store','cities.edit', 'cities.update', 'cities.delete'  ,'cities.deleteAll' ,]
            ]);

            # cities store
            Route::get('cities/create', [
                'uses'  => 'CityController@create',
                'as'    => 'cities.create',
                'title' => ' صفحة اضافة مدينة'
            ]);


            # cities store
            Route::post('cities/store', [
                'uses'  => 'CityController@store',
                'as'    => 'cities.store',
                'title' => ' اضافة مدينة'
            ]);

            # cities update
            Route::get('cities/{id}/edit', [
                'uses'  => 'CityController@edit',
                'as'    => 'cities.edit',
                'title' => 'صفحه تحديث مدينة'
            ]);

            # cities update
            Route::put('cities/{id}', [
                'uses'  => 'CityController@update',
                'as'    => 'cities.update',
                'title' => 'تحديث مدينة'
            ]);

            # cities delete
            Route::delete('cities/{id}', [
                'uses'  => 'CityController@destroy',
                'as'    => 'cities.delete',
                'title' => 'حذف مدينة'
            ]);
            #delete all cities
            Route::post('delete-all-cities', [
                'uses'  => 'CityController@destroyAll',
                'as'    => 'cities.deleteAll',
                'title' => 'حذف مجموعه من المدن'
            ]);
        /*------------ end Of cities ----------*/

        /*------------ start Of categories ----------*/
            Route::get('categories-show/{id?}', [
                'uses'      => 'CategoryController@index',
                'as'        => 'categories.index',
                'title'     => 'الاقسام',
                'icon'      => '<i class="feather icon-list"></i>',
                'type'      => 'parent',
                'sub_route' => false,
                'child'     => ['categories.create', 'categories.store','categories.edit', 'categories.update', 'categories.delete'  ,'categories.deleteAll' ,]
            ]);

            # categories store
            Route::get('categories/create/{id?}', [
                'uses'  => 'CategoryController@create',
                'as'    => 'categories.create',
                'title' => ' صفحة اضافة قسم'
            ]);


            # categories store
            Route::post('categories/store', [
                'uses'  => 'CategoryController@store',
                'as'    => 'categories.store',
                'title' => ' اضافة قسم'
            ]);

            # categories update
            Route::get('categories/{id}/edit', [
                'uses'  => 'CategoryController@edit',
                'as'    => 'categories.edit',
                'title' => 'صفحه تحديث قسم'
            ]);

            # categories update
            Route::put('categories/{id}', [
                'uses'  => 'CategoryController@update',
                'as'    => 'categories.update',
                'title' => 'تحديث قسم'
            ]);

            # categories delete
            Route::delete('categories/{id}', [
                'uses'  => 'CategoryController@destroy',
                'as'    => 'categories.delete',
                'title' => 'حذف قسم'
            ]);
            #delete all categories
            Route::post('delete-all-categories', [
                'uses'  => 'CategoryController@destroyAll',
                'as'    => 'categories.deleteAll',
                'title' => 'حذف مجموعه من الاقسام'
            ]);
        /*------------ end Of categories ----------*/


        /*------------ start Of estate-categories ----------*/
        Route::get('estate-categories', [
            'uses'      => 'EstateCategoryController@index',
            'as'        => 'estate-categories.index',
            'title'     => 'فئات العقار',
            'icon'      => '<i class="feather icon-align-center"></i>',
            'type'      => 'parent',
            'sub_route' => false,
            'child'     => ['estate-categories.create', 'estate-categories.store','estate-categories.edit', 'estate-categories.update', 'estate-categories.delete'  ,'estate-categories.deleteAll' ,]
        ]);

        # estate-categories store
        Route::get('estate-categories/create', [
            'uses'  => 'EstateCategoryController@create',
            'as'    => 'estate-categories.create',
            'title' => ' صفحة اضافة فئة'
        ]);


        # estate-categories store
        Route::post('estate-categories/store', [
            'uses'  => 'EstateCategoryController@store',
            'as'    => 'estate-categories.store',
            'title' => ' اضافة فئة'
        ]);

        # estate-categories update
        Route::get('estate-categories/{id}/edit', [
            'uses'  => 'EstateCategoryController@edit',
            'as'    => 'estate-categories.edit',
            'title' => 'صفحه تحديث فئة'
        ]);

        # estate-categories update
        Route::put('estate-categories/{id}', [
            'uses'  => 'EstateCategoryController@update',
            'as'    => 'estate-categories.update',
            'title' => 'تحديث فئة'
        ]);

        # estate-categories delete
        Route::delete('estate-categories/{id}', [
            'uses'  => 'EstateCategoryController@destroy',
            'as'    => 'estate-categories.delete',
            'title' => 'حذف فئة'
        ]);
        #delete all estate-categories
        Route::post('delete-all-estate-categories', [
            'uses'  => 'EstateCategoryController@destroyAll',
            'as'    => 'estate-categories.deleteAll',
            'title' => 'حذف مجموعه من فئات'
        ]);

        /*------------ end Of EstateCategory ----------*/

        /*------------ start Of bank transfers ----------*/
            Route::get('bank-transfers', [
                'uses'      => 'BankTransferController@index',
                'as'        => 'bankTransfers.index',
                'title'     => 'الحوالات',
                'icon'      => '<i class="feather icon-dollar-sign"></i>',
                'type'      => 'parent',
                'sub_route' => false,
                'child'     => ['bankTransfers.create','bankTransfers.edit', 'bankTransfers.update', 'bankTransfers.delete'  ,'bankTransfers.deleteAll']
            ]);

            # bank transfers store
            Route::get('bank-transfers/create', [
                'uses'  => 'BankTransferController@create',
                'as'    => 'bankTransfers.create',
                'title' => ' صفحة اضافة الحوالة'
            ]);



            # bank transfers update
            Route::get('bank-transfers/{id}/edit', [
                'uses'  => 'BankTransferController@edit',
                'as'    => 'bankTransfers.edit',
                'title' => 'صفحه تحديث الحوالة'
            ]);

            # bank transfers update
            Route::put('bank-transfers/{id}', [
                'uses'  => 'BankTransferController@update',
                'as'    => 'bankTransfers.update',
                'title' => 'تحديث الحوالة'
            ]);

            # bank transfers delete
            Route::delete('bank-transfers/{id}', [
                'uses'  => 'BankTransferController@destroy',
                'as'    => 'bankTransfers.delete',
                'title' => 'حذف الحوالة'
            ]);
            #delete all bank transfers
            Route::post('delete-all-bank-transfers', [
                'uses'  => 'BankTransferController@destroyAll',
                'as'    => 'bankTransfers.deleteAll',
                'title' => 'حذف مجموعه من الحوالات'
            ]);
        /*------------ end Of bank transfers ----------*/

        /*------------ start Of accounttypes ----------*/
            Route::get('accounttypes', [
                'uses'      => 'AccountTypeController@index',
                'as'        => 'accounttypes.index',
                'title'     => 'حسابات التسجيل',
                'icon'      => '<i class="feather icon-airplay"></i>',
                'type'      => 'parent',
                'sub_route' => false,
                'child'     => ['accounttypes.create', 'accounttypes.store','accounttypes.edit', 'accounttypes.update', 'accounttypes.delete'  ,'accounttypes.deleteAll' ,]
            ]);

            # accounttypes store
            Route::get('accounttypes/create', [
                'uses'  => 'AccountTypeController@create',
                'as'    => 'accounttypes.create',
                'title' => ' صفحة اضافة الحساب'
            ]);


            # accounttypes store
            Route::post('accounttypes/store', [
                'uses'  => 'AccountTypeController@store',
                'as'    => 'accounttypes.store',
                'title' => ' اضافة الحساب'
            ]);

            # accounttypes update
            Route::get('accounttypes/{id}/edit', [
                'uses'  => 'AccountTypeController@edit',
                'as'    => 'accounttypes.edit',
                'title' => 'صفحه تحديث الحساب'
            ]);

            # accounttypes update
            Route::put('accounttypes/{id}', [
                'uses'  => 'AccountTypeController@update',
                'as'    => 'accounttypes.update',
                'title' => 'تحديث الحساب'
            ]);

            # accounttypes delete
            Route::delete('accounttypes/{id}', [
                'uses'  => 'AccountTypeController@destroy',
                'as'    => 'accounttypes.delete',
                'title' => 'حذف الحساب'
            ]);
            #delete all accounttypes
            Route::post('delete-all-accounttypes', [
                'uses'  => 'AccountTypeController@destroyAll',
                'as'    => 'accounttypes.deleteAll',
                'title' => 'حذف مجموعه من الحسابات'
            ]);
        /*------------ end Of accounttypes ----------*/

        /*------------ start Of estatetypes ----------*/
            Route::get('estatetypes', [
                'uses'      => 'EstateTypeController@index',
                'as'        => 'estatetypes.index',
                'title'     => 'انواع العقارات',
                'icon'      => '<i class="feather icon-image"></i>',
                'type'      => 'parent',
                'sub_route' => false,
                'child'     => ['estatetypes.create', 'estatetypes.store','estatetypes.edit', 'estatetypes.update', 'estatetypes.delete'  ,'estatetypes.deleteAll' ,]
            ]);

            # estatetypes store
            Route::get('estatetypes/create', [
                'uses'  => 'EstateTypeController@create',
                'as'    => 'estatetypes.create',
                'title' => ' صفحة اضافة نوع عقار'
            ]);


            # estatetypes store
            Route::post('estatetypes/store', [
                'uses'  => 'EstateTypeController@store',
                'as'    => 'estatetypes.store',
                'title' => ' اضافة نوع العقار'
            ]);

            # estatetypes update
            Route::get('estatetypes/{id}/edit', [
                'uses'  => 'EstateTypeController@edit',
                'as'    => 'estatetypes.edit',
                'title' => 'صفحه تحديث نوع العقار'
            ]);

            # estatetypes update
            Route::put('estatetypes/{id}', [
                'uses'  => 'EstateTypeController@update',
                'as'    => 'estatetypes.update',
                'title' => 'تحديث نوع العقار'
            ]);

            # estatetypes delete
            Route::delete('estatetypes/{id}', [
                'uses'  => 'EstateTypeController@destroy',
                'as'    => 'estatetypes.delete',
                'title' => 'حذف نوع العقار'
            ]);
            #delete all estatetypes
            Route::post('delete-all-estatetypes', [
                'uses'  => 'EstateTypeController@destroyAll',
                'as'    => 'estatetypes.deleteAll',
                'title' => 'حذف مجموعه من انواع العقارات'
            ]);
        /*------------ end Of estatetypes ----------*/

        /*------------ start Of housingtypes ----------*/
            Route::get('housingtypes', [
                'uses'      => 'HousingTypeController@index',
                'as'        => 'housingtypes.index',
                'title'     => 'انواع المساكن',
                'icon'      => '<i class="feather icon-image"></i>',
                'type'      => 'parent',
                'sub_route' => false,
                'child'     => ['housingtypes.create', 'housingtypes.store','housingtypes.edit', 'housingtypes.update', 'housingtypes.delete'  ,'housingtypes.deleteAll' ,]
            ]);

            # housingtypes store
            Route::get('housingtypes/create', [
                'uses'  => 'HousingTypeController@create',
                'as'    => 'housingtypes.create',
                'title' => ' صفحة اضافة السكن'
            ]);


            # housingtypes store
            Route::post('housingtypes/store', [
                'uses'  => 'HousingTypeController@store',
                'as'    => 'housingtypes.store',
                'title' => ' اضافة السكن'
            ]);

            # housingtypes update
            Route::get('housingtypes/{id}/edit', [
                'uses'  => 'HousingTypeController@edit',
                'as'    => 'housingtypes.edit',
                'title' => 'صفحه تحديث السكن'
            ]);

            # housingtypes update
            Route::put('housingtypes/{id}', [
                'uses'  => 'HousingTypeController@update',
                'as'    => 'housingtypes.update',
                'title' => 'تحديث السكن'
            ]);

            # housingtypes delete
            Route::delete('housingtypes/{id}', [
                'uses'  => 'HousingTypeController@destroy',
                'as'    => 'housingtypes.delete',
                'title' => 'حذف السكن'
            ]);
            #delete all housingtypes
            Route::post('delete-all-housingtypes', [
                'uses'  => 'HousingTypeController@destroyAll',
                'as'    => 'housingtypes.deleteAll',
                'title' => 'حذف مجموعه من انواع المساكن'
            ]);
        /*------------ end Of housingtypes ----------*/
        #new_routes_here


        /*------------ start Of intros ----------*/
            Route::get('intros', [
                'uses'      => 'IntroController@index',
                'as'        => 'intros.index',
                'title'     => 'الصفحات الافتتاحية',
                'icon'      => '<i class="feather icon-loader"></i>',
                'type'      => 'parent',
                'sub_route' => false,
                'child'     => ['intros.create', 'intros.store','intros.edit', 'intros.update', 'intros.delete'  ,'intros.deleteAll' ,]
            ]);

            # intros store
            Route::get('intros/create', [
                'uses'  => 'IntroController@create',
                'as'    => 'intros.create',
                'title' => 'اضافة صفحة افتتاحية'
            ]);


            # intros store
            Route::post('intros/store', [
                'uses'  => 'IntroController@store',
                'as'    => 'intros.store',
                'title' => ' اضافة صفحة افتتاحية'
            ]);

            # intros update
            Route::get('intros/{id}/edit', [
                'uses'  => 'IntroController@edit',
                'as'    => 'intros.edit',
                'title' => 'صفحه تحديث صفحة افتتاحية'
            ]);

            # intros update
            Route::put('intros/{id}', [
                'uses'  => 'IntroController@update',
                'as'    => 'intros.update',
                'title' => 'تحديث صفحة افتتاحية'
            ]);

            # intros delete
            Route::delete('intros/{id}', [
                'uses'  => 'IntroController@destroy',
                'as'    => 'intros.delete',
                'title' => 'حذف صفحة افتتاحية'
            ]);
            #delete all intros
            Route::post('delete-all-intros', [
                'uses'  => 'IntroController@destroyAll',
                'as'    => 'intros.deleteAll',
                'title' => 'حذف مجموعه من الصفحات التعريفية'
            ]);
        /*------------ end Of intros ----------*/

        /*------------ start Of socials ----------*/
            Route::get('socials', [
                'uses'      => 'SocialController@index',
                'as'        => 'socials.index',
                'title'     => 'وسائل التواصل',
                'icon'      => '<i class="feather icon-message-circle"></i>',
                'type'      => 'parent',
                'sub_route' => false,
                'child'     => ['socials.create', 'socials.store', 'socials.show', 'socials.update', 'socials.edit', 'socials.delete' ,'socials.deleteAll']
            ]);

            # socials store
            Route::get('socials/create', [
                'uses'  => 'SocialController@create',
                'as'    => 'socials.create',
                'title' => ' صفحة اضافة تواصل'
            ]);

            # socials store
            Route::post('socials', [
                'uses'  => 'SocialController@store',
                'as'    => 'socials.store',
                'title' => ' اضافة تواصل'
            ]);

            # socials update
            Route::get('socials/{id}', [
                'uses'  => 'SocialController@show',
                'as'    => 'socials.show',
                'title' => 'صفحه عرض تواصل'
            ]);
            # socials update
            Route::get('socials/{id}/edit', [
                'uses'  => 'SocialController@edit',
                'as'    => 'socials.edit',
                'title' => 'صفحه تحديث تواصل'
            ]);
            # socials update
            Route::put('socials/{id}', [
                'uses'  => 'SocialController@update',
                'as'    => 'socials.update',
                'title' => 'تحديث تواصل'
            ]);

            # socials delete
            Route::delete('socials/{id}', [
                'uses'  => 'SocialController@destroy',
                'as'    => 'socials.delete',
                'title' => 'حذف تواصل'
            ]);

            #delete all socials
            Route::post('delete-all-socials', [
                'uses'  => 'SocialController@destroyAll',
                'as'    => 'socials.deleteAll',
                'title' => 'حذف مجموعه من وسائل التواصل'
            ]);
        /*------------ end Of socials ----------*/

        /*------------ start Of complaints ----------*/
            Route::get('all-complaints', [
                'as'        => 'all_complaints',
                'uses'      => 'ComplaintController@index',
                'icon'      => '<i class="feather icon-mail"></i>',
                'title'     => 'الشكاوي والمقترحات',
                'type'      => 'parent',
                'sub_route' => false,
                'child'     => [
                    'complaints.delete' ,'complaints.deleteAll','complaints.show','complaint.replay'
                ]
            ]);

            # complaint replay
            Route::post('complaints-replay/{id}', [
                'uses'  => 'ComplaintController@replay',
                'as'    => 'complaint.replay',
                'title' => 'رد علي الرساله'
            ]);
            # socials update
            Route::get('complaints/{id}', [
                'uses'  => 'ComplaintController@show',
                'as'    => 'complaints.show',
                'title' => 'صفحه الرساله'
            ]);
            # complaints delete
            Route::delete('complaints/{id}', [
                'uses'  => 'ComplaintController@destroy',
                'as'    => 'complaints.delete',
                'title' => 'حذف الرساله'
            ]);

            #delete all complaints
            Route::post('delete-all-complaints', [
                'uses'  => 'ComplaintController@destroyAll',
                'as'    => 'complaints.deleteAll',
                'title' => 'حذف مجموعه من الرسائل'
            ]);
        /*------------ end Of complaints ----------*/

        /*------------ start Of seos ----------*/
            Route::get('seos', [
                'uses'      => 'SeoController@index',
                'as'        => 'seos.index',
                'title'     => 'سيو',
                'icon'      => '<i class="feather icon-list"></i>',
                'type'      => 'parent',
                'child'     => [
                    'seos.index','seos.store', 'seos.update', 'seos.delete' , 'seos.deleteAll' ,
                ]
            ]);

            # seos store
            Route::get('seos/create', [
                'uses'  => 'SeoController@create',
                'as'    => 'seos.create','clients.edit',
                'title' => ' صفحة اضافة سيو'
            ]);

            # seos update
            Route::get('seos/{id}/edit', [
                'uses'  => 'SeoController@edit',
                'as'    => 'seos.edit',
                'title' => 'صفحه تحديث سيو'
            ]);

            #store
            Route::post('seos/store', [
                'uses'  => 'SeoController@store',
                'as'    => 'seos.store',
                'title' => ' اضافة سيو'
            ]);

            #update
            Route::put('seos/{id}', [
                'uses'  => 'SeoController@update',
                'as'    => 'seos.update',
                'title' => 'تحديث سيو'
            ]);

            #deletّe
            Route::delete('seos/{id}', [
                'uses'  => 'SeoController@destroy',
                'as'    => 'seos.delete',
                'title' => 'حذف سيو'
            ]);
            #delete
            Route::post('delete-all-seos', [
                'uses'  => 'SeoController@destroyAll',
                'as'    => 'seos.deleteAll',
                'title' => 'حذف مجموعه من السيو'
            ]);
        /*------------ end Of seos ----------*/

        /*------------ start Of sms ----------*/
            Route::get('sms', [
                'uses'      => 'SMSController@index',
                'as'        => 'sms.index',
                'title'     => 'باقات الرسائل',
                'icon'      => '<i class="feather icon-smartphone"></i>',
                'type'      => 'parent',
                'sub_route' => false,
                'child'     => ['sms.update','sms.change',]
            ]);
            # sms change
            Route::post('sms-change', [
                'uses'  => 'SMSController@change',
                'as'    => 'sms.change',
                'title' => 'تحديث نوع باقه الرسائل'
            ]);
            # sms update
            Route::put('sms/{id}', [
                'uses'  => 'SMSController@update',
                'as'    => 'sms.update',
                'title' => 'تحديث باقه رسائل'
            ]);

        /*------------ end Of sms ----------*/


        /*------------ start Of reports----------*/
            Route::get('reports', [
                'uses'      => 'ReportController@index',
                'as'        => 'reports',
                'icon'      => '<i class="feather icon-edit-2"></i>',
                'title'     => 'التقارير',
                'type'      => 'parent',
                'sub_route' => false,
                'child'     => ['reports.delete' ,'reports.deleteAll' ,'reports.show']
            ]);

            # reports show
            Route::get('reports/{id}', [
                'uses'  => 'ReportController@show',
                'as'    => 'reports.show',
                'title' => 'عرض تقرير'
            ]);

            # reports delete
            Route::delete('reports/{id}', [
                'uses'  => 'ReportController@destroy',
                'as'    => 'reports.delete',
                'title' => 'حذف تقرير'
            ]);

            #delete all reports
            Route::post('delete-all-reports', [
                'uses'  => 'ReportController@destroyAll',
                'as'    => 'reports.deleteAll',
                'title' => 'حذف مجموعه من التقارير'
            ]);
        /*------------ end Of reports ----------*/

        /*------------ start Of Roles----------*/
            Route::get('roles', [
                'uses'      => 'RoleController@index',
                'as'        => 'roles.index',
                'title'     => 'قائمة الصلاحيات',
                'icon'      => '<i class="feather icon-eye"></i>',
                'type'      => 'parent',
                'child'     => [
                    'roles.index','roles.create', 'roles.store', 'roles.edit', 'roles.update', 'roles.delete' ,
                ]
            ]);

            #add role page
            Route::get('roles/create', [
                'uses'  => 'RoleController@create',
                'as'    => 'roles.create',
                'title' => 'اضافة صلاحيه',

            ]);

            #store role
            Route::post('roles/store', [
                'uses' => 'RoleController@store',
                'as' => 'roles.store',
                'title' => 'تمكين اضافة صلاحيه'
            ]);

            #edit role page
            Route::get('roles/{id}/edit', [
                'uses' => 'RoleController@edit',
                'as' => 'roles.edit',
                'title' => 'تعديل صلاحيه'
            ]);

            #update role
            Route::put('roles/{id}', [
                'uses' => 'RoleController@update',
                'as' => 'roles.update',
                'title' => 'تمكين تعديل صلاحيه'
            ]);

            #delete role
            Route::delete('roles/{id}', [
                'uses' => 'RoleController@destroy',
                'as' => 'roles.delete',
                'title' => 'حذف صلاحيه'
            ]);

        /*------------ end Of Roles----------*/

        /*------------ start Of Settings----------*/
            Route::get('settings', [
                'uses'      => 'SettingController@index',
                'as'        => 'settings.index',
                'title'     => 'الاعدادات',
                'icon'      => '<i class="feather icon-settings"></i>',
                'type'      => 'parent',
                'child'     => [
                    'settings.index','settings.update','settings.message.all','settings.message.one','settings.send_email' ,
                ]
            ]);

            #update
            Route::put('settings', [
                'uses' => 'SettingController@update',
                'as' => 'settings.update',
                'title' => 'تحديث الاعدادات'
            ]);

            #message all
            Route::post('settings/{type}/message-all', [
                'uses'  => 'SettingController@messageAll',
                'as'    => 'settings.message.all',
                'title' => 'مراسلة الجميع'
            ])->where('type','email|sms|notification');

            #message one
            Route::post('settings/{type}/message-one', [
                'uses'  => 'SettingController@messageOne',
                'as'    => 'settings.message.one',
                'title' => 'مراسلة مستخدم'
            ])->where('type','email|sms|notification');

            #send email
            Route::post('settings/send-email', [
                'uses'  => 'SettingController@sendEmail',
                'as'    => 'settings.send_email',
                'title' => 'ارسال ايميل'
            ]);
        /*------------ end Of Settings ----------*/


    });

});


