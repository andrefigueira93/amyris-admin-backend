<?php

// --------------------------
// Custom Backpack Routes
// --------------------------
// This route file is loaded automatically by Backpack\Base.
// Routes you generate using Backpack\Generators will be placed here.

Route::group([
    'prefix'     => config('backpack.base.route_prefix', 'admin'),
    'middleware' => array_merge(
        (array) config('backpack.base.web_middleware', 'web'),
        (array) config('backpack.base.middleware_key', 'admin')
    ),
    'namespace'  => 'App\Http\Controllers\Admin',
], function () { // custom admin routes
    Route::crud('partner', 'PartnerCrudController');
    Route::crud('product', 'ProductCrudController');
    Route::crud('review', 'ReviewCrudController');
    Route::crud('client', 'ClientCrudController');
    Route::crud('section', 'SectionCrudController');
    Route::crud('page', 'LandingPageCrudController');
    Route::crud('faq', 'FAQCrudController');
    Route::crud('testimonial', 'TestimonialCrudController');
    Route::crud('bundle', 'BundleCrudController');
    Route::crud('newsletter', 'NewsletterCrudController');
    Route::crud('social-media', 'SocialMediaCrudController');
    Route::crud('project', 'ProjectCrudController');
    Route::crud('ingredient', 'IngredientCrudController');
    Route::crud('category', 'CategoryCrudController');
    Route::crud('user', 'UserCrudController');
    Route::crud('video', 'VideoCrudController');
    Route::crud('top-banner', 'TopBannerCrudController');
    Route::crud('collection', 'CollectionCrudController');
    Route::crud('feature', 'FeatureCrudController');
}); // this should be the absolute last line of this file