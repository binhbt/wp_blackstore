<?php get_header(); ?>
    <?php if(have_posts()){ ?>
    <?php the_post(); ?>
<div class="NavBar" id="post-<?php the_ID(); ?>"><a href="/">Home</a> › <?php the_title(); ?></div>
       <div class="TextStyle">
            <?php the_content(); ?>
        </div>
    <?php }?>
<?php include (TEMPLATEPATH . '/view-chuyen-muc.php' ); ?>
<?php get_footer(); ?>