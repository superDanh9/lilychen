# HANDOFF — LILY CHEN SPRINT NGÀY 1 ĐÃ XONG FOOTER

> **File này dùng cho chat mới** để tiếp tục sprint 25/05/2026 từ task **Landing Page khóa Cá Nhân**.
> Đọc kèm với: `HANDOFF-LILYCHEN-MAKEUP-v2.md`, `HANDOFF-LILYCHEN-SPRINT-2505.md`, `about-danh.md` trong Project Knowledge.
>
> **Cập nhật lần cuối:** 20/05/2026 (Ngày 1 sprint - sau khi footer hoàn tất).

---

## 1. SPRINT GOAL (KHÔNG ĐỔI)

- Hoàn thiện 6 trang website trước 24/05/2026
- Ads launch 25/05/2026 (budget 5 triệu, focus khóa Cá Nhân)
- Đồ án deadline đầu tháng 7/2026

---

## 2. ĐÃ XONG NGÀY 1 ✅

### Footer mới (HOÀN THÀNH)

- ✅ Background đen `#2c2c2c` sang trọng (style Liphamy)
- ✅ Logo text "LILYCHEN" + "Makeup Academy" font Playfair Display (không dùng PNG)
- ✅ 4 cột: Brand+Social | Liên hệ NAP | Menu | Google Maps embed
- ✅ Icons dùng SVG base64 data URI (giải pháp cuối cùng sau khi:
  - Class `icon-location` của Flatsome không có → dùng Unicode emoji bị WP escape
  - SVG inline → bị WP Customizer reject vì security
  - → **Chốt: SVG → base64 → nhúng vào `<img src="data:image/svg+xml;base64,...">`**)
- ✅ Absolute Footer mặc định Flatsome đã ẩn hoàn toàn bằng CSS
- ✅ Copyright bar `#1a1a1a` + 2 link Privacy/Terms
- ✅ Google Maps embed pin chính xác Lily Chen (URL có Place ID)
- ✅ Chỉ còn 1 social icon Facebook (bỏ IG + TikTok vì Lily chưa có)
- ✅ URL Facebook thật: `https://www.facebook.com/profile.php?id=61562076789244`

### 2 trang pháp lý (HOÀN THÀNH)

- ✅ Trang `/chinh-sach-bao-mat/` (~1800 từ, 10 mục)
- ✅ Trang `/dieu-khoan-su-dung/` (~1900 từ, 15 mục)
- ✅ Cả 2 viết theo **Luật Bảo vệ dữ liệu cá nhân 2025 (Luật 91/2025/QH15)** — KHÔNG dùng Nghị định 13/2023 (đã hết hiệu lực từ 01/01/2026)
- ✅ Link cross-reference đã sửa từ `claude.ai/...` → `lilychenmakeup.com/...`

### Schema LocalBusiness (CHƯA LÀM — vẫn cần cho SEO local)

- ⏳ JSON-LD chuẩn theo Luật mới, paste vào ô "HTML after footer" trong Customize > Footer
- ⏳ File đã có sẵn: `lilychen-schema-localbusiness.html` (xem outputs cũ)
- ⏳ Lưu ý cần cập nhật: chỉ còn 1 social link Facebook, không phải 3

---

## 3. CHƯA LÀM CHO SPRINT (THỨ TỰ ƯU TIÊN)

| # | Task | Ưu tiên | Ước thời gian |
|---|---|---|---|
| 1 | **Landing page `/lp-khoa-ca-nhan/`** (việc CHÍNH ngày 1 còn lại) | 🔴 Rất cao | 4-6h |
| 2 | Schema LocalBusiness (paste vào HTML after footer) | 🟡 Trung | 15 phút |
| 3 | Polish trang chủ | 🟡 Trung | 1h |
| 4 | Polish `/khoa-hoc/` (fix khoảng trắng dưới ảnh) | 🟢 Thấp | 30 phút |
| 5 | Code trang `/gioi-thieu/` (E-E-A-T) | 🟡 Trung | 2h |
| 6 | Code trang `/lien-he/` (form + Maps + NAP) | 🟡 Trung | 1.5h |
| 7 | Code trang `/tac-pham-hoc-vien/` (gallery) | 🟡 Trung | 1h |
| 8 | Tối ưu ảnh + Alt text 6 trang | 🟢 Thấp | 2h (chia với bạn cùng nhóm) |
| 9 | Meta tags + Heading hierarchy audit | 🟢 Thấp | 1h |
| 10 | Setup GTM + GA4 events + Facebook Pixel | 🔴 Cao | 2h |

---

## 4. TÀI NGUYÊN ĐÃ CÓ (TRONG OUTPUTS HOẶC PROJECT)

### File CSS hoàn chỉnh đang dùng (đã deploy)
- `lilychen-custom-FINAL.css` — Global Custom CSS (gồm popup + trang chủ + khóa học + footer)
- `PATCH-CSS-FOOTER-V3-CLEAN.css` — Patch CSS cho IMG (đã merge vào FINAL)

### File shortcode footer đang dùng (đã deploy)
- `lilychen-footer-shortcode-V4-FINAL.txt` — Shortcode footer chính thức (1 FB only + Maps thật + SVG base64)

### Tài liệu reference
- `research_lilychenmakeup.docx` — Research gốc Lily Chen
- `Phan-tich-doi-thu-LilyChen.docx` — Phân tích 22 đối thủ
- `chinh-sach-bao-mat.md` — Content trang Chính sách bảo mật
- `dieu-khoan-su-dung.md` — Content trang Điều khoản sử dụng

---

## 5. BÀI HỌC TỪ NGÀY 1 (QUAN TRỌNG CHO CHAT MỚI)

Đây là các pitfalls đã gặp + giải pháp, **chat mới đọc kỹ để KHÔNG lặp lại**:

### Bài học #1: WordPress Customizer block thẻ `<svg>` trong widget HTML
→ Khi cần icon, **dùng SVG encode base64 trong `<img src="data:image/svg+xml;base64,...">`**, không dùng SVG inline.

### Bài học #2: Class icon font Flatsome không nhất quán
→ Class `icon-location`, `icon-email`, `icon-clock` KHÔNG tồn tại trong Flatsome.
→ Không tin tưởng class icon font theme, **luôn dùng SVG tự host**.

### Bài học #3: WordPress escape Unicode emoji thành HTML entity
→ Emoji 📍 ✉ bị convert thành `&#x1f4cd;` `&#x2709;` → hiển thị text thay vì icon.
→ Không dùng Unicode emoji trong shortcode WP.

### Bài học #4: CSS không chấp nhận comment HTML
→ Comment phải dùng `/* */`, KHÔNG dùng `<!-- -->`.
→ Trước khi gửi file CSS, **verify không có ký tự HTML lẫn vào**.

### Bài học #5: Markdown link relative bị browser parse sai context
→ `[Link](/page/)` paste vào WP có thể giữ domain `claude.ai` thay vì `lilychenmakeup.com`.
→ **Luôn dùng absolute URL** `https://lilychenmakeup.com/page/` trong file Markdown sẽ paste vào WP.

### Bài học #6: Nghị định 13/2023 đã hết hiệu lực từ 01/01/2026
→ Thay bằng **Luật 91/2025/QH15** (Luật Bảo vệ dữ liệu cá nhân 2025).
→ KHÔNG dùng template Privacy Policy/Terms cũ từ Google search.
→ Khi viết content pháp lý → **luôn web_search verify** luật hiện hành trước.

### Bài học #7 (từ Danh): "Vấn đề cơ bản tốn nhiều thời gian xử lý"
→ Trước khi gửi code dài, **verify từng phần nhỏ**:
   - CSS có valid syntax không? (kiểm tra `}` đóng/mở, comment đúng cú pháp)
   - HTML có bị WP security reject không?
   - URL có tuyệt đối không?
   - Class CSS có thật sự tồn tại trong theme không?

→ Đầu tư 30 giây verify > 30 phút debug.

---

## 6. THÔNG TIN BRAND CỐT LÕI (KHÔNG ĐỔI)

| Item | Value |
|---|---|
| Tên | Lily Chen Makeup Academy |
| Địa chỉ | B14, Đường số 3, KDC Hiệp Phát 2, P. Hiệp Thành, TP. Thủ Dầu Một, Bình Dương |
| Hotline | 088 997 97 91 |
| Email tạm | thlongntl@gmail.com |
| Giờ mở cửa | 7:00 - 21:00 (T2 - CN) |
| Facebook | https://www.facebook.com/profile.php?id=61562076789244 |
| Tọa độ GPS | 11.008445586116267, 106.66021628073656 |
| Place ID Google | 0x3174cfcd66482895:0x3b8b6467fd59eb3d (name: "LILYCHEN MAKEUP") |
| Màu thương hiệu | `#ff8da1`, `#d4537a` (gradient hồng) |
| Màu footer | `#2c2c2c` (nền chính), `#1a1a1a` (copyright bar) |
| Font heading | Playfair Display |
| Font body | Nunito |

---

## 7. LANDING PAGE KHÓA CÁ NHÂN — YÊU CẦU CHI TIẾT

### Mục tiêu
- URL: `lilychenmakeup.com/lp-khoa-ca-nhan/`
- Là **đích chính của ads** (Facebook Ads + có thể Google Ads)
- Conversion goal: **Form submit** (Họ tên + SĐT) hoặc **Click gọi hotline**
- Persona target: **Văn phòng 25-35 tuổi** (Persona A)

### Đặc điểm Landing khác trang `/khoa-hoc/` thường
- **KHÔNG có header navigation** đầy đủ (chỉ có logo, có thể nút "Gọi ngay" góc phải) → giảm exit options
- **KHÔNG có footer phức tạp** → footer rút gọn (chỉ địa chỉ + hotline + copyright)
- **KHÔNG có sidebar, blog widget**
- Single goal: convert → mọi element hỗ trợ goal đó

### Cấu trúc đề xuất (Framework: AIDA + PAS)

1. **Hero** — Headline đập vào pain point + 2 CTA (form submit + gọi ngay) + ảnh transformation
2. **Trust bar** — 4 metric: học viên / 90% thực hành / 1:5 / 24/7
3. **Problem Agitation** — Vẽ pain point cụ thể của Persona A (đánh nền mốc, không biết phối màu...)
4. **Solution** — 3 USP của Lily Chen
5. **Course Details** — Khóa Cá Nhân: thời lượng, sĩ số, lộ trình, học phí (price anchoring nếu có)
6. **Social Proof** — Before/After + Testimonial 3 cards (placeholder chờ Danh thu thập)
7. **About Lily Chen** — Mini bio + ảnh (E-E-A-T signal)
8. **FAQ** — 5-7 câu xử lý objection
9. **Final CTA** — Form đăng ký + Hotline + Urgency mềm

### Voice và copywriting
- **Ngôi thứ 3** (institutional) — "Tại Lily Chen Makeup Academy...", "Học viện cung cấp..."
- Xưng "chị" với độc giả (Persona A 25-35)
- KHÔNG dùng "Tôi"/"mình" như Blog

### Yêu cầu kỹ thuật
- Sử dụng lại Global Custom CSS đã có (không tạo file CSS mới)
- Style theo brand: hồng `#ff8da1` + `#d4537a`, font Playfair + Nunito
- Mobile responsive
- Page speed quan trọng (đây là landing ads, slow = mất tiền)
- Form CF7 mới (separate với form trang chủ để tracking riêng conversion)

---

## 8. CHỈ DẪN CHO CHAT MỚI

Chat mới phải:

1. **Đọc file này + 3 file handoff khác** trước khi trả lời
2. **KHÔNG plan lại** sprint từ đầu — plan đã có
3. **Hỏi 2-3 câu clarifying ngắn** về Landing page (vd: có giá học phí thật chưa? có ưu đãi gì cụ thể?) trước khi viết code
4. **Đi thẳng vào code Landing page** sau khi Danh confirm thông tin
5. **Verify từng kỹ thuật trước khi gửi**:
   - CSS có valid syntax (dùng `/* */` chỉ)
   - HTML không có `<svg>` inline (dùng SVG base64 nếu cần icon)
   - URL absolute (`https://lilychenmakeup.com/...`)
   - Class theme có tồn tại không
6. **KHÔNG dùng** Unicode emoji trong shortcode WP
7. **Áp dụng 7 bài học** ở mục 5 file này
