# HANDOFF — SPRINT ADS LAUNCH 25/05/2026

> **File này dành cho chat mới tiếp tục dự án Lily Chen Makeup Academy.**
> Đây là sprint NGẮN HẠN 3 ngày, KHÔNG thay thế HANDOFF-LILYCHEN-MAKEUP-v2.md.
> Đọc file v2 trước để có context tổng thể, sau đó đọc file này để biết scope sprint hiện tại.

---

## 1. BỐI CẢNH SPRINT

### Mục tiêu sprint
**Hoàn thiện website 6 trang trong 3 ngày (20-22/05/2026) để ads launch ngày 25/05 đạt conversion tốt.**

### Tại sao gấp
- **25/05/2026:** 2 bạn cùng nhóm bắt đầu chạy quảng cáo (budget 5 triệu, tập trung khóa Cá Nhân)
- Web không hoàn thiện → ads đốt tiền vô ích → data báo cáo xấu → đồ án mất điểm
- Logic Danh dùng (đúng): *"xây nhà xong mới tổ chức tân gia"*

### Đồ án
- **Tên:** Đồ án cuối kỳ "Digital Marketing with AI" — FPT Skillking
- **Nhóm:** 4 người. Danh + 1 bạn (yếu hơn) phụ trách web. 2 bạn còn lại lo ads + document
- **Deadline đồ án:** Đầu tháng 7/2026 (phản biện + thuyết trình với giám khảo)
- **Tiêu chí chấm (theo các khóa trước):** On-page SEO + Technical SEO + Content + UX rất khắt khe
  - Ảnh phải WebP, có alt text, đặt tên đúng
  - Schema markup, meta tags, heading hierarchy, internal linking
  - Core Web Vitals tốt
  - **KHÔNG có file chính thức** — đây là thông tin truyền miệng từ các khóa trước

### Phương án Danh chọn (đã thảo luận, đã chốt)
- **Phương án Y (mở rộng):** Làm 6 trang đồng bộ trong 3 ngày
- **Danh CHẤP NHẬN RỦI RO** scope rộng + thời gian gấp
- Lý do Danh chọn: muốn trải nghiệm áp lực thật để rèn kỹ năng làm việc dưới deadline

---

## 2. SCOPE SPRINT 3 NGÀY (CHỐT, KHÔNG ĐÀM PHÁN LẠI)

### Trang phải hoàn thiện (6 trang)

| # | Trang | Ưu tiên | Lý do |
|---|---|---|---|
| 1 | Trang chủ | Cao | Ads có thể dẫn về |
| 2 | `/khoa-hoc/` | **Rất cao** | Ads dẫn về chính |
| 3 | `/lp-khoa-ca-nhan/` (landing page mới) | **Rất cao** | Ads dẫn về chính, focus khóa Cá Nhân |
| 4 | `/gioi-thieu/` | Trung | E-E-A-T signal (Experience, Expertise) |
| 5 | `/lien-he/` | Trung | E-E-A-T + Local SEO + NAP |
| 6 | `/tac-pham-hoc-vien/` | Trung | E-E-A-T (Trustworthiness) + Social proof |

### Việc phải làm

**A. Code + Design**
- [ ] Footer redesign (đen sang trọng `#2c2c2c`, có Schema Local Business)
- [ ] Tạo landing page `/lp-khoa-ca-nhan/` (sub-folder, không phải subdomain)
- [ ] Polish trang chủ (sửa những gì lộ liễu)
- [ ] Polish `/khoa-hoc/` (đã có, cần check lại với góc nhìn ads conversion)
- [ ] Code trang `/gioi-thieu/` (cấu trúc E-E-A-T, content placeholder)
- [ ] Code trang `/lien-he/` (form + Google Maps embed + NAP structured)
- [ ] Code trang `/tac-pham-hoc-vien/` (gallery layout, placeholder cho ảnh Before/After)

**B. SEO Technical**
- [ ] Schema markup: LocalBusiness (footer) + Course (2 khóa) + FAQPage (trang chủ) + Organization
- [ ] Meta title + description cho 6 trang (qua Rank Math)
- [ ] Heading hierarchy audit (H1 duy nhất, H2 → H3 đúng cấu trúc)
- [ ] Internal linking giữa các trang
- [ ] Submit sitemap.xml (qua Rank Math) lên Google Search Console
- [ ] Tạo robots.txt chuẩn

**C. Tối ưu ảnh (chỉ ảnh trên 6 trang sprint, KHÔNG phải toàn site)**
- [ ] Compress ảnh (target <100KB cho ảnh thường, <300KB cho hero)
- [ ] Convert sang WebP (plugin hoặc tool online)
- [ ] Đặt tên file đúng (vd: `lily-chen-makeup-academy-binh-duong.webp` thay vì `IMG_2341.jpg`)
- [ ] Alt text cho **TẤT CẢ** ảnh trên 6 trang
- [ ] Lazy loading (Flatsome đã có sẵn, kiểm tra bật chưa)

**D. Tracking (BẮT BUỘC cho ads + report)**
- [ ] Cài Google Tag Manager (GTM)
- [ ] GA4 events: form_submit, button_click, scroll_depth (50%, 75%, 100%)
- [ ] Facebook Pixel (cho ads Meta)
- [ ] UTM template cho 2 bạn chạy ads
- [ ] Conversion tracking trong Google Ads (nếu có chạy Google Ads)

**E. Performance**
- [ ] Test Core Web Vitals 6 trang (PageSpeed Insights)
- [ ] Fix lỗi LCP, CLS nếu có
- [ ] Test mobile thực tế trên 2-3 thiết bị

### KHÔNG làm trong sprint này (để sau 25/05)
- Blog content (3-5 bài viết)
- Tối ưu ảnh các trang phụ ngoài 6 trang sprint
- Báo cáo đồ án chi tiết
- A/B testing landing page
- Email marketing setup

---

## 3. PHÂN CHIA TASK

Danh tự phân việc cho bạn còn lại theo ý Danh (Danh muốn tự làm để rèn kỹ năng quản lý).

**Gợi ý task có thể giao cho bạn yếu hơn:**
- Compress + rename + upload ảnh
- Điền alt text trong Media Library
- Test mobile, ghi note lỗi
- Sửa text/copy nội dung khi Danh chỉ định
- Điền meta tags qua Rank Math (sau khi Claude viết content)

**Task Danh nên giữ:**
- Paste code shortcode + CSS
- Debug khi lỗi
- Setup tracking (GA4, GTM, Pixel)
- Decision về design + SEO strategy

---

## 4. NHỮNG VIỆC DANH LÀM SONG SONG (NGOÀI CODE)

Danh đã cam kết làm các việc sau để có content thật cho 3 trang E-E-A-T:

- [ ] **Nhắn Zalo 5-10 học viên cũ** xin:
  - Ảnh chân dung (cho card review)
  - Ảnh Before/After (cho trang Tác phẩm + Section Before/After trang chủ)
- [ ] **Phỏng vấn Lily Chen 30 phút** (ghi âm):
  - Câu chuyện làm nghề, năm bắt đầu
  - Học viên đáng nhớ nhất
  - Triết lý giảng dạy
  - Thành tích, chứng chỉ, bằng cấp
- [ ] **Lấy số liệu thực** từ Lily: số học viên đã đào tạo, giá khóa Cá Nhân chính xác

---

## 5. THÔNG TIN KỸ THUẬT QUAN TRỌNG

### Hạ tầng
- **Hosting:** AZDIGI (cPanel link: hfn51-22098.azdigihost.com:2083)
- **Platform:** WordPress + Flatsome theme
- **Plugins đã cài:** Site Kit, Rank Math SEO, Contact Form 7, Popup Maker, Google Analytics, Flatsome theme
- **Plugins CẦN CÀI thêm cho sprint:** GTM4WP (Google Tag Manager) + plugin compress ảnh (ShortPixel hoặc Smush)

### Quyền của Danh
- ✅ Admin WordPress full
- ✅ cPanel AZDIGI (đã thấy ở screenshot)
- ✅ Cài plugin được
- ✅ Sửa code, CSS được
- ✅ Setup GA4, GTM, Pixel được

### Brand identity
- **Tên:** Lily Chen Makeup Academy
- **Địa chỉ:** B14, Đường số 3, KDC Hiệp Phát 2, P. Hiệp Thành, TP. Thủ Dầu Một, Bình Dương
- **Hotline:** 088 997 97 91
- **Email tạm thời:** `thlongntl@gmail.com` (đồng ý dùng tạm cho sprint, đổi sau)
- **Giờ mở cửa:** 7:00 - 21:00
- **Màu thương hiệu:** `#ff8da1`, `#d4537a` (gradient hồng). KHÔNG dùng `#ff1493` (chói)
- **Footer mới:** Nền đen `#2c2c2c` (phong cách A — Liphamy style)
- **Font:** Playfair Display (heading) + Nunito (body)

### Persona target ads
- **PRIMARY (focus ads):** Văn phòng 25-35 tuổi — Khóa Cá Nhân — giá rẻ, dễ ra đơn
- Persona 2 (secondary): Gen Z 18-24 — Khóa Chuyên Nghiệp

### Files đã có trong Project Knowledge
- `about-danh.md` — về Danh
- `HANDOFF-LILYCHEN-MAKEUP-v2.md` — handoff tổng thể (đọc cái này trước)
- `lilychen-homepage.txt` + `lilychen-trang-khoa-hoc.txt` — shortcode trang chủ + khóa học
- `lilychen-css-trang-khoa-hoc.css` — CSS trang khóa học
- `HUONG-DAN-TRIEN-KHAI.md` — hướng dẫn deploy cũ

### Files CHƯA có (sẽ tạo trong sprint)
- Shortcode + CSS footer mới
- Shortcode + CSS landing page khóa Cá Nhân
- Shortcode 3 trang E-E-A-T (Giới thiệu, Liên hệ, Tác phẩm)
- File checklist 3 ngày
- File hướng dẫn tracking (GTM, GA4, Pixel)
- File Schema markup JSON-LD

---

## 6. TIMELINE GỢI Ý (Chat mới có thể điều chỉnh)

### Ngày 1 — 20/05/2026 (Thứ Tư)
**Theme: CODE NGÀY — Tạo nền tảng**

| Buổi | Việc | Người làm |
|---|---|---|
| Sáng | Claude viết: Footer + Landing page Cá Nhân + Schema Local Business | Claude |
| Sáng | Danh paste Footer, test trên staging | Danh |
| Chiều | Claude viết: 3 trang E-E-A-T (Giới thiệu, Liên hệ, Tác phẩm) | Claude |
| Chiều | Danh paste Landing page + 3 trang E-E-A-T | Danh |
| Tối | Bạn yếu hơn: bắt đầu compress + rename ảnh đợt 1 | Bạn |
| Tối | Danh: nhắn Zalo 5 học viên xin ảnh, gọi Lily phỏng vấn | Danh |

### Ngày 2 — 21/05/2026 (Thứ Năm)
**Theme: CONTENT + ẢNH + META**

| Buổi | Việc | Người làm |
|---|---|---|
| Sáng | Claude viết meta tags + Schema cho 6 trang | Claude |
| Sáng | Danh + bạn: upload ảnh đã optimize, điền alt text | Cả 2 |
| Chiều | Danh: điền meta qua Rank Math | Danh |
| Chiều | Bạn: review nội dung trên các trang, ghi note lỗi | Bạn |
| Tối | Danh: phân tích phỏng vấn Lily, viết content trang Giới thiệu | Danh |

### Ngày 3 — 22/05/2026 (Thứ Sáu)
**Theme: TRACKING + PERFORMANCE + TEST**

| Buổi | Việc | Người làm |
|---|---|---|
| Sáng | Claude hướng dẫn Danh cài GTM + GA4 events | Claude + Danh |
| Sáng | Danh: cài Facebook Pixel, setup conversion tracking | Danh |
| Chiều | Test Core Web Vitals 6 trang, fix lỗi tốc độ | Claude + Danh |
| Chiều | Bạn: test mobile toàn bộ 6 trang, ghi note | Bạn |
| Tối | Final check: submit sitemap, internal linking, polish | Danh |

### Buffer — 23-24/05/2026 (Thứ Bảy - Chủ Nhật)
Fix lỗi phát sinh + bù việc chưa kịp ngày 1-3

### Ngày launch — 25/05/2026 (Thứ Hai)
Ads chạy. Monitor tracking có hoạt động không.

---

## 7. PHONG CÁCH LÀM VIỆC VỚI DANH

Đây là kim chỉ nam — chat mới TUYỆT ĐỐI tôn trọng:

- **Gọi:** "Danh"
- **Ngôn ngữ:** Tiếng Việt
- **Hỏi trước nếu chưa rõ** — không tự đoán
- **Cô đọng, có ví dụ thực tế**, ứng dụng được ngay
- **Nhắc khi có cách làm thông minh hơn** — push back khi cần
- **Gom feedback rồi sửa 1 lần**, không sửa lặt vặt nhiều vòng
- Không thích: tâng bốc, lý thuyết suông, nói chung chung
- **Đạo đức marketing:** Không bịa số, không review giả, dùng placeholder `[CẬP NHẬT]` cho data chưa có

### Push back có nguyên tắc
Khi Danh quyết định có rủi ro cao, chat mới **nên** nói thẳng — nhưng:
1. Nói rõ lý do tại sao rủi ro
2. Đề xuất phương án thay thế
3. **Nếu Danh vẫn quyết định giữ ý kiến → tôn trọng, không lặp lại**

Danh **đã chấp nhận rủi ro** scope 6 trang trong 3 ngày. Đây là quyết định cuối, không bàn lại.

---

## 8. ĐIỂM NHẠY CẢM CHAT MỚI CẦN BIẾT

### Danh có xu hướng tự đánh giá thấp bản thân
Khi Danh nói "tôi yếu/dốt" → check thực tế trước (có thể Dunning-Kruger ngược). Danh thực ra MẠNH hơn sinh viên marketing 4 năm điển hình ở mảng MarTech/Analytics (background MIS).

### Danh đang chịu áp lực thật
- Vừa học FPT Skillking + chạy Grab 3 buổi/tuần
- Deadline cứng cuối 2026 BẮT BUỘC có việc làm
- Áp lực gia đình
- Sprint 3 ngày này là áp lực thêm

→ Chat mới giúp Danh **thực tế** + **giữ momentum** + **không over-promise**.

### Quy tắc "AI giúp 70%, Danh làm 30%"
Chat mới phải nhớ: AI viết code + content tốt, nhưng KHÔNG thay được việc tay (upload ảnh, paste code, test mobile, gọi học viên...). Đừng để Danh kỳ vọng AI làm hộ toàn bộ.

---

## 9. ACCEPTANCE CRITERIA (Sprint xong khi nào?)

Sprint coi như **THÀNH CÔNG** nếu đến hết ngày 24/05:

- [x] 6 trang đều có content + cấu trúc hoàn thiện (placeholder OK với điều kiện cấu trúc đúng E-E-A-T)
- [x] Schema markup hoạt động (test bằng Google Rich Results Test)
- [x] Meta title + description cho 6 trang đều có
- [x] Ảnh trên 6 trang đều: WebP, có alt text, tên file đúng
- [x] GA4 + GTM + Facebook Pixel hoạt động (test bằng GA4 DebugView, Tag Assistant)
- [x] PageSpeed Insights mobile **>=70** cho 6 trang (lý tưởng >=80)
- [x] Mobile responsive không lỗi rõ ràng
- [x] Sitemap submitted lên Google Search Console
- [x] Footer mới đã thay footer cũ
- [x] Landing page `/lp-khoa-ca-nhan/` sẵn sàng nhận ads

Sprint **THẤT BẠI** nếu đến 25/05:
- Ads chạy nhưng tracking không hoạt động → không có data
- Trang quan trọng (Landing + /khoa-hoc/) bị lỗi nặng
- Core Web Vitals dưới 50

---

## 10. RỦI RO ĐÃ CHẤP NHẬN

Danh xác nhận hiểu các rủi ro sau:

1. **Scope vượt mức khuyến nghị** — bình thường 6 trang cần 1-2 tuần, ép 3 ngày dễ thiếu polish
2. **Phụ thuộc bạn còn lại** — nếu bạn không commit đủ thời gian, Danh phải gánh thêm
3. **Content placeholder** — 3 trang E-E-A-T có thể rỗng nếu Danh không kịp xin content thật
4. **Lỗi phát sinh không có buffer** — WordPress conflict, plugin bug có thể tốn nửa ngày
5. **Sức khỏe** — 3 ngày làm cường độ cao + vẫn học FPT + có thể vẫn chạy Grab

Trade-off Danh nhận: **rèn kỹ năng làm việc dưới áp lực thật** — đây là kỹ năng quan trọng cho công việc digital marketing sau này.

---

## 11. CHỈ DẪN CHO CHAT MỚI

Khi Danh mở chat mới với prompt đính kèm, chat mới phải:

1. **Đọc file này + HANDOFF-LILYCHEN-MAKEUP-v2.md** trước khi trả lời
2. **KHÔNG hỏi lại** những gì đã có trong handoff (về scope, phương án, deadline...)
3. **Bắt đầu bằng:**
   - Xác nhận đã hiểu sprint goal
   - Hỏi Danh đã sẵn sàng làm Ngày 1 chưa
   - Yêu cầu Danh screenshot trang `/khoa-hoc/` hiện tại để đánh giá thực trạng
4. **Đi thẳng vào task ngày 1** sau khi Danh confirm sẵn sàng
5. **KHÔNG plan lại từ đầu** — plan đã có trong handoff
6. Nếu Danh muốn đổi scope giữa sprint → push back 1 lần, nếu Danh giữ quyết định → tôn trọng

---

## 12. QUICK REFERENCE

| Item | Value |
|---|---|
| Sprint deadline | 24/05/2026 (buffer 23-24) |
| Ads launch | 25/05/2026 |
| Đồ án deadline | Đầu tháng 7/2026 |
| Hôm nay khi tạo handoff | 19/05/2026 |
| Còn lại | 5 ngày (3 sprint + 2 buffer) |
| Trang phải xong | 6 trang |
| Budget ads | 5 triệu VNĐ |
| Focus khóa | Cá Nhân (giá rẻ, dễ ra đơn) |
| Email tạm | thlongntl@gmail.com |
| Hosting | AZDIGI |
| Theme | Flatsome |
| SEO plugin | Rank Math |
