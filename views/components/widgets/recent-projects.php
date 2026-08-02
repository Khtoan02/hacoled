<?php
/**
 * Reusable Sidebar Widget: Recent Featured Projects
 */
$projects_query = new WP_Query( array(
    'post_type'      => 'post',
    'posts_per_page' => 3,
    'category_name'  => 'du-an-tieu-bieu-moi',
) );
if ( !$projects_query->have_posts() ) {
    $projects_query = new WP_Query( array(
        'post_type'      => 'post',
        'posts_per_page' => 3,
        'category_name'  => 'projects,du-an,hang-muc-da-thi-cong',
    ) );
}
?>
<div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-5">
    <h3 class="text-sm font-bold text-gray-900 pb-3 border-b border-gray-100 mb-4 flex items-center gap-2">
        <i class="ph-bold ph-monitor text-[#D90429]"></i>
        Dự án mới thi công
    </h3>
    <div class="space-y-4">
        <?php
        if ( $projects_query->have_posts() ) :
            while ( $projects_query->have_posts() ) : $projects_query->the_post();
                ?>
                <div class="flex items-center gap-3 group">
                    <a href="<?php the_permalink(); ?>" class="w-14 h-10 rounded overflow-hidden flex-shrink-0 bg-gray-50">
                        <?php 
                        if ( has_post_thumbnail() ) {
                            the_post_thumbnail( 'thumbnail', array( 'class' => 'w-full h-full object-cover transition-transform duration-300 group-hover:scale-110' ) );
                        } else {
                            echo '<div class="w-full h-full bg-slate-50 flex items-center justify-center"><i class="ph-bold ph-image text-slate-350 text-sm"></i></div>';
                        }
                        ?>
                    </a>
                    <div class="min-w-0 flex-1">
                        <a href="<?php the_permalink(); ?>" class="text-[11px] font-bold text-gray-800 hover:text-[#D90429] transition-colors line-clamp-2 leading-tight">
                            <?php the_title(); ?>
                        </a>
                    </div>
                </div>
                <?php
            endwhile;
            wp_reset_postdata();
        else :
            echo '<p class="text-xs text-gray-400">Không có dự án mới.</p>';
        endif;
        ?>
    </div>
</div>
