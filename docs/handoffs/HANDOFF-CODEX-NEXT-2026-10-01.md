> Sắp xếp 08/10/2026: đường dẫn trong dấu backtick được hiểu từ gốc dự án, trừ tên handoff cùng thư mục. Trang HTML cũ và các mẫu thử nay ở `prototypes/static-site/`; thông tin triển khai bên dưới là ghi nhận lịch sử.

# Bàn giao chat Codex tiếp theo — Lily Chen Academy

Ngày: 01/10/2026. Đây là điểm nối tiếp mới nhất của cuộc trò chuyện, sau chuyển production và xóa staging.

## Đọc trước và thứ tự ưu tiên

- Đọc file này trước, sau đó `HANDOFF-PRODUCTION-2026-10-01.md` để xem báo cáo chi tiết do Antigravity lưu.
- `HANDOFF-2026-10-01.md` là lịch sử trước chuyển production. Các hạn chế chỉ-staging và trạng thái SSH chưa xác minh trong tài liệu/memory cũ đã bị thay thế bởi quyết định và hiện trạng dưới đây. Không chạy lại quy trình cũ.
- Người dùng đã chốt đợt chuyển đổi, nghỉ ngơi và yêu cầu chuyển sang chat mới; hiện không có nhiệm vụ triển khai nào còn chờ thực hiện.

## Cách cộng tác đã chốt

- Dùng tiếng Việt, giải thích đơn giản, từng bước nhỏ. Người dùng cần website ổn, mượt, không lỗi giao diện; tránh mở rộng thành audit quá mức hoặc lặp lại kiểm tra đã hoàn tất khi không có lỗi mới.
- Codex điều phối, suy luận, đọc/kiểm tra bằng chứng, review và soạn prompt. Antigravity sửa code, commit/push và triển khai theo phạm vi được giao. Không tự sửa code hay deploy thay Antigravity khi chưa có yêu cầu mới.
- Giữ WordPress truyền thống với theme riêng; nhóm quen WordPress và sẽ cần ecommerce/plugin. Không mở lại CMS/headless hay chẩn đoán FTPS.
- Bảo toàn thiết kế, nội dung, ảnh và thứ tự đã duyệt. Giao diện hiển thị đúng không đồng nghĩa nội dung đều sửa được trong quản trị: nhiều phần đang nằm trong template; khi có yêu cầu CMS phải kiểm tra cụ thể.
- Trước thao tác mới cần xem hiện trạng file; không reset/ghi đè thay đổi người khác. Không tự xóa thêm dữ liệu, gửi thêm form/email thử hoặc thiết lập môi trường mới chỉ vì đọc handoff.

## Hiện trạng cuối đợt chuyển đổi

- Website chính: https://lilychenmakeup.com ; document root `/home/qxhbxcsl/public_html`.
- Theme: `lilychen-academy` v1.0.0; source local `wordpress/lilychen-academy`.
- **Database production hiện tại: `qxhbxcsl_wp622`. Đây từng là DB staging nhưng nay phục vụ web chính; tuyệt đối không xóa/ghi đè vì nhầm là staging.** DB cũ `qxhbxcsl_wp473` giữ lại.
- Commit cuối: `d12fb97ad12492e797e60fc5ff8f2dd76ff798f6`, `fix(theme): remove test mode label from submit button and cleanup course form notification`.
- Repo GitHub: https://github.com/superDanh9/lilychen ; nhánh main.
- Repo hosting `/home/qxhbxcsl/repositories/lilychen-staging` vẫn giữ và dùng quản lý mã nguồn dù tên còn staging. Không xóa/đổi tên tự động.
- Thư mục `/home/qxhbxcsl/public_html/staging` đã được Antigravity xóa theo phê duyệt người dùng; URL `/staging/` trả 404 theo báo cáo.
- Người dùng muốn dùng `xinchaodanh.id.vn` làm nơi test giao diện/hiệu ứng sau này; **chưa thiết lập**, không tự triển khai. Chọn môi trường phù hợp nếu cần thử WordPress/plugin/form, không mặc định bản static đủ.
- Hạn mức cPanel theo Antigravity kiểm tra UAPI: 3072 MB, dùng 711,49 MB, còn 2360,51 MB, thu hồi khoảng 440 MB. Đây là snapshot; số `df` trước đó thuộc toàn ổ máy chủ, không phải quota tài khoản.

## SSH và dữ liệu nhạy cảm

- Antigravity đã SSH thành công với user `qxhbxcsl`, cổng 2210, hostname `lilychenmakeup.com` / `hfn51-22098.azdigihost.com`; PHP CLI báo 8.2.33.
- Key local `C:\Users\Admin\.ssh\id_ed25519_antigravity_staging`; không đọc/in nội dung private key. Không tạo lại key hoặc yêu cầu người dùng dán lệnh cPanel mỗi lần.
- SSH user có quyền cả production và staging, không phải tài khoản bị giới hạn staging ở OS.
- Không in git remote/config vì từng có token trong URL. Không đưa secret, DB password, SMTP password, token hoặc key vào chat/tài liệu/Git.

## Form và nghiệm thu

- Form thực lưu CPT `dang_ky_tu_van` trước khi gửi email. REST `/wp-json/lilychen/v1/lead`. Lỗi gửi email không làm mất bản ghi.
- Hai email nhận đã được người dùng chốt: `thlongntl@gmail.com`, `danh39379@gmail.com`.
- Có phân quyền quản trị lead, honeypot, timegate, rate limit; bản sửa trước promotion `4009266` xử lý capabilities và nguồn IP. Không suy diễn một lượt có một bản ghi là bảo đảm idempotency cho mọi retry.
- SMTP hiện có dùng Gmail qua WP Mail SMTP. Người dùng xác nhận thực nhận email trước đó; một ảnh cho thấy thư ở Spam. Không khẳng định Inbox ổn định hay cả hai hộp thư đã nhận từng lượt test mới. Không tự đổi DNS/SMTP.
- Test API production: Post ID 982. Test UI Chrome khách chưa đăng nhập theo báo cáo Antigravity: **Post ID 983**, 01/10/2026 23:09:37, nhãn `[TEST-UI]`; thông báo cảm ơn, nút không kẹt, đúng 1 bản ghi mới, `_mail_status=sent`, hai địa chỉ nhận đúng.
- `sent` không chứng minh email đã đến Inbox/Spam của cả hai người nhận. Không cần hỏi lặp lại xác nhận cũ hoặc tự gửi thêm test.
- Nhãn thử nghiệm trên nút và tiêu đề đã bỏ; người dùng có ảnh production xác nhận nút đã sạch nhãn.

## Bằng chứng và giới hạn xác minh

- Trong cuộc trò chuyện, Codex từng xem trực tiếp production: theme mới, liên kết Tác phẩm đúng, badge chuyên mục bài viết hết chồng tiêu đề. Người dùng xác nhận mail và ảnh nút sau sửa.
- Các kết quả cuối sau dọn staging là **báo cáo Antigravity**, không phải tất cả do Codex tự chạy lại: diff toàn theme khớp d12fb97; không còn phụ thuộc staging; media production bao phủ staging; sáu URL chính HTTP 200; staging 404.
- Antigravity báo test Chrome headless desktop 1280x900/mobile 390x844 cho trang chủ và hai trang khóa học: ảnh tải 26/26, 14/14, 15/15; không scrollbar ngang. Riêng trang chuyên nghiệp mobile có `overflow-x: clip`; thuộc tính này riêng lẻ không chứng minh mọi phần tử không bị cắt. Không mở lại audit nếu không thấy vấn đề mới.
- Chat Antigravity trước bị treo lúc browser test rồi không tìm lại được lịch sử. Đã mở phiên mới kiểm tra hiện trạng, không chạy lại promotion, và hoàn tất test UI cùng dọn staging. Không cần tiếp tục chẩn đoán vụ treo.

## Backup và tệp bàn giao

- Giữ backup local/server, DB cũ và các bản ghi TEST. Source code local không phải bản backup đầy đủ DB/media.
- `local_database_backups/` có DB exports nén; trước đây Codex đã kiểm gzip/hash các bản đầu, không thử restore. Antigravity báo có bản cập nhật trước promotion mốc `20261001_221733` cho cả wp473/wp622.
- Backup cấu hình trước promotion: `/home/qxhbxcsl/pre_promotion_backup/` theo báo cáo; chứa dữ liệu nhạy cảm, không in nội dung.
- Backup theme được giữ: `/home/qxhbxcsl/lilychen-theme-backup-87zMy5na`; các backup khác không tự dọn. Local có `theme-backup-2026-09-29`.
- Codex đọc thực tế `HANDOFF-PRODUCTION-2026-10-01.md` khi tạo file này; xác nhận local HEAD d12fb97. Không có thay đổi tracked trong `git status --short`; ba file untracked trước tạo handoff này: `HANDOFF-2026-10-01.md`, `HANDOFF-PRODUCTION-2026-10-01.md`, `wordpress/HUONG_DAN_CAI_DAT_VA_KIEM_TRA.md`. Không fetch hoặc xác minh remote trong lần bàn giao này.

## Bắt đầu chat mới

1. Đọc hai handoff mới, không lặp onboarding hoặc kiểm tra migration.
2. Nói ngắn đã nắm trạng thái; chờ người dùng chọn công việc tiếp theo. Giai đoạn chuyển production/dọn staging đã kết thúc.
3. Nếu nhận báo cáo Antigravity mới, phân biệt nội dung báo cáo với bằng chứng tự kiểm; chỉ kiểm tra phù hợp với vấn đề và mục tiêu mới.
4. Mọi tác vụ tương lai có thể tác động website thật: xác định phạm vi trước khi giao thực thi. Không coi phê duyệt migration cũ là quyền sửa/xóa production không giới hạn.
