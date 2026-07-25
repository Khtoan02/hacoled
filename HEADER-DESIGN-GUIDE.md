# 🎨 Hướng Dẫn Thiết Kế Visual Header & Hệ Thống Nhận Diện HacoLED

Tài liệu này chi tiết hóa toàn bộ hệ thống thiết kế (Design System) của **Visual Header HacoLED**, bao gồm bảng màu chuẩn, hiệu ứng họa tiết **Trống Đồng Đông Sơn**, viền kim loại vàng hoàng gia và các quy tắc tái sử dụng cho các Section, Footer, Card khác trên toàn bộ website.

---

## 📌 1. Triết Lý Thiết Kế (Design Concept)

Visual Header của HacoLED được xây dựng theo phong cách **Premium Visual & Cultural Fusion**:
- **Tông màu chủ đạo**: Đỏ đô sơn thủy/huyết dụ gradient kết hợp sắc vàng hoàng gia (Gold/Amber accent).
- **Điểm nhấn văn hóa**: Họa tiết Trống Đồng Đông Sơn mạ vàng dạng watermark chìm phía sau logo và background header.
- **Trải nghiệm hiện đại**: Glassmorphism (kính mờ), micro-animations mượt mà, sticky collapse tự động khi cuộn trang.

---

## 🎨 2. Bảng Mã Màu & Gradient System

### 🔴 Gam Màu Đỏ Đô Header (Red Gradient)
Dùng cho background chính của Header, Banner hoặc các khối nổi bật (Hero/CTA Section).

| Thành phần | Mã màu / Class Tailwind | Mô tả |
| :--- | :--- | :--- |
| **Gradient Header** | `bg-gradient-to-r from-[#b31217] via-[#a30f14] to-[#8a0b10]` | Đỏ đô đậm có chiều sâu, tương phản cao |
| **Gradient Submenu** | `background: linear-gradient(180deg, #920d12 0%, #76090d 100%)` | Dành cho nền Dropdown & Mega Menu |
| **Mobile Header Bg** | `background: linear-gradient(90deg, #b31217, #8a0b10)` | Nền menu di động cố định |

### 🟡 Gam Màu Vàng Hoàng Gia (Gold Accent)
Dùng cho đường kẻ viền (Accent Line), Icon highlight, Badge, Text hover và đường chỉ gạch dưới (Underline).

| Thành phần | Mã màu / Class Tailwind | Hex Code |
| :--- | :--- | :--- |
| **Gold Primary (Sáng)** | `text-[#fbbf24]`, `bg-[#fbbf24]` | `#fbbf24` (Yellow 400 / Amber 400) |
| **Gold Deep (Đậm)** | `text-[#b45309]`, `border-[#b45309]` | `#b45309` (Amber 700) |
| **Gold Light (Ánh kim)** | `text-[#fffbeb]` | `#fffbeb` (Amber 50) |
| **Gold Dark Accent** | `text-[#78350f]` | `#78350f` (Amber 900) |

---

## 🥁 3. Họa Tiết Trống Đồng Đông Sơn (`.hdr-logo-ds`)

Họa tiết Trống Đồng là nhận diện cốt lõi của thương hiệu HacoLED.

### 📐 Thông số Kỹ thuật
- **File đường dẫn ảnh**: `assets/images/dongson-optimized.webp` (hoặc `assets/images/logo-haco.png` / SVG)
- **Kích thước chuẩn (Header)**: `580px × 580px`
- **Vị trí căn chỉnh**: Căn giữa tuyệt đối (`top: 50%`, `left: 50%`, `transform: translate(-50%, -50%)`)
- **Độ trong suốt (Opacity)**: 
  - Trạng thái thường: `opacity: 0.20` (`20%`)
  - Khi hover logo: `opacity: 0.28` (`28%`)

### ⚡ Filter Chuyển Màu Trống Đồng Sang Màu Vàng Ánh Kim (Gold Tint Filter)
Sử dụng CSS Filter để đổi họa tiết trống đồng gốc (xám/đen/trắng) thành **màu vàng ánh kim sang trọng** mà không cần sửa file ảnh gốc:

```css
.hdr-logo-ds {
  position: absolute;
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%);
  width: 580px;
  height: 580px;
  background-image: url('../images/dongson-optimized.webp');
  background-repeat: no-repeat;
  background-position: center;
  background-size: contain;
  opacity: 0.20;
  pointer-events: none;
  z-index: 0;
  /* Filter tạo màu vàng hoàng gia chuẩn HacoLED */
  filter: invert(80%) sepia(35%) saturate(1200%) hue-rotate(345deg) brightness(102%) contrast(98%);
  transition: opacity 0.35s ease;
}

.hdr-logo:hover .hdr-logo-ds {
  opacity: 0.28;
}
```

### 🌌 Background Grid Chấm Đốm Phụ (Dot Matrix Layer)
Nền đốm chòm sao công nghệ hiện đại kết hợp với Trống Đồng:

```css
.header-bg-dots {
  position: absolute;
  inset: 0;
  opacity: 0.06;
  background-image: radial-gradient(circle, #ffffff 1px, transparent 1px);
  background-size: 24px 24px;
  pointer-events: none;
}
```

---

## 👑 4. Nẹp Viền Kim Loại Vàng (Gold Metallic Accent Line)

Dùng đặt ở rìa trên hoặc rìa dưới của Header, Section Dividers, hoặc Footer top bar:

```html
<!-- Gold Metallic Line -->
<div class="h-[2px] w-full relative z-40" 
     style="background: linear-gradient(90deg, #b45309, #fbbf24, #fffbeb, #fbbf24, #b45309);">
</div>
```

Hoặc hiệu ứng phát sáng (Glow Accent Line):
```css
.gold-glow-line {
  height: 3px;
  background: linear-gradient(90deg, #78350f 0%, #fbbf24 25%, #fde68a 50%, #fbbf24 75%, #78350f 100%);
  box-shadow: 0 2px 14px rgba(251, 191, 36, 0.55);
}
```

---

## 💎 5. Ô Tìm Kiếm Glassmorphism & Badge Liên Hệ

### 🔍 Ô Tìm kiếm Kính Mờ (Glassmorphic Input)
```html
<form method="get" action="/" class="relative group">
  <input 
    type="search" 
    name="s" 
    placeholder="Tìm sản phẩm, giải pháp hiển thị, âm thanh..."
    class="w-full rounded-full pl-12 pr-10 py-3 text-[13px] text-white placeholder-white/70 focus:outline-none transition-all duration-300 focus:bg-black/20 border border-white/20 focus:border-[#fbbf24]"
    style="background: rgba(0, 0, 0, 0.12);" 
  />
  <span class="absolute left-4.5 top-1/2 -translate-y-1/2 text-white/60 pointer-events-none">
    <svg class="w-4.5 h-4.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
      <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.602 10.602z"/>
    </svg>
  </span>
</form>
```

### 📞 Hotline Badge Tròn (Circle Icon Badge)
```html
<a href="tel:0342324488" class="flex items-center gap-3 group">
  <div class="w-10 h-10 rounded-full flex items-center justify-center bg-white/10 group-hover:bg-white border border-white/30 transition-all duration-300 group-hover:scale-105">
    <svg class="w-4 h-4 text-white group-hover:text-[#b31217]" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
      <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 6.75c0 8.284 6.716 15 15 15h2.25a2.25 2.25 0 0 0 2.25-2.25v-1.372c0-.516-.351-.966-.852-1.091l-4.423-1.106c-.44-.11-.902.055-1.173.417l-.97 1.293c-2.824-1.802-5.127-4.106-6.93-6.93l1.293-.97c.363-.271.527-.734.417-1.173L6.963 3.102a1.125 1.125 0 0 0-1.091-.852H4.5A2.25 2.25 0 0 0 2.25 4.5v2.25z"/>
    </svg>
  </div>
  <div class="leading-tight">
    <span class="block text-[9px] font-bold uppercase tracking-widest text-[#fbbf24]">Hotline báo giá</span>
    <span class="block text-[15px] font-extrabold text-white font-display">034.232.4488</span>
  </div>
</a>
```

---

## 🛠️ 6. Hướng Dẫn Tái Sử Dụng Cho Các Section Khác

Muốn thiết kế Hero Banner, Section Khuyến Mãi, Section Giới Thiệu hoặc Footer mang cùng phong cách Visual Header:

### 1. Áp dụng Trống Đồng Chìm Cho Hero Section / Section Title
```html
<section class="relative overflow-hidden bg-gradient-to-r from-[#b31217] via-[#a30f14] to-[#8a0b10] text-white py-16">
  <!-- Trống Đồng Chìm làm background section -->
  <div class="hdr-logo-ds opacity-10 pointer-events-none"></div>

  <!-- Nền đốm công nghệ -->
  <div class="header-bg-dots"></div>

  <div class="relative z-10 max-w-6xl mx-auto px-4 text-center">
    <h2 class="text-3xl md:text-4xl font-extrabold text-white font-display">
      Màn Hình LED & Giải Pháp Hiển Thị <span class="text-[#fbbf24]">Hàng Đầu</span>
    </h2>
    <div class="mt-3 mx-auto h-[2px] w-24 bg-gradient-to-r from-transparent via-[#fbbf24] to-transparent"></div>
  </div>
</section>
```

### 2. Áp dụng Cho Footer
- Dùng **Gold Metallic Accent Line** ở phía trên cùng của Footer.
- Đặt họa tiết Trống Đồng chìm (`opacity: 0.08` đến `0.15`) phía sau Logo Footer hoặc chính giữa Footer.
- Dùng màu chữ chính là `text-white` và highlight link bằng `hover:text-[#fbbf24]`.

---

### 📂 File Tham Chiếu Code
- Mã nguồn Header: [header-default.php](file:///c:/laragon/www/HacoLED/wp-content/themes/hacoled/views/components/headers/header-default.php)
- File CSS Tailwind: [tailwind.css](file:///c:/laragon/www/HacoLED/wp-content/themes/hacoled/src/css/tailwind.css)
