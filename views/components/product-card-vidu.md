import React, { useState } from 'react';
import { ArrowUpRight, ShieldCheck, Star, CheckCircle2 } from 'lucide-react';

const ProductCard = () => {
  const [isHovered, setIsHovered] = useState(false);

  // Dữ liệu mẫu được cập nhật với hình ảnh mới và danh sách tag rút gọn
  const project = {
    name: "Màn Hình LED All-in-One Hikvision",
    description: "Giải pháp hiển thị tích hợp hoàn chỉnh với viền zero-bezel siêu mỏng. Mang đến trải nghiệm thị giác liền mạch, hoàn hảo cho không gian hội nghị và sảnh chính cao cấp.",
    tags: ["Bảo Hành 24-36 Tháng", "CO/CQ", "Bền Bỉ 24/7", "Dành Cho Dự Án"],
    image: "https://vph.com.vn/storage/uploads/noidung/man-hinh-led-hikvision-ds-d4425fi-ckf-0.png"
  };

  return (
    <div 
      className="relative group w-full max-w-[400px] h-[520px] rounded-[2rem] transition-all duration-700 perspective-1000"
      onMouseEnter={() => setIsHovered(true)}
      onMouseLeave={() => setIsHovered(false)}
    >
      {/* Lớp hào quang phía sau thẻ, tỏa sáng khi hover */}
      <div className="absolute -inset-0.5 rounded-[2rem] bg-gradient-to-br from-[#E3000F]/30 via-transparent to-[#D4AF37]/30 opacity-0 blur-2xl transition-all duration-700 group-hover:opacity-100 group-hover:duration-500"></div>

      {/* Background chính của thẻ */}
      <div className="absolute inset-0 rounded-[2rem] bg-white/60 backdrop-blur-2xl border border-white/80 overflow-hidden shadow-[0_20px_50px_rgba(0,0,0,0.05)] transition-all duration-700 group-hover:border-white group-hover:bg-white/80 group-hover:shadow-[0_30px_60px_rgba(0,0,0,0.1)]">
        
        {/* Điểm nhấn gradient nhẹ ở góc */}
        <div className="absolute top-0 right-0 w-64 h-64 bg-[#E3000F]/5 rounded-full blur-[80px] -translate-y-1/2 translate-x-1/2"></div>
        <div className="absolute bottom-0 left-0 w-64 h-64 bg-[#D4AF37]/5 rounded-full blur-[80px] translate-y-1/2 -translate-x-1/2"></div>

        {/* Layout hiển thị hình ảnh và các tag nổi */}
        <div className="absolute inset-0 p-8 pb-44 flex items-center justify-center z-10">
          <div className="relative w-full h-full flex items-center justify-center">
            {/* Vòng tròn trang trí mờ nhạt phía sau sản phẩm */}
            <div className="absolute w-[250px] h-[250px] rounded-full border border-gray-200/50 bg-gray-50/50 transition-transform duration-1000 ease-out group-hover:scale-110"></div>
            
            <img 
              src={project.image} 
              alt={project.name}
              // Sử dụng object-contain để đảm bảo hiển thị đầy đủ ảnh vuông
              className="relative z-10 w-full h-full object-contain filter drop-shadow-[0_20px_30px_rgba(0,0,0,0.15)] transition-all duration-700 ease-out group-hover:-translate-y-8 group-hover:scale-110"
            />

            {/* Các tag đặc biệt nằm lơ lửng trên ảnh */}
            <div className="absolute top-0 left-0 z-20 flex flex-col gap-2">
              {/* Tag "Chính Hãng" - Nổi bật nhất */}
              <span className="px-3 py-1.5 text-[11px] font-extrabold tracking-wider text-white bg-gradient-to-r from-[#E3000F] to-[#ff4d4d] rounded-full flex items-center gap-1.5 uppercase shadow-[0_4px_15px_rgba(227,0,15,0.4)] border border-[#E3000F]/30 backdrop-blur-md">
                <ShieldCheck size={14} />
                Chính Hãng
              </span>
              
              {/* Tag "5 Sao" */}
              <span className="px-2.5 py-1 text-[10px] font-bold tracking-wider text-[#A67C00] bg-[#D4AF37]/20 border border-[#D4AF37]/40 rounded-full flex items-center gap-1 uppercase backdrop-blur-md w-fit">
                <Star size={12} className="text-[#D4AF37] fill-[#D4AF37]" />
                5 Sao
              </span>
            </div>
          </div>
        </div>

        {/* Bảng thông tin bên dưới */}
        <div className="absolute bottom-4 left-4 right-4 z-20">
          <div className="relative bg-white/70 backdrop-blur-xl border border-white rounded-3xl p-5 overflow-hidden transition-all duration-500 shadow-[0_10px_40px_rgba(0,0,0,0.05)] group-hover:bg-white/95 group-hover:shadow-[0_15px_50px_rgba(0,0,0,0.1)]">
            
            {/* Lớp phủ gradient mỏng tạo chiều sâu */}
            <div className="absolute inset-0 bg-gradient-to-t from-white/80 to-transparent pointer-events-none"></div>

            <div className="relative flex flex-col gap-3">
              
              {/* Các tag tĩnh còn lại */}
              <div className="flex flex-wrap gap-1.5">
                {project.tags.map((tag, index) => (
                  <span key={index} className="px-2 py-1 text-[8.5px] font-semibold tracking-wider text-gray-600 bg-gray-50/80 border border-gray-200/80 rounded-full flex items-center gap-1 uppercase transition-colors hover:bg-gray-100">
                    <CheckCircle2 size={9} className="text-green-500" />
                    {tag}
                  </span>
                ))}
              </div>

              <div className="flex items-start justify-between gap-4 mt-1">
                <div className="flex-1">
                  <h3 className="text-lg font-bold text-gray-900 leading-snug tracking-wide group-hover:text-transparent group-hover:bg-clip-text group-hover:bg-gradient-to-r group-hover:from-[#E3000F] group-hover:to-[#ff4d4d] transition-all duration-300">
                    {project.name}
                  </h3>
                  
                  {/* Animation mở rộng mô tả */}
                  <div className={`grid transition-all duration-500 ease-[cubic-bezier(0.4,0,0.2,1)] ${isHovered ? 'grid-rows-[1fr] opacity-100 mt-2' : 'grid-rows-[0fr] opacity-0 mt-0'}`}>
                    <p className="text-xs text-gray-600 font-medium leading-relaxed overflow-hidden">
                      {project.description}
                    </p>
                  </div>
                </div>

                {/* Nút xem chi tiết */}
                <button className="flex-shrink-0 w-10 h-10 flex items-center justify-center rounded-2xl bg-gray-100 border border-gray-200 text-gray-600 transition-all duration-300 hover:bg-[#E3000F] hover:border-[#E3000F] hover:text-white hover:shadow-[0_0_20px_rgba(227,0,15,0.3)] group-hover:scale-105">
                  <ArrowUpRight size={18} className="transition-transform duration-300 group-hover:rotate-12" />
                </button>
              </div>
            </div>

          </div>
        </div>
      </div>
    </div>
  );
};

export default function App() {
  return (
    // Nền sáng đặc trưng
    <div className="min-h-screen bg-[#f4f6f8] flex flex-col items-center justify-center p-4 font-sans selection:bg-[#E3000F]/20 selection:text-[#E3000F] overflow-hidden relative">
      
      {/* Họa tiết lưới mờ (Grid) ở nền */}
      <div className="absolute inset-0 pointer-events-none opacity-40">
        <div className="w-full h-full bg-[linear-gradient(to_right,#0000000a_1px,transparent_1px),linear-gradient(to_bottom,#0000000a_1px,transparent_1px)] bg-[size:40px_40px]"></div>
      </div>

      <ProductCard />
    </div>
  );
}