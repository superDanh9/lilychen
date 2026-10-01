<?php
/**
 * Template Name: Khóa Học (Trang Tổng Hợp)
 * Template Post Type: page
 *
 * Mẫu trang riêng cho đường dẫn /khoa-hoc/ (Trang tổng hợp khóa học).
 * Chuyển giao trực tiếp từ khoa-hoc/index.html đã duyệt.
 * Bảo toàn 100% thiết kế, bố cục, nội dung, bảng so sánh và hiệu ứng canvas hạt.
 * Tương thích staging (/staging/) và liên kết nội bộ an toàn bằng home_url().
 *
 * @package LilyChen_Academy
 */

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

get_header();
?>

<!-- Structured Data: Course List Schema (Dynamic for Live & Staging) -->
<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "ItemList",
  "itemListElement": [
    {
      "@type": "Course",
      "position": 1,
      "name": "Khóa Học Trang Điểm Cá Nhân",
      "description": "Tự makeup chuyên nghiệp cho chính mình từ Zero-base. Lịch học linh động, tài trợ 100% mỹ phẩm và dụng cụ.",
      "url": "<?php echo esc_url(home_url('/khoa-hoc-trang-diem-ca-nhan/')); ?>",
      "provider": {
        "@type": "EducationalOrganization",
        "name": "Lily Chen Makeup Academy",
        "sameAs": "<?php echo esc_url(home_url('/')); ?>"
      }
    },
    {
      "@type": "Course",
      "position": 2,
      "name": "Khóa Học Trang Điểm Chuyên Nghiệp",
      "description": "Đào tạo nghề Makeup Artist toàn diện trong 2-3 tháng. 80% thực chiến trên mẫu thật, tặng 3 khóa học trị giá >13tr.",
      "url": "<?php echo esc_url(home_url('/khoa-hoc-trang-diem-chuyen-nghiep/')); ?>",
      "provider": {
        "@type": "EducationalOrganization",
        "name": "Lily Chen Makeup Academy",
        "sameAs": "<?php echo esc_url(home_url('/')); ?>"
      }
    }
  ]
}
</script>

<main id="mainContent">
  <!-- ========================================================
       PAGE HERO BANNER WITH AMBIENT PARTICLES
       ======================================================== -->
  <section class="page-hero">
    <canvas id="hubHeroCanvas" class="particle-canvas page-hero-canvas" aria-hidden="true" data-engine="three.js r180"></canvas>
    <div class="container">
      <span class="page-hero-badge">
        <svg width="14" height="14" viewBox="0 0 24 24" fill="currentColor"><path d="M12 2l2.4 7.4h7.6l-6.2 4.5 2.4 7.4-6.2-4.5-6.2 4.5 2.4-7.4-6.2-4.5h7.6z"/></svg>
        LỘ TRÌNH ĐÀO TẠO ĐỘC BẢN · CHUẨN BOUTIQUE ACADEMY
      </span>
      <h1 class="page-hero-title">Chọn Khóa Học Phù Hợp Với Bạn</h1>
      <p class="page-hero-desc">
        Hai khóa học được thiết kế cho hai mục tiêu khác nhau — bạn muốn makeup cho chính mình để đẹp hơn mỗi ngày, hay bạn muốn theo nghề makeup chuyên nghiệp để nhận show và mở tiệm? Hãy để Lily Chen đồng hành giúp bạn chọn đúng lộ trình.
      </p>
      <div class="page-breadcrumbs">
        <a href="<?php echo esc_url(home_url('/')); ?>">Trang Chủ</a>
        <span>/</span>
        <span>Khóa Học</span>
      </div>
    </div>
  </section>

  <!-- ========================================================
       DUAL COURSE OVERVIEW CARDS
       ======================================================== -->
  <section class="section-padding">
    <div class="container">
      <div class="section-header text-center" data-reveal>
        <span class="section-tag">ĐỊNH HƯỚNG MỤC TIÊU</span>
        <h2 class="section-title">Hai Lựa Chọn — Một Tiêu Chuẩn Tinh Hoa</h2>
        <p class="section-desc">
          Không dạy theo công thức rập khuôn. Dù bạn học để làm đẹp cho bản thân hay bước vào con đường nghệ thuật chuyên nghiệp, Master Lily Chen đều trực tiếp cầm tay chỉ việc uốn nắn từng nét cọ.
        </p>
      </div>

      <div class="course-hub-grid" data-reveal-stagger>
        <!-- Card 1: Khóa Trang Điểm Cá Nhân -->
        <article class="course-hub-card">
          <div>
            <span class="course-hub-badge">DÀNH CHO BẠN MUỐN ĐẸP MỖI NGÀY</span>
            <h3 class="course-hub-title">Trang Điểm Cá Nhân</h3>
            <p class="course-hub-desc">
              Bạn cảm thấy lúng túng trước hàng tá cọ vẽ và bảng màu? Lớp nền cứ &quot;mốc&quot; hoặc trông quá đậm so với đời thường? Khóa học Makeup Cá Nhân tại Lily Chen được thiết kế để giúp bạn làm chủ gương mặt mình. Không cần kỹ thuật cầu kỳ, chúng tôi tập trung vào việc giúp bạn đẹp hơn khi là chính mình.
            </p>

            <div class="course-hub-specs">
              <div class="course-spec-item">
                <strong>4 – 5 Buổi</strong>
                <span>Lịch học linh hoạt (Tối / Cuối tuần)</span>
              </div>
              <div class="course-spec-item">
                <strong>Tối Đa 5 Học Viên</strong>
                <span>Hoặc học kèm 1:1 VIP</span>
              </div>
              <div class="course-spec-item">
                <strong>100% Tài Trợ</strong>
                <span>Mỹ phẩm &amp; dụng cụ tại lớp</span>
              </div>
              <div class="course-spec-item">
                <strong>Zero-Base</strong>
                <span>Phù hợp người chưa từng cầm cọ</span>
              </div>
            </div>

            <div class="course-hub-price">
              <div class="course-hub-price-label">Học Phí Trọn Gói</div>
              <div class="course-hub-price-val">Chỉ từ 1.500.000 VNĐ</div>
            </div>
          </div>

          <div style="display: flex; flex-direction: column; gap: 12px; margin-top: 10px;">
            <a href="<?php echo esc_url(home_url('/khoa-hoc-trang-diem-ca-nhan/')); ?>" class="btn btn-primary btn-block">
              <span>Xem Chi Tiết Khóa Cá Nhân</span>
              <svg width="18" height="18" viewBox="0 0 24 24" fill="currentColor"><path d="M5 13h11.86l-5.43 5.43 1.42 1.42L21.14 12l-8.29-8.29-1.42 1.42L16.86 11H5v2z"/></svg>
            </a>
            <a href="#dang-ky" class="btn btn-secondary btn-block">
              <span>Nhận Tư Vấn Gói Cá Nhân</span>
            </a>
          </div>
        </article>

        <!-- Card 2: Khóa Makeup Chuyên Nghiệp -->
        <article class="course-hub-card featured">
          <div>
            <span class="course-hub-badge" style="background: #fdf2f4; color: #b93b62; border: 1px solid #f8d7e0;">
              🔥 DÀNH CHO BẠN MUỐN THEO NGHỀ · 80% THỰC CHIẾN
            </span>
            <h3 class="course-hub-title">Makeup Chuyên Nghiệp</h3>
            <p class="course-hub-desc">
              Nghề Makeup không chỉ là tô son điểm phấn, đó là sự kết hợp giữa tư duy thẩm mỹ, kỹ thuật chuẩn xác và sự thấu hiểu khách hàng. Nếu bạn đang tìm kiếm một bước đệm vững chắc để bước chân vào thế giới làm đẹp chuyên nghiệp, tự tin nhận show và mở studio riêng, đây chính là nơi bắt đầu.
            </p>

            <div class="course-hub-specs">
              <div class="course-spec-item">
                <strong>2 – 3 Tháng</strong>
                <span>80% thực chiến trên mẫu thật</span>
              </div>
              <div class="course-spec-item">
                <strong>Tối Đa 5 Học Viên</strong>
                <span>Kèm 1:1 uốn nắn từng nét cọ</span>
              </div>
              <div class="course-spec-item">
                <strong>Tặng 3 Khóa Học</strong>
                <span>Búi tóc, Media, Bảng mắt (&gt;13tr)</span>
              </div>
              <div class="course-spec-item">
                <strong>Hỗ Trợ Trọn Đời</strong>
                <span>Cấp bằng &amp; kết nối việc làm</span>
              </div>
            </div>

            <div class="course-hub-price">
              <div class="course-hub-price-label">Học Phí Ưu Đãi Giới Hạn</div>
              <div class="course-hub-price-val">
                <del>30.000.000đ</del> 25.000.000 VNĐ
              </div>
              <span style="font-size: 0.8rem; color: #166534; background: #e8f5e9; padding: 2px 8px; border-radius: 4px; display: inline-block; margin-top: 4px; font-weight: 600;">
                Tiết kiệm ngay 5.000.000đ · Trả góp 2–3 đợt
              </span>
            </div>
          </div>

          <div style="display: flex; flex-direction: column; gap: 12px; margin-top: 10px;">
            <a href="<?php echo esc_url(home_url('/khoa-hoc-trang-diem-chuyen-nghiep/')); ?>" class="btn btn-primary btn-block">
              <span>Xem Chi Tiết Khóa Chuyên Nghiệp</span>
              <svg width="18" height="18" viewBox="0 0 24 24" fill="currentColor"><path d="M5 13h11.86l-5.43 5.43 1.42 1.42L21.14 12l-8.29-8.29-1.42 1.42L16.86 11H5v2z"/></svg>
            </a>
            <a href="#dang-ky" class="btn btn-secondary btn-block">
              <span>Giữ Suất Ưu Đãi Khóa Chuyên Nghiệp</span>
            </a>
          </div>
        </article>
      </div>
    </div>
  </section>

  <!-- ========================================================
       DIRECT COMPARISON TABLE
       ======================================================== -->
  <section class="section-padding" style="background: var(--bg-surface);">
    <div class="container">
      <div class="section-header text-center" data-reveal>
        <span class="section-tag">BẢNG ĐỐI CHIẾU TRỰC TIẾP</span>
        <h2 class="section-title">So Sánh Chi Tiết Quyền Lợi Hai Khóa Học</h2>
        <p class="section-desc">
          Bảng đối chiếu minh bạch giúp bạn đánh giá toàn diện về mục tiêu, thời gian, giáo trình và quyền lợi nhận được trước khi quyết định đăng ký.
        </p>
      </div>

      <div class="course-comparison-wrapper" data-reveal>
        <table class="course-comparison-table">
          <thead>
            <tr>
              <th style="width: 25%;">Tiêu chí so sánh</th>
              <th style="width: 37.5%;">Khóa Trang Điểm Cá Nhân</th>
              <th style="width: 37.5%;" class="highlight">Khóa Makeup Chuyên Nghiệp ⭐</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td class="criteria-title">Mục tiêu khóa học</td>
              <td>Làm chủ gương mặt của chính mình, tự tin makeup đi làm chỉ sau 10-15 phút và dự tiệc nhẹ nhàng sang trọng.</td>
              <td style="font-weight: 600; color: var(--color-rose-deep);">Đào tạo toàn diện để trở thành Makeup Artist chuyên nghiệp, vững tay nghề nhận show cưới/dạ tiệc và mở studio riêng.</td>
            </tr>
            <tr>
              <td class="criteria-title">Đối tượng học viên</td>
              <td>Chị em văn phòng, học sinh/sinh viên, người chưa từng cầm cọ trang điểm (Zero-base).</td>
              <td>Người muốn chuyển nghề, Makeup Artist mới ra nghề cần nâng cao tay nghề, người định hướng mở tiệm kinh doanh.</td>
            </tr>
            <tr>
              <td class="criteria-title">Thời lượng đào tạo</td>
              <td><strong>4 – 5 buổi</strong> (Khoảng 2–3 tuần, mỗi buổi 2.5 tiếng).</td>
              <td><strong>2 – 3 tháng</strong> thực chiến (12 tuần, 2-3 buổi/tuần, mỗi buổi 3-4 tiếng).</td>
            </tr>
            <tr>
              <td class="criteria-title">Sĩ số &amp; Phương pháp</td>
              <td>Lớp nhỏ tối đa 5 học viên hoặc gói VIP kèm 1:1 trực tiếp.</td>
              <td>Lớp tối đa 5 học viên — Master Lily Chen trực tiếp &quot;cầm tay chỉ việc&quot;, uốn nắn từng góc cọ.</td>
            </tr>
            <tr>
              <td class="criteria-title">Tỷ lệ thực hành</td>
              <td>100% thực hành trực tiếp trên chính khuôn mặt bạn.</td>
              <td><strong>80% thực chiến trên người mẫu thật</strong> ngay từ các buổi đầu — nói không với học lý thuyết chay.</td>
            </tr>
            <tr>
              <td class="criteria-title">Mỹ phẩm &amp; Dụng cụ</td>
              <td>Tài trợ 100% mỹ phẩm chính hãng &amp; dụng cụ tại lớp suốt khóa.</td>
              <td>Tài trợ 100% mỹ phẩm High-end tại lớp + Tặng kèm Bảng màu mắt cao cấp khởi nghiệp.</td>
            </tr>
            <tr>
              <td class="criteria-title">Quà tặng đặc quyền</td>
              <td>Tư vấn set up túi makeup cá nhân tinh gọn; Tặng Gói chụp Beauty (với gói VIP).</td>
              <td>
                <strong>Gói quà tặng trị giá &gt;13.000.000đ:</strong><br>
                • Khóa búi tóc chuyên nghiệp (8.000.000đ)<br>
                • Khóa Media quay chụp bằng điện thoại (5.000.000đ)<br>
                • Bảng màu mắt cao cấp
              </td>
            </tr>
            <tr>
              <td class="criteria-title">Kết quả tốt nghiệp</td>
              <td>Hiểu làn da, phân tích tỉ lệ mặt, tự makeup đẹp cho bản thân trong mọi dịp.</td>
              <td>Làm chủ mọi layout (Cô dâu, Dự tiệc, Douyin, Fashion), thi tốt nghiệp, cấp bằng &amp; chụp Portfolio mẫu thật.</td>
            </tr>
            <tr>
              <td class="criteria-title">Học phí đầu tư</td>
              <td>
                <strong>Chỉ từ 1.500.000đ</strong><br>
                <span style="font-size: 0.85rem; color: var(--text-muted);">(Cơ bản: 1.5tr | Nâng cao: 2tr | VIP 1:1: 3tr)</span>
              </td>
              <td>
                <strong style="color: var(--color-rose-deep); font-size: 1.25rem;">25.000.000đ</strong>
                <del style="color: var(--text-muted); margin-left: 6px;">30.000.000đ</del><br>
                <span style="font-size: 0.82rem; color: #166534; font-weight: 600;">Tiết kiệm 5.000.000đ · Hỗ trợ trả góp 2–3 đợt</span>
              </td>
            </tr>
            <tr>
              <td class="criteria-title">Tìm hiểu chi tiết</td>
              <td>
                <a href="<?php echo esc_url(home_url('/khoa-hoc-trang-diem-ca-nhan/')); ?>" class="btn btn-secondary btn-sm" style="margin-top: 4px;">
                  Chi Tiết Khóa Cá Nhân &rarr;
                </a>
              </td>
              <td>
                <a href="<?php echo esc_url(home_url('/khoa-hoc-trang-diem-chuyen-nghiep/')); ?>" class="btn btn-primary btn-sm" style="margin-top: 4px;">
                  Chi Tiết Khóa Chuyên Nghiệp &rarr;
                </a>
              </td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </section>

  <!-- ========================================================
       WHY CHOOSE LILY CHEN ACADEMY (3 CORE PILLARS)
       ======================================================== -->
  <section class="section-padding">
    <div class="container">
      <div class="section-header text-center" data-reveal>
        <span class="section-tag">CAM KẾT ĐÀO TẠO</span>
        <h2 class="section-title">3 Khác Biệt Làm Nên Uy Tín Của Lily Chen</h2>
        <p class="section-desc">
          Chúng tôi thấu hiểu nỗi lo của bạn: sợ học lý thuyết chay, sợ lớp quá đông không ai kèm, và sợ các khoản chi phí ẩn mỹ phẩm phát sinh. Lily Chen ra đời để giải quyết triệt để những rào cản đó.
        </p>
      </div>

      <div class="skills-grid course-pillars-grid" data-reveal-stagger>
        <div class="skill-card">
          <div class="skill-num">01</div>
          <h3 class="skill-title">80% – 90% Mẫu Thật</h3>
          <p class="skill-desc">
            Học đi đôi với làm, nói không với học chay. Học viên được cọ xát thực tế trên đa dạng nền da (da mụn, da khô, da dầu) và nhiều cấu trúc khuôn mặt. Tốt nghiệp là tự tin nhận khách ngay.
          </p>
        </div>

        <div class="skill-card">
          <div class="skill-num">02</div>
          <h3 class="skill-title">Sĩ Số Vàng 1:5</h3>
          <p class="skill-desc">
            Lớp nhỏ cầm tay chỉ việc, Master Lily Chen trực tiếp uốn nắn từng góc cầm cọ, lực tán nền, nét kẻ eyeliner theo từng khung xương mặt. Không bao giờ có tình trạng lớp đông chen chúc.
          </p>
        </div>

        <div class="skill-card">
          <div class="skill-num">03</div>
          <h3 class="skill-title">Minh Bạch 100%</h3>
          <p class="skill-desc">
            Học phí công bố là học phí trọn gói. Đã bao gồm mỹ phẩm cao cấp và dụng cụ thực hành tại lớp. Tuyệt đối không chèo kéo, không vẽ thêm chi phí mỹ phẩm hàng chục triệu đồng.
          </p>
        </div>
      </div>
    </div>
  </section>

  <!-- ========================================================
       SECTION: CONSULTATION FORM
       ======================================================== -->
  <section id="dang-ky" class="section-padding conversion-section">
    <div class="container">
      <div class="conversion-grid">
        <!-- Left Column: Information -->
        <div class="conversion-info" data-reveal>
          <span class="section-tag">TƯ VẤN MIỄN PHÍ</span>
          <h2 class="conversion-title">Bạn Cần Hỗ Trợ Chọn Lộ Trình Phù Hợp?</h2>
          <p class="conversion-desc">
            Đừng ngần ngại để lại thông tin. Master Lily Chen sẽ trực tiếp lắng nghe mong muốn, phân tích nền tảng hiện tại và tư vấn giải pháp tối ưu nhất cho quỹ thời gian và ngân sách của bạn.
          </p>

          <div class="conversion-benefits">
            <div class="benefit-item">
              <svg class="check-icon" width="18" height="18" viewBox="0 0 24 24" fill="var(--color-rose)"><path d="M9 16.17L4.83 12l-1.42 1.41L9 19 21 7l-1.41-1.41z"/></svg>
              <span>Tư vấn hoàn toàn miễn phí &amp; không chèo kéo mua khóa học</span>
            </div>
            <div class="benefit-item">
              <svg class="check-icon" width="18" height="18" viewBox="0 0 24 24" fill="var(--color-rose)"><path d="M9 16.17L4.83 12l-1.42 1.41L9 19 21 7l-1.41-1.41z"/></svg>
              <span>Học viên được xếp lịch học linh hoạt theo thời gian rảnh cá nhân</span>
            </div>
            <div class="benefit-item">
              <svg class="check-icon" width="18" height="18" viewBox="0 0 24 24" fill="var(--color-rose)"><path d="M9 16.17L4.83 12l-1.42 1.41L9 19 21 7l-1.41-1.41z"/></svg>
              <span>Tài trợ 100% mỹ phẩm chính hãng trải nghiệm thực tế tại lớp</span>
            </div>
            <div class="benefit-item">
              <svg class="check-icon" width="18" height="18" viewBox="0 0 24 24" fill="var(--color-rose)"><path d="M9 16.17L4.83 12l-1.42 1.41L9 19 21 7l-1.41-1.41z"/></svg>
              <span>Hỗ trợ chính sách trả góp 2–3 đợt linh hoạt cho khóa chuyên nghiệp</span>
            </div>
          </div>
        </div>

        <!-- Right Column: Interactive Lead Form -->
        <div class="lead-form-card" data-reveal>
          <div class="lead-form-header">
            <h3 class="lead-form-title">Đăng Ký Nhận Tư Vấn</h3>
            <p class="lead-form-sub">Nhận phân tích phong cách trang điểm &amp; ưu đãi học phí</p>
          </div>

          <form id="leadForm" class="lead-form" novalidate>
            <input type="hidden" name="source_page" value="<?php echo esc_attr(home_url('/khoa-hoc/')); ?>">

            <div class="form-group">
              <label for="leadName" class="form-label">Họ và tên của bạn <span>*</span></label>
              <input type="text" id="leadName" name="name" class="form-control" placeholder="Ví dụ: Nguyễn Thùy Linh" required>
            </div>

            <div class="form-group">
              <label for="leadPhone" class="form-label">Số điện thoại / Zalo <span>*</span></label>
              <input type="tel" id="leadPhone" name="phone" class="form-control" placeholder="Ví dụ: 0987 654 321" required>
            </div>

            <div class="form-group">
              <label for="leadCourse" class="form-label">Khóa học bạn quan tâm <span>*</span></label>
              <select id="leadCourse" name="course" class="form-control" required>
                <option value="" disabled selected>-- Chọn khóa học bạn muốn tư vấn --</option>
                <option value="Khóa Cá Nhân - Gói Cơ Bản (1.500.000đ)">Khóa Cá Nhân - Gói Cơ Bản (4 buổi · 1.500.000đ)</option>
                <option value="Khóa Cá Nhân - Gói Nâng Cao (2.000.000đ)">Khóa Cá Nhân - Gói Nâng Cao (5 buổi · 2.000.000đ)</option>
                <option value="Khóa Cá Nhân - Gói VIP 1:1 (3.000.000đ)">Khóa Cá Nhân - Gói VIP 1:1 (5 buổi kèm riêng · 3.000.000đ)</option>
                <option value="Khóa Chuyên Nghiệp (Ưu đãi 25.000.000đ)">Khóa Makeup Chuyên Nghiệp (2-3 tháng · Ưu đãi 25.000.000đ)</option>
                <option value="Tôi cần tư vấn chọn khóa phù hợp">Tôi cần Lily Chen tư vấn chọn khóa phù hợp</option>
              </select>
            </div>

            <div class="form-group">
              <label for="leadTime" class="form-label">Khung giờ học mong muốn</label>
              <select id="leadTime" name="time" class="form-control">
                <option value="Linh hoạt">Linh hoạt theo lịch rảnh của tôi</option>
                <option value="Ca Sáng (09:00 - 11:30)">Ca Sáng (09:00 - 11:30)</option>
                <option value="Ca Chiều (14:00 - 16:30)">Ca Chiều (14:00 - 16:30)</option>
                <option value="Ca Tối (18:00 - 20:30)">Ca Tối (18:00 - 20:30 - Thích hợp văn phòng)</option>
                <option value="Cuối tuần (Thứ 7 - CN)">Học vào các ngày cuối tuần (Thứ 7 - CN)</option>
              </select>
            </div>

            <div class="form-group">
              <label for="leadMessage" class="form-label">Ghi chú hoặc câu hỏi của bạn</label>
              <textarea id="leadMessage" name="message" class="form-control" rows="3" placeholder="Ví dụ: Mình chưa từng makeup, muốn học để tự tin đi làm mỗi ngày..."></textarea>
            </div>

            <button type="submit" class="btn btn-primary btn-lg form-submit-btn">
              GỬI ĐĂNG KÝ TƯ VẤN
              <svg width="18" height="18" viewBox="0 0 24 24" fill="currentColor"><path d="M5 13h11.86l-5.43 5.43 1.42 1.42L21.14 12l-8.29-8.29-1.42 1.42L16.86 11H5v2z"/></svg>
            </button>

            <div class="form-privacy-note">
              <svg width="15" height="15" viewBox="0 0 24 24" fill="currentColor"><path d="M12 1L3 5v6c0 5.55 3.84 10.74 9 12 5.16-1.26 9-6.45 9-12V5l-9-4zm-2 16l-4-4 1.41-1.41L10 14.17l6.59-6.59L18 9l-8 8z"/></svg>
              Thông tin được bảo mật tuyệt đối theo <a href="<?php echo esc_url(home_url('/chinh-sach-bao-mat/')); ?>" style="color: inherit; text-decoration: underline;">Chính sách bảo mật</a>. Lily Chen Academy sẽ liên hệ trong 24 giờ.
            </div>

            <!-- Success Notification Box -->
            <div id="formSuccessMsg" class="form-success-msg" role="status" aria-live="polite"></div>
          </form>
        </div>
      </div>
    </div>
  </section>
</main>

<?php
get_footer();
