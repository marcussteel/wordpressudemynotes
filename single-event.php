<!-- Custom type bu sayfa içeiklerin event custom type ın  girildiğindeki detay sayfadır -->

<?php get_header(); ?>

<div class="container pt-5 pb-5">
    <h1>This is a event post you can find in  single-event.php</h1>
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
      <p><a class="metabox__blog-home-link" href="<?php echo get_post_type_archive_link( 'event' ) ?>">
      <i class="fa fa-home" aria-hidden="true"></i>
       Events Home </a> <span class="metabox__main"><?php the_title(); ?>
        </span></p>
</div>
<div class="generic-content"> <?php the_content( ); ?></div>
</div>


<!-- Single event page in alt bölümünde event ların altında kaydettiğimiz related_programs tan veriyi alacak    program içindeki related fieldları gösterecek -->
<?php 
    $relatedPrograms = get_field('related_programs');
    // print_r($relatedPrograms);
    if($relatedPrograms){
        echo '<hr class= "section-break" ';
        echo '<h2 class="headline headline--medium">Related Program(s)</h2>';
        echo '<ul class="link-list min-list">';
        foreach($relatedPrograms as $program){?>
            <li><a href="<?php echo get_the_permalink($program) ?>"> <?php echo get_the_title($program) ?>  </a></li>
        <?php 
        echo '</ul>';

    }

    }
?>

     <?php endwhile; endif; ?>


</div>

<?php get_footer(); ?>