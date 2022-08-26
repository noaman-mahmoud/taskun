<?php

namespace App\Traits;
trait  menu
{
    public function home()
    {
        $menu = [
            [
                'name' => awtTrans('المشرفين'),
                'count' => \App\Models\Admin::count(),
                'icon' => 'icon-users',
                'url' => url('admin/admins'),
            ],
            [
                'name' => awtTrans('الملاك'),
                'count' => \App\Models\User::where('user_type','owner')->count(),
                'icon' => 'icon-users',
                'url' => url('admin/clients'),
            ],
            [
                'name' => awtTrans('المكاتب'),
                'count' => \App\Models\User::where('user_type','office')->count(),
                'icon' => 'icon-users',
                'url' => url('admin/offices'),
            ],
            [
                'name' => awtTrans('المسوقين'),
                'count' => \App\Models\User::where('user_type','marketer')->count(),
                'icon' => 'icon-users',
                'url' => url('admin/marketers'),
            ],
            [
                'name' => awtTrans('المستخدمين  المحظورين'),
                'count' => \App\Models\User::where('block', 1)->count(),
                'icon' => 'icon-users',
                'url' => url('admin/clients/block'),
            ],
            [
                'name' => awtTrans('الحسابات البنكيه'),
                'count' => \App\Models\Bank::count(),
                'icon' => 'icon-users',
                'url' => url('admin/Bank-accounts'),
            ],
            [
                'name'  => awtTrans('العقارات'),
                'count' => \App\Models\Estate::count(),
                'icon'  => 'icon-home',
                'url'   => url('admin/estates'),
            ],
            [
                'name'  => awtTrans('المميزات'),
                'count' => \App\Models\Feature::count(),
                'icon'  => 'icon-check-square',
                'url'   => url('admin/features'),
            ],
            [
                'name' => awtTrans('وسائل التواصل'),
                'count' => \App\Models\Social::count(),
                'icon' => 'icon-thumbs-up',
                'url' => url('admin/socials'),
            ],
            [
                'name' => awtTrans('رسائل التواصل'),
                'count' => \App\Models\Complaint::count(),
                'icon' => 'icon-list',
                'url' => url('admin/all-complaints'),
            ],
            [
                'name' => awtTrans('التقارير'),
                'count' => \App\Models\LogActivity::count(),
                'icon' => 'icon-list',
                'url' => url('admin/reports'),
            ],
            [
                'name' => awtTrans('فئات العقارات'),
                'count' => \App\Models\EstateCategory::count(),
                'icon' => 'icon-list',
                'url' => url('admin/estate-categories'),
            ],
            [
                'name' => awtTrans('المدن'),
                'count' => \App\Models\City::count(),
                'icon' => 'icon-list',
                'url' => url('admin/cities'),
            ],
            [
                'name' => awtTrans('الاسئلة الشائعة'),
                'count' => \App\Models\Fqs::count(),
                'icon' => 'icon-list',
                'url' => url('admin/fqs'),
            ],
            [
                'name' => awtTrans('الصفحات التعريفية'),
                'count' => \App\Models\Intro::count(),
                'icon' => 'icon-list',
                'url' => url('admin/intros'),
            ],
            [
                'name' => awtTrans('الحوالات'),
                'count' => \App\Models\BankTransfer::count(),
                'icon' => 'icon-list',
                'url' => url('admin/bank-transfers'),
            ],
            [
                'name' => awtTrans('انواع العقارات'),
                'count' => \App\Models\EstateType::where('deleted',0)->count(),
                'icon' => 'icon-list',
                'url' => url('admin/estatetypes'),
            ],
            [
                'name' => awtTrans('انواع المساكن'),
                'count' => \App\Models\HousingType::count(),
                'icon' => 'icon-list',
                'url' => url('admin/housingtypes'),
            ],
            [
                'name' => awtTrans('الصلاحيات'),
                'count' => \App\Models\Role::count(),
                'icon' => 'icon-eye',
                'url' => url('admin/roles'),
            ],
        ];

        return $menu;
    }

    public function introSiteCards()
    {
        $menu = [
            [
                'name' => awtTrans('بنرات الاسلايدر'),
                'count' => \App\Models\IntroSlider::count(),
                'icon' => 'icon-users',
                'url' => url('admin/introsliders'),
            ],
            [
                'name' => awtTrans('سكشن خدماتنا'),
                'count' => \App\Models\IntroService::count(),
                'icon' => 'icon-users',
                'url' => url('admin/introservices'),
            ],
            [
                'name' => awtTrans('اقسام الاسئلة الشائعه'),
                'count' => \App\Models\IntroFqsCategory::count(),
                'icon' => 'icon-users',
                'url' => url('admin/introfqscategories'),
            ],
            [
                'name' => awtTrans(' الاسئلة الشائعه'),
                'count' => \App\Models\IntroFqs::count(),
                'icon' => 'icon-users',
                'url' => url('admin/introfqs'),
            ],
            [
                'name' => awtTrans('شركاء النجاح'),
                'count' => \App\Models\IntroPartener::count(),
                'icon' => 'icon-users',
                'url' => url('admin/introparteners'),
            ],
            [
                'name' => awtTrans('رسائل العملاء'),
                'count' => \App\Models\IntroMessages::count(),
                'icon' => 'icon-users',
                'url' => url('admin/intromessages'),
            ],
            [
                'name' => awtTrans('وسائل التواصل'),
                'count' => \App\Models\IntroSocial::count(),
                'icon' => 'icon-users',
                'url' => url('admin/introsocials'),
            ],
            [
                'name' => awtTrans('قسم كيف نعمل'),
                'count' => \App\Models\IntroHowWork::count(),
                'icon' => 'icon-users',
                'url' => url('admin/introhowworks'),
            ],
        ];
        return $menu;
    }

}
