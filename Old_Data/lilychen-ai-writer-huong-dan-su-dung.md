# HƯỚNG DẪN SỬ DỤNG — TRỢ LÝ AI VIẾT BÀI SEO LILY CHEN
**Phiên bản 1.0 — 04/06/2026**

> File này KHÔNG phải system prompt. Đây là cẩm nang cho **Danh** — những việc cần làm SAU khi AI xuất bài, cách đăng lên WordPress, xử lý lỗi Rank Math, và các bài học thực chiến.
>
> System prompt nằm ở file riêng: `lilychen-ai-writer-claude-v1.2.md`.
>
> **⚠️ Lưu cả 2 file ra ngoài Claude (Google Drive / Notion).** Đã từng mất khi team Claude cũ bị hủy.

---

## PHẦN A: QUY TRÌNH TỪ AI → BÀI ĐĂNG (end-to-end)

### Bước 1 — Lấy bài từ Claude
Chạy prompt active role → trả lời 3 câu clarifying → duyệt outline → nhận bài full với output các phần.

### Bước 2 — Chuẩn bị nội dung
Copy Phần 1 (nội dung Markdown hoặc block Gutenberg) của bài.

### Bước 3 — Tạo post mới trên WordPress
- Vào WordPress → Bài viết → Viết bài mới
- Paste nội dung vào (block Gutenberg là chuẩn — KHÔNG cần lo "dạng HTML")
- Đặt category, tag phù hợp

### Bước 4 — ⭐ ĐIỀN RANK MATH (KHÂU QUAN TRỌNG NHẤT — đừng quên)
Đây là bước bị bỏ sót ở bài đầu tiên khiến điểm chỉ 14/100. Mở khung Rank Math bên phải, bấm "Chỉnh sửa đoạn trích", điền lần lượt 4 thứ từ **Phần 2 (Metadata)** của bài:

| Ô Rank Math | Lấy từ | Lưu ý |
|---|---|---|
| Focus Keyword (Từ khóa chính) | Phần 2 | Điền ĐẦU TIÊN — các check khác phụ thuộc ô này |
| Meta Title (Tiêu đề SEO) | Phần 2 | ≤60 ký tự, từ khóa ở đầu |
| Meta Description | Phần 2 | ≤155 ký tự |
| URL Slug | Phần 2 | Ngắn gọn, chứa từ khóa, ≤75 ký tự |

> 🎯 Chỉ riêng bước này, điểm nhảy từ 14 → ~70 ngay lập tức.

### Bước 5 — Thêm ảnh
- Tạo 3 ảnh từ "Phần 4: Suggestion ảnh" (dùng prompt Midjourney/Gemini Imagen có sẵn)
- Upload, đặt **alt text** đúng như AI gợi ý (có từ khóa)
- Đặt 1 ảnh làm **Featured Image** (ảnh đại diện)

### Bước 6 — Schema (v1.2: KHÔNG dán JSON thủ công)
- BlogPosting: Rank Math tự lo. Chỉ cần điền đủ tác giả + featured image.
- FAQ: dùng block "FAQ by Rank Math", chép câu hỏi/trả lời từ section FAQ của bài vào.

### Bước 7 — Internal & External link
- Gắn 3 internal link theo "Phần 5" của bài
- Đảm bảo có ≥1 external link (AI từ v1.2 đã tự chèn; nếu chưa, thêm 1 link Vinmec/Hello Bacsi)

### Bước 8 — Kiểm tra điểm & xuất bản
- Mục tiêu: **≥85** (xem Phần C để hiểu điểm nào đáng theo, điểm nào bỏ qua)
- Điền nốt placeholder (Phần 6 của bài) — CHỈ điền số đã xác nhận với Lily
- Preview → Xuất bản

---

## PHẦN B: XỬ LÝ LỖI RANK MATH (Troubleshoot nhanh)

Bảng tra cứu từ chính các lỗi đã gặp ở bài đầu tiên:

| Lỗi Rank Math báo | Nguyên nhân thật | Cách sửa |
|---|---|---|
| Từ khóa không có trong tiêu đề SEO | Chưa điền Meta Title | Điền Title (Bước 4) |
| Không thấy trong Meta Description | Chưa điền Description | Điền Description |
| Không thấy trong URL | Slug mặc định | Điền slug từ Phần 2 |
| Không có ở đầu nội dung / trong nội dung | Ô Focus Keyword trống/sai → RM dò sai | Điền đúng Focus Keyword |
| Mật độ từ khóa 0.00 hoặc thấp | Cụm chính xuất hiện ít | Chèn thêm cụm chính xác tới khi đạt 0.5–0.7% |
| Không có trong H2/H3 | Heading chưa chứa cụm nguyên văn | Sửa 1 H2 chứa cụm chính xác (bỏ chữ đệm như "ở") |
| Thiếu hình ảnh / alt | Chưa upload ảnh | Upload 3 ảnh + alt text |
| Không có liên kết ra ngoài | Thiếu external link | Thêm 1 link nguồn uy tín, `target="_blank"` |
| URL quá dài | Slug dài | Rút gọn slug (chỉ làm khi bài CHƯA publish) |
| **Dùng Content AI để tối ưu** | **Tính năng Rank Math PRO trả phí** | **BỎ QUA — không phản ánh chất lượng** |

### Lưu ý về mật độ từ khóa
- Ngưỡng xanh ≈ 0.5%. Bài 1500 từ → cụm chính cần ~8 lần.
- Vòng lặp bài đầu: 0.21% (4 lần) → 0.27% → 0.47% (7 lần) → 0.5%+ (8 lần). Mất 4 vòng.
- Từ v1.2, AI tự đạt 0.5–0.7% ngay bản đầu → đỡ phải sửa.

### Lưu ý về định dạng dán
"Dán dạng HTML" hay "block Gutenberg" KHÔNG ảnh hưởng điểm Rank Math. Điểm phụ thuộc nội dung + metadata, không phụ thuộc định dạng paste. Đừng mất công đổi qua lại.

---

## PHẦN C: HIỂU ĐÚNG ĐIỂM RANK MATH (quan trọng về tư duy)

**85+ đã là bài SEO tốt. Đừng đuổi theo 100/100.**

- Rank Math chấm các yếu tố **on-page máy móc**: có từ khóa ở đâu, mật độ bao nhiêu, độ dài title... Nó KHÔNG đo được chất lượng nội dung thật hay khả năng lên top.
- **Mật độ từ khóa** là chỉ số lỗi thời nhất — Google gần như không dùng. Nhồi cụm từ khóa để lên điểm có thể **phản tác dụng** (Google phạt keyword stuffing, bài đọc cứng).
- **Content AI** luôn báo đỏ nếu không mua Pro — kệ nó.
- Một bài 85 đọc tự nhiên > một bài 100 nhồi từ khóa.

**Với đồ án FPT Skillking:** giảng viên đánh giá việc Danh **giải thích được TẠI SAO** mỗi yếu tố on-page quan trọng, không phải con số plugin. Hiểu cơ chế > chạy theo điểm.

---

## PHẦN D: BÀI HỌC THỰC CHIẾN (cập nhật mỗi khi gặp vấn đề mới)

### Từ bài #1 — "học makeup Bình Dương" (04/06/2026, đạt 85+)
1. **Luôn điền Rank Math (Bước 4) trước khi lo lắng về điểm.** 14→70 chỉ nhờ bước này.
2. **External link là bắt buộc** — Rank Math trừ điểm nếu thiếu. Dùng nguồn thật (Vinmec...).
3. **Mật độ từ khóa** đừng để AI viết xong mới sửa — từ v1.2 AI tự đạt chuẩn ngay.
4. **Anti-hallucination ở khâu người dùng:** chỉ điền số liệu Lily đã xác nhận. Suýt tự điền giá khóa khi chưa hỏi.
5. **2 JSON thủ công là thừa** với Rank Math — đã bỏ khỏi output.
6. **Backup ngoài Claude** — đừng để lặp lại sự cố mất file.

### Từ bài #__ — [tên bài tiếp theo]
*(Để trống — điền khi gặp vấn đề mới)*

---

## PHẦN E: PROMPT ACTIVE ROLE (copy nhanh)

**Bản đầy đủ (bài quan trọng — có hỏi/outline):**
```
Đọc kỹ file "lilychen-ai-writer-claude-v1.2.md" trong Project Knowledge.
Active role Senior SEO Copywriter cho Lily Chen Makeup Academy theo file đó.
Tuân thủ: Phần 1 (brand), Phần 3 (anti-hallucination), Phần 4 (workflow hỏi 3 câu),
Phần 5 (external link + mật độ 0.5-0.7%), Phần 7 (output), Phần 8 (checklist).

TASK — Viết blog SEO:
- Từ khóa chính: [GÕ KEYWORD]
- Persona: [A 25-35 / B 18-24]
- Mục tiêu: [SEO traffic / chuyển đổi]
- Thông tin đặc biệt: [hoặc trống]

Bắt đầu: confirm role → hỏi 3 câu clarifying → ĐỪNG viết luôn.
```

**Bản nhanh (one-shot):**
```
Đọc "lilychen-ai-writer-claude-v1.2.md" và active role SEO Copywriter Lily Chen.
Viết luôn không hỏi — blog SEO:
- Keyword: [GÕ KEYWORD]  | Persona: [A/B]  | Mục tiêu: [traffic/chuyển đổi]
Tuân thủ output (Phần 7) + anti-hallucination (Phần 3) + external link + mật độ 0.5-0.7%.
Cuối bài note giả định + placeholder.
```

---

**Tác giả:** Claude + Danh · **Cập nhật:** 04/06/2026
