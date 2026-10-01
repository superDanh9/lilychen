<?php
/**
 * Template Name: Khóa Học Trang Điểm Chuyên Nghiệp
 * Template Post Type: page
 *
 * Mẫu trang riêng cho đường dẫn /khoa-hoc-trang-diem-chuyen-nghiep/.
 * Chuyển giao trực tiếp 100% từ khoa-hoc-trang-diem-chuyen-nghiep/index.html đã duyệt.
 * Bảo toàn thiết kế, lộ trình 12 tuần, 3 quà tặng, tác phẩm thực chiến và form mô phỏng.
 *
 * @package LilyChen_Academy
 */

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

get_header();
?>

<script type="application/ld+json">
  {
    "@context": "https://schema.org",
    "@type": "Course",
    "name": "Khóa Học Trang Điểm Chuyên Nghiệp (Makeup Artist)",
    "description": "Lộ trình đào tạo bài bản 2-3 tháng từ Lily Chen Academy — 80% thực chiến trên mẫu thật, du học chuẩn Nhật Bản. Sẵn sàng nhận show, mở tiệm ngay sau tốt nghiệp.",
    "provider": {
      "@type": "EducationalOrganization",
      "name": "Lily Chen Makeup Academy",
      "sameAs": "https://lilychenmakeup.com"
    },
    "offers": {
      "@type": "Offer",
      "price": "25000000",
      "priceCurrency": "VND",
      "category": "Đào tạo nghề chuyên nghiệp 2-3 tháng"
    }
  }
  </script>

<main id="mainContent">
    <!-- Page Hero Banner with Canvas -->
    <section class="page-hero">
      <canvas id="proHeroCanvas" class="particle-canvas page-hero-canvas" aria-hidden="true" data-engine="three.js r180"></canvas>
      <div class="container">
        <span class="page-hero-badge">
          <svg width="14" height="14" viewBox="0 0 24 24" fill="currentColor"><path d="M12 2l2.4 7.4h7.6l-6.2 4.5 2.4 7.4-6.2-4.5-6.2 4.5 2.4-7.4-6.2-4.5h7.6z"/></svg>
          KHÓA HỌC CHUYÊN NGHIỆP · THỜI LƯỢNG 2–3 THÁNG
        </span>
        <h1 class="page-hero-title">Trở Thành Makeup Artist Chuyên Nghiệp</h1>
        <p class="page-hero-desc">
          Lộ trình đào tạo bài bản từ Lily Chen Academy — 80% thực chiến trên người mẫu thật, du học chuẩn Nhật Bản. Tốt nghiệp tự tin nhận show cô dâu, dự tiệc và sẵn sàng mở tiệm riêng.
        </p>

        <div style="display: flex; flex-wrap: wrap; justify-content: center; gap: 14px; margin-bottom: 24px;">
          <span style="background: rgba(255,255,255,0.85); border: 1px solid var(--border-subtle); padding: 6px 14px; border-radius: 99px; font-size: 0.85rem; font-weight: 600; color: var(--text-primary);">
            ✓ 80+ Chuyên viên đã ra nghề thành công
          </span>
          <span style="background: rgba(255,255,255,0.85); border: 1px solid var(--border-subtle); padding: 6px 14px; border-radius: 99px; font-size: 0.85rem; font-weight: 600; color: var(--text-primary);">
            ✓ Master Lily Chen trực tiếp uốn nắn 1:1
          </span>
          <span style="background: rgba(255,255,255,0.85); border: 1px solid var(--border-subtle); padding: 6px 14px; border-radius: 99px; font-size: 0.85rem; font-weight: 600; color: var(--text-primary);">
            ✓ Đối tác makeup chính thức TDMU 2025
          </span>
        </div>

        <div class="page-breadcrumbs">
          <a href="<?php echo esc_url(home_url('/')); ?>">Trang Chủ</a>
          <span>/</span>
          <a href="<?php echo esc_url(home_url('/khoa-hoc/')); ?>">Khóa Học</a>
          <span>/</span>
          <span>Trang Điểm Chuyên Nghiệp</span>
        </div>
      </div>
    </section>

    <!-- Highlights Strip -->
    <section style="background: #ffffff; border-bottom: 1px solid var(--border-hairline); padding: 24px 0;">
      <div class="container">
        <div class="course-feature-strip">
          <div>
            <div style="font-size: 1.5rem; margin-bottom: 4px;">🎯</div>
            <strong style="display: block; font-size: 1.05rem; color: var(--text-primary); margin-bottom: 4px;">80% Thực Chiến</strong>
            <span style="font-size: 0.86rem; color: var(--text-secondary);">Học trên mẫu thật ngay từ buổi đầu — không học chay, không xem suông</span>
          </div>
          <div>
            <div style="font-size: 1.5rem; margin-bottom: 4px;">👥</div>
            <strong style="display: block; font-size: 1.05rem; color: var(--text-primary); margin-bottom: 4px;">Lớp Tối Đa 5 Học Viên</strong>
            <span style="font-size: 0.86rem; color: var(--text-secondary);">Cô Ly trực tiếp theo sát, sửa kỹ thuật riêng cho từng cá nhân</span>
          </div>
          <div>
            <div style="font-size: 1.5rem; margin-bottom: 4px;">🇯🇵</div>
            <strong style="display: block; font-size: 1.05rem; color: var(--text-primary); margin-bottom: 4px;">Chuẩn Đào Tạo Nhật Bản</strong>
            <span style="font-size: 0.86rem; color: var(--text-secondary);">Giảng viên du học ngành Mỹ phẩm tại Nhật — kỹ thuật chuẩn xác, tinh tế</span>
          </div>
        </div>
      </div>
    </section>

    <!-- Section 1: Target Audience (Bạn đang ở vị trí nào?) -->
    <section class="section-padding">
      <div class="container">
        <div class="section-header text-center" data-reveal>
          <span class="section-tag">KHÓA HỌC DÀNH CHO</span>
          <h2 class="section-title">Bạn Đang Ở Vị Trí Nào?</h2>
          <p class="section-desc">
            3 nhóm học viên phù hợp nhất với khóa Chuyên nghiệp — tìm phiên bản hiện tại của bạn để bắt đầu bứt phá.
          </p>
        </div>

        <div class="audience-grid" data-reveal-stagger>
          <div class="audience-card">
            <div class="audience-icon">💼</div>
            <h3 class="audience-title">Người Chuyển Nghề</h3>
            <p class="audience-desc">
              Đang làm công việc văn phòng, muốn rời bàn giấy để theo đuổi đam mê makeup chuyên nghiệp tự do. Bạn cần một lộ trình thực chiến rõ ràng và kỹ năng đủ vững để tự tin bước sang lĩnh vực mới.
            </p>
          </div>

          <div class="audience-card">
            <div class="audience-icon">🌟</div>
            <h3 class="audience-title">Makeup Artist Mới Ra Nghề</h3>
            <p class="audience-desc">
              Đã có nền tảng cơ bản nhưng chưa cứng tay hoặc muốn nâng tầm layout (Bridal cao cấp, Editorial, Fashion) và xây dựng thương hiệu cá nhân để thu hút tệp khách hàng trả giá cao.
            </p>
          </div>

          <div class="audience-card">
            <div class="audience-icon">🏪</div>
            <h3 class="audience-title">Người Muốn Mở Tiệm</h3>
            <p class="audience-desc">
              Sẵn sàng kinh doanh dịch vụ làm đẹp tại địa phương. Bạn cần đầy đủ cả kỹ thuật makeup chuyên sâu, kỹ năng tạo kiểu tóc, tư duy vận hành lẫn chiến lược hình ảnh để mở tiệm sinh lời bền vững.
            </p>
          </div>
        </div>
      </div>
    </section>

    <!-- Section 2: 4 Core Competencies -->
    <section class="section-padding" style="background: var(--bg-surface);">
      <div class="container">
        <div class="section-header text-center" data-reveal>
          <span class="section-tag">BẠN SẼ LÀM CHỦ</span>
          <h2 class="section-title">4 Năng Lực Cốt Lõi Của Makeup Artist Toàn Năng</h2>
          <p class="section-desc">
            Vượt xa kỹ năng tô son điểm phấn thông thường — khóa học tôi luyện bạn trở thành một nghệ sĩ có tư duy thẩm mỹ cao và phong thái làm nghề chuẩn mực.
          </p>
        </div>

        <div class="skills-grid" data-reveal-stagger>
          <div class="skill-card">
            <div class="skill-num">01</div>
            <h3 class="skill-title">Kỹ Thuật Chuyên Sâu HD</h3>
            <p class="skill-desc">
              Lớp nền HD siêu thực, căng bóng và bền màu suốt 12 tiếng. Thành thạo tuyệt chiêu nhấn mí, tinh chỉnh tỉ lệ xương mặt, che phủ hoàn hảo mọi khuyết điểm (da mụn viêm, tàn nhang, sẹo rỗ).
            </p>
          </div>

          <div class="skill-card">
            <div class="skill-num">02</div>
            <h3 class="skill-title">Đa Dạng Phong Cách</h3>
            <p class="skill-desc">
              Tự tin biến hóa mọi layout: Cô dâu thanh lịch/ngọt ngào, Dạ tiệc sang trọng quyến rũ, Beauty sắc sảo, Fashion/Editorial cá tính. Bắt kịp xu hướng Douyin và Barbiecore hot trend.
            </p>
          </div>

          <div class="skill-card">
            <div class="skill-num">03</div>
            <h3 class="skill-title">Tư Duy Làm Nghề &amp; Branding</h3>
            <p class="skill-desc">
              Vượt khỏi kỹ năng cầm cọ — học setup ánh sáng, góc chụp tác phẩm bằng điện thoại, định vị thương hiệu cá nhân trên TikTok/Facebook và chiến lược tiếp cận khách hàng tiềm năng.
            </p>
          </div>

          <div class="skill-card">
            <div class="skill-num">04</div>
            <h3 class="skill-title">80% Thực Chiến Mẫu Thật</h3>
            <p class="skill-desc">
              Môi trường làm việc chuyên nghiệp, cường độ cao. Giảng viên trực tiếp "cầm tay chỉ việc" trên người mẫu thật — rèn luyện tốc độ và bản lĩnh để tốt nghiệp là nhận khách ngay.
            </p>
          </div>
        </div>
      </div>
    </section>

    <!-- Section 3: 12-Week Curriculum (4 Stages) -->
    <section class="section-padding">
      <div class="container">
        <div class="section-header text-center" data-reveal>
          <span class="section-tag">GIÁO TRÌNH BÀI BẢN</span>
          <h2 class="section-title">Lộ Trình 4 Giai Đoạn Đào Tạo (12 Tuần)</h2>
          <p class="section-desc">
            Thiết kế khoa học từ nền tảng vững chắc đến thực chiến chuyên sâu — cam kết không giấu nghề.
          </p>
        </div>

        <div class="curriculum-grid" data-reveal-stagger>
          <!-- Stage 1 -->
          <div class="curriculum-stage-card">
            <div class="stage-num-badge">01</div>
            <div class="stage-week-tag">Tuần 1 – Tuần 2</div>
            <h3 class="stage-title">Nền Tảng Vững Chắc &amp; Nhận Diện Gương Mặt</h3>
            <p class="stage-desc">
              Phân tích cấu trúc xương mặt, nhận diện 5 loại da và bệnh lý thường gặp. Kỹ thuật skincare trước trang điểm để nền bền 12 tiếng. Quy luật bánh xe màu sắc và phối màu hài hòa theo sắc tộc da.
            </p>
            <div class="stage-tags">
              <span class="stage-tag">Cấu trúc mặt</span>
              <span class="stage-tag">Phân tích da</span>
              <span class="stage-tag">Bánh xe màu</span>
              <span class="stage-tag">Skincare nền</span>
            </div>
          </div>

          <!-- Stage 2 -->
          <div class="curriculum-stage-card">
            <div class="stage-num-badge">02</div>
            <div class="stage-week-tag">Tuần 3 – Tuần 6</div>
            <h3 class="stage-title">Kỹ Thuật Cọ &amp; Xử Lý Nền Chuyên Sâu HD</h3>
            <p class="stage-desc">
              Master Lily Chen trực tiếp uốn nắn lực cọ. Kỹ thuật đánh nền "glass-skin" mỏng nhẹ, che khuyết điểm da mụn viêm, sẹo rỗ, quầng thâm mà không dày cộm. Chân mày phẩy sợi và eyeliner sắc nét.
            </p>
            <div class="stage-tags">
              <span class="stage-tag">Nền trong veo</span>
              <span class="stage-tag">Che da mụn</span>
              <span class="stage-tag">Chân mày tỉ lệ</span>
              <span class="stage-tag">Eyeliner sắc sảo</span>
            </div>
          </div>

          <!-- Stage 3 -->
          <div class="curriculum-stage-card">
            <div class="stage-num-badge">03</div>
            <div class="stage-week-tag">Tuần 7 – Tuần 10</div>
            <h3 class="stage-title">80% Thực Chiến Mẫu Thật &amp; Layout Thịnh Hành</h3>
            <p class="stage-desc">
              Thực hành liên tục trên người mẫu thật dưới sự giám sát 1:1. Làm chủ các layout: Cô dâu ngọt ngào/sang trọng, Dạ tiệc quyến rũ, Douyin trong trẻo, Kỷ yếu. Đào tạo kèm kỹ thuật Hair Styling búi tóc.
            </p>
            <div class="stage-tags">
              <span class="stage-tag">Makeup Cô dâu</span>
              <span class="stage-tag">Dạ tiệc cao cấp</span>
              <span class="stage-tag">Douyin trend</span>
              <span class="stage-tag">Tạo kiểu tóc</span>
            </div>
          </div>

          <!-- Stage 4 -->
          <div class="curriculum-stage-card">
            <div class="stage-num-badge">04</div>
            <div class="stage-week-tag">Tuần 11 – Tuần 12</div>
            <h3 class="stage-title">Thi Tốt Nghiệp, Cấp Bằng &amp; Ra Nghề Nhận Khách</h3>
            <p class="stage-desc">
              Thực hiện bài thi tốt nghiệp toàn diện trên mẫu thật. Cấp chứng chỉ Academy. Hỗ trợ chụp bộ ảnh Portfolio chuyên nghiệp tại studio để bắt đầu nhận khách. Tư vấn set up cốp đồ thông minh và kết nối việc làm.
            </p>
            <div class="stage-tags">
              <span class="stage-tag">Thi tốt nghiệp</span>
              <span class="stage-tag">Cấp chứng chỉ</span>
              <span class="stage-tag">Chụp Portfolio</span>
              <span class="stage-tag">Định hướng nghề</span>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- Section 4: 3 Exclusive Bonus Gifts (>13.000.000đ) -->
    <section class="section-padding" style="background: var(--bg-surface);">
      <div class="container">
        <div class="section-header text-center" data-reveal>
          <span class="section-tag">ĐẶC QUYỀN ĐĂNG KÝ HÔM NAY</span>
          <h2 class="section-title">Gói Quà Tặng Trị Giá Hơn 13.000.000đ</h2>
          <p class="section-desc">
            3 đặc quyền giúp bạn rút ngắn lộ trình trở thành chuyên gia toàn năng — chỉ áp dụng cho học viên đăng ký trong đợt ưu đãi khai giảng.
          </p>
        </div>

        <div class="gifts-grid" data-reveal-stagger>
          <!-- Gift 1 -->
          <div class="gift-card">
            <span class="gift-badge">TẶNG KÈM 💇‍♀️</span>
            <h3 class="gift-title">Khóa Búi Tóc Chuyên Nghiệp</h3>
            <div class="gift-val">Trị giá: 8.000.000 VNĐ</div>
            <p class="gift-desc">
              Trở thành chuyên gia làm đẹp toàn năng. Kết hợp thuần thục giữa Makeup và Hair Styling giúp bạn chinh phục những cô dâu khó tính nhất, tăng gấp đôi cơ hội nhận show và nâng cao thu nhập.
            </p>
          </div>

          <!-- Gift 2 -->
          <div class="gift-card">
            <span class="gift-badge">TẶNG KÈM 📸</span>
            <h3 class="gift-title">Khóa Media Chuyên Sâu</h3>
            <div class="gift-val">Trị giá: 5.000.000 VNĐ</div>
            <p class="gift-desc">
              Tay nghề giỏi cần biết cách tỏa sáng. Hướng dẫn kỹ thuật quay chụp, căn góc, đánh sáng và chỉnh màu tác phẩm chỉ với chiếc điện thoại — bí quyết xây thương hiệu cá nhân thu hút tệp khách hàng cao cấp.
            </p>
          </div>

          <!-- Gift 3 -->
          <div class="gift-card">
            <span class="gift-badge">TẶNG KÈM 🎨</span>
            <h3 class="gift-title">Bảng Màu Mắt Cao Cấp</h3>
            <div class="gift-val">Hành Trang Khởi Nghiệp</div>
            <p class="gift-desc">
              Chất phấn siêu mịn, độ bám cao và lên màu chuẩn xác — hỗ trợ tối đa để bạn thỏa sức sáng tạo, thực hành trọn vẹn mọi layout từ cơ bản đến nâng cao ngay tại lớp mà không lo thiếu dụng cụ.
            </p>
          </div>
        </div>
      </div>
    </section>

    <!-- Section 5: Transparent Pricing Box -->
    <section class="section-padding">
      <div class="container" style="max-width: 900px;">
        <div class="section-header text-center" data-reveal>
          <span class="section-tag">HỌC PHÍ MINH BẠCH</span>
          <h2 class="section-title">Đầu Tư Một Lần — Sinh Lời Trọn Đời</h2>
          <p class="section-desc">Mức học phí ưu đãi đặc biệt dành cho học viên đăng ký trong đợt tuyển sinh này.</p>
        </div>

        <div style="background: linear-gradient(135deg, #ffffff 0%, #fffbfc 100%); border: 2px solid var(--color-rose); border-radius: var(--radius-card); padding: 40px 36px; box-shadow: var(--shadow-lg);" data-reveal>
          <div style="display: flex; flex-wrap: wrap; justify-content: space-between; align-items: flex-start; gap: 20px; border-bottom: 1px solid var(--border-hairline); padding-bottom: 24px; margin-bottom: 24px;">
            <div>
              <span style="background: var(--color-rose-soft); color: var(--color-rose-deep); font-size: 0.78rem; font-weight: 800; padding: 4px 12px; border-radius: 99px; text-transform: uppercase; letter-spacing: 0.08em; display: inline-block; margin-bottom: 10px;">
                ƯU ĐÃI KHAI GIẢNG GIỚI HẠN
              </span>
              <h3 style="font-family: var(--font-heading); font-size: 1.85rem; color: var(--text-primary); margin: 0 0 6px;">
                Khóa Chuyên Nghiệp (2–3 Tháng)
              </h3>
              <p style="color: var(--text-muted); font-size: 0.9rem; margin: 0;">
                Sĩ số vàng: Tối đa 5 học viên · Kèm sát 1:1 trên mẫu thật
              </p>
            </div>

            <div style="text-align: right;">
              <div style="font-size: 1.15rem; color: var(--text-muted); text-decoration: line-through;">30.000.000đ</div>
              <div style="font-family: var(--font-heading); font-size: 2.5rem; font-weight: 800; color: var(--color-rose-deep); line-height: 1;">
                25.000.000 <span style="font-size: 1.2rem; font-weight: 600;">đ</span>
              </div>
              <span style="font-size: 0.85rem; color: #166534; font-weight: 700; background: #e8f5e9; padding: 3px 10px; border-radius: 4px; display: inline-block; margin-top: 6px;">
                Tiết kiệm ngay 5.000.000 VNĐ
              </span>
            </div>
          </div>

          <h4 style="font-size: 1.05rem; margin-bottom: 16px; color: var(--text-primary);">Quyền Lợi Đã Bao Gồm Trọn Gói:</h4>
          <ul class="package-inclusions-grid">
            <li style="display: flex; align-items: flex-start; gap: 10px; font-size: 0.92rem; color: var(--text-secondary);">
              <svg width="18" height="18" viewBox="0 0 24 24" fill="var(--color-rose)" style="flex-shrink: 0; margin-top: 2px;"><path d="M9 16.17L4.83 12l-1.42 1.41L9 19 21 7l-1.41-1.41z"/></svg>
              <span>Khóa Chuyên nghiệp 2-3 tháng (80% thực chiến mẫu thật)</span>
            </li>
            <li style="display: flex; align-items: flex-start; gap: 10px; font-size: 0.92rem; color: var(--text-secondary);">
              <svg width="18" height="18" viewBox="0 0 24 24" fill="var(--color-rose)" style="flex-shrink: 0; margin-top: 2px;"><path d="M9 16.17L4.83 12l-1.42 1.41L9 19 21 7l-1.41-1.41z"/></svg>
              <span><strong>Tặng Khóa búi tóc chuyên nghiệp</strong> (8.000.000đ)</span>
            </li>
            <li style="display: flex; align-items: flex-start; gap: 10px; font-size: 0.92rem; color: var(--text-secondary);">
              <svg width="18" height="18" viewBox="0 0 24 24" fill="var(--color-rose)" style="flex-shrink: 0; margin-top: 2px;"><path d="M9 16.17L4.83 12l-1.42 1.41L9 19 21 7l-1.41-1.41z"/></svg>
              <span><strong>Tặng Khóa Media quay chụp bằng điện thoại</strong> (5.000.000đ)</span>
            </li>
            <li style="display: flex; align-items: flex-start; gap: 10px; font-size: 0.92rem; color: var(--text-secondary);">
              <svg width="18" height="18" viewBox="0 0 24 24" fill="var(--color-rose)" style="flex-shrink: 0; margin-top: 2px;"><path d="M9 16.17L4.83 12l-1.42 1.41L9 19 21 7l-1.41-1.41z"/></svg>
              <span><strong>Tặng Bảng màu mắt cao cấp</strong> khởi nghiệp</span>
            </li>
            <li style="display: flex; align-items: flex-start; gap: 10px; font-size: 0.92rem; color: var(--text-secondary);">
              <svg width="18" height="18" viewBox="0 0 24 24" fill="var(--color-rose)" style="flex-shrink: 0; margin-top: 2px;"><path d="M9 16.17L4.83 12l-1.42 1.41L9 19 21 7l-1.41-1.41z"/></svg>
              <span>Tài trợ 100% mỹ phẩm High-end thực hành tại lớp</span>
            </li>
            <li style="display: flex; align-items: flex-start; gap: 10px; font-size: 0.92rem; color: var(--text-secondary);">
              <svg width="18" height="18" viewBox="0 0 24 24" fill="var(--color-rose)" style="flex-shrink: 0; margin-top: 2px;"><path d="M9 16.17L4.83 12l-1.42 1.41L9 19 21 7l-1.41-1.41z"/></svg>
              <span>Hỗ trợ chính sách trả góp 2–3 đợt linh hoạt</span>
            </li>
          </ul>

          <div style="background: var(--bg-subtle); padding: 18px 24px; border-radius: var(--radius-sm); display: flex; flex-wrap: wrap; justify-content: space-between; align-items: center; gap: 16px;">
            <div>
              <span style="display: block; font-size: 0.82rem; color: var(--text-muted); text-transform: uppercase; font-weight: 700;">Tổng giá trị thực tế nhận được:</span>
              <strong style="font-size: 1.25rem; color: var(--text-primary); font-family: var(--font-heading);">43.000.000đ+</strong>
            </div>
            <a href="#dang-ky" class="btn btn-primary btn-large">
              <span>ĐĂNG KÝ NGAY — GIỮ SUẤT ƯU ĐÃI</span>
              <svg width="18" height="18" viewBox="0 0 24 24" fill="currentColor"><path d="M5 13h11.86l-5.43 5.43 1.42 1.42L21.14 12l-8.29-8.29-1.42 1.42L16.86 11H5v2z"/></svg>
            </a>
          </div>
        </div>
      </div>
    </section>

    <!-- Section 6: Graduate Stories -->
    <section class="section-padding" style="background: var(--bg-surface);">
      <div class="container">
        <div class="section-header text-center" data-reveal>
          <span class="section-tag">HỌC VIÊN ĐÃ RA NGHỀ</span>
          <h2 class="section-title">Câu Chuyện Thành Công</h2>
          <p class="section-desc">Những chuyên viên đã hoàn thành khóa học và đang theo nghề makeup chuyên nghiệp thành công.</p>
        </div>

        <div class="stories-grid" data-reveal-stagger>
          <div class="story-card">
            <p class="story-quote">
              "Sau khóa học, mình đã tự tin mở tiệm riêng tại Bình Dương. Doanh thu tháng đầu đã vượt mong đợi nhờ kỹ thuật và mindset cô Ly truyền lại."
            </p>
            <div class="story-author">
              <div>
                <div class="story-name">Nguyễn Thị Mỹ Duyên</div>
                <div class="story-role">Chủ tiệm Makeup Studio tại Bình Dương</div>
              </div>
            </div>
          </div>

          <div class="story-card">
            <p class="story-quote">
              "Mình chuyển từ công việc văn phòng sang makeup. Thu nhập đều đặn và thoải mái hơn so với công việc cũ của mình — cảm ơn cô Ly đã chỉ dạy cả tay nghề lẫn cách xây thương hiệu cá nhân."
            </p>
            <div class="story-author">
              <div>
                <div class="story-name">Phạm Nguyễn Tú Trinh</div>
                <div class="story-role">Freelance Makeup Artist nhận show cô dâu</div>
              </div>
            </div>
          </div>

          <div class="story-card">
            <p class="story-quote">
              "Đã có nền tảng cơ bản nhưng việc biến nó thành nghề thì còn rất nhiều khó khăn. Khóa Chuyên nghiệp giúp mình bứt phá và tự tin nhận show cô dâu cao cấp."
            </p>
            <div class="story-author">
              <div>
                <div class="story-name">Lê Thị Thu Thảo</div>
                <div class="story-role">Chuyên viên trang điểm Bridal &amp; Sự kiện</div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- Section 7: Authentic Before / After & Work Gallery -->
    <section class="section-padding">
      <div class="container">
        <div class="section-header text-center" data-reveal>
          <span class="section-tag">PORTFOLIO THỰC CHIẾN</span>
          <h2 class="section-title">Tác Phẩm &amp; Kết Quả Thực Tế Tại Lớp</h2>
          <p class="section-desc">Hình ảnh trước và sau khi học viên trang điểm trực tiếp trên người mẫu thật dưới sự hướng dẫn của Lily Chen.</p>
        </div>

        <div class="before-after-grid" data-reveal-stagger>
          <div class="before-after-card">
            <img src="<?php echo esc_url(lilychen_image_url('trc-sau-1.webp')); ?>" alt="Trước và sau trang điểm cô dâu" class="before-after-img">
            <div class="before-after-caption">Xử lý nền da &amp; Layout Cô Dâu</div>
          </div>
          <div class="before-after-card">
            <img src="<?php echo esc_url(lilychen_image_url('trc-sau-2.webp')); ?>" alt="Trước và sau makeup che khuyết điểm" class="before-after-img">
            <div class="before-after-caption">Che khuyết điểm &amp; Nhấn mí HD</div>
          </div>
          <div class="before-after-card">
            <img src="<?php echo esc_url(lilychen_image_url('trc-sau-3.webp')); ?>" alt="Biến hóa phong cách trang điểm dự tiệc" class="before-after-img">
            <div class="before-after-caption">Layout Dạ Tiệc Sang Trọng</div>
          </div>
          <div class="before-after-card">
            <img src="<?php echo esc_url(lilychen_image_url('trc-sau-4.webp')); ?>" alt="Tác phẩm makeup thực chiến mẫu thật" class="before-after-img">
            <div class="before-after-caption">Biến hóa phong cách Douyin</div>
          </div>
        </div>
      </div>
    </section>

    <!-- Section 8: FAQs -->
    <section class="section-padding" style="background: var(--bg-surface);">
      <div class="container" style="max-width: 860px;">
        <div class="section-header text-center" data-reveal>
          <span class="section-tag">CÂU HỎI THƯỜNG GẶP</span>
          <h2 class="section-title">Bạn Còn Băn Khoăn Về Khóa Chuyên Nghiệp?</h2>
          <p class="section-desc">Giải đáp minh bạch mọi thắc mắc trước khi bạn quyết định theo nghề.</p>
        </div>

        <div class="faq-accordion" data-reveal-stagger>
          <div class="faq-item">
            <button type="button" class="faq-question" aria-expanded="false">
              <span>Tôi chưa có kinh nghiệm makeup, có theo được khóa Chuyên nghiệp không?</span>
              <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="6 9 12 15 18 9"></polyline></svg>
            </button>
            <div class="faq-answer">
              <p>Hoàn toàn được. Lộ trình thiết kế cho cả Zero-base lẫn người đã có nền — bắt đầu từ kỹ thuật nền tảng đến chuyên sâu. Vì lớp tối đa 5 học viên nên cô Ly có thể điều chỉnh tốc độ phù hợp với từng người. Bạn chỉ cần đủ đam mê và sẵn sàng thực hành cường độ cao.</p>
            </div>
          </div>

          <div class="faq-item">
            <button type="button" class="faq-question" aria-expanded="false">
              <span>Sau khóa học tôi có thể đi làm hoặc mở tiệm ngay không?</span>
              <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="6 9 12 15 18 9"></polyline></svg>
            </button>
            <div class="faq-answer">
              <p>Có. 80+ học viên đã ra nghề thành công — người mở tiệm riêng, người làm freelancer nhận show, người vào salon lớn. Khóa học không chỉ dạy kỹ thuật mà còn cả tư duy làm nghề, xây thương hiệu cá nhân, chụp ảnh tác phẩm — đủ hành trang để bạn bắt đầu kinh doanh ngay.</p>
            </div>
          </div>

          <div class="faq-item">
            <button type="button" class="faq-question" aria-expanded="false">
              <span>Thời lượng học cụ thể như thế nào trong 2-3 tháng?</span>
              <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="6 9 12 15 18 9"></polyline></svg>
            </button>
            <div class="faq-answer">
              <p>Lịch học linh động sắp xếp theo cohort. Trung bình 2-3 buổi/tuần, mỗi buổi 3-4 tiếng. Tổng thời lượng đảm bảo phủ hết các layout (Bridal, Beauty, Fashion/Editorial) và đủ thực hành cứng tay. Lịch cụ thể sẽ được tư vấn sau khi bạn để lại thông tin.</p>
            </div>
          </div>

          <div class="faq-item">
            <button type="button" class="faq-question" aria-expanded="false">
              <span>Học phí 25.000.000đ đã bao gồm những gì?</span>
              <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="6 9 12 15 18 9"></polyline></svg>
            </button>
            <div class="faq-answer">
              <p>Bao gồm trọn gói: Khóa Chuyên nghiệp 2-3 tháng + 3 đặc quyền tặng kèm (Khóa búi tóc 8tr, Khóa Media 5tr, Bảng màu mắt cao cấp) + 100% mỹ phẩm và dụng cụ High-end tại lớp + hỗ trợ trọn đời sau khóa. Tổng giá trị thực tế hơn 43.000.000đ — bạn không phải trả thêm bất kỳ chi phí nào.</p>
            </div>
          </div>

          <div class="faq-item">
            <button type="button" class="faq-question" aria-expanded="false">
              <span>Có hỗ trợ kết nối khách hàng hoặc cơ hội việc làm sau khóa không?</span>
              <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="6 9 12 15 18 9"></polyline></svg>
            </button>
            <div class="faq-answer">
              <p>Có. Học viên ưu tú được giới thiệu vào mạng lưới đối tác của học viện (đám cưới, sự kiện, show ảnh) — đặc biệt sau hợp tác với TDMU 2025, mạng lưới này đang mở rộng nhanh. Cô Ly cũng thường xuyên review portfolio và tư vấn cá nhân để bạn định vị thương hiệu phù hợp.</p>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- Section 9: Consultation Form -->
    <section id="dang-ky" class="section-padding conversion-section">
      <div class="container">
        <div class="conversion-grid">
          <div class="conversion-info" data-reveal>
            <span class="section-tag">ĐĂNG KÝ TƯ VẤN</span>
            <h2 class="conversion-title">Bắt Đầu Hành Trình Trở Thành Makeup Artist</h2>
            <p class="conversion-desc">
              Để lại thông tin — Lily Chen Academy sẽ liên hệ trong 24h để tư vấn chi tiết lộ trình, lịch khai giảng và đảm bảo bạn nhận trọn gói ưu đãi giới hạn.
            </p>

            <div class="conversion-benefits">
              <div class="benefit-item">
                <svg class="check-icon" width="18" height="18" viewBox="0 0 24 24" fill="var(--color-rose)"><path d="M9 16.17L4.83 12l-1.42 1.41L9 19 21 7l-1.41-1.41z"/></svg>
                <span>Tư vấn lộ trình hoàn toàn miễn phí &amp; bảo lưu suất ưu đãi</span>
              </div>
              <div class="benefit-item">
                <svg class="check-icon" width="18" height="18" viewBox="0 0 24 24" fill="var(--color-rose)"><path d="M9 16.17L4.83 12l-1.42 1.41L9 19 21 7l-1.41-1.41z"/></svg>
                <span>Hỗ trợ chính sách trả góp học phí linh hoạt 2–3 đợt</span>
              </div>
              <div class="benefit-item">
                <svg class="check-icon" width="18" height="18" viewBox="0 0 24 24" fill="var(--color-rose)"><path d="M9 16.17L4.83 12l-1.42 1.41L9 19 21 7l-1.41-1.41z"/></svg>
                <span>Nhận trọn bộ 3 khóa tặng kèm trị giá > 13.000.000đ</span>
              </div>
            </div>
          </div>

          <div class="lead-form-card" data-reveal>
            <div class="lead-form-header">
              <h3 class="lead-form-title">Đăng Ký Khóa Chuyên Nghiệp</h3>
              <p class="lead-form-sub">Nhận tư vấn lịch khai giảng &amp; bảng quà tặng 13 triệu</p>
            </div>

            <form id="leadForm" class="lead-form" novalidate>
              <input type="hidden" name="source_page" value="Trang Khóa Học Trang Điểm Chuyên Nghiệp (/khoa-hoc-trang-diem-chuyen-nghiep/)">

              <div class="form-group">
                <label for="leadName" class="form-label">Họ và tên của bạn <span>*</span></label>
                <input type="text" id="leadName" name="name" class="form-control" placeholder="Ví dụ: Lê Thị Thu Thảo" required>
              </div>

              <div class="form-group">
                <label for="leadPhone" class="form-label">Số điện thoại / Zalo <span>*</span></label>
                <input type="tel" id="leadPhone" name="phone" class="form-control" placeholder="Ví dụ: 0987 654 321" required>
              </div>

              <div class="form-group">
                <label for="leadCourse" class="form-label">Khóa học đăng ký <span>*</span></label>
                <select id="leadCourse" name="course" class="form-control" required>
                  <option value="Khóa Chuyên Nghiệp (Ưu đãi 25.000.000đ)" selected>Khóa Chuyên Nghiệp 2-3 Tháng (Ưu Đãi 25.000.000đ ⭐)</option>
                  <option value="Khóa Chuyên Nghiệp - Cần tư vấn trả góp">Khóa Chuyên Nghiệp (Cần tư vấn chính sách trả góp 2-3 đợt)</option>
                </select>
              </div>

              <div class="form-group">
                <label for="leadTime" class="form-label">Dự kiến thời gian bắt đầu học</label>
                <select id="leadTime" name="time" class="form-control">
                  <option value="Đợt khai giảng gần nhất">Đợt khai giảng sớm nhất trong tháng này</option>
                  <option value="Tháng tới">Tháng tới</option>
                  <option value="Linh hoạt">Linh hoạt theo tư vấn của học viện</option>
                </select>
              </div>

              <div class="form-group">
                <label for="leadMessage" class="form-label">Mục tiêu của bạn khi theo nghề</label>
                <textarea id="leadMessage" name="message" class="form-control" rows="3" placeholder="Ví dụ: Mình muốn chuyển nghề để nhận show cô dâu và sau này mở tiệm riêng..."></textarea>
              </div>

              <button type="submit" class="btn btn-primary btn-lg form-submit-btn">
                GỬI ĐĂNG KÝ TƯ VẤN
                <svg width="18" height="18" viewBox="0 0 24 24" fill="currentColor"><path d="M5 13h11.86l-5.43 5.43 1.42 1.42L21.14 12l-8.29-8.29-1.42 1.42L16.86 11H5v2z"/></svg>
              </button>

              <div class="form-privacy-note">
                <svg width="15" height="15" viewBox="0 0 24 24" fill="currentColor"><path d="M12 1L3 5v6c0 5.55 3.84 10.74 9 12 5.16-1.26 9-6.45 9-12V5l-9-4zm-2 16l-4-4 1.41-1.41L10 14.17l6.59-6.59L18 9l-8 8z"/></svg>
                Thông tin được bảo mật tuyệt đối theo <a href="<?php echo esc_url(home_url('/chinh-sach-bao-mat/')); ?>" style="color: inherit; text-decoration: underline;">Chính sách bảo mật</a>. Master Lily Chen sẽ liên hệ trong 24 giờ.
              </div>
            
              <!-- Success Notification Box (Test Mode Compatibility) -->
              <div id="formSuccessMsg" class="form-success-msg" role="status" aria-live="polite"></div>
            </form>
          </div>
        </div>
      </div>
    </section>
  </main>

<?php
get_footer();
