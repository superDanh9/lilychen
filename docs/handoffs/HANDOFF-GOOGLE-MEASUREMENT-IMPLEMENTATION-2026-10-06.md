> Sắp xếp 08/10/2026: đường dẫn trong dấu backtick được hiểu từ gốc dự án, trừ tên handoff cùng thư mục. Trang HTML cũ và các mẫu thử nay ở `prototypes/static-site/`; thông tin triển khai bên dưới là ghi nhận lịch sử.

# BÁO CÁO TRIỂN KHAI VÀ XÁC MINH ĐO LƯỜNG GOOGLE (GTM & GA4)
**Website:** [Lily Chen Makeup Academy](https://lilychenmakeup.com/)  
**Thời điểm thực hiện:** 06/10/2026 18:30 (Asia/Saigon)  
**Tập tin bàn giao:** `HANDOFF-GOOGLE-MEASUREMENT-IMPLEMENTATION-2026-10-06.md`  
**Container GTM chính thức:** `GTM-TJRRBJRF` (Phiên bản Live: 18)  
**Tài sản GA4 chính thức:** `G-2917B9BVVX` (Property ID: `530676219`)  

---

## 1. CÁC TẬP TIN ĐÃ THAY ĐỔI & BẢN SAO LƯU (BACKUPS)

### 1.1. Danh sách tập tin thay đổi
Chỉ thay đổi đúng 3 tập tin cần thiết trong theme `lilychen-academy`, giữ nguyên toàn bộ giao diện, bố cục, hình ảnh/video, GSAP và hiệu ứng hạt:
1. `wordpress/lilychen-academy/functions.php`:
   - Bổ sung duy nhất một cơ chế tích hợp Google Tag Manager container `GTM-TJRRBJRF` qua standard WordPress hooks:
     - `wp_head` (priority 1): Thẻ script GTM đặt ở đầu `<head>`.
     - `wp_body_open` (priority 1): Thẻ noscript iframe đặt ngay sau `<body>`.
   - Không chèn thêm gtag cấu hình GA4 bên ngoài GTM.
2. `wordpress/lilychen-academy/inc/lead-handler.php`:
   - Hàm `lilychen_process_lead_submission($data)`:
     - Nhánh honeypot (`_hp_company`): Giả lập thành công cho bot nhưng trả cờ `'lead_saved' => false`. Không lưu DB, không gửi email.
     - Nhánh kiểm tra thời gian nạp form (< 2.5s): Trả `'lead_saved' => false`.
     - Nhánh rate limit (>= 5 lần / 10 phút): Trả `'lead_saved' => false`.
     - Nhánh kiểm tra hợp lệ họ tên và số điện thoại Việt Nam: Trả `'lead_saved' => false`.
     - Nhánh lưu database thất bại (`wp_insert_post` lỗi): Trả `'lead_saved' => false`.
     - **Nhánh lưu database thành công**: Trả cờ `'lead_saved' => true` kèm thông báo thành công.
     - Lỗi gửi email (nếu SMTP gián đoạn) không phủ nhận lead đã lưu trong database: vẫn trả `'lead_saved' => true`.
3. `wordpress/lilychen-academy/assets/js/main.js`:
   - Hàm chuẩn hóa danh mục cố định `getControlledCourseName(rawCourse)` và `getControlledFormId(form)`.
   - Trong bộ xử lý submit form: Chỉ đẩy sự kiện `form_lead_success` vào `window.dataLayer` khi thỏa mãn đồng thời:
     `response.ok && resData && resData.success && resData.lead_saved === true`.
   - Ngăn chặn đẩy trùng lặp qua cờ `form._leadMeasurementPushed`.
   - Cam kết Non-PII 100%: Tuyệt đối không gửi họ tên, số điện thoại, email, ghi chú hay nội dung phản hồi máy chủ vào dataLayer hay GA4.
   - Đặt trong khối `try ... catch`: Bất kỳ lỗi đo lường nào cũng không làm gián đoạn thông báo gửi form thành công hiển thị tới người dùng.

### 1.2. Vị trí bản sao lưu & Phương án Rollback
Trước khi sửa đổi và tải lên máy chủ, toàn bộ các tập tin nguyên bản đã được sao lưu đầy đủ:
- **Bản sao lưu Local:** `backups/production_pre_gtm_deploy_20261006/`
  - `functions.php` (MD5: `4815941869ec91a056efd2f0971c86f5`)
  - `header.php` (MD5: `f1eada992b39d5c92e98c47b9926c888`)
  - `inc/lead-handler.php` (MD5: `50a517baefe4275ae4c82b0a9278fba1`)
  - `assets/js/main.js` (MD5: `aae3c21a0dd8274f129b778976154a1a`)
- **Bản sao lưu Remote (trên máy chủ Production):** `/home/qxhbxcsl/backups_pre_gtm_deploy_20261006/`
- **Lệnh Rollback tức thì (nếu cần hoàn tác):**
  ```bash
  cp -p /home/qxhbxcsl/backups_pre_gtm_deploy_20261006/functions.php /home/qxhbxcsl/public_html/wp-content/themes/lilychen-academy/
  cp -p /home/qxhbxcsl/backups_pre_gtm_deploy_20261006/inc/lead-handler.php /home/qxhbxcsl/public_html/wp-content/themes/lilychen-academy/inc/
  cp -p /home/qxhbxcsl/backups_pre_gtm_deploy_20261006/assets/js/main.js /home/qxhbxcsl/public_html/wp-content/themes/lilychen-academy/assets/js/
  cd /home/qxhbxcsl/public_html && wp litespeed-purge all
  ```

---

## 2. KẾT QUẢ TRIỂN KHAI VÀ ĐỐI CHIẾU MÃ NGUỒN

1. **Triển khai có kiểm soát qua FTPS/SCP:**
   - Đã tải 3 tệp lên đúng đường dẫn theme hoạt động: `/home/qxhbxcsl/public_html/wp-content/themes/lilychen-academy/`.
2. **Kiểm tra cú pháp (Syntax Validation):**
   - `php -l functions.php`: `No syntax errors detected` (Exit code: 0).
   - `php -l inc/lead-handler.php`: `No syntax errors detected` (Exit code: 0).
   - `node -c assets/js/main.js`: Cú pháp JavaScript hợp lệ 100% (Exit code: 0).
3. **Làm sạch bộ đệm (LiteSpeed Cache Purge):**
   - Thực thi `wp litespeed-purge all` -> Kết quả: `Success: Đã xóa tất cả!`.
4. **Đối chiếu Checksum MD5 sau triển khai:**
   - `functions.php`: Local = Remote = `e0b58817c7c01ef4a77bb35a6e92e2db` (Khớp 100%).
   - `inc/lead-handler.php`: Local = Remote = `0bcea4be2abf846160519354c0ac78b4` (Khớp 100%).
   - `assets/js/main.js`: Local = Remote = `bda94d0246c4153aca40112417141ccc` (Khớp 100%).

---

## 3. BẰNG CHỨNG XÁC MINH RUNTIME TRÌNH DUYỆT THỰC TẾ

Đã sử dụng Headless Chrome kết nối trực tiếp qua giao thức Chrome DevTools Protocol (CDP) trên cả Trang chủ (`https://lilychenmakeup.com/`) và Trang con (`https://lilychenmakeup.com/lien-he/`):

### 3.1. Xác nhận nạp Google Tag Manager
- `window.google_tag_manager`: Tồn tại trên môi trường window (`true`).
- Danh sách Container đang nạp: `['GTM-TJRRBJRF']`.
- Network Request GTM:
  - `GET https://www.googletagmanager.com/gtm.js?id=GTM-TJRRBJRF` (HTTP 200).
- DataLayer ban đầu: Đã nạp các sự kiện tiêu chuẩn `gtm.js`, `gtm.dom`, `gtm.load`.

### 3.2. Xác nhận luồng dữ liệu GA4 chính thức `G-2917B9BVVX`
- Thẻ cấu hình chính #29 (`GA4 | Cấu hình chính | G-2917B9BVVX`) được GTM kích hoạt tự động:
  - `GET https://www.googletagmanager.com/gtag/js?id=G-2917B9BVVX&cx=c&gtm=4e6a21` (HTTP 200).
  - `POST https://analytics.google.com/g/collect?v=2&tid=G-2917B9BVVX&...` (HTTP 204).
  - `POST https://stats.g.doubleclick.net/g/collect?v=2&tid=G-2917B9BVVX&...` (HTTP 204).
  - `POST https://www.google.com/measurement/conversion?tid=G-2917B9BVVX&en=first_visit`
  - `POST https://www.google.com/measurement/conversion?tid=G-2917B9BVVX&en=session_start`
- **Kết luận:** Trình duyệt thực tế đã gửi thành công các gói tin thu thập dữ liệu (hits) về đúng luồng GA4 chính thức `G-2917B9BVVX`.

### 3.3. Bảo toàn nguyên vẹn toàn bộ hệ thống Google Ads
- Các thẻ Ads đang kích hoạt trên GTM phiên bản Live 18 không bị ảnh hưởng:
  - `GET https://www.googletagmanager.com/gtag/js?id=AW-18140552512`
  - `GET https://www.googletagmanager.com/gtag/js?id=AW-18036531249`
  - `POST https://www.google.com/rmkt/collect/18036531249/`
  - `GET https://www.googleadservices.com/pagead/conversion/18140552512/`
- Trình liên kết chuyển đổi (Conversion Linker) và các thẻ Google Ads gốc hoạt động bình thường.

---

## 4. KẾT QUẢ KIỂM THỬ XỬ LÝ FORM VÀ CONSENT

### 4.1. Hiện trạng Complianz Consent Mode
- Plugin `complianz-gdpr` (v7.5.5) đang hoạt động trên hệ thống, tuy nhiên cài đặt Wizard chưa được thiết lập khu vực lãnh thổ (`regions: array()`), cờ `consent_mode: false` và không có banner cookie hiển thị trên giao diện người dùng.
- Antigravity tuân thủ nghiêm ngặt chỉ dẫn: Không can thiệp, không vô hiệu hóa banner hay phá vỡ cài đặt consent mode.
- Thẻ GTM nạp chuẩn qua `wp_head` của theme, không bị Complianz chặn.

### 4.2. Kiểm thử chống Spam & Các nhánh từ chối trên Production
Đã thực thi kiểm thử độc lập các nhánh từ chối của `lilychen_process_lead_submission` trực tiếp trên máy chủ WordPress:
- **Nhánh Honeypot:** Gửi `_hp_company: 'Bot Company'` -> Kết quả: `success: true`, `lead_saved: false` (PASS). Không lưu lead vào database, không gửi email.
- **Nhánh Time-Gate:** Gửi form nạp tức thì (< 2.5s) -> Kết quả: `success: false`, `lead_saved: false` (PASS).
- **Nhánh Validation Số điện thoại:** Gửi số không hợp lệ -> Kết quả: `success: false`, `lead_saved: false` (PASS).
- **Nhánh Validation Họ tên:** Gửi tên < 2 ký tự -> Kết quả: `success: false`, `lead_saved: false` (PASS).
- **Kiểm tra cơ sở dữ liệu `dang_ky_tu_van`:** Tổng số lead hiện có: **0**. Tuyệt đối không tạo bất kỳ bản ghi lead hay kích hoạt email thật nào trong quá trình kiểm thử.

### 4.3. Kiểm thử Frontend Logic (Unit Tests)
- Mapping Khóa học cá nhân: `Khóa Cá Nhân 4 Buổi` -> `khoa_trang_diem_ca_nhan` (PASS).
- Mapping Khóa chuyên nghiệp: `Khóa Chuyên Nghiệp 3 Tháng` -> `khoa_trang_diem_chuyen_nghiep` (PASS).
- Mapping Khóa cô dâu: `Khóa Cô Dâu Nâng Cao` -> `khoa_chuyen_sau_co_dau` (PASS).
- Khóa mặc định / Chuỗi không hợp lệ -> `tu_van_khoa_hoc` (PASS).
- Mapping Form ID: Trang chủ -> `lead_form_home`, Trang khóa cá nhân -> `lead_form_ca_nhan`, Trang liên hệ -> `lead_form_lien_he` (PASS).
- Điều kiện bắn dataLayer: Chỉ bắn khi `resData.lead_saved === true`; từ chối bắn khi `lead_saved === false` hoặc lỗi mạng (PASS).
- Chống bắn trùng lặp (Deduplication): Ngăn chặn thành công các lượt push lặp lại (PASS).

---

## 5. PHẦN CẦN NGƯỜI DÙNG THỰC HIỆN ĐỂ NGHIỆM THU CUỐI CÙNG

Hệ thống kỹ thuật (GTM Container Live 18, hook WordPress, lead-handler trả cờ `lead_saved`, và frontend dataLayer event `form_lead_success`) đã sẵn sàng 100%.

Để nghiệm thu cuối cùng việc **GA4 thực sự ghi nhận sự kiện `generate_lead` trong báo cáo**:
Người quản trị (`danhn2130@gmail.com`) thực hiện đúng **1 lượt gửi form có kiểm soát** theo các bước sau:

1. **Bước 1:** Mở trình duyệt, đăng nhập vào **Google Analytics** (Tài sản `530676219` - *Lê Anh Khôi > lilychen*) -> Vào mục **Báo cáo (Reports)** -> **Thời gian thực (Realtime)** (hoặc **Quản trị** -> **DebugView** nếu mở qua Tag Assistant).
2. **Bước 2:** Truy cập website [https://lilychenmakeup.com/](https://lilychenmakeup.com/) (hoặc mở qua Google Tag Assistant: `tagassistant.google.com`).
3. **Bước 3:** Cuộn xuống form đăng ký tư vấn và điền thông tin thử nghiệm của chính bạn (ví dụ: Tên: *Nguyễn Thành Danh*, Số điện thoại thật của bạn, chọn khóa học muốn test). Đợi tối thiểu 3 giây sau khi trang tải xong rồi bấm **GỬI ĐĂNG KÝ TƯ VẤN**.
4. **Bước 4:** Quan sát:
   - Trên website: Xuất hiện hộp thông báo xanh *"Gửi Yêu Cầu Tư Vấn Thành Công!"*.
   - Trong WP-Admin (`/wp-admin/edit.php?post_type=dang_ky_tu_van`): Xuất hiện bản ghi lead mới với đầy đủ thông tin.
   - Trong GA4 Realtime: Sự kiện `generate_lead` xuất hiện với các tham số `course_name` và `form_id`.
   - Trong hòm thư (`thlongntl@gmail.com` và `danh39379@gmail.com`): Nhận email thông báo đăng ký mới.

> **Lưu ý quan trọng:** Không tự gửi nhiều lượt thử nghiệm liên tiếp để tránh kích hoạt cơ chế chống spam (rate limit 5 lần/10 phút) hoặc làm nhiễu dữ liệu của học viện.
