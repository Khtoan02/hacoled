# HacoLED Visual Standard

File này là quy chuẩn visual ngắn cho `hacoled_theme`. Khi thiết kế section, component hoặc page mới, ưu tiên dùng token/class dưới đây thay vì hard-code màu riêng.

## Brand Palette

| Vai trò | Token Tailwind | CSS variable | Hex | Cách dùng |
| --- | --- | --- | --- | --- |
| Đỏ chủ đạo | `haco-red`, `brand-red` | `--haco-red` | `#B31217` | CTA, icon active, badge chính, border nhấn |
| Đỏ sáng | `haco-redHot`, `brand-hotRed` | `--haco-red-hot` | `#E60000` | Điểm nhấn mạnh, gradient start, hover nổi bật |
| Đỏ sâu | `haco-redDeep`, `brand-darkRed` | `--haco-red-deep` | `#8A0B10` | Chỉ dùng làm neo gradient, không dùng làm nền phẳng lớn |
| Vàng thương hiệu | `haco-gold`, `brand-gold`, `accent-gold` | `--haco-gold` | `#FBBF24` | Gold line, chip premium, highlight số liệu |
| Nền sáng | `haco-surface`, `brand-bg` | `--haco-surface` | `#F8F6F5` | Page background, section nền sáng |
| Mực chữ | `haco-ink`, `brand-text` | `--haco-ink` | `#1C0505` | Heading/text tối, không dùng làm brand panel lớn |
| Chữ phụ | `haco-muted`, `brand-muted` | `--haco-muted` | `#5C3030` | Excerpt, mô tả, metadata |

## Utility Classes

- `haco-brand-shell`: nền đỏ chính của header/footer. Dùng cho wrapper lớn cần đồng bộ visual thương hiệu.
- `haco-brand-panel`: nền đỏ cao cấp cho hero, CTA panel, event panel, mobile drawer. Có red-hot, brand red, gold glow.
- `haco-brand-panel-soft`: nền đỏ nhẹ hơn cho panel phụ.
- `haco-gold-line`: đường line vàng ở header/footer hoặc divider premium.
- `haco-brand-grid`: lớp grid sáng rất nhẹ đặt trên panel đỏ khi cần chiều sâu.

## Rules

1. Không dùng `brand-text`, `#1C0505`, `#3a0606`, `#5a0c0c`, `#6b0509` làm nền lớn. Các màu này chỉ nên là chữ tối hoặc shadow/overlay rất nhẹ.
2. Nền đỏ lớn phải dùng `haco-brand-shell`, `haco-brand-panel` hoặc `haco-brand-panel-soft`.
3. Header, footer, mobile drawer và CTA đỏ phải cùng hệ đỏ `#E60000 -> #B31217 -> #8A0B10`.
4. Card nội dung trên nền sáng nên dùng trắng/kem, border slate nhẹ, nhấn bằng `brand-red` và `brand-gold`.
5. Ảnh bài viết/blog ưu tiên tỷ lệ 16:9 hoặc 16:10; tránh crop vuông cho thumbnail bài viết.
6. Vàng chỉ dùng làm accent cao cấp: line, chip, số liệu, icon nhỏ. Không dùng vàng làm nền section lớn.

## Component Recipe

```html
<section class="rounded-3xl haco-brand-panel border border-brand-gold/20 text-white">
  <div class="absolute inset-0 haco-brand-grid opacity-40"></div>
  <!-- content -->
</section>
```

Với card trắng:

```html
<article class="rounded-3xl border border-slate-200 bg-white/85 shadow-sm">
  <!-- content -->
</article>
```
