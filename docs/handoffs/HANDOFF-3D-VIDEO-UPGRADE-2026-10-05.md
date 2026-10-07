> Sắp xếp 08/10/2026: đường dẫn trong dấu backtick được hiểu từ gốc dự án, trừ tên handoff cùng thư mục. Trang HTML cũ và các mẫu thử nay ở `prototypes/static-site/`; thông tin triển khai bên dưới là ghi nhận lịch sử.

# Bàn giao: nâng cấp website 3D và video

Ngày: 05/10/2026, múi giờ Asia/Saigon.
Workspace: `C:\Users\Admin\OneDrive\Documents\Lilychen makeup academy`
Website: https://lilychenmakeup.com

## 1. Yêu cầu mới nhất của người dùng

Người dùng muốn chuyển sang chat mới để thực hiện một đợt nâng cấp website toàn diện theo xu hướng mới, hướng tới website 3D và bổ sung video. Chưa chọn phong cách, phạm vi 3D, vị trí video, công nghệ hoặc tài nguyên video/3D cụ thể.

Người dùng nói rõ KHÔNG gửi prompt tích hợp đo form cuối cùng cho Antigravity. Không được coi prompt đó là công việc đã thực hiện.

Ưu tiên hiện tại chuyển sang nâng cấp trải nghiệm website. Phần kết nối đo lường còn dang dở cần được bảo toàn và đưa vào kế hoạch phù hợp, không tự mở lại thành nhiệm vụ ưu tiên.

## 2. Cách phối hợp và phạm vi

- Trao đổi bằng tiếng Việt dễ hiểu, từng bước.
- Vai trò đã thống nhất: Codex phân tích, xác minh, đề xuất và viết prompt; Google Antigravity IDE thực hiện. Chưa có yêu cầu đổi cách phối hợp này.
- Yêu cầu mới cho phép đề xuất thiết kế lại toàn diện; các ràng buộc trước đó về không thay đổi giao diện thuộc giai đoạn kiểm kê đo lường, không được dùng để phủ nhận yêu cầu nâng cấp mới.
- Chưa có thiết kế được duyệt hoặc quyền deploy/publish cho đợt nâng cấp mới. Bắt đầu bằng khảo sát có phạm vi, lựa chọn hướng thiết kế và kế hoạch, không tự sửa production.
- Không tự bỏ nội dung kinh doanh đã duyệt, ảnh thật, thông tin khóa học, form đăng ký, dữ liệu khách hàng hoặc SEO. Nêu rõ phần nào đề xuất thay đổi để người dùng quyết định.
- Không cần kiểm tra lại toàn bộ công việc GSAP/hạt cũ. Chỉ đọc phần liên quan khi cần tái sử dụng hoặc thay thế trong thiết kế mới.

## 3. Nền tảng và định hướng khảo sát

- Đây là website WordPress custom theme `lilychen-academy`, không mặc định React/Next.js hoặc chuyển CMS.
- Source local liên quan: `wordpress/lilychen-academy/`.
- Website cũ từng dùng Flatsome; website mới dùng custom theme. Có animation GSAP và hiệu ứng hạt/canvas từ công việc trước.
- Không chốt phiên bản theme/commit production từ các báo cáo cũ: thông tin từng có 1.0.0 và 1.0.2; xác minh có mục tiêu khi cần triển khai.
- Bắt đầu chat mới bằng việc làm rõ người dùng muốn 3D thật tương tác hay hiệu ứng chiều sâu/chuyển động, mức độ nâng cấp toàn site hay các trang chủ lực, và video đã có hay cần sản xuất.
- Vì người dùng yêu cầu xu hướng mới nhất, nghiên cứu ví dụ hiện hành và tài liệu chính thức khi tư vấn công nghệ; chưa có nghiên cứu xu hướng mới nào được thực hiện trong lượt tạo handoff này.
- Đề xuất ít phương án rõ ràng, phù hợp học viện makeup và hình ảnh thật. Đánh giá trải nghiệm mobile, tốc độ tải, khả năng xem nội dung khi hiệu ứng không chạy, reduced motion và khả năng quản trị nội dung/video trong WordPress.
- Không tự chọn thư viện, mua dịch vụ, cài plugin, tạo tài sản trả phí hoặc dựng 3D toàn site trước khi thống nhất nhu cầu.

## 4. Hệ thống đo lường đã chốt

Người phụ trách chính GTM và GA4: Nguyễn Thành Danh, `danhn2130@gmail.com`.

| Thành phần | Định danh |
|---|---|
| GTM chính thức | `GTM-TJRRBJRF` |
| GTM account | `6348356206` |
| GTM container nội bộ | `248566125` |
| GA4 account | `389434666` |
| GA4 property | `530676219` |
| Luồng web | `lilychen`, Stream ID `14321840108` |
| GA4 measurement ID | `G-2917B9BVVX` |

- Ảnh đã xác nhận người dùng có quyền GTM Account Administrator, Container Publish và GA4 Property Administrator.
- Google Ads do thành viên khác phụ trách. Chưa ánh xạ hai mã `AW-18140552512`, `AW-18036531249` với Customer ID chính thức. `990-676-3686` xuất hiện trong các quyền liên kết GA4; chưa xác nhận tài khoản quảng cáo đang chạy.
- Người dùng yêu cầu GIỮ NGUYÊN các thẻ Ads và trạng thái như cấu hình gốc. Không tự tạm dừng/xóa/đổi chuyển đổi Ads.

## 5. GTM: đã publish phiên bản 18, được Codex kiểm tra trực tiếp

Antigravity đã cấu hình qua API trong workspace ID 19, tên `Lily Chen - Measurement Rebuild`. Sau đó NGƯỜI DÙNG tự bấm Publish.

Codex đã gọi API đọc Live sau thông báo publish và xác nhận:
- Live version: **18**.
- Tên: `Lily Chen - Measurement Rebuild`.
- Thẻ **#31**: `GA4 | Lead đã lưu | generate_lead`, gửi về `G-2917B9BVVX`, tham số `course_name` và `form_id`.
- Trigger **#28**: `Trigger | form_lead_success`, custom event khớp chính xác `form_lead_success`.
- Không cần tạo thêm thẻ/trigger đo form trùng.

Cấu hình workspace đã được Codex đối chiếu snapshot trước publish:
- 16 thẻ: 7 Ads giữ nguyên + 3 GA4 mới không paused + 6 GA4 cũ paused.
- Ads giữ nguyên: tag IDs **16, 17, 19, 21, 23, 24, 25**, gồm Conversion Linker #17.
- GA4 cũ paused: IDs **3, 5, 9, 13, 14, 22**.
- Thẻ mới #29: `GA4 | Cấu hình chính | G-2917B9BVVX`, Initialization - All Pages.
- Thẻ mới #30: `GA4 | Bấm gọi | click_to_call`, trigger #4 với Click URL chứa `tel:`, chỉ gửi `link_type=tel`.
- Biến #26: `DLV | course_name`; biến #27: `DLV | form_id`.
- Bốn trigger cũ không đổi; thêm #28, tổng 5 trigger tùy chỉnh và 2 biến tùy chỉnh.
- Tên và cấu hình Ads chưa chuẩn hóa, theo yêu cầu giữ nguyên. Quy ước cho phần mới: `Nền tảng | Chức năng | Đích/sự kiện`, `Trigger | Điều kiện`, `DLV | tên_trường`.
- Thẻ không paused chưa chứng minh đã phát dữ liệu; thẻ Ads #19 vẫn không có trigger.

## 6. Phần đo form CHƯA triển khai vào website

Lần đọc source local cuối cùng của Codex:
- `wordpress/lilychen-academy/inc/lead-handler.php` đã lưu lead qua `wp_insert_post`, post type `dang_ky_tu_van`, rồi gửi email.
- API: `/wp-json/lilychen/v1/lead`.
- `wordpress/lilychen-academy/assets/js/main.js` xử lý phản hồi `response.ok && resData.success`.
- Chưa thấy `lead_saved`, `form_lead_success` hay mã `GTM-TJRRBJRF` trong source theme local đã tìm.
- Nhánh honeypot `_hp_company` cố ý trả `success:true` nhưng KHÔNG lưu lead và KHÔNG gửi email. Không dùng riêng `success:true` để tính lead thật.
- Thiết kế được đề xuất, CHƯA thực hiện: server trả `lead_saved:true` chỉ cho lead đã lưu; frontend phát `form_lead_success` khi HTTP thành công, `success` đúng và `lead_saved === true`.
- Chỉ gửi `course_name`, `form_id` từ giá trị cố định; không gửi tên, điện thoại, email, ghi chú hoặc chuỗi thông báo server vào GA4/dataLayer.
- Form lưu khách trong WordPress; GTM/GA4 chỉ đo lượt/sự kiện, không thay thế nơi lưu hồ sơ khách.
- Người dùng không gửi prompt tích hợp cuối cùng cho Antigravity, nên không coi phần này đã được sửa/deploy.
- Chưa xác minh đầy đủ website live tải GTM hoặc consent thực tế. Publish GTM không tự chèn GTM vào WordPress.
- Chưa chạy form production thử hoặc xác nhận GA4 DebugView/Realtime cho cấu hình mới. Không tự gửi form gây lead/email/chuyển đổi Ads.

## 7. Kết nối Antigravity qua GTM API

- Script local: `scratch/gtm_manager.py` (đã nhiều lần được Antigravity chỉnh; đọc phiên bản hiện tại khi cần sử dụng).
- OAuth dùng project Cloud **xinchaodanh**, ID `gen-lang-client-0898132828`.
- Client Desktop có phần ID khớp client trong ảnh tên `openclaw xinchaodanh - main`; người dùng từng nghiên cứu nên có nhiều project. Chưa có quyết định chuyển sang Cloud project riêng.
- Codex đã kiểm tra token trực tiếp với Google: hợp lệ, audience khớp client local, scopes chỉ `tagmanager.readonly` và `tagmanager.edit.containers`.
- Token không có scope publish/quản lý người dùng/xóa container. Người dùng tự publish bằng giao diện GTM.
- Google tokeninfo không trả email trong kiểm tra đó; Codex chưa độc lập xác nhận email người cấp token. `login_hint` không phải bằng chứng danh tính.
- OAuth scope không tự giới hạn riêng container Lily Chen; công cụ phải khóa account/container/workspace khi ghi.
- Thư mục xác thực: `C:\Users\Admin\.antigravity_gtm\`, ngoài repo và OneDrive. KHÔNG in hoặc đưa client secret, token, refresh token vào chat/tài liệu/repo.
- Không coi kết nối trước đó luôn còn hiệu lực; chỉ kiểm tra lại khi công việc thực sự cần API.

## 8. Bằng chứng và tài liệu cần đọc theo nhu cầu

- `HANDOFF-GOOGLE-MEASUREMENT-2026-10-04.md`: bối cảnh ban đầu.
- `HANDOFF-GOOGLE-MEASUREMENT-INVENTORY-2026-10-04.md`: báo cáo Antigravity có các cập nhật; một số kết luận cũ từng quá mức, ưu tiên bằng chứng và các đính chính trong handoff này.
- `backups/gtm/GTM-TJRRBJRF_workspace18_original_backup_20261004.json`: backup export gốc.
- `backups/gtm/GTM-GTM-TJRRBJRF_live_version_17_20261005_210121.json`: API snapshot Live 17. Codex đã chuẩn hóa enum và đối chiếu: cấu hình tags/triggers/variables/built-ins khớp workspace18.
- `backups/gtm/GTM-TJRRBJRF_workspace_19_snapshot_20261005_212251.json`: snapshot workspace sau áp dụng; schema gồm `entities.tags`, `entities.triggers`, `entities.variables`, `entities.built_in_variables`.
- Bản nháp v1/v2 là lịch sử: KHÔNG dùng lại vì đã pause Ads trái với yêu cầu sau đó. V3 đã khôi phục Ads; cấu hình thực trong GTM sau apply/publish là mốc hiện hành.
- Các handoff production cũ chỉ đọc khi cần kiến trúc/triển khai; không mở lại toàn bộ audit migration hoặc GSAP.

## 9. Điểm bắt đầu đề xuất cho chat mới

1. Xác nhận mục tiêu nâng cấp trải nghiệm 3D và video, vẫn dùng WordPress và cách phối hợp Codex–Antigravity.
2. Hỏi ngắn gọn về phong cách mong muốn và nguồn video; khảo sát có phạm vi website/source để hiểu cấu trúc cần giữ.
3. Nghiên cứu xu hướng hiện hành, đề xuất 2–3 hướng thiết kế với minh họa/tham chiếu và đánh đổi mobile/tốc độ/quản trị.
4. Thống nhất phạm vi rồi mới viết prompt triển khai từng giai đoạn cho Antigravity.
5. Đưa form, SEO, khả năng truy cập và đo lường vào tiêu chí nghiệm thu. Giữ nguyên Ads; nối tín hiệu lead khi được triển khai, không tạo trùng thẻ đã publish.

Chưa thực hiện thay đổi thiết kế, source, deploy hoặc cấu hình đo lường nào trong lượt tạo handoff này.
