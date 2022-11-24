<?php
function load_stylesheets()
{
    wp_register_style('bootstrap', 'https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css', array(), false, 'all' );
    wp_enqueue_style( 'bootstrap' );
    // wp_register_style('stylesheet', get_template_directory_uri().'/style.css', array(), false, 'all' );
    // wp_enqueue_style( 'stylesheet' );

    wp_enqueue_script('main-university-js', get_theme_file_uri('/build/index.js'), array('jquery'), '1.0', true);
    wp_enqueue_script('main-universitylink-js',"https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js", array(), false, 'all');
    wp_enqueue_style('custom-google-fonts', '//fonts.googleapis.com/css?family=Roboto+Condensed:300,300i,400,400i,700,700i|Roboto:100,300,400,400i,700,700i');
    wp_enqueue_style('font-awesome', '//maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css');
    wp_enqueue_style('university_main_styles', get_theme_file_uri('/build/style-index.css'));
    wp_enqueue_style('university_extra_styles', get_theme_file_uri('/build/index.css'));
}   

add_action( 'wp_enqueue_scripts', 'load_stylesheets');

// title ekleme
function university_features(){
    // register_nav_menu( 'headerMenuLocation', 'Header Menu Location');
    // register_nav_menu( 'footerMenuLocationOne', 'Footer Menu Location One');
    // register_nav_menu( 'footerMenuLocationTwo', 'Footer Menu Location Two');
    add_theme_support('title-tag' );
    // resim eklemeyi aktifleştirme   FAKAT program veya professor gibi post-type larda görünmesi için mu-plugins lere eklemeliyiz.
    add_theme_support( 'post-thumbnails' );
    add_image_size('professorLandscape', 400,260,true );//true means crop the image true yaerine array(''left, 'top.....) ama gerek yok
    add_image_size('professorPortrait', 480,650,true );//true means crop the image
}
add_action('after_setup_theme', 'university_features' );


add_filter( 'use_block_editor_for_post_type', '__return_false',100 );
// normalde classic editor de bu işi yapar




// manü aktifleştirme
add_theme_support( 'menus' );


// sayfamızda olacak menüleri tamamlamamız gerekiyor
register_nav_menus( 
    array(
    'top-menu' => __('Top Menu', 'theme'),
    'footer-menu' => __('Footer Menu', 'theme'),
) );


// register side bar 
register_sidebar( 
    array(
    'name'=> 'Page Sidebar',
    'id'=> 'page-sidebar',
    'class'=> '',
    'before_title'=> '<h4>',
    'after_title'=> '</h4>',
) );

// register a new post type 
// https://developer.wordpress.org/resource/dashicons/#heart
// bunu mu-plugins klasörüne koyfuk
// function university_post_types(){
//     register_post_type( 'event', array(
//     'public' =>true,
//     'labels' =>array(
//         'name'=> 'Events'
//     ),
//     'menu_icon' => 'dashicons-calendar'
    
//     ) );
// }
// add_action( 'init', 'university_post_types' );

// sıralamayı burada da ayarlayabiliriz, event geçince otomatik olarak göstermeyi bıraksın
function university_adjust_queries($query){

    //program listesinde dersleri alfabetik sıraya diziyoruz
    if(!is_admin(  )AND is_post_type_archive( 'program' ) AND is_main_query(  )){
        $query->set('orderby', 'title');
        $query->set('order', 'ASC');
        $query->set('post_per_page', -1);

    }
    // if statement e almazsak bütün sayfalardaki pagination ları etkiliyor admini bile...
     if(!is_admin() AND is_post_type_archive( 'event' ) AND $query->is_main_query(  )){
        $today= date('Ymd');
      $query->set('meta_key', 'event_date');  //set('posts_per_page', '1')
      $query->set('orderby', 'meta_value_num');  
      $query->set('order', 'ASC');  
      $query->set('meta_query',array(
                          array(
                            'key' => 'event_date',
                            'compare' => '>=',
                            'value' => $today,
                            'type' => 'numeric'
                          )));  
    }
    
}
add_action( ('pre_get_posts'), 'university_adjust_queries' );