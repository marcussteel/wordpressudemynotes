<!-- bu sayfa içeiklerin blog yazılarının  girildiğindeki detay sayfadır -->

<?php get_header(); ?>

<div class="container pt-5 pb-5">
    <h1>This is a post , not a page  you can find me in single php</h1>
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
        <p> DONT FORGET TO REPLACE ME LATER</p>
      </div>
    </div>  
  </div>
 <div class="container container--narrow page-section">

 <!-- metabox bölümü  -->
 <div class="metabox metabox--position-up metabox--with-home-link">
      <p><a class="metabox__blog-home-link" href="<?php echo site_url( '/blog' ) ?>"><i class="fa fa-home" aria-hidden="true"></i> Blog Home </a> <span class="metabox__main">Posted by <?php the_author_posts_link(  );?> <?php the_time('n.j.y');?> in <?php echo get_the_category_list( ',' );?></span></p>
    </div>
<div class="generic-content">
    <?php the_content( ); ?>
</div>
</div>

    <?php endwhile; endif; ?>

            <?php comments_template( ); ?>
</div>

<?php get_footer(); ?>