<!-- Custom type bu sayfa içeiklerin program  ın  girildiğindeki detay sayfadır -->

<?php get_header(); ?>

<div class="container pt-5 pb-5">
        <div class="page-banner">
    <div class="page-banner__bg-image" style="background-image: url(<?php echo get_theme_file_uri('/images/ocean.jpg') ?>);"></div>
    <div class="page-banner__content container container--narrow">
      <h1 class="page-banner__title"><?php the_title(); ?></h1>
      <div class="page-banner__intro">
            <h1>This is a event post you can find in  single-program.php</h1>
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


<!-- Related professor ları göstereceğiz.  -->
<?php
                    $today= date('Ymd');
                    $homeProfessors = new WP_Query(array(
                      'posts_per_page'=>-1, // -1 means all associated professors
                      // 'category_name'=>'blog',
                      'post_type' => 'professor',
                      // sorting the closest date, default one is post_date
                      // 'meta_key' => 'event_date',
                      'orderby' => 'title', //post_date, title  => meta_value  
                      'order' => 'ASC', //'DESC','ASC'
                      //disable event that time has passed
                      'meta_query' => array(
                          // array(
                          //   'key' => 'event_date',
                          //   'compare' => '>=',
                          //   'value' => $today,
                          //   'type' => 'numeric'
                          // ),
                        array(
                            'key' => 'related_programs',//array(12,120,1250)
                            'compare' => 'LIKE',
                            'value' => '"' . get_the_ID(  )  . '"'// "12"
                        )
                        )));
                        if ($homeProfessors->have_posts()){
                        echo '<hr class="section-break"';
                       echo '<h2 class="headline headline--medium"> ' . get_the_title() . ' professors</h2>';
                                              
                       echo '<ul class="professor-cards">';
                    while ($homeProfessors-> have_posts(  )){
                    $homeProfessors -> the_post(  );?>
                    <li class="professor-card__list-item">
                      <a class="professor-card" href="<?php the_permalink() ?> "> 
                        <img class="professor-card__img" src="<?php the_post_thumbnail_url( ) ?>" alt="">
                        <span class="professor-card__name"><?php the_title( ) ?></span>
                      </a>
                    
                    </li>
                    <?php } 
                     echo '</ul>';                 
                    wp_reset_postdata(  );
                    
                    ?>
 <?php }; 
?>
<!-- Related professor ları gösterdik.  -->




<!-- Related programları (gelecek olanları) göstereceğiz.  -->
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
                        if ($homePageEvents->have_posts()){
                        echo '<hr class="section-break"';
                       echo '<h2 class="headline headline--medium">Upcoming ' . get_the_title() . ' Events</h2>';
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


<?php }; 
?>
           


<?php get_footer(); ?>