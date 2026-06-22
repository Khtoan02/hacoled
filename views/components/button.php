<?php
/**
 * Reusable Button Component
 *
 * @var string $text
 * @var string $type
 * @var string $url
 * @var string $target
 * @var string $class
 */

$text        = $text ?? __('Nhấp vào đây', 'hacoled');
$type        = $type ?? 'primary';
$url         = $url ?? '#';
$target      = $target ?? '_self';
$extra_class = $class ?? '';

$base_classes = 'inline-flex items-center justify-center font-semibold rounded-lg text-sm transition-all duration-200 focus:outline-none';

$type_classes = [
    'primary'   => 'bg-gradient-to-r from-accent-red to-accent-rose text-white shadow-glow-red hover:shadow-red-500/30 transform hover:-translate-y-0.5 px-6 py-3',
    'secondary' => 'bg-slate-800 text-white border border-slate-700 hover:bg-slate-700/80 px-6 py-3',
    'outline'   => 'bg-transparent text-slate-200 border border-white/10 hover:border-accent-red hover:text-accent-red px-6 py-3',
    'glow'      => 'bg-transparent text-accent-red border border-accent-red/30 hover:bg-accent-red/10 px-6 py-3 led-glowing'
];

$classes = $base_classes . ' ' . ($type_classes[$type] ?? $type_classes['primary']) . ' ' . $extra_class;
?>

<a href="<?php echo esc_url($url); ?>" 
   target="<?php echo esc_attr($target); ?>" 
   class="<?php echo esc_attr($classes); ?>">
  <?php echo esc_html($text); ?>
</a>
