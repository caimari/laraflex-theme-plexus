<?php

namespace Caimari\LaraFlexThemePlexus;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Route;
use Illuminate\View\FileViewFinder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\ViewErrorBag;

use Caimari\LaraFlex\Controllers\SiteMenuController;
use Caimari\LaraFlex\Controllers\ViewController;
use Caimari\LaraFlex\Models\GeneralSettings;
use Caimari\LaraFlex\Models\Theme;
use Caimari\LaraFlex\Models\SitePage;
use Caimari\LaraFlex\Models\SitePost;
use Caimari\LaraFlex\Models\CodeSnippet;
use Caimari\LaraFlex\Models\SitePostCategory;
use Caimari\LaraFlex\Models\SitePostTag;
use Caimari\LaraFlex\Models\SiteView;


class PlexusServiceProvider extends ServiceProvider
{
    public function register()
    {
        //
    }

    public function boot()
    {


        // Publicar los seeders: php artisan vendor:publish --tag=plexus-seeders
        $this->publishes([
            __DIR__.'/../seeders' => database_path('seeders')
        ], 'plexus-seeders');


        $this->loadViewsFrom(__DIR__.'/resources/views', 'plexus');
       // $this->loadViewsFrom(__DIR__.'/../resources/views', 'plexus');

        $this->loadRoutesFrom(__DIR__.'/routes/web.php');
    
     //    view()->composer('*', function ($view) 
     //   {
      //      $view->with('errors', session()->get('errors') ? session()->get('errors') : new ViewErrorBag);
      //  });
		
		View::composer(['layouts.app', 'plexus::app'], function ($view) {
			$view->with('errors', session()->get('errors') ? session()->get('errors') : new ViewErrorBag);
		});

		
		
    $activeTheme = null;
    $settings = null;

		
    try {
        if (Schema::hasTable('site_themes')) {
            $activeTheme = Theme::where('active', 1)->first();
        }
    } catch (\Exception $e) {
        // manejo de la situación cuando la tabla no existe
        // puedes asignar un valor predeterminado a $activeTheme aquí
    }

    try {
        $settings = GeneralSettings::firstOrFail();
    } catch (\Exception $e) {
        // Maneja el caso en el que no hay registros o la tabla no existe
        // Por ejemplo, puedes establecer valores predeterminados o mostrar un mensaje de error
    }
		

// $site_description = (!empty($activeTheme->site_description)) ? $activeTheme->site_description : $settings->site_description;
$site_description = $activeTheme && $activeTheme->site_description ? $activeTheme->site_description : ($settings && $settings->site_description ? $settings->site_description : '');
$site_title = $activeTheme && $activeTheme->site_title ? $activeTheme->site_title : ($settings && $settings->site_title ? $settings->site_title : '');
$site_url = $activeTheme && $activeTheme->site_url ? $activeTheme->site_url : ($settings && $settings->site_url ? $settings->site_url : '');

$login_active = $activeTheme && $activeTheme->login_active ? $activeTheme->login_active : ($settings && $settings->login_active ? $settings->login_active : '');
$register_active = $activeTheme && $activeTheme->register_active ? $activeTheme->register_active : ($settings && $settings->register_active ? $settings->register_active : '');

$site_email = $activeTheme && $activeTheme->site_email ? $activeTheme->site_email : ($settings && $settings->site_email ? $settings->site_email : '');
$site_phone = $activeTheme && $activeTheme->site_phone ? $activeTheme->site_phone : ($settings && $settings->site_phone ? $settings->site_phone : '');
$logo = $activeTheme && $activeTheme->logo ? $activeTheme->logo : ($settings && $settings->logo ? $settings->logo : '');

$facebook = $activeTheme && $activeTheme->facebook ? $activeTheme->facebook : ($settings && $settings->facebook ? $settings->facebook : '');
$twitter = $activeTheme && $activeTheme->twitter ? $activeTheme->twitter : ($settings && $settings->twitter ? $settings->twitter : '');
$linkedin = $activeTheme && $activeTheme->linkedin ? $activeTheme->linkedin : ($settings && $settings->linkedin ? $settings->linkedin : '');
$google_plus = $activeTheme && $activeTheme->google_plus ? $activeTheme->google_plus : ($settings && $settings->google_plus ? $settings->google_plus : '');
$github = $activeTheme && $activeTheme->github ? $activeTheme->github : ($settings && $settings->github ? $settings->github : '');
$pinterest = $activeTheme && $activeTheme->pinterest ? $activeTheme->pinterest : ($settings && $settings->pinterest ? $settings->pinterest : '');
$instagram = $activeTheme && $activeTheme->instagram ? $activeTheme->instagram : ($settings && $settings->instagram ? $settings->instagram : '');
$youtube = $activeTheme && $activeTheme->youtube ? $activeTheme->youtube : ($settings && $settings->youtube ? $settings->youtube : '');
$vimeo = $activeTheme && $activeTheme->vimeo ? $activeTheme->vimeo : ($settings && $settings->vimeo ? $settings->vimeo : '');
$rss = $activeTheme && $activeTheme->rss ? $activeTheme->rss : ($settings && $settings->rss ? $settings->rss : '');

// Color Styles
$color_default = $activeTheme && $activeTheme->color_default ? $activeTheme->color_default : ($settings && $settings->color_default ? $settings->color_default : '');
$color_default_2 = $activeTheme && $activeTheme->color_default_2 ? $activeTheme->color_default_2 : ($settings && $settings->color_default_2 ? $settings->color_default_2 : '');
$sub_bar_color = $activeTheme && $activeTheme->sub_bar_color ? $activeTheme->sub_bar_color : ($settings && $settings->sub_bar_color ? $settings->sub_bar_color : '');
$sub_bar_text_color = $activeTheme && $activeTheme->sub_bar_text_color ? $activeTheme->sub_bar_text_color : ($settings && $settings->sub_bar_text_color ? $settings->sub_bar_text_color : '');
$header_logo_color = $activeTheme && $activeTheme->header_logo_color ? $activeTheme->header_logo_color : ($settings && $settings->header_logo_color ? $settings->header_logo_color : '');

        if ($activeTheme) {
            // Establece la configuración del tema en la configuración global
            config([
                'theme.login_active' => $login_active,
                'theme.register_active' => $register_active,
                'theme.site_url' => $site_url,
                'theme.site_url' => $site_url,
                'theme.site_description' => $site_description,
                'theme.site_email' => $site_email,
                'theme.site_phone' => $site_phone,
                'theme.logo' => $activeTheme->logo,
                'theme.site_name' => $activeTheme->site_name,
                'theme.facebook'    => $activeTheme->facebook,
                'theme.twitter' => $activeTheme->twitter,
                'theme.linkedin'    => $activeTheme->linkedin,
                'theme.google_plus' => $activeTheme->google_plus,
                'theme.github'  => $activeTheme->github,
                'theme.pinterest'   => $activeTheme->pinterest,
                'theme.youtube'   => $activeTheme->youtube,
                'theme.vimeo'   => $activeTheme->vimeo,
                'theme.instagram'   => $activeTheme->instagram,
                'theme.rss' => $activeTheme->rss,
                'theme.breadcrumb_active' => $activeTheme->breadcrumb_active,
                'theme.header_sub_bar_active' => $activeTheme->header_sub_bar_active,
                'theme.main_content_active' => $activeTheme->main_content_active,
                'theme.footer_active' => $activeTheme->footer_active,
                'theme.footer_2_active' => $activeTheme->footer_2_active,
                'theme.menu_locations' => $activeTheme->menu_locations,
                'theme.footer.copyright_active' => $activeTheme->footer_copyright_active,
                'theme.title_active' => $activeTheme->title_active,
                'theme.header_image_active' => $activeTheme->header_image_active,
                'theme.sidebar_post_cat_active' => $activeTheme->sidebar_post_cat_active,
                'theme.sidebar_post_tab_active' => $activeTheme->sidebar_post_tab_active,
                'theme.sidebar_text_widget_active' => $activeTheme->sidebar_text_widget_active,
                'theme.sidebar_search_active' => $activeTheme->sidebar_search_active,
                'theme.color_default' => $activeTheme->color_default,
                'theme.color_default_2' => $activeTheme->color_default_2,
                'theme.sub_bar_color'   => $activeTheme->sub_bar_color,
                'theme.sub_bar_text_color' => $activeTheme->sub_bar_text_color,
                'theme.header_logo_color'   => $activeTheme->header_logo_color,
            ]);
			
			 
			
        }
    
		
		    // General Settings
    		View::composer(['layouts.app', 'plexus::app', 'partials.header', 'partials.footer'], function ($view) {
        try {
            $settings = GeneralSettings::firstOrFail();
            $view->with('settings', $settings);
        } catch (\Exception $e) {
            // Manejar el caso en el que no hay registros o la tabla no existe
            $view->with('settings', null);
        }
    });
            
            // Site Themes
           // View::composer('*', function ($view) {
             //   $theme = DB::table('site_themes')->first();
              //  $view->with('theme', $theme);
           // });

        // Posts
        View::composer(['layouts.app', 'plexus::app', 'pages.blog', 'pages.post', 'partials.sidebar', 'partials.widgets'], function ($view) {
            $posts = SitePost::orderBy('created_at', 'desc')->paginate(10);
            $PostTotalViews = 0;
            $PostUniqueViews = 0;
            $totalViews = 0;
            $uniqueViews = 0;
            $postsCount = $posts->count();
        
            $recentPosts = SitePost::orderBy('created_at', 'desc')->take(4)->get();

            $postsWithImage = $posts->filter(function ($post) {
                return isset($post->image) && !empty($post->image);
            });
        
            $mostViewedPosts = SitePost::withCount([
                'views as total_views' => function ($query) {
                    $query->select(DB::raw("SUM(views) as total_views"));
                }
            ])->orderByDesc('total_views')->take(4)->get();
        
            $popularPosts = SitePost::withCount([
                'views as total_views' => function ($query) {
                    $query->select(DB::raw("SUM(views) as total_views"));
                }
            ])->orderByDesc('total_views')->take(3)->get();
        
            $firstThreePostsWithImage = SitePost::whereNotNull('image')
                                                 ->where('image', '<>', '')
                                                 ->inRandomOrder()
                                                 ->take(3)
                                                 ->get();
        
            // Aquí añadimos las vistas totales y las vistas únicas a cada post
            foreach($posts as $post) {
                $post->totalViews = $post->views->sum('views');
                $post->uniqueViews = $post->views->count();
                $PostTotalViews += $post->totalViews;
                $PostUniqueViews += $post->uniqueViews;
            }
        
            // Y también para los post más vistos y los primeros tres post con imagen
            foreach($mostViewedPosts as $post) {
                $post->totalViews = $post->views->sum('views');
                $post->uniqueViews = $post->views->count();
            }
        
            foreach($firstThreePostsWithImage as $post) {
                $post->totalViews = $post->views->sum('views');
                $post->uniqueViews = $post->views->count();
            }
        
            // Pasamos las variables a las vistas
            $view->with('posts', $posts)
                ->with('postsCount', $postsCount)
                ->with('postsWithImage', $postsWithImage)
                ->with('mostViewedPosts', $mostViewedPosts)
                ->with('firstThreePosts', $firstThreePostsWithImage)
                ->with('PostTotalViews', $PostTotalViews)
                ->with('PostUniqueViews', $PostUniqueViews)
                ->with('totalViews', $totalViews)
                ->with('uniqueViews', $uniqueViews)
                ->with('recentPosts', $recentPosts)
                ->with('popularPosts', $popularPosts);
        });
        

                // Pages
                View::composer(['layouts.app', 'plexus::app', 'pages.page'], function ($view) {
                    $pages = SitePage::orderBy('created_at', 'desc')->paginate(10); 

                    $pageTotalViews = 0;
                    $pageUniqueViews = 0;

                    foreach ($pages as $page) {
                        $page->totalViews = $page->views->sum('views');
                        $page->uniqueViews = $page->views->count();
                        $pageTotalViews += $page->totalViews;
                        $pageUniqueViews += $page->uniqueViews;
                    }

                    $view->with('pages', $pages);
                    $view->with('pageTotalViews', $pageTotalViews);
                    $view->with('pageUniqueViews', $pageUniqueViews);
                });



			// Categories
			View::composer(['layouts.app', 'plexus::app', 'partials.sidebar', 'pages.blog', 'pages.category'], function ($view) {
				$categories = null;
				try {
					if (Schema::hasTable('site_post_categories')) {
						$categories = SitePostCategory::withCount('posts')->get();
					}
				} catch (\Exception $e) {
					// manejo de la situación cuando la tabla no existe
					// puedes asignar un valor predeterminado a $categories aquí si lo necesitas
				}
				$view->with('categories', $categories);
			});

			// Tags
			View::composer(['layouts.app', 'plexus::app', 'partials.sidebar', 'pages.blog', 'pages.tag'], function ($view) {
				$tags = null;
				try {
					if (Schema::hasTable('site_post_tags')) {
						$tags = SitePostTag::all();
					}
				} catch (\Exception $e) {
					// manejo de la situación cuando la tabla no existe
					// puedes asignar un valor predeterminado a $tags aquí si lo necesitas
				}
				$view->with('tags', $tags);
			});

                               
                $page = null;
				try {
					if (Schema::hasTable('site_pages')) {
						$page = SitePage::first();
					}
				} catch (\Exception $e) {
					// manejo de la situación cuando la tabla no existe
					// puedes asignar un valor predeterminado a $page aquí si lo necesitas
				}

				// Compartir la variable 'page' con todas las vistas
				view()->share('page', $page);


                        $post = null;
                        $category = null;
                        $tag = null;
                        $previousPost = null;
                        $nextPost = null;

                        try {
                            if (Schema::hasTable('site_posts')) {
                                $post = SitePost::first();
                                $previousPost = SitePost::orderBy('id', 'desc')->first();
                                $nextPost = SitePost::orderBy('id', 'asc')->first();
                            }
                        } catch (\Exception $e) {
                            // manejo de la situación cuando la tabla no existe
                            // puedes asignar un valor predeterminado a $post, $previousPost y $nextPost aquí si lo necesitas
                        }
                        view()->share('post', $post);
                        View::share('previousPost', $previousPost);
                        View::share('nextPost', $nextPost);

                        try {
                            if (Schema::hasTable('site_post_categories')) {
                                $category = SitePostCategory::first();
                            }
                        } catch (\Exception $e) {
                            // manejo de la situación cuando la tabla no existe
                            // puedes asignar un valor predeterminado a $category aquí si lo necesitas
                        }
                        view()->share('category', $category);

                        try {
                            if (Schema::hasTable('site_post_tags')) {
                                $tag = SitePostTag::first();
                            }
                        } catch (\Exception $e) {
                            // manejo de la situación cuando la tabla no existe
                            // puedes asignar un valor predeterminado a $tag aquí si lo necesitas
                        }
                        view()->share('tag', $tag);



							// Items Menu
                            View::composer(['layouts.app', 'plexus::app', 'partials.header', 'partials.navigation'], function ($view) {
                                try {
                                    $menuController = new SiteMenuController();
                                    $public_menu = $menuController->showMenu();
                                    $view->with('public_menu', $public_menu);
                                } catch (\Exception $e) {
                                    // Manejar la excepción aquí
                                    // Por ejemplo, puedes asignar un valor predeterminado al menú
                                    $view->with('public_menu', []);
                                }
                            });


                        

		
    }
}