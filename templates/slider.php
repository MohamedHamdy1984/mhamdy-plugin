<?php

$args = [
    'post_type' => 'testimonial',
    'post_status' => 'publish',
    'posts_per_page' => 5,
    'meta_query' => [
        [
            'key' => '_mhamdy_testimonial_key',
            'value' => 's:8:"approved";i:1;s:8:"featured";i:1;',
            'compare' => 'LIKE'
        ]
    ]
];

$query = new WP_Query($args);

if ($query->have_posts()) :
    $i = 1;
    echo '<div class="mhamdy-slider--wrapper"><div class="mhamdy-slider--container">
        <div class="mhamdy-slider--view"><ul>';
    while ($query->have_posts()) : $query->the_post();
        $data = get_post_meta(get_the_ID(), '_mhamdy_testimonial_key', true);
        $name = $data['name'] ?? '';
        echo '<li class="mhamdy-slider--view__slides'.($i === 1 ?  ' is-active' : '').'"><p class="testimonial-qoute">"'.get_the_content().
            '"</p><p class="testimonial-author">~ '.$name.' ~</p></li>';
            $i++;
    endwhile;
    echo '</ul></div>
            <div class="mhamdy-slider--arrows">
                <span class="arrow mhamdy-slider--arrows__left">&#x3c;</span>
                <span class="arrow mhamdy-slider--arrows__right">&#x3e;</span>
            </div>
        </div></div>';
endif;

wp_reset_postdata();