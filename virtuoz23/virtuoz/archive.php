<?php get_header(); ?>
<?php get_template_part( '/template-parts/breadcrumbs' ); ?>

<section class="section section-xl bg-default text-md-left">
  <div class="container">
    <div class="row row-70">
      <div class="col-lg-8">
        <?php 
          $current_taxonomy = get_queried_object()->taxonomy;
          $current_slug = get_queried_object()->slug;
        ?>
        <?php
          $page = ( get_query_var( 'page' ) ) ? get_query_var( 'page' ) : 1;
          $args = array(
            'post_type'      => get_post_type(),
            'tax_query'      => array(
              array(
                  'taxonomy' => $current_taxonomy,
                  'field'    => 'slug',
                  'terms'    => $current_slug
              )
            ),
            'posts_per_page' => 4,
            'paged'          => $page
          );
          $loop = new WP_Query( $args );
        ?>
        <?php
          if( $loop->have_posts() ) {
            while( $loop->have_posts() ) {
              $loop->the_post();
              ?>
                <article class="post post-classic">
                  <h4 class="post-classic-title">
                    <a href="<?php the_permalink(); ?>"
                      ><?php the_title(); ?></a
                    >
                  </h4>
                  <div
                    class="post-classic-panel group-middle justify-content-start"
                  >
                    <!-- <div class="post-classic-comments">
                      <span class="icon fa fa-comments-o"></span><a href="#">0</a>
                    </div> -->
                    <div class="post-classic-time">
                      <span class="icon fa fa-clock-o"></span>
                      <time datetime="<?php the_time('j.m.Y'); ?>"><?php the_time('j.m.Y'); ?></time>
                    </div>
                  </div>
                  <a class="post-classic-figure" href="<?php the_permalink(); ?>"
                    >
                    <?php
                      if( has_post_thumbnail() ) {
                        the_post_thumbnail( 'post-news' );
                      }
                    ?>
                  </a>
                </article>
              <?php
            }
            wp_reset_postdata();
          } else {
            ?>
              <p>Нет новостей с таким тегом...</p>
            <?php
          }
        ?>
      </div>
      <div class="col-lg-4">
        <!-- Post Sidebar-->
        <div class="post-sidebar post-sidebar-inset">
          <div class="post-sidebar-item">
            <h5>Популярные новости</h5>
            <div class="post-sidebar-item-inset">
              <?php
                $current_taxonomy = get_queried_object()->taxonomy;
                $current_slug = get_queried_object()->slug;

                $args = array(
                  'post_type'    => get_post_type(),
                  'tax_query'    => array(
                    array(
                      'taxonomy' => $current_taxonomy,
                      'field'    => 'slug',
                      'terms'    => $current_slug,
                    )
                  ),
                  'posts_per_page' => 5,
                );
                $loop = new WP_Query( $args );
              ?>
              <?php
                if( $loop->have_posts() ) {
                  while( $loop->have_posts() ) {
                    $loop->the_post();
                    ?>
                      <article class="post post-minimal">
                        <h6 class="post-minimal-title">
                          <a href="<?php the_permalink(); ?>"
                            ><?php the_title(); ?></a
                          >
                        </h6>
                      </article>
                    <?php
                  }
                  wp_reset_postdata();
                } 
              ?>
            </div>
          </div>
          <div class="post-sidebar-item">
            <h5>Теги</h5>
            <div class="post-sidebar-item-inset">
              <div class="group-xs group-middle justify-content-start">
                <?php 
                  $current_taxonomy = get_queried_object()->taxonomy;
                  $current_slug = get_queried_object()->slug;

                  $terms = get_terms( [
                    'taxonomy'   => $current_taxonomy,
                    'order'      => 'ASC',
                    'hide_empty' => false,
                  ] );
                  $args = array(
                    'type'       => get_post_type(),
                    'order'      => 'ASC',
                    'hide_empty' => false
                  );
                  $tags = get_tags($args);
                  
                  foreach($terms as $term) { 
                    $title = $term->name;
                    $link  = get_tag_link( $term->term_id );

                    ?>
                    <a class="badge badge-white" href="<?= $link; ?>">
                      <svg
                        xmlns="http://www.w3.org/2000/svg"
                        x="0px"
                        y="0px"
                        width="16px"
                        height="27px"
                        viewBox="0 0 16 27"
                        enable-background="new 0 0 16 27"
                        xml:space="preserve"
                      >
                        <path
                          d="M0,0v6c4.142,0,7.5,3.358,7.5,7.5S4.142,21,0,21v6h16V0H0z"
                        ></path>
                      </svg>
                      <div><?= $title; ?></div>
                    </a>
                    <?php
                  }
                ?>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<?php get_footer(); ?>