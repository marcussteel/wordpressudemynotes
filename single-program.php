<!-- Custom type bu sayfa içeiklerin program  ın  girildiğindeki detay sayfadır -->

<?php get_header(); ?>

<div class="container pt-5 pb-5">
    <h1>This is a event post you can find in  single-program.php</h1>
<?php single_cat_title(); ?>

<!-- resim varsa ekle    -->
    <?php if (has_post_thumbnail( )):?>
    <img src="<?php the_post_thumbnail_url(); ?>" class="img-fluid pt-5 pb-5">
    <?php endif; ?>


<!-- içerik varsa ekle  -->
    <?php if (have_posts(  )): while (have_posts(  )) : the_post(  ); ?>
        <div class="page-banner">
    <div class="page-banner__bg-image" style="background-image: url(<?php echo get_theme_file_uri('/images/ocean.jpg') ?>);"></div>
    <div class="page-banner__content container container--narrow">
      <h1 class="page-banner__title"><?php the_title(); ?></h1>
      <div class="page-banner__intro">
        <p>DONT FORGET TO REPLACE ME LATER</p>
      </div>
    </div>  
  </div>
 <div class="container container--narrow page-section">

 <!-- metabox bölümü  -->
 <div class="metabox metabox--position-up metabox--with-home-link">
      <p><a class="metabox__blog-home-link" href="<?php echo get_post_type_archive_link( 'program' ) ?>">
      <i class="fa fa-home" aria-hidden="true"></i>
       All Programs </a> <span class="metabox__main"><?php the_title(); ?>
        </span></p>
    </div>
<div class="generic-content"> <?php the_content( ); ?>

<?php
                    $today= date('Ymd');
                    $homePageEvents = new WP_Query(array(
                      'posts_per_page'=>2,
                      // 'category_name'=>'blog',
                      'post_type' => 'event',
                      // sorting the closest date, default one is post_date
                      'meta_key' => 'event_date',
                      'orderby' => 'meta_value_num', //post_date, title  => meta_value  
                      'order' => 'ASC', //'DESC','ASC'
                      //disable event that time has passed
                      'meta_query' => array(
                          array(
                            'key' => 'event_date',
                            'compare' => '>=',
                            'value' => $today,
                            'type' => 'numeric'
                          ),
                        array(
                            'key' => 'related_programs',//array(12,120,1250)
                            'compare' => 'LIKE',
                            'value' => '"' . get_the_ID(  )  . '"'// "12"
                        )
                        )));
                    while ($homePageEvents-> have_posts(  )){
                    $homePageEvents -> the_post(  );?>
                        <div class="event-summary">
                          <a class="event-summary__date t-center" href="#">

                            <!--in event custom type getting date field by sorting the closest date -->
                            <span class="event-summary__month"> <?php 
                            $eventDate = new DateTime( get_field('event_date') );
                            echo $eventDate->format('M');
                            ?> </span>
                            <span class="event-summary__day"><?php echo $eventDate->format('d');
                             ?></span>
                          </a>
                          <div class="event-summary__content">
                            <h5 class="event-summary__title headline headline--tiny"><a href="<?php the_permalink(  ); ?>"><?php the_title( ); ?></a></h5>
                            <p><?php if (has_excerpt(  )){
                                 echo get_the_excerpt(  );
                                } else {
                                  echo wp_trim_words( get_the_content(), 18);} ; 
                                ?> <a href="<?php the_permalink(  ); ?>" class="nu gray">Learn more</a></p>
                          </div>
                        </div>
                    <?php
                    } wp_reset_postdata(  );
                    ?>

</div>
</div>

    <?php endwhile; endif; ?>

           
</div>

<?php get_footer(); ?>