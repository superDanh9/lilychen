# 4 PROMPT DEEP RESEARCH CHO GEMINI — DỰ ÁN LILY CHEN

> **Cách dùng:**
> 1. Mở Gemini Pro → click vào "Deep Research" (icon thí nghiệm)
> 2. Copy NGUYÊN BLOCK (gồm cả phần QUY TẮC) → paste vào ô chat
> 3. Gemini sẽ đề xuất research plan trước khi chạy → review plan → bấm "Start research"
> 4. Đợi 5-10 phút → khi xong, click "Export" hoặc copy toàn bộ output
> 5. Paste output về cho Claude để verify từng số + đóng gói thành báo cáo
>
> **Chạy 4 prompt TUẦN TỰ (mỗi cái 1 chat mới), không chạy đồng thời.**
> **Mỗi prompt có 1 block "QUY TẮC" giống nhau — đừng xoá, đây là phần bắt Gemini không bịa số.**

---

## PROMPT 1 — THỊ TRƯỜNG BEAUTY/MAKEUP VIỆT NAM

```
Bạn là chuyên gia nghiên cứu thị trường. Tôi đang viết báo cáo đồ án 
tốt nghiệp Digital Marketing tại FPT Skillking cho một học viện đào tạo 
makeup tại Bình Dương (Lily Chen Makeup Academy). Giảng viên chấm rất 
nặng về độ chính xác số liệu — chỉ cần phát hiện 1 số bịa là mất 
điểm nặng.

NHIỆM VỤ: Nghiên cứu thị trường mỹ phẩm và làm đẹp tại Việt Nam, 
giai đoạn 2023-2026 và dự báo tới 2030.

CẦN TÌM CỤ THỂ:
1. Quy mô thị trường mỹ phẩm VN (USD/VND) các năm gần nhất
2. CAGR (tốc độ tăng trưởng kép) ngành beauty VN
3. Tỷ lệ phụ nữ VN sử dụng mỹ phẩm hàng ngày/hàng tuần (chia theo nhóm tuổi)
4. Top 3-5 danh mục sản phẩm tăng trưởng mạnh nhất 
   (skincare, makeup, suncare, fragrance...)
5. Chi tiêu trung bình/người/tháng cho beauty (chia theo nhóm thu nhập nếu có)
6. So sánh chi tiêu/quan tâm beauty: Gen Z (18-24) vs Millennials (25-35)
7. Tỷ lệ mua hàng online vs offline beauty VN
8. Mức độ phổ biến của K-beauty, J-beauty tại VN
9. Dự báo thị trường 2027-2030

QUY TẮC TUYỆT ĐỐI (vi phạm = tôi BỎ TOÀN BỘ output):

1. KHÔNG được bịa số. Không tìm được nguồn → ghi rõ 
   "KHÔNG TÌM ĐƯỢC NGUỒN cho [X]".

2. Mỗi data point BẮT BUỘC có 4 phần:
   - Con số/fact chính xác
   - URL nguồn ĐẦY ĐỦ (https://...) — tôi sẽ click verify từng cái
   - Tên tổ chức công bố + năm
   - QUOTE NGUYÊN VĂN 1-2 câu từ source chứa con số đó

3. Ưu tiên nguồn theo thứ tự độ tin cậy:
   - Tổng cục Thống kê (gso.gov.vn), Bộ Công Thương, Bộ Y Tế
   - Statista, Euromonitor, Mordor Intelligence, Grand View Research
   - Decision Lab, Q&Me, Nielsen, Kantar Worldpanel, Cimigo
   - Báo có dẫn nguồn gốc: VnExpress, Tuổi Trẻ, Lao Động, 
     Forbes VN, Brands VN
   - TUYỆT ĐỐI TRÁNH: blog cá nhân, agency tự PR, e-commerce site 
     không trích nguồn gốc

4. Nếu cùng 1 chỉ số có 2 nguồn khác số → ghi CẢ 2 + đánh dấu 
   "DISCREPANCY" + nêu lý do có thể.

5. Tìm cả tiếng Việt VÀ tiếng Anh ("Vietnam cosmetics market size", 
   "Vietnam beauty industry", "Vietnam makeup consumer survey"...) 
   để mở rộng coverage.

OUTPUT FORMAT (bắt buộc, mỗi data point block riêng):

---
**[DATA POINT #X]**
- **Chỉ số:** [tên chỉ số]
- **Giá trị:** [con số + đơn vị]
- **Nguồn:** [tên tổ chức]
- **Năm công bố:** [YYYY]
- **URL:** [đường dẫn đầy đủ]
- **Quote nguyên văn:** "[trích dẫn 1-2 câu chứa con số]"
- **Độ tin cậy:** [Cao/Trung bình/Thấp + lý do]
- **Ghi chú:** [discrepancy, context, hoặc note]
---

CUỐI OUTPUT: liệt kê mục riêng 
"DATA POINT KHÔNG TÌM ĐƯỢC NGUỒN" + đề xuất hướng search bổ sung.
```

---

## PROMPT 2 — THỊ TRƯỜNG ĐÀO TẠO MAKEUP VIỆT NAM

```
Bạn là chuyên gia nghiên cứu thị trường giáo dục. Tôi đang viết báo cáo 
đồ án tốt nghiệp Digital Marketing tại FPT Skillking cho Lily Chen 
Makeup Academy (Bình Dương). Giảng viên chấm rất nặng về độ chính xác 
số liệu — chỉ cần phát hiện 1 số bịa là mất điểm nặng.

NHIỆM VỤ: Nghiên cứu thị trường đào tạo makeup tại Việt Nam.

CẦN TÌM CỤ THỂ:

1. Số học viện/trung tâm dạy makeup chính thức tại VN (nếu có thống kê)
2. Số người làm nghề makeup artist chuyên nghiệp tại VN
3. Mức học phí TRUNG BÌNH các khóa makeup (chia theo loại khóa: 
   cá nhân / chuyên nghiệp / cô dâu / nâng cao)
4. Profile chi tiết Top 5-7 academy LỚN NHẤT VN (cần verify còn hoạt động):
   - Seoul Academy, Tina Lê Makeup, Quách Ánh, DIVA Academy, 
     Vinnie, Tokyo Beauty, Liphamy, Yumi Academy
   - Mỗi academy: học phí khóa cá nhân, học phí khóa pro, 
     số chi nhánh, địa điểm chính, thành lập năm bao nhiêu, 
     USP chính (truy cập website chính thức để lấy giá hiện hành)
5. Mức lương khởi điểm makeup artist mới ra nghề tại VN
6. Mức lương trung bình makeup artist 2-3 năm kinh nghiệm
7. Tỷ lệ học viên tốt nghiệp khóa makeup đi làm nghề (nếu có data)
8. Mô hình kinh doanh phổ biến: studio cá nhân vs academy nhiều chi nhánh
9. Xu hướng học makeup online vs offline post-COVID (2022 trở đi)

QUY TẮC TUYỆT ĐỐI:

1. KHÔNG bịa. Không có nguồn → ghi "KHÔNG TÌM ĐƯỢC NGUỒN cho [X]".
2. Mỗi data point có URL + quote nguyên văn + năm.
3. Đặc biệt với học phí từng academy: ghi rõ NGÀY truy cập website 
   + URL trang học phí cụ thể (KHÔNG ghi từ blog reviewer thứ 3).
4. Nếu academy không công khai học phí trên web → ghi rõ 
   "Học phí không công khai online".

NGUỒN ƯU TIÊN:
- Website CHÍNH THỨC của từng academy
- VietnamWorks, TopCV, ITviec, Glints (mức lương ngành)
- Tổng cục Thống kê (mã ngành dịch vụ làm đẹp)
- Brands VN, MarketingAI, AdAsia
- Báo lớn dẫn nguồn gốc

OUTPUT FORMAT: Giống Prompt 1.

Với profile academy, dùng bảng:

| Academy | Năm thành lập | Khóa cá nhân (giá) | Khóa pro (giá) | Số chi nhánh | URL học phí | Ngày truy cập |
|---------|---------------|--------------------|--------------------|--------------|-------------|---------------|
```

---

## PROMPT 3 — LOCAL BÌNH DƯƠNG

```
Bạn là chuyên gia nghiên cứu thị trường địa phương. Tôi đang viết báo 
cáo đồ án tốt nghiệp Digital Marketing tại FPT Skillking cho Lily Chen 
Makeup Academy đặt tại TP. Thủ Dầu Một, tỉnh Bình Dương. Giảng viên 
chấm rất nặng về độ chính xác số liệu.

NHIỆM VỤ: Nghiên cứu profile dân cư + thị trường beauty tại Bình Dương.

CẦN TÌM CỤ THỂ:

1. Dân số Bình Dương các năm gần nhất 
   (tổng + chia theo giới tính, có thể chia theo huyện/thành phố)
2. Cơ cấu độ tuổi Bình Dương (đặc biệt nhóm nữ 18-35)
3. Dân số riêng TP. Thủ Dầu Một
4. Số lượng công nhân nữ tại các KCN Bình Dương 
   (BD có VSIP, Mỹ Phước, Đại Đăng... nhiều KCN, đông công nhân nữ)
5. Số lượng sinh viên đại học/cao đẳng tại Bình Dương 
   - ĐH Thủ Dầu Một
   - ĐH Việt Đức
   - ĐH Bình Dương
   - ĐH Quốc tế Miền Đông
   - Các cao đẳng khác
6. Thu nhập trung bình người lao động Bình Dương 
   (cả công nhân lẫn văn phòng nếu có chia)
7. Số spa/salon/thẩm mỹ viện đăng ký tại Bình Dương 
   (nếu có thống kê từ Sở KH-ĐT BD hoặc Sở Y Tế BD)
8. Mức độ phát triển thương mại Bình Dương so với mặt bằng VN 
   (GDP đầu người, top tỉnh giàu nhất...)
9. Khoảng cách Bình Dương - TP.HCM và mức độ "chảy máu" khách hàng 
   sang TP.HCM cho dịch vụ cao cấp (nếu có bài báo hoặc khảo sát)
10. Mức độ phủ Internet + Facebook + TikTok ở Bình Dương 
    (nếu có thống kê We Are Social, Decision Lab chia theo tỉnh)

QUY TẮC TUYỆT ĐỐI: Giống các prompt trước.

NGUỒN ƯU TIÊN BỔ SUNG:
- Cục Thống kê Bình Dương (gso.gov.vn → tab tỉnh)
- Cổng thông tin điện tử Bình Dương (binhduong.gov.vn)
- Niên giám thống kê Bình Dương các năm
- Báo Bình Dương (baobinhduong.vn)
- We Are Social + Hootsuite "Digital Vietnam" report
- Sở Y tế Bình Dương (cấp phép cơ sở dịch vụ thẩm mỹ)

OUTPUT FORMAT: Giống Prompt 1.
```

---

## PROMPT 4 — GOOGLE TRENDS + KEYWORD RESEARCH

```
Bạn là chuyên gia SEO. Tôi đang viết báo cáo đồ án tốt nghiệp 
Digital Marketing tại FPT Skillking cho Lily Chen Makeup Academy 
(Bình Dương). Phần SEO + keyword là một mục quan trọng trong báo cáo.

NHIỆM VỤ: Phân tích keyword và xu hướng tìm kiếm liên quan đến 
"học makeup" tại Việt Nam, đặc biệt focus Bình Dương.

CẦN TÌM CỤ THỂ:

1. Volume tìm kiếm trung bình/tháng tại VN cho các keyword:
   - "học makeup"
   - "học trang điểm"
   - "khóa học makeup"
   - "học makeup Bình Dương"
   - "học trang điểm Bình Dương"
   - "học makeup TP HCM"
   - "học makeup Thủ Dầu Một"
   - "makeup artist Bình Dương"
   - "học makeup online"
   - "tự học makeup"
   - "makeup cô dâu"
   - "makeup văn phòng"
   - "lớp makeup cá nhân"

2. Trend 12 tháng + 5 năm cho keyword "học makeup" trên Google Trends VN 
   (mô tả xu hướng tăng/giảm/ổn định + paste link Trends thật)

3. Top related queries + breakout queries cho "học makeup" trên Trends

4. Search intent của mỗi keyword chính 
   (Informational / Commercial / Transactional / Navigational)

5. Top 10 domain đang xếp hạng cho "học makeup Bình Dương" 
   trên Google.com.vn (SERP hiện tại)

6. Difficulty / competition của keyword "học makeup Bình Dương" 
   (nếu có data Ahrefs/SEMrush/Ubersuggest free)

7. Mùa cao điểm tìm kiếm makeup trong năm 
   (Tết, mùa cưới, tốt nghiệp, lễ 8/3, 20/10...)

QUY TẮC:
- Volume từ tool nào → ghi rõ tool đó 
  (Ahrefs / SEMrush / Ubersuggest / Keyword Planner / Keywords Everywhere)
- Khác tool có số khác nhau → ghi CẢ 2-3 nguồn
- Google Trends: paste URL trends thật, KHÔNG bịa shape của trend
- SERP: ghi top domain hiện tại + ngày check

OUTPUT FORMAT mỗi keyword 1 block:

---
**Keyword:** [keyword]
**Volume:** [số/tháng] (nguồn: [tool], ngày check: [DD/MM/YYYY])
**Trend 12 tháng:** [tăng/giảm/ổn định + mô tả]
**Difficulty:** [score nếu có]
**Search intent:** [loại]
**Top 3 domain SERP:** [list]
**Ghi chú:** [breakout query, seasonality, đặc thù local]
---

Nếu KHÔNG tool nào có volume → ghi "KHÔNG TÌM ĐƯỢC VOLUME" 
+ đề xuất cách thay thế (Google Suggest, AnswerThePublic, 
TikTok Search Insights...).
```

---

## SAU KHI GEMINI CHẠY XONG 4 PROMPT

1. Copy toàn bộ output mỗi prompt → save vào file riêng 
   (gemini-output-1.txt, gemini-output-2.txt, gemini-output-3.txt, 
   gemini-output-4.txt) hoặc paste thẳng về Claude.

2. Claude sẽ:
   - Verify từng URL có hoạt động không (random check)
   - Verify quote có khớp với nội dung URL không
   - Loại bỏ data point nghi ngờ
   - Đóng gói thành các section của báo cáo research

3. Sau khi verify → bắt đầu viết Phần 2 (Tổng quan ngành) + Phần 3 
   (Local Bình Dương) của document research.
