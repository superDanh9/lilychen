> Sắp xếp 08/10/2026: đường dẫn trong dấu backtick được hiểu từ gốc dự án, trừ tên handoff cùng thư mục. Trang HTML cũ và các mẫu thử nay ở `prototypes/static-site/`; thông tin triển khai bên dưới là ghi nhận lịch sử.

# Lily Chen — định hướng trang chủ mới

Ngày: 02/10/2026.

## Quyết định đã được người dùng chốt

Thiết kế lại mạnh toàn bộ bố cục trang chủ, đồng thời biên tập độ dài, thứ tự và cách trình bày nội dung để phát huy hiệu ứng hạt. Làm bản thử để người dùng xem và duyệt; chỉ deploy website thật sau phê duyệt riêng. Không cần hỏi lại có được làm mới bố cục hay không.

Codex chuẩn bị định hướng và review; Antigravity thực hiện. Tài liệu này là phương án cụ thể hóa để làm bản thử, chưa phải thiết kế chi tiết hoặc nội dung cuối đã được duyệt.

## Nguồn và hiện trạng

- Đọc `HANDOFF-CODEX-NEXT-2026-10-01.md` trước khi làm việc. Website hiện dùng WordPress với theme `wordpress/lilychen-academy`. Staging cũ đã bị xóa; tên repository hosting còn chữ staging không có nghĩa là môi trường thử.
- Đã đọc template local `wordpress/lilychen-academy/front-page.php`. Giá trị mặc định trong PHP không chứng minh giá trị hiện tại trong database; sử dụng dữ liệu đang có khi đưa bản thử vào WordPress.
- Video tham chiếu: `C:\Users\Admin\Videos\Screen Recordings\Screen Recording 2026-10-02 213506.mp4`, dài khoảng 55 giây; website mẫu `https://antigravity.google/`.
- Đầu trang: khoảng 0–20 giây. Hai vùng nội dung có hạt tụ hình: khoảng 34–45 giây. Video là chuẩn thị giác cho lần thiết kế này.
- `scratch/antigravity-animation` là mã tham khảo của davidpelayo, không có bằng chứng là mã Google công bố. Không coi việc tích hợp kho này là đã tái hiện đúng video. Giữ nguồn và LICENSE khi sử dụng mã.
- `thu-mau-trang-chu/` đã có bản thử cũ; không ghi đè. Tạo bản thử riêng, ví dụ `thu-mau-trang-chu-v2/`, sau khi kiểm tra đường dẫn chưa được sử dụng.

## Hướng thẩm mỹ

Nền sáng, khoảng trắng rộng, chữ có phân cấp rõ, ảnh thật kích thước lớn. Màu thương hiệu là điểm nhấn; chọn sắc độ sau khi đối chiếu logo và giao diện hiện tại. Tránh một chuỗi các thẻ bo góc giống nhau hoặc phủ gradient lên toàn trang.

Chuyển động hạt tập trung ở phần mở đầu và phần chọn khóa học. Các vùng ảnh, giảng viên, phản hồi và form tạo nhịp nghỉ. Không cần thêm hiệu ứng hạt cho mọi section.

## Bố cục cụ thể cho bản thử

### 1. Mở đầu: cho người xem biết Lily Chen là ai

- Một tiêu đề chính nổi bật về đào tạo makeup chuyên nghiệp và cá nhân; dòng định vị Thủ Dầu Một · Bình Dương vẫn dễ tìm.
- Có thể viết lại tiêu đề theo hướng thương hiệu, nhưng vẫn phải nói rõ dịch vụ đào tạo makeup; không dùng khẩu hiệu trừu tượng thay toàn bộ thông tin.
- Một câu bổ trợ ngắn từ nội dung hiện có. Nút chính dẫn đến phần chọn khóa học; liên kết phụ dẫn đến tác phẩm.
- Dành phần lớn không gian cho trường hạt bao quanh chữ. Chữ là HTML có thể chọn, đọc và bấm liên kết bình thường.

### 2. Tác phẩm: chứng minh chất lượng bằng hình ảnh

- Gộp mosaic đầu trang và gallery tác phẩm hiện tại thành một phần chọn lọc; tránh lặp các ảnh giống nhau ở hai khu vực.
- Bố cục ảnh có kích thước khác nhau, ưu tiên gương mặt và chi tiết makeup; không đặt chữ đè lên gương mặt.
- Giữ tinh thần câu “Vẻ Đẹp Độc Bản Qua Từng Nét Cọ”; có thể biên tập nếu phù hợp bố cục.
- Dẫn sang trang tác phẩm hiện có để xem đầy đủ. Không xóa ảnh khỏi thư viện hay thay bằng ảnh học viên giả.

### 3. Hai hướng học: điểm tương tác chính

- Hai vùng rộng: Chuyên nghiệp trước, Cá nhân sau. Desktop có thể đặt cạnh nhau để người xem dễ so sánh và chuyển chuột như video; mobile xếp dọc.
- Mỗi vùng gồm tên khóa học, một câu nêu đối tượng/kết quả, thông tin quyết định ngắn và một liên kết xem chi tiết.
- Giữ học phí và thời lượng dễ tìm ở phần này; các danh sách quyền lợi, chương trình dài chuyển sang trang chi tiết nếu nơi đó đã có đủ nội dung tương ứng.
- Hạt nền phân tán, tụ thành hình bao quanh khối nội dung đang được tương tác, rồi chuyển trở lại khi đổi vùng. Chừa khoảng trống quanh chữ và nút.
- Mỗi khóa có một hình riêng. Trước tiên đạt độ mượt của chuyển động; không mặc định dùng dấu ngoặc lập trình của Google hoặc tự áp đặt hình cọ/son. Antigravity chọn hình thử phù hợp và giải thích ngắn để người dùng xem.

### 4. Trải nghiệm học: từ lớp học đến thực hành

- Dùng ảnh lớp học và hoạt động thực tế hiện có để kể câu chuyện học tập.
- Chọn vài điểm đào tạo quan trọng từ nguồn hiện tại, diễn đạt gọn. Phần King & Queen 2025 trở thành ví dụ hoạt động thực tế trong mạch này thay vì bị ghép vào gallery tác phẩm.
- Không gán ảnh sự kiện thành ảnh lớp học hoặc dùng ảnh của một hoạt động để minh họa thành tích khác.

### 5. Giảng viên và tiếng nói học viên

- Chân dung Master Lily Chen cùng phần giới thiệu cô đọng, lời chia sẻ giữ đúng ý nguồn.
- Phản hồi học viên là phần tiếp nối, có bố cục riêng; không cần ép tất cả thành một hàng thẻ đồng dạng.
- Nếu trích ngắn lời chứng thực, giữ nguyên câu trích và danh tính gắn với nguồn. Không tạo nhận xét hoặc số liệu mới; không biến ảnh tác phẩm thành chân dung học viên khi chưa xác minh.

### 6. Thông tin hỗ trợ quyết định

- FAQ giữ dạng mở/đóng dễ dùng, ưu tiên câu hỏi giúp chọn khóa học.
- Blog trình bày gọn, tiếp tục sử dụng bài viết thực và liên kết hiện có; đứng trước vùng đăng ký cuối để trang kết thúc bằng hành động rõ ràng.

### 7. Tư vấn và footer

- Lời mời tư vấn ngắn, hotline dễ tìm, form rõ ràng và thuận tiện trên điện thoại.
- Giữ luồng đăng ký thực tế khi tích hợp WordPress. Trong bản thử giao diện, form phải được nhận biết là bản thử và không gửi lead/email thật.
- Giữ các liên kết liên hệ, bảo mật và điều khoản. Tránh thêm nhiều nút kêu gọi giống nhau trong cùng vùng.

## Nội dung và chức năng

Được thay bố cục, thứ tự section, cách chia thông tin, typography và biên tập câu chữ trong phạm vi trang chủ. Thông tin thực tế, học phí, thời lượng, cam kết và lời chứng thực phải đúng nguồn. Chưa xác minh thì đánh dấu cần kiểm tra, không tự thêm lời hứa.

Giữ WordPress và những trường nội dung đang chỉnh được trong quản trị khi tích hợp. Không biến dữ liệu động thành nội dung cố định chỉ vì bản thử dùng HTML. Không đổi cấu trúc URL, backend form hoặc các trang khác trong lần làm mẫu này.

## Cách làm và nghiệm thu

1. Kiểm tra thay đổi đang có; tạo bản thử riêng để so sánh. Có thể làm mẫu giao diện static local trước, nhưng phải ghi rõ đây chưa phải bản tích hợp WordPress.
2. Làm đầy đủ bố cục trang chủ cùng hai nhóm chuyển động. Đối chiếu video thay vì coi các nhãn như “three.js” hay tên thư viện là bằng chứng.
3. Xem thực tế khi để yên chuột, di chuyển, dừng và rời vùng hạt; thử chuyển qua lại hai khóa học. Kiểm tra cuộn trang, link, bàn phím, mobile và chế độ giảm chuyển động. Nội dung vẫn đầy đủ khi không có hover.
4. Gửi đường dẫn bản thử chạy được, ảnh tổng thể desktop/mobile và đoạn quay chuyển động. Báo rõ phần đã kiểm tra và phần chưa xác minh.
5. Người dùng xem và góp ý; sửa bản thử theo phản hồi. Duyệt thiết kế không tự đồng nghĩa với cho phép deploy: trước triển khai thật cần tích hợp theme, kiểm tra chức năng liên quan, chuẩn bị backup/rollback và có phê duyệt deploy của người dùng.

Không deploy, push, sửa database production hoặc thiết lập domain thử chỉ dựa vào brief này.
