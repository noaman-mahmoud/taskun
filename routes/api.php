<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::group(['middleware' => ['localization'] , 'namespace' => 'Api'], function() {

    // auth controller
    Route::get('account-types'                      ,'AuthController@accountTypes');
    Route::post('sign-up'                           ,'AuthController@signUp');
    Route::post('sign-in'                           ,'AuthController@signIn');
    Route::post('forget-password'                   ,'AuthController@forgetPassword');
    // auth routes

    Route::group(['middleware' => ['jwt']], function (){

        Route::post('activate-code'                  ,'AuthController@activateCode');
        Route::post('switch-notification'            ,'UserController@switchNotification');
        Route::get('resend-code'                     ,'AuthController@resendCode');
        Route::post('reset-password'                 ,'AuthController@resetPassword');
        Route::post('log-out'                        ,'AuthController@Logout');
        Route::get('profile'                         ,'UserController@profile');
        Route::post('update-phone-request'           ,'AuthController@updatePhoneRequest');
        Route::post('check-update-phone-code'        ,'AuthController@checkUpdatePhoneCode');
        Route::post('edit-password'                  ,'AuthController@EditPassword');
        Route::get('notifications'                   ,'UserController@notifications');
        Route::get('count-notifications'             ,'UserController@countNotifications');
        Route::post('delete-notifications'           ,'UserController@deleteNotifications');
        Route::post('update-profile'                 ,'UserController@updateProfile');
        Route::post('change-notify-statue'           ,'UserController@changeNotifyStatue');
        Route::post('add-complaint'                  ,'ComplaintController@StoreComplaint');



        #### Estate #####
        Route::post('add-estate'              ,'EstateController@addEstate');  // create estate step [1]
        Route::post('add-details-estate'      ,'EstateController@addDetailsEstate'); //create estate step [2]
        Route::post('estate-user-contacts'    ,'EstateController@estateUserContacts');// create estate step [3]
        Route::post('delete-estate'           ,'EstateController@deleteEstate');
        Route::post('edit-estate'             ,'EstateController@editEstate');  // edit estate
        Route::post('update-estate'           ,'EstateController@updateEstate');

        #### User App #####
        Route::post('favorite'                ,'UserController@favorite');
        Route::get('my-favorites'             ,'UserController@myFavorites');
        Route::post('like'                    ,'UserController@like');
        Route::post('user-estate-details'     ,'UserController@userEstateDetails');
        Route::get('archived-estates'         ,'UserController@archivedEstates');
        Route::post('bank-transfer'           ,'UserController@bankTransfer');
        Route::post('complaints'              ,'UserController@complaints');
        #### End User App #####

        #### Provider App #####
        Route::get('provider-estates'         ,'ProviderController@providerEstates');
        Route::get('provider-estate-details'  ,'ProviderController@providerEstateDetails');
        Route::post('estate-archive'          ,'ProviderController@estateArchive');
        Route::get('archived-estates'         ,'ProviderController@archivedEstates');
        #### End Provider App #####

        #### Management App #####
        Route::post('add-property'            ,'ManagementController@addProperty');
        Route::get('real-properties'          ,'ManagementController@realProperties');
        Route::get('property-details'         ,'ManagementController@propertyDetails');
        Route::post('edit-property'           ,'ManagementController@editProperty');
        Route::post('delete-property'         ,'ManagementController@deleteProperty');
        Route::post('add-unit'                ,'ManagementController@addUnit');
        Route::post('delete-unit'             ,'ManagementController@deleteUnit');
        Route::post('edit-unit'               ,'ManagementController@editUnit');
        Route::get('unit-message-data'        ,'ManagementController@unitMessageData');
        Route::post('unit-archive'            ,'ManagementController@unitArchive');
        Route::post('archived-units'          ,'ManagementController@archivedUnits');
        #### End Management App #####

    });

    // optional auth routes
    Route::group(['middleware'=> ['jwtOptional']],function (){

        Route::get('estates-main'                   ,'UserController@estatesMain');
        Route::get('providers'                      ,'ProviderController@providers');
        Route::get('provider-details'               ,'ProviderController@providerDetails');
        Route::post('estate-details'                ,'EstateController@estateDetails');
        Route::post('estates-search'                ,'EstateController@estatesSearch');
        Route::post('search-estates-provider'       ,'EstateController@searchEstatesProvider');
        Route::post('estates-filter'                ,'EstateController@estatesFilter');
        Route::get('settings'                       ,'SettingController@settings');

        Route::get('estate-types'                   ,'ManagementController@estateTypes');
        Route::get('housing-types'                  ,'ManagementController@housingTypes');

        Route::post('features'                       ,'SettingController@features');
        Route::get('about'                           ,'SettingController@about');
        Route::get('terms'                           ,'SettingController@terms');
        Route::post('complaint'                      ,'SettingController@complaint');
        Route::post('connect-us'                     ,'SettingController@connect_us');
        Route::get('privacy'                         ,'SettingController@privacy');
        Route::get('intros'                          ,'SettingController@intros');
        Route::get('fqss'                            ,'SettingController@fqss');
        Route::get('socials'                         ,'SettingController@socials');
        Route::get('management-fees'                 ,'SettingController@management_fees');
        Route::get('bank-accounts'                   ,'SettingController@bank_accounts');
        Route::post('features'                       ,'EstateController@features');
        Route::post('confirm-estate'                 ,'EstateController@confirmEstate');
        Route::get('images'                          ,'ImageController@images');
        Route::get('categories/{id?}'                ,'SettingController@categories');
        Route::get('estate-categories'               ,'SettingController@estate_categories');
        Route::get('additions'                       ,'SettingController@additions');
        Route::get('calculator'                      ,'SettingController@calculator');
        Route::get('countries'                       ,'CountryController@countries');
        Route::get('countries-with-cities'           ,'CountryController@countriesWithCities');
        Route::get('cities'                          ,'CountryController@cities');
        Route::get('cities-by-country/{country_id}'  ,'CountryController@citiesByCountry');
    });


});
