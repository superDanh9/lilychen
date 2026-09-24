# HANDOFF — SETUP TRỢ LÝ AI VIẾT BÀI SEO LILY CHEN

> **File này dành cho chat mới hoặc khi tài khoản Claude gặp sự cố — để khôi phục toàn bộ ngữ cảnh.**
> Đọc kèm với các handoff khác trong Project Knowledge:
> - `HANDOFF-LILYCHEN-MAKEUP-v2.md` (handoff tổng thể dự án)
> - `HANDOFF-LILYCHEN-SPRINT-2505.md` (sprint ads launch)
> - `about-danh.md` (về Danh)
>
> **Cập nhật lần cuối:** 21/05/2026

---

## 1. BỐI CẢNH FILE HANDOFF NÀY

### File này nói về cái gì
Việc thiết kế, test và triển khai **trợ lý AI chuyên viết bài SEO** cho Lily Chen Makeup Academy. Không liên quan trực tiếp đến sprint 25/05 hoặc website redesign.

### Tại sao cần trợ lý AI viết bài
- Danh phải produce content blog SEO đều đặn để kéo organic traffic (yêu cầu đồ án Digital Marketing FPT Skillking)
- Cần content quality cao mà không tốn 4–6 giờ/bài như tự viết
- Cần đạo đức marketing: KHÔNG bịa số liệu, KHÔNG review giả

### Phân biệt vai trò
- **Sprint 25/05** — code website 6 trang để chạy ads (đã handoff riêng)
- **AI Writer** — viết blog SEO + landing page lâu dài (file này)

---

## 2. CÁC QUYẾT ĐỊNH ĐÃ CHỐT QUA PHIÊN LÀM VIỆC

### Quyết định 1: Scope của trợ lý AI
- ✅ **Blog SEO** (đăng trên lilychenmakeup.com/blog/)
- ✅ **Landing Page Sales** (đăng trên /lp-*/)
- ❌ **Social content** — BỎ (FB/IG/TikTok không phải task Danh)
- ❌ **Email marketing** — chưa cần

### Quyết định 2: Nền tảng
- **Chính:** Claude Project (do tin tưởng Claude follow workflow + anti-hallucination strict hơn)
- **Phụ trợ:** Gemini Pro — chỉ dùng cho RESEARCH data + tạo ảnh (Imagen), KHÔNG viết content
- **Đã loại bỏ:** Gemini Gem Labs — render UI sai mục tiêu, cắt 65% nội dung

### Quyết định 3: Voice & xưng hô
| Loại content | Voice | Xưng hô với độc giả |
|---|---|---|
| Blog SEO | Ngôi thứ NHẤT — "Mình là Lily..." | "chị" (Persona A) / "em" (Persona B) |
| Landing Page | Ngôi thứ BA — "Tại Lily Chen Makeup Academy..." | Trung tính |

### Quyết định 4: Output format mỗi bài
Mỗi bài viết phải có **6 phần đầy đủ**:
1. Nội dung Markdown (paste WordPress)
2. Metadata Rank Math (Title ≤60 ký tự, Description ≤155, Slug, Focus + Secondary keywords)
3. JSON-LD Schema (Article/Course + FAQPage RIÊNG)
4. Suggestion ảnh (Alt text + Midjourney prompt EN)
5. Internal link gợi ý (tối thiểu 3 link)
6. Danh sách placeholder cần Danh điền

### Quyết định 5: Anti-hallucination strict
- Số liệu thị trường: search Google verify hoặc `[CẦN NGUỒN: ...]`
- Thông tin Lily Chen: hỏi Danh hoặc `[XÁC NHẬN VỚI LILY: ...]`
- Testimonial: **TUYỆT ĐỐI KHÔNG bịa** → `[TESTIMONIAL THẬT: ...]`
- Ưu đãi: KHÔNG bịa → `[ƯU ĐÃI CỤ THỂ: cần xác nhận]`
- Kiến thức ngành makeup phổ thông: tự viết OK

### Quyết định 6: Workflow multi-step (mặc định)
1. Danh giao task → AI HỎI 3 câu clarifying (persona/mục tiêu/thông tin đặc biệt)
2. Danh trả lời → AI đề xuất OUTLINE (H1/H2/H3 + FAQ + ước lượng độ dài)
3. Danh chốt outline → AI viết FULL bài
4. Override: Danh nói *"viết luôn không hỏi"* để bypass step 1-2

### Quyết định 7: Persona target
- **Persona A** — Văn phòng 25–35 (target khóa Cá Nhân) — xưng "chị"
- **Persona B** — Gen Z 18–24 (target khóa Chuyên Nghiệp) — xưng "em"

---

## 3. FILES ĐÃ TẠO

### 3 file system prompt chính (đã hoàn thành 21/05/2026)

| File | Mục đích | Trạng thái |
|---|---|---|
| `lilychen-ai-writer-claude.md` | System prompt cho Claude Project | ✅ Đã upload vào Project Knowledge |
| `lilychen-ai-writer-gemini.md` | System prompt cho Gemini Gem Pro (backup) | ✅ Đã tạo nhưng KHÔNG dùng (Gemini có vấn đề) |
| `lilychen-ai-writer-huong-dan-su-dung.md` | Hướng dẫn dùng + Library 25 topic + Prompt examples | ✅ Đã tạo |

### File này
| File | Mục đích |
|---|---|
| `HANDOFF-LILYCHEN-AI-WRITER-v1.md` | Backup ngữ cảnh để khôi phục nếu mất tài khoản Claude |

---

## 4. BÀI HỌC TỪ TEST GEMINI GEM LABS (21/05/2026)

### Test setup
- Topic test: "Học makeup ở Bình Dương — Tự học hay đi học trung tâm?"
- Persona A (25–35)
- Mục tiêu: SEO traffic
- Tool test: Gemini Gem Labs (Pro) với prompt từ `lilychen-ai-writer-gemini.md`

### Kết quả
- ✅ Workflow multi-step hoạt động — Gemini hỏi clarifying trước
- ✅ Outline đề xuất tốt — 7 H2 hợp lý, có local SEO
- ❌ **Bài cuối cùng có 5 lỗi NGHIÊM TRỌNG:**
  1. Bị cắt 65% nội dung (~650 từ thay vì 1.800)
  2. Mất 3/7 H2 (Tiêu chí chọn nơi học / Bài toán chi phí / Kết luận)
  3. FAQ chỉ có 2/6 câu (mất 4 câu)
  4. AI BỊA số liệu: "6 buổi 2-3 tiếng", "30 phút xuống 10-15 phút", "6 tháng thử và sai"
  5. Thiếu internal link cụ thể + thiếu Alt text + Schema thiếu trường

### Nguyên nhân
Gem Labs tối ưu sai mục tiêu — **render UI webpage đẹp** thay vì viết Markdown content. UI có 4 tab (Draft / SEO / Visual / Checklist) → bài bị cắt để vừa khung.

### Kết luận
- **Bỏ Gemini Gem Labs** khỏi plan
- **Giữ Gemini Pro** nhưng chỉ cho research + tạo ảnh
- **Claude Project** làm tool chính viết bài

---

## 5. PHÂN VAI 2 TOOL (mới sau test)

| Tool | Việc nên làm | Việc KHÔNG nên làm |
|---|---|---|
| **Claude Project** | Viết Blog SEO, Landing Page, edit nội dung, refactor bài cũ | Search data real-time, tạo ảnh |
| **Gemini Pro** | Research số liệu thị trường (có Google Search), tạo ảnh (Imagen), phân tích đối thủ (NotebookLM với nhiều PDF) | Viết content (đã chứng minh không follow workflow đúng) |
| **Gemini Gem Labs** | (Bỏ) | (Bỏ) |

### Workflow kết hợp gợi ý
1. **Bước 1 (Gemini):** Search "số liệu thị trường makeup Việt Nam 2026" → lấy nguồn URL có thật
2. **Bước 2 (Claude):** Paste data + nguồn URL vào prompt → yêu cầu Claude lồng vào bài
3. **Bước 3 (Gemini):** Sau khi có bài + Alt text + Midjourney prompt → dùng Imagen tạo ảnh thật theo prompt

---

## 6. TRẠNG THÁI HIỆN TẠI (21/05/2026)

### Đã hoàn thành
- ✅ 3 file system prompt đã viết và refine
- ✅ File `lilychen-ai-writer-claude.md` đã upload vào Project Knowledge
- ✅ Đã test Gemini Gem Labs → có evidence để loại bỏ
- ✅ Đã có phân vai 2 tool rõ ràng

### Đang chờ
- ⏳ Test bài đầu tiên trên Claude Project — topic "học makeup Bình Dương"
- ⏳ So sánh output Claude vs Gemini Gem Labs (đã có) → có baseline thực tế
- ⏳ Sau 2-3 bài đầu → đánh giá có cần update prompt v1.1 không

### Việc Danh cần làm song song (không thuộc AI Writer)
- Sprint 25/05 — code 6 trang website (xem file Sprint handoff)
- Thu thập 3-5 review thật từ học viên cũ
- Phỏng vấn Lily Chen 30 phút để có content thật cho Persona section

---

## 7. PROMPT KHỞI ĐỘNG CHO CHAT MỚI

### Khi Danh mở chat mới trong project hiện tại

```
Đọc kỹ file "lilychen-ai-writer-claude.md" trong project knowledge.

Từ thời điểm này, bạn KHÔNG còn là Claude trợ lý tổng hợp cho dự án Lily Chen 
nữa. Bạn đang active role MỚI theo file đó:

→ Senior SEO Copywriter chuyên ngành Beauty & Education,
   phụ trách viết Blog SEO + Landing Page cho Lily Chen Makeup Academy.

Tuân thủ NGHIÊM NGẶT toàn bộ system prompt trong file:
- Phần 1: Brand Context
- Phần 3: Anti-hallucination rules
- Phần 4: Workflow multi-step (HỎI 3 câu clarifying TRƯỚC khi viết)
- Phần 5: Module A Blog SEO
- Phần 7: Output format 6 phần BẮT BUỘC

═══════════════════════════════════════════════════════

TASK — Viết blog SEO:

- Từ khóa chính: [GÕ KEYWORD]
- Persona target: [Persona A 25–35 / Persona B 18–24]
- Mục tiêu: [SEO traffic / chuyển đổi / nurturing]
- Thông tin đặc biệt: [hoặc để trống]
- Độ dài: 1.800–2.200 từ

Bắt đầu bằng:
1. Confirm đã đọc file (1-2 câu)
2. Hỏi 3 câu clarifying theo workflow Bước 1
3. ĐỪNG viết luôn — đợi tôi trả lời clarifying trước
```

### Khi tài khoản Claude gặp sự cố — bắt đầu lại từ đầu

Nếu mất hoàn toàn tài khoản Claude hoặc Project bị xóa, Danh làm theo:

```
1. Tạo Claude Project mới
2. Upload các file handoff (từ Notion/Google Drive backup):
   - HANDOFF-LILYCHEN-MAKEUP-v2.md
   - HANDOFF-LILYCHEN-SPRINT-2505.md
   - HANDOFF-LILYCHEN-AI-WRITER-v1.md (file này)
   - about-danh.md
   - lilychen-ai-writer-claude.md (system prompt SEO writer)
3. Vào Custom Instructions của Project, paste nội dung từ 
   "=== BEGIN SYSTEM PROMPT ===" trong lilychen-ai-writer-claude.md
4. Mở chat mới, dùng prompt khởi động ở trên
```

---

## 8. CHECKLIST QUALITY CHECK MỖI BÀI

Sau khi Claude viết xong bài, Danh check 5 điểm:

- [ ] Đủ 7+ H2 (Quick Answer + Section 1-5 + FAQ + Kết luận)?
- [ ] FAQ có 5-7 câu conversational?
- [ ] KHÔNG có số liệu bịa? Số nào không có nguồn → bị thay bằng placeholder?
- [ ] Internal link đủ 3+ với anchor text rõ?
- [ ] Output đủ 6 phần (Markdown + Metadata + Schema + Ảnh + Internal link + Placeholder)?
- [ ] Độ dài đạt 1.800-2.200 từ?
- [ ] Voice đúng persona (Blog ngôi 1 / Landing ngôi 3, xưng đúng chị/em)?
- [ ] KHÔNG có từ cấm? (Số 1, Đảm bảo, Cam kết, Tốt nhất, 100%)
- [ ] Có lồng "Bình Dương" / "Thủ Dầu Một" tự nhiên (local SEO)?

---

## 9. ROADMAP NÂNG CẤP

### v1.0 (hiện tại — 21/05/2026)
- ✅ Blog SEO + Landing Page
- ✅ Anti-hallucination strict
- ✅ 2 persona, 2 voice
- ✅ Đã phân vai Claude/Gemini

### v1.1 (dự kiến sau 2-3 bài đầu)
- [ ] Tinh chỉnh prompt nếu Claude vẫn có lỗi nào lặp lại
- [ ] Bổ sung case study mẫu (sau khi có data thật)
- [ ] Update brand context với data Lily Chen confirm

### v2.0 (sau sprint 25/05 + đồ án)
- [ ] Mở rộng Module C: Social content nếu cần
- [ ] Thêm Module Email marketing
- [ ] Tích hợp GA4 data → AI biết bài nào đang work

### v3.0 (sau khi có việc làm)
- [ ] Adapt prompt cho dự án freelance khác
- [ ] Build prompt library cá nhân làm portfolio MarTech

---

## 10. QUICK REFERENCE

| Item | Value |
|---|---|
| Project Knowledge files | about-danh / HANDOFF-MAKEUP-v2 / HANDOFF-SPRINT-2505 / HANDOFF-AI-WRITER-v1 / lilychen-ai-writer-claude.md |
| File system prompt SEO writer | `lilychen-ai-writer-claude.md` |
| File hướng dẫn dùng + library topic | `lilychen-ai-writer-huong-dan-su-dung.md` |
| Tool chính viết bài | Claude Project (project hiện tại) |
| Tool phụ research/ảnh | Gemini Pro |
| Tool đã loại | Gemini Gem Labs |
| Workflow mặc định | Multi-step (Hỏi → Outline → Viết) |
| Override | "Viết luôn không hỏi" |
| Voice Blog | Ngôi 1 (Lily kể chuyện) |
| Voice Landing | Ngôi 3 (Institutional) |
| Persona A | Văn phòng 25-35, xưng "chị" |
| Persona B | Gen Z 18-24, xưng "em/bạn" |
| Độ dài Blog | 1.800-2.200 từ |
| Độ dài Landing | 800-1.500 từ visible |
| Output mỗi bài | 6 phần đầy đủ |
| Internal link tối thiểu Blog | 3 link có anchor text |
| FAQ tối thiểu | 5-7 câu |

---

**Version:** 1.0
**Ngày tạo:** 21/05/2026
**Người tạo:** Claude + Danh
**Trigger update:** Sau khi viết 3 bài thật → review → cập nhật version 1.1
