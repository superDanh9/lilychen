# Lily Chen Makeup Academy

## Cấu trúc dự án

- **wordpress/lilychen-academy/**: theme WordPress; giữ nguyên đường dẫn triển khai.
- **prototypes/static-site/**: bộ HTML cũ và bốn mẫu thử, dùng chung ảnh/CSS.
- **docs/handoffs/**: bàn giao theo ngày; đọc ngày và phạm vi trước khi sử dụng.
- **docs/briefs/**: yêu cầu thiết kế.
- **docs/content/**: tài liệu nội dung.
- **backups/**: sao lưu database, cấu hình, theme và GTM; chỉ lưu nội bộ, không đưa lên Git.
- **Old_Data/**: tài liệu lịch sử, giữ nguyên.
- **Hình ảnh chính thức/**: ảnh gốc, giữ nguyên.
- **scratch/** và **outputs/**: công cụ/đầu ra nội bộ, được Git bỏ qua.
- **.agents/** và **skills-lock.json**: cấu hình skill.

## Tài liệu

- [HANDOFF-2026-10-01.md](docs/handoffs/HANDOFF-2026-10-01.md)
- [HANDOFF-3D-VIDEO-UPGRADE-2026-10-05.md](docs/handoffs/HANDOFF-3D-VIDEO-UPGRADE-2026-10-05.md)
- [HANDOFF-CODEX-NEXT-2026-10-01.md](docs/handoffs/HANDOFF-CODEX-NEXT-2026-10-01.md)
- [HANDOFF-GOOGLE-MEASUREMENT-2026-10-04.md](docs/handoffs/HANDOFF-GOOGLE-MEASUREMENT-2026-10-04.md)
- [HANDOFF-GOOGLE-MEASUREMENT-IMPLEMENTATION-2026-10-06.md](docs/handoffs/HANDOFF-GOOGLE-MEASUREMENT-IMPLEMENTATION-2026-10-06.md)
- [HANDOFF-GOOGLE-MEASUREMENT-INVENTORY-2026-10-04.md](docs/handoffs/HANDOFF-GOOGLE-MEASUREMENT-INVENTORY-2026-10-04.md)
- [HANDOFF-PRODUCTION-2026-10-01.md](docs/handoffs/HANDOFF-PRODUCTION-2026-10-01.md)
- [BRIEF-TRANG-CHU-MOI-2026-10-02.md](docs/briefs/BRIEF-TRANG-CHU-MOI-2026-10-02.md)
- [TAI_LIEU_NOI_DUNG_KHOA_HOC.md](docs/content/TAI_LIEU_NOI_DUNG_KHOA_HOC.md)
- [TIEN_DO_CHUYEN_BAI_VIET.md](docs/content/TIEN_DO_CHUYEN_BAI_VIET.md)

## Xem nguyên mẫu

Chạy máy chủ tĩnh với document root là `prototypes/static-site/`, không phải gốc repository. Ví dụ nếu có Python:

```powershell
python -m http.server 8765 --bind 127.0.0.1 --directory prototypes/static-site
```

Mở http://127.0.0.1:8765/. Máy chủ tĩnh chỉ phục vụ giao diện; không chạy API Node trong api/contact.js hay PHP/WordPress. Không gửi form thử từ bản nguyên mẫu. Các script QA cũ trong scratch có thể còn dùng đường dẫn cũ; kiểm tra cấu hình trước khi chạy lại.

## Quy ước lưu file

Tài liệu mới đặt trong nhóm docs phù hợp; mẫu thử mới đặt cạnh các mẫu hiện có trong prototypes/static-site. File tạm đặt trong scratch hoặc outputs. Không xóa backup/ảnh gốc chỉ vì cũ, không gom thêm file vào thư mục gốc. Các tài liệu lịch sử không phải bằng chứng trạng thái hosting hiện tại.

Nhật ký di chuyển và SHA-256 trước/sau được lưu nội bộ tại scratch/organization-2026-10-08/. Đợt sắp xếp không commit, push hoặc deploy.
