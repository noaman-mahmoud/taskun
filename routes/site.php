<?php

use Illuminate\Support\Facades\Route;

Route::group(['middleware' => ['language','web','HtmlMinifier']], function () {

   /*--------------------- Authentication -----------------------------*/

    Route::get('sign-in'                         , 'AuthController@signIn')->name('login');
    Route::post('post-sign-in'                   , 'AuthController@postSignIn');
    Route::get('sign-up'                         , 'AuthController@signUp');
    Route::post('post-sign-up'                   , 'AuthController@postSignUp');
    Route::get('activate-code'                   , 'AuthController@activateCode');
    Route::get('resend-code'                     , 'AuthController@resendCode');
    Route::post('post-activate-code'             , 'AuthController@postActivateCode');

    Route::get('forget-password'                 , 'AuthController@forgetPassword');
    Route::post('post-forget-password'           , 'AuthController@postForgetPassword');
    Route::get('code-forget-password'            , 'AuthController@codeForgetPassword');
    Route::post('check-code-forget'              , 'AuthController@checkCodeForget');
    Route::get('new-password'                    , 'AuthController@newPassword');
    Route::post('post-new-password'              , 'AuthController@postNewPassword');

   /*--------------------- End Authentication --------------------------*/

    Route::get('/'                               , 'SiteController@index');
    Route::get('language/{lang}'                 , 'SiteController@language');

    Route::post('post-search'                    , 'SiteController@postSearch');
    Route::get('search'                          , 'SiteController@search');
    Route::post('contact'                        , 'SiteController@contact');
    Route::get('live-shows'                      , 'SiteController@liveShows');
    Route::post('estates-filter'                 , 'SiteController@estatesFilter');
    Route::post('estates-search'                 , 'SiteController@estatesSearch');
    Route::get('filters'                         , 'SiteController@filters');
    Route::get('estate-details/{id}'             , 'SiteController@estateDetails');
    Route::get('brokers'                         , 'SiteController@brokers');
    Route::get('broker-details/{uuid}'           , 'SiteController@brokerDetails');
    Route::get('broker-estates/{uuid}'           , 'SiteController@brokerEstates');

    Route::get('about'                           , 'SettingController@about');
    Route::get('policy'                          , 'SettingController@policy');
    Route::get('terms'                           , 'SettingController@terms');
    Route::get('commission-calculator'           , 'SiteController@commissionCalculator');
    Route::get('quest-calculator'                , 'SiteController@questCalculator');
    Route::get('contact-us'                      , 'SettingController@contactUs');

    Route::get('bank-accounts'                   , 'SettingController@bankAccounts');



    Route::group(['middleware' => ['auth']], function () {

       Route::get('account'                      , 'UserController@account');
       Route::get('profile'                      , 'UserController@profile');
       Route::post('update-profile'              , 'UserController@updateProfile');
       Route::get('my-estates'                   , 'UserController@myEstates');
       Route::get('archived-estates'             , 'UserController@archivedEstates');
       Route::get('my-favorites'                 , 'UserController@myFavorites');
       Route::post('favorite'                    , 'UserController@favorite');
       Route::get('logout'                       , 'AuthController@logout');
       Route::post('transfer'                    , 'UserController@transfer');
       Route::get('bank-transfer'                , 'UserController@bankTransfer');
       Route::post('post-bank-transfer'          , 'UserController@postBankTransfer');
       Route::get('paid-successfully'            , 'UserController@paidSuccessfully');

       ## Estates  ##
        Route::get('add-estate'                  , 'EstateController@addEstate');
        Route::post('post-add-estate'            , 'EstateController@postAddEstate');
        Route::get('add-details-estate'          , 'EstateController@addDetailsEstate');
        Route::post('post-add-details-estate'    , 'EstateController@postAddDetailsEstate');
        Route::get('estate-contacts'             , 'EstateController@estateContacts');
        Route::post('post-estate-contacts'       , 'EstateController@postEstateContacts');
        Route::get('financial-obligations'       , 'EstateController@financialObligations');
        Route::get('confirm-estate'              , 'EstateController@confirmEstate');
        Route::get('estate-published'            , 'EstateController@estatePublished');

       ## End Estates  ##

       ## Management  ##
       Route::get('property-management'          , 'ManagementController@propertyManagement');
       Route::get('add-property'                 , 'ManagementController@addProperty');
       Route::post('post-add-property'           , 'ManagementController@postAddProperty');
       Route::get('real-properties'              , 'ManagementController@realProperties');
       Route::get('property-details/{id}'        , 'ManagementController@propertyDetails');
       Route::get('add-unit/{id}'                , 'ManagementController@addUnit');
       Route::post('post-add-unit'               , 'ManagementController@postAddUnit');
       Route::get('unit-details/{id}/{property}' , 'ManagementController@unitDetails');
       Route::get('edit-unit'                    , 'ManagementController@editUnit');
       Route::post('delete-unit'                 , 'ManagementController@deleteUnit');
       Route::post('post-edit-unit'              , 'ManagementController@postEditUnit');
       ## End Management ##
    });

});








