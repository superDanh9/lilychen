> Sắp xếp 08/10/2026: đường dẫn trong dấu backtick được hiểu từ gốc dự án, trừ tên handoff cùng thư mục. Trang HTML cũ và các mẫu thử nay ở `prototypes/static-site/`; thông tin triển khai bên dưới là ghi nhận lịch sử.

# Lily Chen Makeup Academy — Bàn Giao Triển Khai Production & Dọn Dẹp Staging

*Thời điểm hoàn tất:* Ngày 01/10/2026 (23:25 GMT+7)  
*Mục đích:* Ghi nhận hiện trạng cuối cùng sau khi website đã chuyển lên Production thành công, kiểm thử biểu mẫu tư vấn bằng trình duyệt thực tế và dọn dẹp hoàn tất môi trường Staging.

---

## 1. Môi trường Production Chính Thức
* **Tên miền website:** `https://lilychenmakeup.com`
* **Thư mục gốc web (Document Root):** `/home/qxhbxcsl/public_html`
* **Cơ sở dữ liệu Production:** `qxhbxcsl_wp622` (đang phục vụ trực tiếp, tuyệt đối không xóa/ghi đè).
* **Cơ sở dữ liệu cũ:** `qxhbxcsl_wp473` (bảo toàn nguyên vẹn trên hệ thống).
* **Giao diện kích hoạt:** Theme riêng `lilychen-academy` (phiên bản 1.0.0).

---

## 2. Mã Nguồn & Commit Triển Khai Thực Tế
* **Commit triển khai hiện tại:** `d12fb97ad12492e797e60fc5ff8f2dd76ff798f6`
  * *Thông điệp commit:* `fix(theme): remove test mode label from submit button and cleanup course form notification`
  * *Thời gian commit:* 2026-10-01 22:39:25 +0700.
* **Đối chiếu tệp tin:** Đã đối chiếu toàn diện bằng `diff -ru --strip-trailing-cr`. Thư mục theme tại `/home/qxhbxcsl/public_html/wp-content/themes/lilychen-academy` đồng nhất 100% với commit `d12fb97` trong Git repository.
* **Nút bấm & nhãn thử nghiệm:** Đã xóa hoàn toàn nhãn `(THỬ NGHIỆM)` / `Chế độ thử nghiệm`. Nút form hiển thị chuẩn `GỬI ĐĂNG KÝ TƯ VẤN` (ở Trang chủ và các trang Khóa học) và `GỬI THÔNG TIN LIÊN HỆ` (ở trang Liên hệ).

---

## 3. Hiện Trạng Staging Sau Khi Dọn Dẹp
* **Thư mục Staging:** Đã xóa hoàn toàn `/home/qxhbxcsl/public_html/staging`.
* **Kiểm tra trước khi xóa:**
  * 0 symlink từ Production trỏ vào Staging.
  * 0 cấu hình trong `.htaccess` hoặc `wp-config.php` phụ thuộc Staging.
  * 0 bản ghi đường dẫn `/staging/` trong cơ sở dữ liệu `qxhbxcsl_wp622`.
  * Không thiếu tệp tin media/uploads nào (Production có 760 tệp, bao quát toàn bộ 743 tệp của Staging).
* **Kết quả sau khi xóa:** URL `https://lilychenmakeup.com/staging/` trả về mã HTTP `404 Not Found`, xác nhận đã ngừng phục vụ hoàn toàn bản WordPress cũ.

---

## 4. Dung Lượng & Hạn Mức Tài Khoản cPanel
* **Hạn mức tài khoản cPanel (xác minh qua cPanel UAPI):**
  * Hạn mức gói hosting (Quota Limit): **3.072 MB** (3 GB).
  * Dung lượng đang sử dụng: **~711,49 MB** (bao gồm toàn bộ mã nguồn web, database và hòm thư).
  * Dung lượng còn trống: **~2.360,51 MB** (~76,9% hạn mức còn khả dụng).
* **Dung lượng thu hồi từ việc dọn Staging:** ~**440 MB** đã được giải phóng trực tiếp vào hạn mức lưu trữ của tài khoản.
* *Lưu ý kỹ thuật:* Số liệu phân vùng hệ điều hành `/dev/sda3` (1,7 TB / trống 75 GB) là thông số toàn bộ ổ cứng máy chủ dùng chung (shared server partition), không phản ánh hạn mức riêng của tài khoản cPanel `qxhbxcsl`.

---

## 5. Vị Trí Kho Lưu Trữ (Repositories) & Bản Sao Lưu (Backups)
* **Kho Git công khai (GitHub):** `https://github.com/superDanh9/lilychen` (nhánh `main`).
* **Kho Git cục bộ trên máy làm việc:** `c:\Users\Admin\OneDrive\Documents\Lilychen makeup academy`.
* **Kho Git trên hosting cPanel:** `/home/qxhbxcsl/repositories/lilychen-staging` (nhánh `main`, commit `d12fb97`; giữ nguyên phục vụ quản lý version).
* **Bản sao lưu theme trên hosting:** `/home/qxhbxcsl/lilychen-theme-backup-87zMy5na`.
* **Bản sao lưu theme cục bộ:** `theme-backup-2026-09-29` trong thư mục máy làm việc.

---

## 6. Hệ Thống Đăng Ký Tư Vấn (Lead Form) & Nghiệm Thu UI
* **Kiểm thử giao diện thực tế (Real Browser UI Test):**
  * Đã thực hiện kiểm thử thành công bằng trình duyệt Google Chrome ở trạng thái khách vãng lai chưa đăng nhập.
  * Mã bản ghi WordPress: **Post ID `983`** (Post Type: `dang_ky_tu_van`).
  * Tiêu đề: `Nguyễn Thu Hằng [TEST-UI] — 0901234588`.
  * Thời gian ghi nhận: `2026-10-01 23:09:37`.
  * Khóa học chọn: `Khóa Chuyên Nghiệp 3 Tháng` - Ca tối (18:00 - 20:30).
  * Thông báo giao diện: Hiển thị hộp xác nhận `✓ Gửi Yêu Cầu Tư Vấn Thành Công!` rõ ràng, nút bấm không bị treo loading.
* **Danh sách email nhận thông báo:**
  1. `thlongntl@gmail.com`
  2. `danh39379@gmail.com`
* **Trạng thái gửi email:** Ghi nhận `_mail_status = sent` trên hệ thống WordPress thông qua plugin WP Mail SMTP (đã dispatch thành công).

---

## 7. Kiểm Tra Hiển Thị Giao Diện Desktop & Mobile
* **Trang chủ (`/`):** Tải hoàn chỉnh, 26/26 ảnh hiển thị đúng, 0 lỗi tràn ngang (Desktop: PASS, Mobile: PASS).
* **Trang Khóa học cá nhân (`/khoa-hoc-trang-diem-ca-nhan/`):** Tải hoàn chỉnh, 14/14 ảnh hiển thị đúng, 0 lỗi tràn ngang (Desktop: PASS, Mobile: PASS).
* **Trang Khóa học chuyên nghiệp (`/khoa-hoc-trang-diem-chuyen-nghiep/`):** Tải hoàn chỉnh, 15/15 ảnh hiển thị đúng, giao diện khớp chuẩn, drawer menu trượt ẩn ngoài màn hình đúng thiết kế, thuộc tính `overflow-x: clip` ngăn chặn hoàn toàn việc phát sinh thanh cuộn ngang trên thiết bị di động (Desktop: PASS, Mobile: PASS).

---

## 8. Các Hạng Mục Chưa Thực Hiện / Để Lại Giai Đoạn Sau
* **Tên miền phụ `xinchaodanh.id.vn`:** Chưa thiết lập cấu hình hoặc trỏ DNS trong đợt này theo yêu cầu của chủ dự án.
* **Trình cài đặt tự động WordPress trên cPanel:** Tuyệt đối không sử dụng công cụ gỡ tự động của cPanel đối với bản Staging để tránh rủi ro xóa nhầm cơ sở dữ liệu `qxhbxcsl_wp622` đang phục vụ Production.
