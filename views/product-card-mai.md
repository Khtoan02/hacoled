import React from 'react';
import { Star, ShoppingBag, ArrowRight } from 'lucide-react';

const ProductCard = ({ category, title, oldPrice, price, image, isHot, reviews, inStock }) => {
  return (
    <div className="flex flex-col bg-white rounded-[1.25rem] shadow-[0_2px_12px_rgba(0,0,0,0.04)] border border-gray-200/70 overflow-hidden hover:shadow-[0_12px_32px_rgba(0,0,0,0.08)] transition-all duration-300 w-full max-w-[380px] h-full mx-auto group">
      
      {/* Khu vực Hình ảnh */}
      <div className="relative w-full pt-[65%] bg-gray-50 overflow-hidden shrink-0">
        <img 
          src={image} 
          alt={title} 
          className="absolute inset-0 w-full h-full object-cover group-hover:scale-105 transition-transform duration-700 ease-out"
          onError={(e) => {
            e.target.src = 'https://placehold.co/600x400/f8fafc/94a3b8?text=Image';
          }}
        />
        {isHot && (
          <div className="absolute top-3 right-3 bg-[#c8102e] text-white text-[10px] font-bold px-2.5 py-1 rounded-full uppercase tracking-widest shadow-sm">
            Hot Sale
          </div>
        )}
      </div>

      {/* Khu vực Nội dung */}
      <div className="p-4 sm:p-5 flex flex-col flex-grow">
        
        {/* Nhóm nội dung phía trên: Xếp sát nhau tự nhiên, không ép cứng chiều cao */}
        <div className="flex flex-col gap-3">
          {/* Header: Category & Title */}
          <div>
            <div className="text-[10px] font-bold text-gray-400 uppercase tracking-[0.15em] mb-1">
              {category}
            </div>
            <h3 className="text-[1.15rem] font-bold text-gray-900 tracking-tight leading-snug line-clamp-2">
              {title}
            </h3>
          </div>

          {/* Text Mô tả (Yếu tố 1) */}
          <p className="text-[12.5px] text-gray-500 leading-relaxed line-clamp-2">
            Phục vụ <strong className="text-gray-700 font-semibold">tận tâm, nhanh chóng</strong> và <strong className="text-gray-700 font-semibold">trọn vẹn</strong> trong suốt quá trình trải nghiệm sản phẩm.
          </p>

          {/* Thẻ Tags (Yếu tố 2, 3, 4) */}
          <div className="flex flex-wrap gap-1.5">
            <span className="bg-gray-50 border border-gray-200/80 text-gray-600 text-[11px] font-semibold px-2.5 py-1.5 rounded-full whitespace-nowrap shadow-sm">
              Hàng chính hãng
            </span>
            <span className="bg-gray-50 border border-gray-200/80 text-gray-600 text-[11px] font-semibold px-2.5 py-1.5 rounded-full whitespace-nowrap shadow-sm">
              Xuất xứ rõ ràng
            </span>
            <span className="bg-gray-50 border border-gray-200/80 text-gray-600 text-[11px] font-semibold px-2.5 py-1.5 rounded-full whitespace-nowrap shadow-sm">
              Bảo hành chính hãng
            </span>
          </div>
        </div>

        {/* Khu vực Giá & Hành động: Dùng mt-auto để dồn khoảng trống xuống đây */}
        <div className="mt-auto pt-6">
          {/* Dùng flex-wrap và thu nhỏ padding/font để giá không bao giờ bị nút bấm đè lên */}
          <div className="flex flex-wrap items-center justify-between mb-4 gap-x-2 gap-y-3">
            <div className="flex flex-col shrink-0">
              <span className="text-[12px] text-gray-400 line-through mb-0.5 font-medium tracking-wide">
                {oldPrice}
              </span>
              <span className="text-[1.25rem] sm:text-[1.3rem] font-black text-gray-900 leading-none tracking-tight">
                {price}
              </span>
            </div>
            
            <button className="bg-[#1a1a1a] hover:bg-black text-white text-[11.5px] font-bold px-3 py-[9px] rounded-[0.5rem] flex items-center justify-center gap-1.5 transition-all active:scale-95 shadow-md shrink-0 ml-auto">
              <span className="whitespace-nowrap">Liên hệ báo giá</span>
              <ShoppingBag className="w-3.5 h-3.5 shrink-0" />
            </button>
          </div>

          {/* Footer Card: Reviews & Status */}
          <div className="flex items-center justify-between pt-3.5 border-t border-gray-100">
            <div className="flex items-center gap-2">
              <div className="flex gap-[1px]">
                {[1, 2, 3, 4, 5].map((star) => (
                  <Star key={star} className="w-3.5 h-3.5 text-[#facc15] fill-[#facc15]" />
                ))}
              </div>
              <span className="text-[11px] text-gray-500 font-medium">{reviews} Đánh giá</span>
            </div>
            <span className={`text-[11px] font-bold uppercase tracking-wider ${inStock ? 'text-emerald-500' : 'text-red-500'}`}>
              {inStock ? 'Sẵn hàng' : 'Liên hệ kho'}
            </span>
          </div>
        </div>

      </div>
    </div>
  );
};

// Component App hiển thị Demo
export default function App() {
  const products = [
    {
      id: 1,
      category: "Màn hình Hiệu suất cao",
      title: "Màn hình ghép Video Wall X-Pro",
      oldPrice: "50.500.000 ₫",
      price: "45.900.000 ₫",
      image: "https://images.unsplash.com/photo-1593640408182-31c70c8268f5?auto=format&fit=crop&q=80&w=800",
      isHot: true,
      reviews: 245,
      inStock: true
    },
    {
      id: 2,
      category: "Màn hình LED Indoor",
      title: "Màn hình LED Cao cấp P2.5",
      oldPrice: "18.000.000 ₫",
      price: "15.500.000 ₫",
      image: "https://images.unsplash.com/photo-1542204165-65bf26472b9b?auto=format&fit=crop&q=80&w=800",
      isHot: false,
      reviews: 182,
      inStock: true
    },
    {
      id: 3,
      category: "Màn hình LED Outdoor",
      title: "Màn hình LED Chống nước IP65",
      oldPrice: "26.000.000 ₫",
      price: "22.000.000 ₫",
      image: "https://images.unsplash.com/photo-1517502884422-41eaead166d4?auto=format&fit=crop&q=80&w=800",
      isHot: true,
      reviews: 94,
      inStock: false
    }
  ];

  return (
    <div className="min-h-screen bg-[#f3f4f6] p-6 md:p-12 font-sans flex items-center">
      <div className="max-w-[1200px] mx-auto w-full">
        {/* Lưới sản phẩm dùng CSS Grid với chiều cao bằng nhau */}
        <div className="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 lg:gap-8 items-stretch">
          {products.map((product) => (
            <ProductCard key={product.id} {...product} />
          ))}
        </div>
      </div>
    </div>
  );
}