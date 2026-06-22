<?php
/**
 * Display single product reviews (comments)
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product-reviews.php.
 *
 * @see     https://woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 9.7.0
 */

defined( 'ABSPATH' ) || exit;

global $product;

if ( ! comments_open() ) {
	return;
}

$count = $product->get_review_count();
$average = $product->get_average_rating();

// Get comments/reviews data for JS filtering & listing
$comments_data = [];
$comments = get_comments(array('post_id' => $product->get_id(), 'status' => 'approve'));

$rates = array(5 => 0, 4 => 0, 3 => 0, 2 => 0, 1 => 0);

foreach($comments as $comment) {
    $rating = intval(get_comment_meta($comment->comment_ID, 'rating', true));
    if ($rating >= 1 && $rating <= 5) {
        $rates[$rating]++;
    }
    
    // Get avatar URL
    $avatar_url = get_avatar_url($comment, array('size' => 48));
    
    $comments_data[] = [
        'id' => $comment->comment_ID,
        'author' => get_comment_author($comment),
        'date' => get_comment_date('', $comment),
        'rating' => $rating,
        'content' => wpautop(get_comment_text($comment)),
        'avatar' => $avatar_url ? $avatar_url : ''
    ];
}
?>
<div id="reviews" class="woocommerce-Reviews text-slate-800" 
     x-data="{
        allReviews: <?php echo esc_attr(json_encode($comments_data)); ?>,
        selectedStar: null,
        limit: 3,
        get filteredReviews() {
            if (this.selectedStar === null) {
                return this.allReviews;
            }
            return this.allReviews.filter(r => r.rating === this.selectedStar);
        },
        get visibleReviews() {
            return this.filteredReviews.slice(0, this.limit);
        },
        selectStarFilter(star) {
            if (this.selectedStar === star) {
                this.selectedStar = null; // Toggle off if clicked again
            } else {
                this.selectedStar = star;
            }
            this.limit = 3; // Reset limit on filter change
        }
     }">
     
    <!-- SEO Fallback: Raw HTML output for Search Engines -->
    <noscript>
        <div class="hidden">
            <?php if ( have_comments() ) : ?>
                <ol class="commentlist">
                    <?php wp_list_comments( apply_filters( 'woocommerce_product_review_list_args', array( 'callback' => 'woocommerce_comments' ) ) ); ?>
                </ol>
            <?php endif; ?>
        </div>
    </noscript>

    <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 mb-10">
        <!-- Left Column: Rating Summary & Breakdown -->
        <div class="lg:col-span-4 bg-slate-50/60 rounded-2xl p-6 border border-slate-100 h-fit lg:sticky lg:top-24 flex flex-col items-center justify-center text-center">
            <h3 class="text-xs font-bold text-gray-500 uppercase tracking-wider mb-2">Đánh giá trung bình</h3>
            <div class="text-5xl font-extrabold text-slate-900 leading-none mb-3">
                <?php echo number_format( $average, 1 ); ?>
            </div>
            
            <!-- Stars -->
            <div class="flex items-center gap-1 mb-2">
                <?php
                $full_stars = floor($average);
                $half_star = ($average - $full_stars) >= 0.5 ? 1 : 0;
                $empty_stars = 5 - $full_stars - $half_star;

                for ($i = 0; $i < $full_stars; $i++) {
                    echo '<i class="ph-fill ph-star text-xl text-amber-500"></i>';
                }
                if ($half_star) {
                    echo '<i class="ph-fill ph-star-half text-xl text-amber-500"></i>';
                }
                for ($i = 0; $i < $empty_stars; $i++) {
                    echo '<i class="ph-bold ph-star text-xl text-slate-200"></i>';
                }
                ?>
            </div>
            
            <p class="text-xs text-slate-500 font-medium mb-6">
                Dựa trên <?php echo esc_html( $count ); ?> đánh giá từ khách hàng
            </p>
            
            <!-- Interactive breakdown progress bars -->
            <div class="w-full space-y-2.5 text-xs">
                <?php
                for($i = 5; $i >= 1; $i--) {
                    $percentage = $count > 0 ? round(($rates[$i] / $count) * 100) : 0;
                    ?>
                    <button @click="selectStarFilter(<?php echo $i; ?>)" 
                            class="w-full flex items-center gap-2 text-left p-1.5 rounded-lg hover:bg-slate-100 transition-colors group focus:outline-none"
                            :class="selectedStar === <?php echo $i; ?> ? 'bg-slate-100/80 font-bold ring-1 ring-slate-200' : ''">
                        <span class="w-3 text-right font-semibold text-slate-600 group-hover:text-[#D90429]"><?php echo $i; ?></span>
                        <i class="ph-fill ph-star text-amber-500"></i>
                        <div class="flex-1 h-2 bg-slate-200/80 rounded-full overflow-hidden">
                            <div class="h-full bg-amber-500 rounded-full group-hover:bg-[#D90429] transition-colors" style="width: <?php echo $percentage; ?>%"></div>
                        </div>
                        <span class="w-10 text-right text-slate-500 font-medium group-hover:text-slate-700" :class="selectedStar === <?php echo $i; ?> ? 'text-[#D90429]' : ''">
                            <?php echo $rates[$i]; ?> (<?php echo $percentage; ?>%)
                        </span>
                    </button>
                    <?php
                }
                ?>
            </div>
            
            <!-- Clear Filter Button -->
            <button x-show="selectedStar !== null" 
                    @click="selectedStar = null" 
                    class="mt-4 text-xs font-semibold text-[#D90429] hover:underline flex items-center gap-1">
                <i class="ph-bold ph-x-circle"></i> Xóa bộ lọc
            </button>
        </div>

        <!-- Right Column: Review List & Call to Action -->
        <div class="lg:col-span-8 flex flex-col justify-between">
            <div id="comments" class="space-y-6">
                <!-- Filter Tabs for quick desktop view -->
                <div class="flex flex-wrap items-center gap-2 border-b border-slate-100 pb-4">
                    <span class="text-xs font-bold text-slate-400 uppercase tracking-wider mr-2">Lọc theo:</span>
                    <button @click="selectedStar = null" 
                            class="px-3 py-1.5 rounded-full text-xs font-semibold border transition-all"
                            :class="selectedStar === null ? 'bg-[#D90429] text-white border-transparent' : 'bg-white text-slate-600 border-slate-200 hover:border-slate-300'">
                        Tất cả (<?php echo esc_html($count); ?>)
                    </button>
                    <template x-for="star in [5, 4, 3, 2, 1]">
                        <button @click="selectStarFilter(star)" 
                                class="px-3 py-1.5 rounded-full text-xs font-semibold border transition-all flex items-center gap-1"
                                :class="selectedStar === star ? 'bg-[#D90429] text-white border-transparent' : 'bg-white text-slate-600 border-slate-200 hover:border-slate-300'">
                            <span x-text="star"></span> <i class="ph-fill ph-star text-amber-500" :class="selectedStar === star ? 'text-white' : ''"></i>
                        </button>
                    </template>
                </div>

                <!-- Review list container -->
                <div>
                    <!-- Empty State -->
                    <template x-if="filteredReviews.length === 0">
                        <div class="text-center py-10 bg-slate-50/50 rounded-2xl border border-dashed border-slate-200">
                            <i class="ph-bold ph-chat-circle-dots text-4xl text-slate-300 mb-3 block"></i>
                            <p class="text-slate-500 text-sm">Không tìm thấy đánh giá phù hợp.</p>
                        </div>
                    </template>

                    <!-- Rendered List -->
                    <ul class="divide-y divide-slate-100">
                        <template x-for="review in visibleReviews" :key="review.id">
                            <li class="py-5 flex items-start gap-4">
                                <div class="flex-shrink-0">
                                    <template x-if="review.avatar">
                                        <img :src="review.avatar" class="w-12 h-12 rounded-full border border-slate-100 shadow-sm object-cover" />
                                    </template>
                                    <template x-if="!review.avatar">
                                        <div class="w-12 h-12 rounded-full bg-slate-100 border border-slate-200 flex items-center justify-center text-slate-600 font-bold text-lg uppercase" x-text="review.author.charAt(0)"></div>
                                    </template>
                                </div>
                                <div class="flex-1 min-w-0">
                                    <div class="flex items-center justify-between gap-2 mb-1">
                                        <h4 class="text-sm font-bold text-slate-900 truncate" x-text="review.author"></h4>
                                        <time class="text-xs text-slate-400 font-medium" x-text="review.date"></time>
                                    </div>
                                    
                                    <!-- Stars -->
                                    <div class="flex items-center gap-0.5 mb-2">
                                        <template x-for="i in 5">
                                            <i class="ph-fill ph-star text-xs" :class="i <= review.rating ? 'text-amber-500' : 'text-slate-200'"></i>
                                        </template>
                                    </div>

                                    <!-- Content -->
                                    <div class="text-sm text-slate-600 leading-relaxed pr-2 prose prose-sm max-w-none" x-html="review.content"></div>
                                </div>
                            </li>
                        </template>
                    </ul>

                    <!-- "Show More Reviews" Button -->
                    <div x-show="filteredReviews.length > limit" class="text-center mt-6 pt-4 border-t border-slate-100">
                        <button @click="limit += 5" 
                                class="inline-flex items-center gap-1.5 text-xs font-bold text-[#D90429] hover:text-red-700 transition-colors uppercase tracking-wider">
                            <span>Xem thêm đánh giá</span>
                            <i class="ph-bold ph-caret-down"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Review Form Section -->
    <?php if ( get_option( 'woocommerce_review_rating_verification_required' ) === 'no' || wc_customer_bought_product( '', get_current_user_id(), $product->get_id() ) ) : ?>
        <div id="review_form_wrapper" class="border-t border-slate-100 pt-8 mt-8" x-data="{ rating: 5, hoverRating: 0 }">
            <div id="review_form" class="max-w-3xl">
                <h3 class="text-base font-bold text-slate-900 mb-6 flex items-center gap-2">
                    <i class="ph-bold ph-pencil-line text-[#D90429]"></i>
                    <span>Viết đánh giá của bạn</span>
                </h3>
                
                <?php
                $commenter    = wp_get_current_commenter();
                $name_email_required = (bool) get_option( 'require_name_email', 1 );
                
                // Form setup
                ob_start();
                ?>
                <form action="<?php echo esc_url( site_url( '/wp-comments-post.php' ) ); ?>" method="post" id="commentform" class="space-y-6">
                    
                    <!-- Star Rating Interactive Selector -->
                    <?php if ( wc_review_ratings_enabled() ) : ?>
                        <div class="space-y-2">
                            <label class="block text-sm font-semibold text-slate-700">Đánh giá của bạn <span class="text-red-500">*</span></label>
                            <div class="flex items-center gap-1.5">
                                <template x-for="i in 5">
                                    <button type="button" 
                                            @click="rating = i" 
                                            @mouseenter="hoverRating = i" 
                                            @mouseleave="hoverRating = 0"
                                            class="p-0.5 focus:outline-none transition-transform hover:scale-110">
                                        <i class="ph-fill ph-star text-3xl transition-colors duration-150"
                                           :class="(hoverRating ? i <= hoverRating : i <= rating) ? 'text-amber-500' : 'text-slate-200'"></i>
                                    </button>
                                </template>
                            </div>
                            <!-- Hidden input for standard form submission -->
                            <input type="hidden" name="rating" :value="rating" required />
                        </div>
                    <?php endif; ?>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <!-- Author -->
                        <div class="space-y-1.5">
                            <label for="author" class="block text-sm font-semibold text-slate-700">Họ và tên <?php echo $name_email_required ? '<span class="text-red-500">*</span>' : ''; ?></label>
                            <input id="author" name="author" type="text" value="<?php echo esc_attr($commenter['comment_author']); ?>" <?php echo $name_email_required ? 'required' : ''; ?>
                                   class="w-full px-4 py-2.5 rounded-xl border border-slate-200 text-sm focus:outline-none focus:border-[#D90429] focus:ring-2 focus:ring-red-100 transition-all placeholder-slate-400" placeholder="Nguyễn Văn A" />
                        </div>
                        
                        <!-- Email -->
                        <div class="space-y-1.5">
                            <label for="email" class="block text-sm font-semibold text-slate-700">Địa chỉ email <?php echo $name_email_required ? '<span class="text-red-500">*</span>' : ''; ?></label>
                            <input id="email" name="email" type="email" value="<?php echo esc_attr($commenter['comment_author_email']); ?>" <?php echo $name_email_required ? 'required' : ''; ?>
                                   class="w-full px-4 py-2.5 rounded-xl border border-slate-200 text-sm focus:outline-none focus:border-[#D90429] focus:ring-2 focus:ring-red-100 transition-all placeholder-slate-400" placeholder="name@example.com" />
                        </div>
                    </div>

                    <!-- Comment textarea -->
                    <div class="space-y-1.5">
                        <label for="comment" class="block text-sm font-semibold text-slate-700">Nội dung đánh giá <span class="text-red-500">*</span></label>
                        <textarea id="comment" name="comment" rows="5" required
                                  class="w-full px-4 py-3 rounded-xl border border-slate-200 text-sm focus:outline-none focus:border-[#D90429] focus:ring-2 focus:ring-red-100 transition-all placeholder-slate-400" placeholder="Chia sẻ trải nghiệm thực tế của bạn về sản phẩm này..."></textarea>
                    </div>

                    <!-- Submit -->
                    <div class="pt-2">
                        <button type="submit" name="submit" id="submit" 
                                class="inline-flex items-center justify-center px-6 py-3 bg-[#D90429] hover:bg-[#b90323] text-white font-bold text-sm uppercase tracking-wider rounded-xl shadow-lg shadow-red-500/10 hover:shadow-red-500/20 hover:-translate-y-0.5 transition-all duration-200">
                            Gửi đánh giá
                        </button>
                    </div>

                    <?php comment_id_fields(); ?>
                    <?php do_action( 'comment_form', $product->get_id() ); ?>
                </form>
                <?php
                $form_html = ob_get_clean();
                
                // Render form using comment_form overrides
                comment_form( array(
                    'title_reply'          => '',
                    'title_reply_before'   => '',
                    'title_reply_after'    => '',
                    'format'               => 'html5',
                    'class_form'           => 'hidden', // Hide the default form output of comment_form()
                ));
                
                // Echo our beautiful custom form
                echo $form_html;
                ?>
            </div>
        </div>
    <?php else : ?>
        <div class="bg-amber-50 border border-amber-200 rounded-xl p-4 mt-8 flex items-center gap-3">
            <i class="ph-bold ph-warning-circle text-xl text-amber-600"></i>
            <p class="text-sm text-amber-800">
                <?php esc_html_e( 'Only logged in customers who have purchased this product may leave a review.', 'woocommerce' ); ?>
            </p>
        </div>
    <?php endif; ?>
    
    <div class="clear"></div>
</div>
