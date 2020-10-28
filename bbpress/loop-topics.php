<?php

/**
 * Topics Loop
 *
 * @package bbPress
 * @subpackage Theme
 */

// Exit if accessed directly
defined( 'ABSPATH' ) || exit;


// Get Pinned Post Ids

$query = kab_help()->forum->getPinnedTopics( get_the_ID() );

$pinnedIds = []; 

if ( $query && $query->have_posts() ) :
    while ( $query->have_posts() ) : $query->the_post();
        $pinnedIds[] = get_the_ID();
    endwhile;
    wp_reset_postdata();
endif;
// 

echo '<pre style="display: none; ">';
var_dump($pinnedIds); 
echo '</pre>';

do_action( 'bbp_template_before_topics_loop' ); ?>

    <div class="forum__topics">
		<?php 
            while ( bbp_topics() ) : bbp_the_topic(); 
        
                $thisid = bbp_get_topic_id();
                $found = array_search($thisid, $pinnedIds); 
        
                if (!is_int($found)) {
                    echo '<span id="' . $found .  '"></span>';
                    bbp_get_template_part( 'loop', 'single-topic' );
                }
            
            endwhile; 
        ?>
    </div>

<?php do_action( 'bbp_template_after_topics_loop' );
