> Sắp xếp 08/10/2026: đường dẫn trong dấu backtick được hiểu từ gốc dự án, trừ tên handoff cùng thư mục. Trang HTML cũ và các mẫu thử nay ở `prototypes/static-site/`; thông tin triển khai bên dưới là ghi nhận lịch sử.

# BÁO CÁO KIỂM KÊ HỆ THỐNG ĐO LƯỜNG GOOGLE (READ-ONLY INVENTORY)
**Website:** [Lily Chen Makeup Academy](https://lilychenmakeup.com/)  
**Ngày thực hiện:** 04/10/2026 (Asia/Saigon)  
**Tập tin báo cáo:** `HANDOFF-GOOGLE-MEASUREMENT-INVENTORY-2026-10-04.md`  
**Chế độ thực hiện:** CHỈ ĐỌC VÀ BÁO CÁO (READ-ONLY) — Tuyệt đối không thay đổi mã nguồn, không sửa cấu hình WordPress/GTM/GA4/Ads, không submit form hay kích hoạt chuyển đổi thử nghiệm.

---

## 1. CÁC QUYẾT ĐỊNH CHÍNH THỨC ĐÃ ĐƯỢC NGƯỜI DÙNG XÁC NHẬN

* **Website chính thức:** `https://lilychenmakeup.com/` (tên miền Production phục vụ học viện).
* **Container GTM chính thức:** `GTM-TJRRBJRF`
  * GTM Account ID: `6348356206`
  * GTM Internal Container ID: `248566125`
  * Tên container: `lilychenmakeup.com`
* **Tài sản GA4 chính thức:** `530676219`
  * Google Analytics Account ID: `389434666` (Tên hiển thị: *Lê Anh Khôi > lilychen*)
  * Tên luồng web: `lilychen`
  * Web Stream ID: `14321840108`
  * Stream URL: `https://lilychenmakeup.com`
  * Measurement ID chính thức: `G-2917B9BVVX`
* **Người phụ trách chính GTM và GA4:** Nguyễn Thành Danh (`danhn2130@gmail.com`).
  * Đã xác minh có quyền **Quản trị viên tài khoản GTM** (Account Administrator), **Quyền Xuất bản vùng chứa GTM** (Publish), và **Quản trị viên tài sản GA4** (Property Administrator).
* **Google Ads:** Do thành viên khác phụ trách; **chưa chốt tài khoản Ads chính thức**.
  * Các mã cần đối chiếu độc lập (chưa được coi là cùng một tài khoản): `AW-18140552512`, `AW-18036531249` và Google Ads Customer ID `990-676-3686`.

---

## 2. NHỮNG GÌ ĐÃ XÁC MINH VÀ BẰNG CHỨNG TƯƠNG ỨNG

### 2.1. Hiện trạng Website Live & Mã nguồn WordPress

1. **Theme đang hoạt động thực tế trên máy chủ Production:**
   * **Bằng chứng:** Lệnh `wp theme list` thực thi trực tiếp trên máy chủ `/home/qxhbxcsl/public_html` xác nhận:
     * Theme `lilychen-academy` (version 1.0.0 / commit `d12fb97`) có trạng thái: **`active`**.
     * Các theme cũ: `flatsome` (3.20.1), `flatsome-child` (3.0), cùng các theme mặc định `twentytwentyfive`, `twentytwentyfour`, `twentytwentythree` đều ở trạng thái: **`inactive`**.
2. **Mã nguồn theme `lilychen-academy` (cả local và máy chủ):**
   * Đã kiểm tra `header.php`, `footer.php`, `functions.php` và thư mục `inc/`.
   * **Bằng chứng:** Theme có gọi hook tiêu chuẩn WordPress `wp_head()` (dòng 22 `header.php`), `wp_body_open()` (dòng 25 `header.php`), và `wp_footer()` (dòng 152 `footer.php`). Tuy nhiên, **hoàn toàn không có bất kỳ dòng mã nào hardcode thẻ script GTM, GA4 hay Google Ads** trong toàn bộ theme.
3. **Danh sách Plugin trên máy chủ Production (`wp plugin list`):**
   * **7 Plugin đang hoạt động (Active):**
     1. `backwpup` (v5.7.6)
     2. `complianz-terms-conditions` (v1.4.1)
     3. `complianz-gdpr` (v7.5.5)
     4. `litespeed-cache` (v7.9.1)
     5. `really-simple-ssl` (v9.8.3)
     6. `seo-by-rank-math` (v1.0.279)
     7. `wp-mail-smtp` (v4.10.0)
   * **Plugin đo lường cũ trên hosting nhưng ở trạng thái TẮT (Inactive):**
     * `google-site-kit` (v1.188.0): **`inactive`** (ĐÃ TẮT).
     * `duracelltomi-google-tag-manager` (GTM4WP v2.0.5): **`inactive`** (ĐÃ TẮT).
     * `contact-form-7`, `contact-form-cfdb7`, `popup-maker`: **`inactive`** (ĐÃ TẮT).
   * **Thư mục `wp-content/mu-plugins`:** Không tồn tại (0 script can thiệp ngầm).
   * **Không có plugin chèn code** (như WPCode, Header and Footer Scripts, Code Snippets) nào được cài đặt.
4. **Kiểm tra cài đặt Flatsome cũ và cơ sở dữ liệu (`wpfk_options`):**
   * **Bằng chứng:** Kiểm tra trường `theme_mods_flatsome` trong database Production `qxhbxcsl_wp622` cho thấy các cài đặt chèn script:
     * `html_scripts_header`: `""` (Rỗng).
     * `html_scripts_footer`: `""` (Rỗng).
     * `html_scripts_after_body`: `""` (Rỗng).
     * `html_scripts_before_body`: `""` (Rỗng).
     => Theme Flatsome cũ không để lại bất kỳ đoạn script đo lường nào trong theme options.
5. **Quan sát HTML live thực tế (Trang chủ `/`, Trang liên hệ `/lien-he/`, Trang `/khoa-hoc-trang-diem-ca-nhan/`):**
   * **Bằng chứng:** Đã tải trực tiếp mã HTML được sinh ra từ web server live và quét toàn bộ các thẻ `<script>`:
     * `GTM-TJRRBJRF` hoặc bất kỳ mã `GTM-*`: **KHÔNG CÓ TRÊN TRANG (0 kết quả)**.
     * `G-2917B9BVVX` hoặc bất kỳ mã `G-*`: **KHÔNG CÓ TRÊN TRANG (0 kết quả)**.
     * `AW-18140552512`, `AW-18036531249` hoặc bất kỳ `AW-*`: **KHÔNG CÓ TRÊN TRANG (0 kết quả)**.
     * `gtm.js` hoặc `gtag/js`: **KHÔNG ĐƯỢC TẢI (0 kết quả)**.
   * **Phát hiện về đoạn script duy nhất liên quan đến gtag trên trang live:**
     * Trên trang live có một thẻ inline script do plugin `complianz-gdpr` chèn tự động:
       ```javascript
       window.gtag_enable_tcf_support = !1;
       window.dataLayer = window.dataLayer || [];
       function gtag(){dataLayer.push(arguments)}
       gtag('js', new Date());
       gtag('config', '', {cookie_flags: 'secure;samesite=none'});
       ```
     * **Bằng chứng phân tích:** Đoạn script này chỉ là "stub rỗng" (config rỗng `''`) do Complianz khởi tạo cơ chế Consent Management khi chưa điền ID. **Hoàn toàn không có thư viện Google nào được kéo về và không có request đo lường HTTP nào được phát đi từ đoạn mã này.**

---

### 2.2. Hiện trạng GTM Container `GTM-TJRRBJRF`

* **Nguồn dữ liệu:** Đọc từ ảnh chụp giao diện thực tế do người dùng cung cấp (`workspaces/18`, `accounts/6348356206`, `containers/248566125`).
* **Không gian làm việc:** `Workspace 18`. Thay đổi đang chờ xử lý: **0** (0 đã sửa đổi, 0 đã thêm, 0 đã xoá — Workspace hoàn toàn đồng bộ với container).
* **Phân quyền GTM đã xác minh:**
  * **Cấp tài khoản (Account 6348356206):**
    * `anhkhoi8902@gmail.com`: Quản trị viên (Admin)
    * `Nguyễn Thành Danh` (`danhn2130@gmail.com`): Quản trị viên (Admin)
    * `phamthailoc20@gmail.com`: Người dùng (User)
    * `thlongntl@gmail.com`: Người dùng (User)
  * **Cấp vùng chứa (Container 248566125):**
    * Cả 4 thành viên (`anhkhoi8902`, `danhn2130`, `phamthailoc20`, `thlongntl`) đều có quyền **Xuất bản (Publish)**.
* **Cảnh báo chất lượng vùng chứa “Khẩn cấp” (1 issue):**
  * Giao diện GTM hiển thị cảnh báo: *"Chất lượng của Vùng chứa: Khẩn cấp. Các vấn đề về Vùng chứa có thể ảnh hưởng đến kết quả đo lường của bạn. Xem 1 issue."*
  * Sơ đồ kết nối hiển thị thẻ Google trỏ đến 2 đích: `AW-18140552512` và `Destination AW-18036531249` (chứa các ID: `AW-18036531249`, `GT-WFMZD5WQ`), cùng dòng `+2 more`.
  * *Lưu ý:* Cần người dùng click vào liên kết "Xem 1 issue" để đọc nội dung kỹ thuật chi tiết; không suy đoán nguyên nhân trước khi có bằng chứng.
* **Kiểm kê 13 Thẻ (Tags) trong GTM Workspace 18:**
  1. `Ads - Tracking Form Makeup Cá Nhân.` (Loại: Google Ads conversion; Trigger: `điền form - ana`; sửa 4 tháng trước)
  2. `cuon_trang` (Loại: GA4 event; Trigger: `cuộn trang`; sửa 6 tháng trước)
  3. `điền form` (Loại: GA4 event; Trigger: `điền form - ana`; sửa 6 tháng trước)
  4. `Etiqueta de Google AW-18036531249` (Loại: Google Tag; Trigger: `Initialization - All Pages`; sửa 4 tháng trước)
  5. `Google Ads - Chuyển đổi Điền Form` (Loại: Google Ads conversion; Trigger: `điền form - ana`; sửa 3 tháng trước)
  6. `Google Tag - analytics - Danh` (Loại: Google Tag; Trigger: `All Pages` & `Initialization - All Pages`, Ngoại lệ: `Initialization - All Pages`; sửa 4 tháng trước)
  7. `Tag - ads- lượt đăng ký` (Loại: Google Ads conversion; Trigger: `click đăng ký khóa học`; sửa 4 tháng trước)
  8. `tag-ads-bam goi` (Loại: Google Ads conversion; Trigger: **Không có trigger / Thẻ mồ côi**; sửa 4 tháng trước)
  9. `TAG-ANA BẤM GỌI` (Loại: GA4 event; Trigger: `nút gửi`; sửa 6 tháng trước)
  10. `tag-ana form` (Loại: GA4 event; Trigger: `điền form - ana`; sửa 6 tháng trước)
  11. `TAG-ANALY` (Loại: Google Tag; Trigger: `Initialization - All Pages`; sửa 6 tháng trước)
  12. `TAG-GGads-KHOI` (Loại: Google Tag; Trigger: `Initialization - All Pages`; sửa 5 tháng trước)
  13. `TRÌNH LK` (Loại: Conversion Linker / Trình liên kết chuyển đổi; Trigger: `All Pages`; sửa 5 tháng trước)

---

### 2.3. Hiện trạng GA4 (Tài sản `530676219`) và Liên kết Google Ads

* **Nguồn dữ liệu:** Đọc từ ảnh chi tiết luồng web và quyền truy cập tài sản.
* **Tài khoản GA4:** `389434666`, Tài sản: `530676219` (Lê Anh Khôi > lilychen).
* **Luồng web:** `lilychen` (ID: `14321840108`, URL: `https://lilychenmakeup.com`, Measurement ID: `G-2917B9BVVX`).
* **Tính năng đo lường nâng cao (Enhanced Measurement):** Đang **BẬT**.
  * Tự động đo: `page_view` (Lượt xem trang), `scroll` (Lượt cuộn 90%), `click` (Lượt nhấp liên kết ngoài), cùng 4 tính năng khác (Video, File download, Search, Form interactions).
* **Cảnh báo trong GA4:** *"Bạn chưa bật tính năng thu thập dữ liệu cho trang web của mình. Nếu bạn đã cài đặt thẻ hơn 48 giờ trước, hãy đảm bảo bạn đã thiết lập thẻ đúng cách."*
  * **Nguyên nhân đã chứng minh:** Do website live sau khi chuyển sang theme mới chưa được chèn mã GTM/GA4, nên không có dữ liệu gửi về luồng GA4 này.
* **Phân quyền GA4 đã xác minh:**
  * `anhkhoi8902@gmail.com`: Quản trị viên (Admin)
  * `Nguyễn Thành Danh` (`danhn2130@gmail.com`): Quản trị viên (Admin)
  * `phamthailoc20@gmail.com`: Quản trị viên (Admin)
  * `thlongntl@gmail.com`: Quản trị viên (Admin cấp tài sản)
* **BẰNG CHỨNG XÁC THỰC VỀ LIÊN KẾT GOOGLE ADS:**
  * Bảng phân quyền tài sản GA4 hiển thị danh sách quyền kế thừa từ tài khoản Google Ads:
    * **Google Ads Customer ID:** **`990-676-3686`**
    * Quản trị viên tài khoản Ads 990-676-3686: có vai trò **Người chỉnh sửa (Editor)** trong GA4.
    * Quyền truy cập tiêu chuẩn: vai trò **Nhà tiếp thị (Marketer)**.
    * Quyền thanh toán, chỉ đọc: vai trò **Người xem (Viewer)**.
  * **KẾT LUẬN ĐÃ CHỨNG MINH:** Tài sản GA4 `530676219` **ĐÃ ĐƯỢC LIÊN KẾT CHÍNH THỨC VỚI TÀI KHOẢN GOOGLE ADS `990-676-3686`**.

---

### 2.4. Vết tích cũ từ cơ sở dữ liệu (Google Site Kit & GTM4WP)

* Khi kiểm tra database cũ `qxhbxcsl_wp473` (bản trước ngày 01/10/2026):
  * Cả hai plugin `google-site-kit` và `duracelltomi-google-tag-manager` đều từng được kích hoạt (Active).
  * Trong bảng `wpfk_options` của database Production hiện tại `qxhbxcsl_wp622`, vẫn còn bản ghi cấu hình `googlesitekit_analytics-4_settings`:
    * Google Tag ID: `GT-TWMWHHXZ`
    * Destination ID: `G-2917B9BVVX`
    * GTM Container ID được Site Kit đồng bộ cũ: `248582853` (Account: `6348368346`)
    * Trạng thái liên kết Ads: `adsLinked = true`
  * Tuy nhiên, trên Production hiện tại, **cả 2 plugin này đều đã INACTIVE**, không chạy mã trên web.

---

## 3. BẢNG KIỂM KÊ TỔNG HỢP MÃ / THẺ ĐO LƯỜNG

| Mã / Tên Thẻ | Loại Thẻ / Công nghệ | Nguồn Chèn | Đích Nhận (Destination) | Điều Kiện Kích Hoạt (Trigger) | Mục Đích / Người Phụ Trách | Trạng Thái Xác Minh Hiện Tại |
|---|---|---|---|---|---|---|
| **GTM-TJRRBJRF** | Container GTM Chính Thức | Từng chèn qua custom code/plugin; **Hiện chưa gắn trên Live** | Toàn bộ các thẻ cấu hình trong Container | `All Pages` (theo chuẩn snippet) | Quản lý đo lường tập trung / Nguyễn Thành Danh | **Chưa xuất ra trang live** (Theme mới chưa chèn mã) |
| **G-2917B9BVVX** | GA4 Measurement ID Chính Thức | Trong GTM (qua Google Tag & GA4 Events) & Site Kit cũ | GA4 Property `530676219` (Luồng `14321840108`) | Theo thẻ Google & sự kiện GA4 | Thu thập dữ liệu hành vi & chuyển đổi / Nguyễn Thành Danh | **Chưa nhận dữ liệu** (Do GTM chưa được gắn trên web) |
| **GT-TWMWHHXZ** | Google Tag | Plugin Google Site Kit | GA4 `G-2917B9BVVX` | `wp_head` (khi Site Kit active) | Google Site Kit tự tạo liên kết GA4 | **Đã ngưng hoạt động** (Site Kit đã inactive) |
| **AW-18140552512** | Google Ads Tag / Destination | Trong GTM | Google Ads Account (chưa rõ ID) | Theo thẻ Ads trong GTM | Theo dõi chuyển đổi quảng cáo Ads | **Tồn tại trong cấu hình GTM**, chưa đối chiếu Customer ID |
| **AW-18036531249** / **GT-WFMZD5WQ** | Google Ads Tag & Google Tag | Trong GTM (`Etiqueta de Google...`) | Google Ads Account (chưa rõ ID) | `Initialization - All Pages` | Khởi tạo Google Tag cho Ads | **Tồn tại trong cấu hình GTM**, có tên tiếng Tây Ban Nha (*Etiqueta de Google*) |
| **Ads Customer ID 990-676-3686** | Tài khoản Google Ads | Liên kết trực tiếp GA4–Ads | GA4 Property `530676219` | Liên kết cấp hệ thống Google | Chia sẻ audience & conversion giữa GA4 và Ads | **Đã xác minh liên kết GA4**; cần xác minh có chạy chiến dịch thực tế không |
| `TRÌNH LK` | Conversion Linker | GTM Workspace 18 | Google Ads Click ID cookies | `All Pages` | Lưu trữ dữ liệu click ads trên trình duyệt | **Có trong GTM**, trạng thái bình thường |
| `Google Tag - analytics - Danh` | Google Tag | GTM Workspace 18 | Có thể là GA4 `G-2917B9BVVX` | `All Pages` & `Initialization - All Pages` (Ngoại lệ: `Initialization - All Pages`) | Thẻ Google cá nhân Danh tạo | **Có trong GTM**; Cấu hình kích hoạt và ngoại lệ đang triệt tiêu nhau |
| `TAG-ANALY` | Google Tag | GTM Workspace 18 | Chưa rõ ID bên trong | `Initialization - All Pages` | Thẻ Analytics cũ của nhóm | **Có trong GTM**; nguy cơ trùng lặp Google Tag |
| `TAG-GGads-KHOI` | Google Tag | GTM Workspace 18 | Có thể là `AW-18036531249` hoặc `AW-18140552512` | `Initialization - All Pages` | Thẻ Ads cá nhân Khôi tạo | **Có trong GTM**; nguy cơ trùng lặp Google Tag |
| `Etiqueta de Google AW-18036531249` | Google Tag | GTM Workspace 18 | `AW-18036531249` | `Initialization - All Pages` | Thẻ Google Ads tự động sinh | **Có trong GTM** |
| `điền form` | GA4 Event | GTM Workspace 18 | GA4 | `điền form - ana` | Đo lường gửi form tư vấn | **Có trong GTM**; trùng trigger với thẻ `tag-ana form` |
| `tag-ana form` | GA4 Event | GTM Workspace 18 | GA4 | `điền form - ana` | Đo lường gửi form tư vấn | **Có trong GTM**; trùng trigger với thẻ `điền form` |
| `cuon_trang` | GA4 Event | GTM Workspace 18 | GA4 | `cuộn trang` | Đo lường hành vi cuộn trang | **Có trong GTM**; Đo 4 mốc (25, 50, 75, 90%), khác với GA4 tự động đo mốc 90%; tạm dừng để đơn giản hóa |
| `TAG-ANA BẤM GỌI` | GA4 Event | GTM Workspace 18 | GA4 | `nút gửi` | Tên ghi "BẤM GỌI" nhưng trigger lại là "nút gửi" | **Có trong GTM**; mâu thuẫn giữa tên thẻ và trigger |
| `Ads - Tracking Form Makeup Cá Nhân.` | Google Ads Conversion | GTM Workspace 18 | Google Ads `18036531249` (label: `i_uk...`) | `điền form - ana` | Chuyển đổi form cá nhân | **Có trong GTM**; Khác label với thẻ form chung; chưa kết luận là chuyển đổi trùng lặp |
| `Google Ads - Chuyển đổi Điền Form` | Google Ads Conversion | GTM Workspace 18 | Google Ads `18036531249` (label: `jn7c...`) | `điền form - ana` | Chuyển đổi form chung | **Có trong GTM**; Khác label với thẻ form cá nhân; chưa kết luận là chuyển đổi trùng lặp |
| `Tag - ads- lượt đăng ký` | Google Ads Conversion | GTM Workspace 18 | Google Ads `18140552512` | `click đăng ký khóa học` (Trigger Form Text) | Đo click đăng ký | **Có trong GTM**; RỦI RO: Trigger dùng `{{Form Text}}`, có nguy cơ chuyển đổi ảo khi chưa gửi form |
| `tag-ads-bam goi` | Google Ads Conversion | GTM Workspace 18 | Google Ads | **Trống (Không có trigger)** | Thẻ mồ côi | **Có trong GTM**; Thẻ không bao giờ kích hoạt |

---

## 4. NGUY CƠ TRÙNG LẶP HOẶC THIẾU HỤT ĐO LƯỜNG

### 4.1. Những vấn đề ĐÃ CHỨNG MINH (Verified Issues)

1. **Thiếu hụt đo lường 100% trên Website Live (Zero Tracking):**
   * *Bằng chứng:* Kiểm tra HTML trực tiếp từ web server và quét DOM trên các trang `/`, `/lien-he/`, `/khoa-hoc-trang-diem-ca-nhan/` đều cho kết quả: 0 thẻ GTM, 0 thẻ GA4, 0 thẻ Ads.
   * *Hậu quả thực tế:* Mọi lượt truy cập của khách hàng, lượt điền form, lượt xem trang hiện tại **hoàn toàn không được ghi nhận vào GA4 hay Google Ads**.
2. **Cấu hình kích hoạt tự triệt tiêu trong thẻ `Google Tag - analytics - Danh`:**
   * *Bằng chứng:* Thẻ có Trigger kích hoạt là `Initialization - All Pages` và `All Pages`, nhưng đồng thời lại đặt Ngoại lệ (Exception) là `Initialization - All Pages`.
   * *Hậu quả:* Việc cài đặt ngoại lệ trùng với sự kiện khởi tạo khiến thẻ hoạt động bất thường hoặc không kích hoạt như mong muốn.
3. **Thẻ mồ côi không có Trigger (`tag-ads-bam goi`):**
   * *Bằng chứng:* Danh sách thẻ trong GTM hiển thị cột Bộ khởi động kích hoạt của thẻ này hoàn toàn để trống. Thẻ này không thể phát sinh lượt chuyển đổi.
4. **Trùng lặp sự kiện Form GA4 trong cấu hình GTM:**
   * *Bằng chứng:* Cả hai thẻ `điền form` và `tag-ana form` đều là loại thẻ sự kiện GA4 và đều dùng chung trigger `điền form - ana`.
   * *Hậu quả:* Nếu GTM được kích hoạt nguyên trạng, một lần người dùng điền form sẽ gửi **ít nhất 2 sự kiện riêng biệt** vào GA4.
5. **Hai thẻ chuyển đổi Google Ads Form khác Conversion Label:**
   * *Bằng chứng:* Hai thẻ `Ads - Tracking Form Makeup Cá Nhân.` và `Google Ads - Chuyển đổi Điền Form` đều kích hoạt bởi `điền form - ana`, nhưng có Conversion Label khác nhau (`i_ukCPPc97ocELHAvphD` vs `jn7cCNG8usMcELHAvphD`).
   * *Đánh giá kỹ thuật:* Chưa đủ căn cứ để kết luận là cùng một chuyển đổi bị lặp. Tuy nhiên, cả hai thẻ đều phụ thuộc trigger Contact Form 7 không còn trên theme mới và tài khoản Ads chưa được chốt.
6. **Mâu thuẫn logic Thẻ - Trigger (`TAG-ANA BẤM GỌI`):**
   * *Bằng chứng:* Tên thẻ là `TAG-ANA BẤM GỌI` (đo cuộc gọi hotline), nhưng trigger gắn vào thẻ lại mang tên `nút gửi` (click submit form).

---

### 4.2. Những vấn đề NGHI VẤN / CẦN XÁC MINH THÊM (Potential Risks)

1. **Nguy cơ đo lường sai (False Positive) từ trigger `Form Text` (`Tag - ads- lượt đăng ký`):**
   * *Phát hiện:* Thẻ này sử dụng trigger `click đăng ký khóa học` với điều kiện kích hoạt là **`{{Form Text}}` bằng `"ĐĂNG KÝ KHÓA HỌC"`** (không phải `{{Click Text}}`).
   * *Rủi ro:* Kích hoạt dựa trên text của form khi xảy ra tương tác click, dẫn đến nguy cơ Google Ads ghi nhận chuyển đổi ảo khi người dùng click tương tác mà chưa điền hoặc gửi form thành công. Chuyển đổi hợp lệ bắt buộc phải kích hoạt khi form gửi và lưu thành công từ server (`lead-handler.php`).
2. **Chồng chéo 4 thẻ Google Tag kích hoạt cùng thời điểm (`Initialization - All Pages`):**
   * *Nghi vấn:* Có tới 4 thẻ Google Tag (`Etiqueta de Google AW-18036531249`, `Google Tag - analytics - Danh`, `TAG-ANALY`, `TAG-GGads-KHOI`) cùng kích hoạt tại `Initialization`.
   * *Rủi ro:* Tải nhiều lần thư viện Google Tag, làm chậm tốc độ hiển thị trang và gây xung đột cấu hình Consent Mode / Linker.
3. **Chênh lệch phạm vi đo lường Cuộn trang (Scroll):**
   * *Hiện trạng:* Thẻ `cuon_trang` trong GTM đo 4 mốc (25, 50, 75, 90%), trong khi GA4 Enhanced Measurement tự động đo mốc 90%. Việc tạm dừng thẻ cũ là nhằm đơn giản hóa mô hình đo lường cho giai đoạn hiện tại, không phải do đã chứng minh trùng lặp hoàn toàn.
4. **Nguy cơ tính trùng giữa Google Ads Conversion trực tiếp và Chuyển đổi nhập từ GA4:**
   * *Nghi vấn:* GA4 Property `530676219` đã liên kết với Google Ads `990-676-3686`. Nếu tài khoản Ads này vừa nhập sự kiện chuyển đổi từ GA4 (GA4 imported conversion) làm Primary, vừa bắn thẻ chuyển đổi Ads trực tiếp từ GTM làm Primary, thì mỗi lead sẽ bị tính 2 lần trong báo cáo Google Ads.

---

## 5. THÔNG TIN CẦN NGƯỜI PHỤ TRÁCH GOOGLE ADS CUNG CẤP

Để hoàn tất việc ánh xạ tài khoản và tránh sai lệch dữ liệu quảng cáo, người phụ trách Google Ads cần cung cấp chính xác các thông tin sau:

1. **Tài khoản Google Ads chính thức đang (hoặc sẽ) chạy chiến dịch cho Lily Chen Makeup Academy là tài khoản nào?**
   * Có phải là tài khoản có Customer ID **`990-676-3686`** (đã thấy trong liên kết GA4) hay không?
   * Hay là một tài khoản khác?
2. **Đối chiếu các mã chuyển đổi (Conversion IDs) trong tài khoản Ads:**
   * Mã **`AW-18140552512`** thuộc về tài khoản Ads nào?
   * Mã **`AW-18036531249`** thuộc về tài khoản Ads nào?
   * Trong tài khoản Ads chính thức, Conversion Action dành cho "Điền Form Tư Vấn" có:
     * **Conversion ID:** `AW-XXXXX` là gì?
     * **Conversion Label:** chuỗi ký tự label tương ứng là gì?
3. **Cấu hình Mục tiêu Chuyển đổi (Conversion Goals) trong Google Ads:**
   * Chiến dịch Ads hiện tại đang tối ưu hóa theo:
     * Thẻ chuyển đổi Google Ads trực tiếp (Google Ads Tag)?
     * Hay Chuyển đổi nhập từ Google Analytics 4 (GA4 imported key event)?
   * Trạng thái của từng hành động chuyển đổi đang là **Primary (Chính)** hay **Secondary (Phụ)**?

---

## 6. ĐỀ XUẤT BƯỚC TIẾP THEO ĐỂ NGƯỜI DÙNG VÀ CODEX XEM XÉT

*(Lưu ý: Đây là đề xuất phương án kỹ thuật, CHƯA triển khai bất kỳ thay đổi nào)*

### Bước 1: Thống nhất cấu hình GTM sạch (Clean GTM Architecture)
* Xuất file backup JSON của Container `GTM-TJRRBJRF` hiện tại để lưu trữ lịch sử toàn bộ 13 thẻ cũ.
* Tạo một Workspace mới (hoặc dọn dẹp có kiểm soát trên Workspace 18):
  * **Chỉ giữ 1 thẻ Google Tag chung** kết nối tới `G-2917B9BVVX` (và bổ sung destination Ads chính thức sau khi chốt).
  * **Chỉ giữ 1 thẻ Conversion Linker** kích hoạt trên `All Pages`.
  * **Tắt/Tạm dừng (Pause)** các thẻ trùng lặp (`tag-ana form`, `cuon_trang`, `TAG-ANALY`, `TAG-GGads-KHOI`, v.v.).
  * **Tạm dừng** các thẻ Google Ads chưa xác định rõ conversion ID/label hợp lệ.

### Bước 2: Tích hợp chuẩn sự kiện Gửi Form Tư Vấn Thành Công
* Website hiện tại gửi form qua API REST custom (`/wp-json/lilychen/v1/lead`, xử lý bởi `inc/lead-handler.php` và JavaScript `main.js`).
* Cấu hình trong `main.js` khi nhận phản hồi `status: 'success'` từ server thì đẩy một custom event vào dataLayer:
  ```javascript
  window.dataLayer = window.dataLayer || [];
  window.dataLayer.push({
    event: 'form_lead_success',
    course_name: selectedCourse,
    form_id: 'tu_van_form'
  });
  ```
* Trong GTM, tạo 1 Custom Event Trigger: `form_lead_success` để kích hoạt thẻ GA4 Event `generate_lead` và thẻ chuyển đổi Google Ads chính thức. Điều này loại bỏ hoàn toàn rủi ro bấm nút mà form bị lỗi vẫn tính chuyển đổi.

### Bước 3: Chèn mã Container `GTM-TJRRBJRF` vào Theme chuẩn WordPress
* Thêm mã GTM vào `functions.php` hoặc `header.php` của theme `lilychen-academy` thông qua hook `wp_head` và `wp_body_open` theo đúng chuẩn Google.
* Kiểm tra để đảm bảo plugin `complianz-gdpr` tương thích với Consent Mode của GTM, không bị chặn script.

### Bước 4: Kiểm thử bằng Google Tag Assistant & GA4 DebugView
* Mở chế độ Xem trước (Preview Mode) của GTM để kiểm tra trên trình duyệt thực tế.
* Xác nhận:
  * Khi vào trang: Thẻ Google Tag bắn hit `page_view` về đúng `G-2917B9BVVX`.
  * Khi cuộn trang: Chỉ nhận 1 sự kiện cuộn từ GA4 Enhanced Measurement.
  * Khi submit form thành công: Sự kiện `form_lead_success` kích hoạt chính xác 1 lần về GA4 và 1 lần về Ads.

---

## 7. GIỚI HẠN KIỂM TRA ĐÃ GHI NHẬN (DISCLOSURE)
* Công cụ khởi chạy trình duyệt phụ tự động (`browser_subagent`) gặp sự cố không tải được driver Playwright 1.57.0 từ CDN bên ngoài (lỗi HTTP 404 từ Playwright CDN). Do đó, việc quan sát DOM và kiểm tra network đã được thực hiện trực tiếp và độc lập thông qua việc tải mã nguồn HTML render thực tế từ web server (`curl -sL`) và công cụ đọc nội dung URL `read_url_content`. Bằng chứng mã nguồn đã được lưu trữ đối chiếu tại các tập tin `scratch/live_homepage_current.html`, `scratch/live_lien_he_current.html` và `scratch/live_khoa_hoc_ca_nhan_current.html`.

---

## 8. CẬP NHẬT GIAI ĐOẠN 2: HOÀN THIỆN BẢN NHÁP WORKSPACE GTM (BẢN NHÁP V2) & ĐỐI CHIẾU KỸ THUẬT
*Mốc thời gian cập nhật:* 05/10/2026 20:15 (Asia/Saigon)  
*Mục đích:* Hoàn thiện bản nháp cấu hình GTM v2, đính chính trạng thái đối chiếu Live 17 vs Workspace 18, đề xuất hợp đồng sự kiện lead đã lưu chống spam honeypot (Non-PII), rà soát chỉ đọc cơ chế Complianz, sửa chính xác lý do tạm dừng các thẻ cũ và phân định ranh giới kiểm tra tĩnh so với import/runtime.

---

### 8.1. Đính Chính Đối Chiếu Phiên Bản Live 17 và Bản Sao Lưu Workspace 18
* **Hiện trạng tệp sao lưu:**
  * Tệp sao lưu gốc được lưu trữ tại: [GTM-TJRRBJRF_workspace18_original_backup_20261004.json](../../backups/gtm/GTM-TJRRBJRF_workspace18_original_backup_20261004.json) (sao chép nguyên trạng từ `C:\Users\Admin\Downloads\GTM-TJRRBJRF_workspace18.json`).
  * Thuộc tính kỹ thuật trong tệp: `containerVersionId = "0"` (biểu thị dữ liệu được xuất ra từ một không gian làm việc nháp - Workspace, cụ thể là Workspace 18).
* **Đính chính mức độ đồng nhất:**
  * Ảnh chụp màn hình Tổng quan của Workspace 18 hiển thị: *0 thay đổi đang chờ xử lý* (0 modified, 0 added, 0 deleted).
  * Ảnh chụp Lịch sử phiên bản (`versions?containerDraftId=18`) xác nhận: *Phiên bản 17 đang hoạt động* (Live, xuất bản ngày 13/07/2026 bởi `danhn2130@gmail.com`) gồm 13 thẻ, 4 trình kích hoạt, 0 biến tùy chỉnh.
  * **Kết luận kỹ thuật chính xác:** Bản sao lưu hiện tại **chỉ được xác nhận là khớp với dữ liệu export từ Workspace 18**. Do **chưa có tệp export JSON độc lập được tải trực tiếp từ Phiên bản Live 17**, nên **chưa có đủ căn cứ kỹ thuật để khẳng định đồng nhất 100%** giữa bản backup và Live 17.
  * *Cam kết:* Giữ nguyên trạng tệp sao lưu gốc để đối chiếu và phục vụ khôi phục (rollback) bất cứ lúc nào.

---

### 8.2. Phân Tích Logic Honeypot (`inc/lead-handler.php`) & Hợp Đồng Sự Kiện Lead Đã Lưu
* **Phân tích mã nguồn xử lý lead thực tế (`wordpress/lilychen-academy/inc/lead-handler.php`):**
  * Hàm `lilychen_process_lead_submission($data)` xử lý hai nhánh gửi lead:
    1. **Nhánh Honeypot (Dòng 357–365):**
       ```php
       $hp_company = isset($data['_hp_company']) ? trim((string)$data['_hp_company']) : '';
       if (!empty($hp_company)) {
           // Giả lập thành công cho spam bot mà không lưu database hay gửi email
           return array(
               'success' => true,
               'message' => esc_html__('Cảm ơn bạn! Thông tin đăng ký đã được tiếp nhận.', 'lilychen-academy'),
           );
       }
       ```
    2. **Nhánh Lưu Lead Thật Vào Cơ Sở Dữ Liệu (Dòng 420–525):**
       Sau khi vượt qua honeypot, time gate (> 2.5s), IP rate limit, sanitize dữ liệu và gọi `wp_insert_post` thành công, hàm trả về:
       ```php
       return array(
           'success' => true,
           'message' => sprintf(
               esc_html__('Cảm ơn %s! Lily Chen Academy đã nhận được yêu cầu tư vấn khóa học và sẽ liên hệ qua số %s trong 24 giờ tới.', 'lilychen-academy'),
               esc_html($name),
               esc_html($cleaned_phone)
           ),
       );
       ```
* **Vấn đề phát hiện đối với đo lường:**
  * Cả hai trường hợp (spam bot dính honeypot và khách hàng thật được lưu database) đều trả về HTTP status 200 và `{ success: true }`.
  * Do đó, điều kiện client-side thông thường: `if (response.ok && resData && resData.success)` là **CHƯA ĐỦ để chứng minh lead đã thực sự được lưu**. Nếu chỉ dựa vào điều kiện này, các lượt bot điền honeypot vẫn sẽ kích hoạt sự kiện chuyển đổi vào GA4/Ads, gây ô nhiễm dữ liệu.
* **Đề xuất hợp đồng sự kiện chuẩn hóa (Chỉ thiết kế, chưa sửa website):**
  1. **Phía Server (`inc/lead-handler.php`):**
     * Trong tương lai khi triển khai, khi lead được lưu thành công vào CPT `dang_ky_tu_van` qua `wp_insert_post`, server sẽ trả thêm một cờ phân định rõ ràng: `'lead_saved' => true`.
     * Nhánh honeypot vẫn tiếp tục trả về `'success' => true` (để giữ nguyên cơ chế đánh lừa spam bot, không làm lộ cơ chế bảo vệ), nhưng **hoàn toàn không có cờ `'lead_saved' => true`** (hoặc trả `'lead_saved' => false`).
  2. **Phía Client (`assets/js/main.js`):**
     * Khi nhận kết quả từ REST API, script chỉ đẩy sự kiện chuyển đổi vào `window.dataLayer` khi thỏa mãn điều kiện kép:
       ```javascript
       if (response.ok && resData && resData.success && resData.lead_saved === true) {
         window.dataLayer = window.dataLayer || [];
         window.dataLayer.push({
           event: 'form_lead_success',
           course_name: submittedCourse || 'Tư vấn khóa học phù hợp',
           form_id: (form && form.id) ? form.id : 'leadForm'
         });
       }
       ```
  3. **Nguyên tắc kỹ thuật & Bảo mật:**
     * **Bảo toàn cơ chế chống spam:** Giữ nguyên vẹn bẫy honeypot đánh lừa bot; bot không bao giờ biết cờ `lead_saved`.
     * **Tuyệt đối không so khớp nội dung thông báo (No regex string matching):** Không phân biệt bằng cách kiểm tra `resData.message` có chứa tên hoặc số điện thoại hay không. Cách làm này vừa mong manh (dễ vỡ khi thay đổi câu chữ giao diện), vừa vi phạm nguyên tắc bảo mật thông tin.
     * **Tuyệt đối Non-PII:** Cả `course_name` và `form_id` đều lấy từ các giá trị cố định được kiểm soát (`<option value="...">` và `<form id="...">`), tuyệt đối không đưa họ tên, số điện thoại hay email vào Data Layer.

---

### 8.3. Sửa Chính Xác Lý Do Tạm Dừng Các Thẻ Cũ Trong Bản Nháp
Nhằm đảm bảo tính trung thực kỹ thuật và không suy đoán, các lý do tạm dừng thẻ cũ đã được chuẩn hóa lại như sau:

1. **Thẻ `cuon_trang` (ID: 9):**
   * *Hiện trạng cũ:* Kích hoạt theo trigger `cuộn trang` (Scroll Depth mốc 25, 50, 75, 90%).
   * *Lý do tạm dừng chuẩn hóa:* Tạm dừng nhằm **đơn giản hóa mô hình đo lường** cho giai đoạn hiện tại (ưu tiên tập trung vào các hành vi cốt lõi như gửi lead và click hotline), **chứ không phải đã chứng minh trùng lặp hoàn toàn** với tính năng cuộn tự động của GA4 (vì thẻ này đo 4 mốc 25-90%, còn GA4 Enhanced Measurement chỉ tự động ghi nhận 1 mốc duy nhất 90%).
2. **Hai thẻ Ads form (`Ads - Tracking Form Makeup Cá Nhân.` ID 24 & `Google Ads - Chuyển đổi Điền Form` ID 25):**
   * *Hiện trạng cũ:* Cả hai thẻ cùng trỏ về Conversion ID `18036531249` nhưng có **Conversion Label hoàn toàn khác nhau** (`i_ukCPPc97ocELHAvphD` so với `jn7cCNG8usMcELHAvphD`).
   * *Lý do tạm dừng chuẩn hóa:* Vì khác Conversion Label, **chưa đủ căn cứ để kết luận là cùng một chuyển đổi bị lặp**. Đây có thể là 2 hành động chuyển đổi riêng biệt được tạo trong Google Ads. Tạm dừng cả 2 thẻ vì tài khoản Google Ads chính thức chưa được xác định, và trigger `.wpcf7-response-output` không hoạt động trên theme mới.
3. **Thẻ `Tag - ads- lượt đăng ký` (ID: 21):**
   * *Hiện trạng cũ:* Sử dụng trigger `click đăng ký khóa học` (ID: 20).
   * *Lý do tạm dừng chuẩn hóa:* Kiểm tra chi tiết bộ lọc trigger ID 20 xác nhận điều kiện kích hoạt là **`{{Form Text}}` bằng `"ĐĂNG KÝ KHÓA HỌC"`** (không phải `{{Click Text}}`). Thẻ này kích hoạt dựa trên nội dung text của form khi xảy ra tương tác click, dẫn đến nguy cơ ghi nhận chuyển đổi ảo (False Positive) khi người dùng click tương tác mà chưa điền hoặc gửi form thành công.
4. **Thẻ Conversion Linker `TRÌNH LK` (ID: 17):**
   * *Lý do tạm dừng:* Tạm dừng thẻ này cho giai đoạn triển khai GA4 hiện tại để cách ly hoàn toàn hệ thống đo lường khỏi các thành phần Google Ads chưa rõ ràng. Giữ nguyên thẻ trong container để sẵn sàng bật lại ngay khi tài khoản Ads được chốt.

---

### 8.4. Kiểm Tra Chỉ Đọc Cấu Hình Complianz (`complianz-gdpr`)
* **Kiểm tra mã nguồn trên máy chủ hosting (`templates/statistics/`):**
  * Plugin `complianz-gdpr` chứa sẵn các mẫu kịch bản hỗ trợ Google Consent Mode v2:
    * **Consent mặc định:** `gtag('consent', 'default', { security_storage: 'granted', functionality_storage: 'granted', personalization_storage: 'denied', analytics_storage: 'denied', ad_storage: 'denied' })`.
    * **Consent cập nhật:** Lắng nghe sự kiện JavaScript `cmplz_before_categories_consent` hoặc `cmplz_revoke` để gọi `gtag('consent', 'update', { ... })`.
* **Kiểm tra cơ sở dữ liệu `wpfk_options`:**
  * Option `cmplz_detected_stats` lưu giá trị `["google-analytics", "google-tag-manager"]`.
* **Hiện trạng mã render thực tế trên HTML Live:**
  * Đoạn mã duy nhất xuất hiện trên trang live hiện tại chỉ là stub rỗng:
    ```javascript
    window.gtag_enable_tcf_support = !1;
    window.dataLayer = window.dataLayer || [];
    function gtag(){dataLayer.push(arguments)}
    gtag('js', new Date());
    gtag('config', '', {cookie_flags: 'secure;samesite=none'});
    ```
  * Đoạn mã này chưa truyền các lệnh `consent default` hay `consent update` hoàn chỉnh sang Google Tag/GTM.
* **Xác nhận trạng thái:**
  * Do thiếu bằng chứng kiểm tra trên môi trường trình duyệt thực tế (browser runtime execution) khi người dùng thực hiện thao tác bấm Chấp thuận hoặc Từ chối trên banner cookie, hiện trạng phối hợp giữa Complianz và Google Tag được đánh dấu là: **Chưa kiểm chứng tại runtime trình duyệt (Unverified at browser runtime)**.
  * Báo cáo **tuyệt đối không khẳng định** là hệ thống đã phối hợp hoàn chỉnh cho tới khi được kiểm thử runtime bằng Tag Assistant.

---

### 8.5. Cấu Trúc Bản Nháp v2 ("Lily Chen - Measurement Rebuild v2")
* **Tệp tin cấu hình bản nháp v2 độc lập:**
  * [GTM-TJRRBJRF_workspace_rebuild_draft_v2_20261005.json](../../backups/gtm/GTM-TJRRBJRF_workspace_rebuild_draft_v2_20261005.json)
  * *(Bản nháp v1 trước đó được giữ nguyên tại [GTM-TJRRBJRF_workspace_rebuild_draft_20261004.json](../../backups/gtm/GTM-TJRRBJRF_workspace_rebuild_draft_20261004.json) để đối chiếu lịch sử).*
* **Các thành phần trong bản nháp v2:**
  * **16 thẻ (Tags):** **3 thẻ hoạt động (Active)** và **13 thẻ tạm dừng (Paused)**.
  * **5 trình kích hoạt (Triggers):** 4 trigger cũ giữ nguyên + 1 trigger sự kiện tùy chỉnh mới.
  * **2 biến tùy chỉnh (User-defined Variables):** 2 biến Data Layer mới (`dlv - course_name` và `dlv - form_id`).
  * **8 biến tích hợp (Built-in Variables):** Giữ nguyên vẹn.

#### Bảng Kiểm Kê Chi Tiết 16 Thẻ Trong Bản Nháp v2:

| STT | ID Thẻ | Tên Thẻ | Loại Thẻ | Gửi Dữ Liệu Gì | Điều Kiện Kích Hoạt | Đích Nhận (Destination) | Trạng Thái Bản Nháp v2 | Ghi Chú Kỹ Thuật |
|---|---|---|---|---|---|---|---|---|
| **1** | **101** | **Google Tag - GA4 Chinh Thuc G-2917B9BVVX** | `googtag` | Cấu hình Google Tag & Page View | `Initialization - All Pages` (ID: 2147479573) | GA4 `G-2917B9BVVX` | **HOẠT ĐỘNG (Active)** | **Thẻ mới**: Thẻ Google Tag duy nhất quản lý luồng dữ liệu GA4 chính thức |
| **2** | **102** | **GA4 - Event - click_to_call** | `gaawe` | Event `click_to_call` (param: `link_type: tel`) | Bấm link điện thoại (Trigger ID 4: Click URL chứa `tel:`) | GA4 `G-2917B9BVVX` | **HOẠT ĐỘNG (Active)** | **Thẻ mới**: Đo hành vi bấm nút gọi hotline; không coi là cuộc gọi đã kết nối; Không lưu số điện thoại |
| **3** | **103** | **GA4 - Event - generate_lead** | `gaawe` | Event `generate_lead` (param: `course_name`, `form_id`) | Custom Event `form_lead_success` (Trigger ID 101) | GA4 `G-2917B9BVVX` | **HOẠT ĐỘNG (Active)** | **Thẻ mới**: Đo chuyển đổi khi lead đã lưu DB thành công; `course_name` và `form_id` lấy từ enum cố định; Non-PII |
| 4 | 17 | `TRÌNH LK` | `gclidw` | Cookie GCLID Google Ads | `All Pages` (ID: 2147479553) | Trình duyệt người dùng | **TẠM DỪNG (Paused)** | **Tạm dừng cho giai đoạn GA4 hiện tại**; Giữ nguyên để bật lại khi chốt tài khoản Ads |
| 5 | 3 | `TAG-ANALY` | `googtag` | Google Tag G-2917B9BVVX cũ | `Initialization - All Pages` | GA4 `G-2917B9BVVX` | **TẠM DỪNG (Paused)** | Đã được thay thế bởi thẻ chuẩn hóa #101 |
| 6 | 5 | `TAG-ANA BẤM GỌI` | `gaawe` | Event `"TAG-ANA BẤM GỌI"` | Trigger nút gửi (Click `tel:`) | GA4 `G-2917B9BVVX` | **TẠM DỪNG (Paused)** | Tên sự kiện sai quy ước GA4; thay bởi thẻ chuẩn hóa #102 |
| 7 | 9 | `cuon_trang` | `gaawe` | Event `theo_doi_cuon` (25-90%) | Trigger cuộn trang | GA4 `G-2917B9BVVX` | **TẠM DỪNG (Paused)** | Tạm dừng để đơn giản hóa mô hình đo lường giai đoạn hiện tại |
| 8 | 13 | `điền form` | `gaawe` | Event `"điền form"` | Trigger `.wpcf7-response-output` | GA4 `G-2917B9BVVX` | **TẠM DỪNG (Paused)** | Sai chuẩn GA4 và trigger CF7 không hoạt động trên theme mới |
| 9 | 14 | `tag-ana form` | `gaawe` | Event `"tag-ana form"` | Trigger `.wpcf7-response-output` | GA4 `G-2917B9BVVX` | **TẠM DỪNG (Paused)** | Trùng lặp với thẻ 13; thay bởi thẻ chuẩn hóa #103 |
| 10 | 22 | `Google Tag - analytics - Danh` | `googtag` | Google Tag luồng cá nhân | `All Pages` & `Initialization` | Luồng cũ `G-PNKT7SHM4T` | **TẠM DỪNG (Paused)** | Luồng cá nhân cũ không còn dùng |
| 11 | 16 | `TAG-GGads-KHOI` | `googtag` | Thẻ Google Ads AW-18140552512 | `Initialization - All Pages` | Google Ads | **TẠM DỪNG (Paused)** | Chờ người phụ trách Ads chốt tài khoản chính thức |
| 12 | 23 | `Etiqueta de Google AW-18036531249` | `googtag` | Thẻ Google Ads AW-18036531249 | `Initialization - All Pages` | Google Ads | **TẠM DỪNG (Paused)** | Chờ người phụ trách Ads chốt tài khoản chính thức |
| 13 | 24 | `Ads - Tracking Form Makeup Cá Nhân.` | `awct` | Chuyển đổi Ads Form Makeup CN | Trigger `.wpcf7-response-output` | Google Ads `18036531249` | **TẠM DỪNG (Paused)** | Khác label với thẻ 25; tạm dừng do chưa chốt tài khoản Ads |
| 14 | 25 | `Google Ads - Chuyển đổi Điền Form` | `awct` | Chuyển đổi Ads Form Chung | Trigger `.wpcf7-response-output` | Google Ads `18036531249` | **TẠM DỪNG (Paused)** | Khác label với thẻ 24; tạm dừng do chưa chốt tài khoản Ads |
| 15 | 21 | `Tag - ads- lượt đăng ký` | `awct` | Chuyển đổi Ads Click Đăng Ký | Trigger `Form Text` = "ĐĂNG KÝ KHÓA HỌC" | Google Ads `18140552512` | **TẠM DỪNG (Paused)** | Trigger Form Text có rủi ro chuyển đổi ảo khi click chưa gửi form |
| 16 | 19 | `tag-ads-bam goi` | `awct` | Chuyển đổi Ads Bấm Gọi | **Không có Trigger (Mồ côi)** | Google Ads `18140552512` | **TẠM DỪNG (Paused)** | Thẻ mồ côi; chờ chốt tài khoản Ads |

---

### 8.6. Kết Quả Kiểm Tra Tĩnh (Static Schema Validation) & Giới Hạn Kiểm Tra
* **Kiểm tra tính toàn vẹn tĩnh của tệp JSON v2 (`scratch/validate_gtm_json.py`):**
  * **Cú pháp JSON:** Cú pháp parse hợp lệ 100%, tuân thủ định dạng `exportFormatVersion: 2`.
  * **Toàn vẹn tham chiếu (Reference Integrity):**
    * Thẻ 101 trỏ đúng Trigger `Initialization - All Pages` (`2147479573`).
    * Thẻ 102 trỏ đúng Trigger `nút gửi` (`4`).
    * Thẻ 103 trỏ đúng Trigger `Custom Event - form_lead_success` (`101`), đọc đúng 2 biến `{{dlv - course_name}}` (`101`) và `{{dlv - form_id}}` (`102`).
    * Thẻ 17 trỏ đúng Trigger `All Pages` (`2147479553`), có thuộc tính `"paused": true`.
    * Toàn bộ 13 thẻ cũ giữ nguyên các giá trị tham số cấu hình ban đầu, chỉ cập nhật `"paused": true`.
  * **Đích nhận (Destinations):**
    * Luồng GA4 duy nhất đang active trỏ về `G-2917B9BVVX`.
    * Toàn bộ các đích Google Ads (`18140552512`, `18036531249`) đều nằm trong nhóm thẻ tạm dừng.
* **Phân biệt ranh giới kiểm tra rõ ràng:**
  * **Kiểm tra tĩnh (Static Validation):** Xác nhận cú pháp JSON, ánh xạ định danh và tính khép kín của đồ thị phụ thuộc giữa Tag, Trigger và Variable.
  * **Giới hạn kỹ thuật cần minh bạch:**
    1. Kiểm tra tĩnh **KHÔNG THỂ THAY THẾ** việc GTM Web UI / GTM API thực tế chấp nhận import khi người quản trị thực hiện (vì GTM có thể có các cơ chế kiểm tra schema nội bộ riêng của Google).
    2. Kiểm tra tĩnh **KHÔNG THỂ THAY THẾ** việc kiểm thử runtime trên trình duyệt thực tế (kiểm tra xung đột script, cơ chế cập nhật cookie consent, việc kích hoạt trigger khi tương tác form thật, và việc bắn hit mạng HTTP sang máy chủ Google Analytics) qua Google Tag Assistant và GA4 DebugView.

---

### 8.7. Hướng Dẫn Nhập (Import) Bản Nháp v2 Vào GTM (Khi Được Phê Duyệt)
Khi người dùng và Codex phê duyệt phương án triển khai, người quản lý container (`danhn2130@gmail.com`) có thể nhập file bản nháp v2 vào GTM theo các bước an toàn sau:

1. **Tạo Workspace riêng trên GTM:**
   * Truy cập `tagmanager.google.com` -> Chọn Container `lilychenmakeup.com` (`GTM-TJRRBJRF`).
   * Chọn menu Không gian làm việc (Workspaces) -> Bấm dấu `+` để tạo Workspace mới.
   * Đặt tên: **`Lily Chen - Measurement Rebuild v2`**.
2. **Nhập tệp JSON bản nháp v2:**
   * Vào tab **Quản trị viên (Admin)** -> Chọn **Nhập vùng chứa (Import Container)**.
   * Chọn tệp tin: Chọn file [GTM-TJRRBJRF_workspace_rebuild_draft_v2_20261005.json](../../backups/gtm/GTM-TJRRBJRF_workspace_rebuild_draft_v2_20261005.json).
   * Chọn không gian làm việc đích: Chọn **Workspace hiện có (Existing workspace)** -> Chọn **`Lily Chen - Measurement Rebuild v2`**.
   * Chọn tùy chọn nhập: Chọn **Ghi đè (Overwrite)** cho workspace mới tạo này.
3. **Kiểm tra bản xem trước thay đổi (Preview Changes):**
   * GTM sẽ hiển thị bảng đối chiếu xác nhận:
     * 3 thẻ thêm mới (#101, #102, #103)
     * 1 trigger thêm mới (#101)
     * 2 biến Data Layer thêm mới (#101, #102)
     * 13 thẻ được cập nhật (chuyển sang trạng thái tạm dừng, bao gồm cả `TRÌNH LK`).
   * Bấm **Xác nhận (Confirm)**.
   * *(Toàn bộ thao tác chỉ diễn ra trong Workspace nháp riêng biệt, hoàn toàn KHÔNG làm thay đổi phiên bản Live 17 đang hoạt động).*

---

## 9. CẬP NHẬT GIAI ĐOẠN 3: THIẾT LẬP KẾT NỐI GTM API V2 TRỰC TIẾP & BẢN NHÁP V3 (GIỮ NGUYÊN THẺ ADS)
*Mốc thời gian cập nhật:* 05/10/2026 20:45 (Asia/Saigon)  
*Mục đích:* Chuyển đổi phương thức quản lý sang kết nối GTM API v2 trực tiếp nhằm trực tiếp quản lý bản nháp thay vì thao tác thủ công, thiết lập ranh giới an toàn tuyệt đối, xây dựng Bản nháp v3 (giữ nguyên trạng thái và cấu hình 7 thẻ Ads gốc kèm Conversion Linker) và lập bảng quy ước đặt tên chuẩn hóa.

---

### 9.1. Trạng Thái Kết Nối GTM API & Thiết Lập Môi Trường An Toàn
* **Kiểm tra môi trường Antigravity:**
  * Không dùng MCP bên thứ ba không rõ nguồn gốc. Ưu tiên sử dụng trực tiếp **Google Tag Manager API v2 chính thức** thông qua script Python độc lập [scratch/gtm_manager.py](../../scratch/gtm_manager.py).
  * **Vị trí lưu trữ bảo mật:** Toàn bộ thông tin xác thực (Client Secret và Token) được lưu trữ tại `C:\Users\Admin\.antigravity_gtm\` (hoàn toàn nằm ngoài git repository và ngoài thư mục OneDrive đồng bộ).
  * **Thông tin OAuth Client:** Đã nạp cấu hình OAuth 2.0 từ `C:\Users\Admin\.antigravity_gtm\client_secret.json` (loại `installed` - Desktop Application, Google Cloud Project ID: `gen-lang-client-0898132828`, Redirect URI: `http://localhost:8085`).
  * **Trạng thái xác thực hiện tại:** Đang chờ người dùng (`danhn2130@gmail.com`) đăng nhập và phê duyệt trên trang Google. Chưa có token, do đó **chưa gọi API đọc thực tế** (phân biệt rõ giữa việc đã chuẩn bị công cụ và việc đã kết nối API thành công).
* **Phương thức xác thực:**
  * OAuth 2.0 Authorization Code Flow với Local Loopback Server (`http://localhost:8085`).
  * Người xác thực: `danhn2130@gmail.com` (sử dụng tham số `login_hint` để Google tự động chọn đúng tài khoản).
  * **Phạm vi quyền (Scopes) yêu cầu tối thiểu:**
    1. `https://www.googleapis.com/auth/tagmanager.readonly` (Đọc cấu hình container, live version, workspaces)
    2. `https://www.googleapis.com/auth/tagmanager.edit.containers` (Chỉnh sửa container trong workspace nháp)
    * *Tuyệt đối không yêu cầu:* quyền xuất bản (`publish`), quyền xóa container, quản lý người dùng (`user_permissions`), hay quản lý tài khoản (`manage.accounts`).
* **Ranh giới bảo vệ đích duy nhất (Boundary Protection):**
  * **Account ID duy nhất được phép:** `6348356206`
  * **Container ID duy nhất được phép:** `248566125` (`GTM-TJRRBJRF`)
  * **Workspace nháp duy nhất được phép ghi:** `Lily Chen - Measurement Rebuild`
  * Script có cơ chế kiểm tra chặn cứng (hardcoded whitelist): Mọi yêu cầu gọi API nằm ngoài Account/Container trên hoặc cố gắng ghi vào workspace khác đều bị chặn và ném ngoại lệ bảo mật ngay lập tức.
  * Giữ nguyên vẹn toàn bộ workspaces của các thành viên khác.

---

### 9.2. Hướng Dẫn Thao Tác Cho Người Dùng (Để Cấp Quyền OAuth)
Người dùng tự đăng nhập và chấp thuận trên trang Google. Tuyệt đối không dán mật khẩu, token, cookie hay client secret vào chat:

1. **Bước 1: Bật Google Tag Manager API trên Google Cloud Console:**
   * Truy cập liên kết trực tiếp sau:
     [Bật Tag Manager API cho Project gen-lang-client-0898132828](https://console.cloud.google.com/apis/library/tagmanager.googleapis.com?project=gen-lang-client-0898132828)
   * Nhấn nút **Enable (Bật)** để kích hoạt Tag Manager API.
2. **Bước 2: Chạy lệnh xác thực local:**
   * Mở PowerShell hoặc Terminal tại thư mục dự án và chạy:
     ```powershell
     python scratch/gtm_manager.py auth
     ```
   * Trình duyệt sẽ tự động mở trang ủy quyền Google OAuth. Chọn tài khoản **`danhn2130@gmail.com`** và nhấn **Tiếp tục / Cho phép (Allow)**.
   * Script sẽ tự động nhận mã ủy quyền qua `http://localhost:8085`, trao đổi token và lưu an toàn vào `C:\Users\Admin\.antigravity_gtm\token.json`.
3. **Bước 3: Xác minh kết nối & Đọc Live/Workspaces:**
   * Sau khi hoàn tất xác thực, chạy lệnh:
     ```powershell
     python scratch/gtm_manager.py test
     ```
   * Script sẽ thực hiện 4 bước xác minh thực tế:
     - Xác nhận Container `GTM-TJRRBJRF` thuộc Account `6348356206`.
     - Lấy Header Live và tải toàn bộ JSON của Phiên bản Live thực tế lưu vào `backups/gtm/GTM-TJRRBJRF_live_version_{versionId}_api_backup.json`, đối chiếu với Live 17.
     - Đọc danh sách workspaces hiện có, đảm bảo không can thiệp workspace của thành viên khác.
     - Kết nối hoặc tạo Workspace riêng `Lily Chen - Measurement Rebuild`.

---

### 9.3. Cấu Trúc Bản Nháp v3 ("Lily Chen - Measurement Rebuild v3")
* **Tệp tin cấu hình bản nháp v3 độc lập:**
  * [GTM-TJRRBJRF_workspace_rebuild_draft_v3_20261005.json](../../backups/gtm/GTM-TJRRBJRF_workspace_rebuild_draft_v3_20261005.json)
  * *(Bản sao lưu gốc, bản v1 và bản v2 được giữ nguyên trạng để đối chiếu lịch sử).*
* **Kết quả đối chiếu 7 thẻ Google Ads với bản export gốc Workspace 18 (`scratch/compare_v3_to_orig.py`):**
  * Cả 7 thẻ Ads: ID **16**, **17**, **19**, **21**, **23**, **24**, **25** đều **ĐỒNG NHẤT 100%** với bản export gốc về loại thẻ, parameters, firing triggers, exceptions, sequencing và trạng thái **HOẠT ĐỘNG (`paused: false`)**.
  * Bao gồm cả thẻ Conversion Linker `TRÌNH LK` (ID: 17) được giữ hoạt động theo đúng quyết định mới của người dùng.
* **Cấu trúc 16 thẻ trong Bản nháp v3:**
  * **10 thẻ Hoạt Động (Active):**
    * 7 thẻ Ads gốc (#16, #17, #19, #21, #23, #24, #25)
    * 3 thẻ GA4 chính thức mới (#101 Google Tag `G-2917B9BVVX`, #102 GA4 `click_to_call`, #103 GA4 `generate_lead` có tham số `course_name` và `form_id`)
  * **6 thẻ Tạm Dừng (Paused):**
    * 6 thẻ GA4 cũ (#3 `TAG-ANALY`, #5 `TAG-ANA BẤM GỌI`, #9 `cuon_trang`, #13 `điền form`, #14 `tag-ana form`, #22 `Google Tag - analytics - Danh`).
  * **5 Trình kích hoạt (Triggers):** 4 trigger cũ giữ nguyên + 1 Custom Event `form_lead_success` (#101).
  * **2 Biến Data Layer (Variables):** `dlv - course_name` (#101) và `dlv - form_id` (#102).
  * **8 Biến tích hợp (Built-in Variables):** Giữ nguyên vẹn.

---

### 9.4. Bảng Quy Ước Đặt Tên Cũ → Tên Mới Đề Xuất

#### Bảng Đối Chiếu Thẻ (Tags):
*Quy tắc chuẩn hóa đề xuất:* `Nền tảng | Chức năng | Đích nhận`.  
*Lưu ý:* Trước mắt trong cấu hình container bản nháp v3, tên các thẻ Ads được **giữ nguyên tên cũ** để bảo toàn lịch sử; bảng dưới đây đóng vai trò đề xuất chuẩn hóa để người dùng và người phụ trách Ads duyệt trước khi áp dụng.

| STT | ID Thẻ | Tên Hiện Tại (Trong Container) | Nền Tảng | Loại Thẻ | Trạng Thái v3 | Tên Đề Xuất Mới (Nền tảng \| Chức năng \| Đích nhận) | Ghi Chú Kỹ Thuật |
|:---:|:---:|:---|:---:|:---:|:---:|:---|:---|
| 1 | **16** | `TAG-GGads-KHOI` | Google Ads | `googtag` | **Active** | `Google Ads \| Google Tag \| AW-18140552512` | Giữ nguyên cấu hình & tên gốc trong container |
| 2 | **17** | `TRÌNH LK` | Google Ads | `gclidw` | **Active** | `Google Ads \| Conversion Linker \| All Pages` | Giữ nguyên hoạt động theo export gốc; sẵn sàng cho Ads |
| 3 | **19** | `tag-ads-bam goi` | Google Ads | `awct` | **Active** | `Google Ads \| Conversion Bấm Gọi \| AW-18140552512 (label: bajkCLub...)` | Thẻ mồ côi giữ nguyên cấu hình gốc; không sửa |
| 4 | **21** | `Tag - ads- lượt đăng ký` | Google Ads | `awct` | **Active** | `Google Ads \| Conversion Lượt Đăng Ký \| AW-18140552512 (label: Kw83CLzw...)` | Giữ nguyên cấu hình gốc (trigger `Form Text`); không sửa |
| 5 | **23** | `Etiqueta de Google AW-18036531249` | Google Ads | `googtag` | **Active** | `Google Ads \| Google Tag \| AW-18036531249` | Giữ nguyên cấu hình gốc; tên tiếng TBN tự sinh |
| 6 | **24** | `Ads - Tracking Form Makeup Cá Nhân.` | Google Ads | `awct` | **Active** | `Google Ads \| Conversion Form Makeup Cá Nhân \| AW-18036531249 (label: i_ukCPPc...)` | Giữ nguyên cấu hình gốc; conversion ID 18036531249 |
| 7 | **25** | `Google Ads - Chuyển đổi Điền Form` | Google Ads | `awct` | **Active** | `Google Ads \| Conversion Điền Form Chung \| AW-18036531249 (label: jn7cCNG8...)` | Giữ nguyên cấu hình gốc; conversion ID 18036531249 |
| 8 | **101** | `Google Tag - GA4 Chinh Thuc G-2917B9BVVX` | GA4 | `googtag` | **Active** | `GA4 \| Google Tag \| G-2917B9BVVX` | Thẻ Google Tag duy nhất quản lý luồng dữ liệu GA4 chính thức |
| 9 | **102** | `GA4 - Event - click_to_call` | GA4 | `gaawe` | **Active** | `GA4 \| Event click_to_call \| G-2917B9BVVX` | Đo click link `tel:`; Non-PII |
| 10 | **103** | `GA4 - Event - generate_lead` | GA4 | `gaawe` | **Active** | `GA4 \| Event generate_lead \| G-2917B9BVVX` | Đo lead đã lưu DB; nhận `course_name` và `form_id`; Non-PII |
| 11 | **3** | `TAG-ANALY` | GA4 | `googtag` | **Paused** | `GA4 \| Google Tag Cũ (Thay bằng #101) \| G-2917B9BVVX` | Tạm dừng để tránh tải trùng thẻ Google Tag GA4 |
| 12 | **5** | `TAG-ANA BẤM GỌI` | GA4 | `gaawe` | **Paused** | `GA4 \| Event Bấm Gọi Cũ (Thay bằng #102) \| G-2917B9BVVX` | Tạm dừng vì tên sự kiện có dấu/vi phạm chuẩn GA4 |
| 13 | **9** | `cuon_trang` | GA4 | `gaawe` | **Paused** | `GA4 \| Event Scroll 4 Mốc (Tạm dừng) \| G-2917B9BVVX` | Tạm dừng để đơn giản hóa mô hình đo lường hiện tại |
| 14 | **13** | `điền form` | GA4 | `gaawe` | **Paused** | `GA4 \| Event Điền Form Cũ (Tạm dừng) \| G-2917B9BVVX` | Tạm dừng vì tên sự kiện sai chuẩn và trigger CF7 cũ |
| 15 | **14** | `tag-ana form` | GA4 | `gaawe` | **Paused** | `GA4 \| Event Form Cũ (Thay bằng #103) \| G-2917B9BVVX` | Tạm dừng vì trùng lặp với thẻ 13 và dùng trigger CF7 cũ |
| 16 | **22** | `Google Tag - analytics - Danh` | GA4 | `googtag` | **Paused** | `GA4 \| Google Tag Luồng Cá Nhân Cũ (Tạm dừng) \| G-PNKT7SHM4T` | Tạm dừng vì trỏ luồng cá nhân cũ không còn dùng |

#### Bảng Đối Chiếu Trình Kích Hoạt (Triggers):
*Quy tắc chuẩn hóa đề xuất:* `Trigger | Điều kiện`.

| ID Trigger | Tên Hiện Tại (Trong Container) | Loại Trigger | Tên Đề Xuất Mới (Trigger \| Điều kiện) | Thẻ Đang Sử Dụng |
|:---:|:---|:---:|:---|:---|
| **4** | `nút gửi` | `LINK_CLICK` | `Trigger \| Click Link tel:` | Thẻ #102 (Active) & Thẻ #5 (Paused) |
| **8** | `cuộn trang` | `SCROLL_DEPTH` | `Trigger \| Scroll Depth 25-90%` | Thẻ #9 (Paused) |
| **12** | `điền form - ana` | `ELEMENT_VISIBILITY` | `Trigger \| Visibility .wpcf7-response-output` | Thẻ #13, #14 (Paused) & Thẻ #24, #25 (Active) |
| **20** | `click đăng ký khóa học` | `CLICK` | `Trigger \| Form Text ĐĂNG KÝ KHÓA HỌC` | Thẻ #21 (Active) |
| **101** | `Custom Event - form_lead_success` | `CUSTOM_EVENT` | `Trigger \| Custom Event form_lead_success` | Thẻ #103 (Active) |

#### Bảng Đối Chiếu Biến (Variables):
*Quy tắc chuẩn hóa đề xuất:* `DLV | tên_trường`.

| ID Biến | Tên Hiện Tại (Trong Container) | Loại Biến | Tên Đề Xuất Mới (DLV \| tên_trường) | Khóa Data Layer | Thẻ Đang Tham Chiếu |
|:---:|:---|:---:|:---|:---:|:---|
| **101** | `dlv - course_name` | Data Layer Variable (`v`) | `DLV \| course_name` | `course_name` | Thẻ #103 (`{{dlv - course_name}}`) |
| **102** | `dlv - form_id` | Data Layer Variable (`v`) | `DLV \| form_id` | `form_id` | Thẻ #103 (`{{dlv - form_id}}`) |

*Cam kết tính toàn vẹn:* Nếu áp dụng đổi tên biến sang `DLV | course_name` và `DLV | form_id`, toàn bộ chuỗi tham chiếu trong thẻ 103 sẽ được cập nhật đồng bộ tương ứng thành `{{DLV | course_name}}` và `{{DLV | form_id}}` để đảm bảo đồ thị tham chiếu không bị gián đoạn.



