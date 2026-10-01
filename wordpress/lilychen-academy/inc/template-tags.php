<?php
/**
 * Custom template tags and helpers for Lily Chen Academy Theme
 *
 * @package LilyChen_Academy
 */

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

/**
 * Retrieve a theme modification value with fallback default
 *
 * @param string $key Theme mod key.
 * @param mixed  $default Default value if mod is not set.
 * @return mixed
 */
function lilychen_get_option($key, $default = '') {
    $val = get_theme_mod($key, $default);
    return ($val !== '' && $val !== null) ? $val : $default;
}

/**
 * Retrieve a structured content value from the unified option with fallback default.
 * Handles keys both with and without 'lilychen_' prefix for seamless compatibility.
 *
 * @param string $key Content key (e.g. 'hotline_display' or 'lilychen_hotline_display').
 * @param mixed  $default Default value if content is not set.
 * @return mixed
 */
function lilychen_get_content($key, $default = '') {
    $options = get_option('lilychen_structured_home_content', array());
    $clean_key = (strpos($key, 'lilychen_') === 0) ? substr($key, 9) : $key;

    if (isset($options[$clean_key]) && $options[$clean_key] !== '') {
        return $options[$clean_key];
    }
    if (isset($options[$key]) && $options[$key] !== '') {
        return $options[$key];
    }
    return $default;
}

/**
 * Return asset URL inside the theme directory
 *
 * @param string $path Relative path within assets directory (e.g. 'images/logo.png').
 * @return string Full URL to the asset.
 */
function lilychen_asset_url($path) {
    return esc_url(get_template_directory_uri() . '/assets/' . ltrim($path, '/'));
}

/**
 * Return image URL inside the theme assets/images directory
 *
 * @param string $filename Name of image file.
 * @return string Full URL to image.
 */
function lilychen_image_url($filename) {
    return esc_url(get_template_directory_uri() . '/assets/images/' . ltrim($filename, '/'));
}

/**
 * Default data for Courses Section (Can be overridden via Customizer)
 *
 * @return array
 */
function lilychen_default_courses() {
    return array(
        'pro' => array(
            'id'             => 'pro',
            'pill'           => 'Khóa Học Tiêu Biểu',
            'target'         => 'Dành cho bạn muốn học nghề &amp; tự chủ tài chính',
            'name'           => 'Khóa Makeup Chuyên Nghiệp',
            'summary'        => 'Đào tạo nghề toàn diện cho người muốn trở thành Makeup Artist tự do, làm việc tại bridal studio hoặc tự mở tiệm trang điểm. 90% thực hành mẫu thật dưới sự kèm cặp 1-1 trực tiếp của Master Lily Chen.',
            'price'          => '25.000.000đ',
            'price_title'    => 'Học phí trọn gói',
            'price_sub'      => 'Hỗ trợ trả góp linh hoạt 2–3 đợt · Tặng bộ cọ chuyên nghiệp cao cấp',
            'specs'          => array(
                array('label' => 'Thời lượng', 'value' => '3 tháng thực chiến'),
                array('label' => 'Thực hành', 'value' => '90% trên mẫu thật'),
                array('label' => 'Sĩ số lớp', 'value' => 'Tối đa 5 học viên'),
            ),
            'highlights'     => array(
                'Làm chủ toàn bộ layout: Cô dâu cao cấp, Dạ tiệc, Kỷ yếu & Douyin hot trend',
                'Xử lý chuyên sâu da khuyết điểm, tạo khối 3D & làm tóc đồng bộ theo layout',
                'Thi tốt nghiệp, cấp chứng chỉ & hướng dẫn chụp ảnh, set up ánh sáng nhận khách 1:1',
            ),
            'image'          => 'lilychen-king-queen-collage-2025.webp',
            'image_alt'      => 'Lớp đào tạo makeup chuyên nghiệp thực hành thực tế tại Lily Chen Academy',
            'detail_link'    => home_url('/khoa-hoc-trang-diem-chuyen-nghiep/'),
        ),
        'personal' => array(
            'id'             => 'personal',
            'pill'           => 'Làm Đẹp Cá Nhân',
            'target'         => 'Dành cho cá nhân, học sinh sinh viên &amp; người đi làm',
            'name'           => 'Khóa Trang Điểm Cá Nhân',
            'summary'        => 'Tự tin trang điểm nhẹ nhàng, tôn nét tự nhiên chỉ sau 10–15 phút mỗi sáng và làm chủ layout dự tiệc thanh lịch, không phụ thuộc tiệm. Giáo trình cá nhân hóa theo từng dáng mặt.',
            'price'          => 'Từ 1.500.000đ',
            'price_title'    => 'Học phí trọn gói',
            'price_sub'      => 'Mỹ phẩm &amp; dụng cụ thực hành được chuẩn bị sẵn 100% tại lớp',
            'specs'          => array(
                array('label' => 'Thời lượng', 'value' => '4 buổi chuyên sâu'),
                array('label' => 'Sĩ số lớp', 'value' => 'Tối đa 5 người'),
                array('label' => 'Lịch học', 'value' => 'Linh hoạt T2–CN'),
            ),
            'highlights'     => array(
                'Nhận diện đặc điểm khuôn mặt & chọn mỹ phẩm đúng tone da, tránh lãng phí',
                'Kỹ thuật tán nền mỏng mịn "glass-skin", kiềm dầu và chống mốc cakey cả ngày',
                'Makeup đi làm nhẹ nhàng 10 phút & layout dự tiệc sang trọng, cuốn hút',
            ),
            'image'          => 'IMG_1646.webp',
            'image_alt'      => 'Layout trang điểm cá nhân tự nhiên thanh lịch tại Lily Chen Makeup Academy',
            'detail_link'    => home_url('/khoa-hoc-trang-diem-ca-nhan/'),
        ),
    );
}

/**
 * Default data for Gallery Artwork Section
 *
 * @return array
 */
function lilychen_default_gallery_items() {
    return array(
        array(
            'category' => 'codau',
            'image'    => 'tacpham6.webp',
            'alt'      => 'Tác phẩm makeup cô dâu tone trong trẻo của học viên Lily Chen',
        ),
        array(
            'category' => 'tiec',
            'image'    => 'tacpham7.webp',
            'alt'      => 'Tác phẩm trang điểm dự tiệc sang trọng của học viên',
        ),
        array(
            'category' => 'douyin',
            'image'    => 'IMG_1644.webp',
            'alt'      => 'Trang điểm phong cách Douyin nhẹ nhàng thanh thuần',
        ),
        array(
            'category' => 'douyin',
            'image'    => 'IMG_1646.webp',
            'alt'      => 'Kỹ thuật che khuyết điểm da và eyeliner sắc nét',
        ),
        array(
            'category' => 'codau',
            'image'    => 'IMG_1680.webp',
            'alt'      => 'Tác phẩm bài thi tốt nghiệp khóa chuyên nghiệp',
        ),
        array(
            'category' => 'tiec',
            'image'    => 'IMG_1697.webp',
            'alt'      => 'Trang điểm kỷ yếu thanh xuân tự nhiên',
        ),
    );
}

/**
 * Default data for Testimonials Section
 *
 * @return array
 */
function lilychen_default_testimonials() {
    return array(
        array(
            'name'       => 'Nguyễn Thị Kim Hoa',
            'course'     => 'Khóa Trang Điểm Cá Nhân',
            'grad'       => 'Tốt nghiệp Tháng 1/2026',
            'avatar'     => 'IMG_1646.webp',
            'quote'      => '“Giảng viên dạy rất có tâm, sau khi hoàn thành khóa học cá nhân mình tự tin hơn hẳn. Trước đây mình xem YouTube tập đánh nền toàn bị mốc và dày cộm, đi làm ai cũng bảo trông già. Được cô Lily chỉnh cho lực tán mút và cách dưỡng ẩm trước khi makeup, giờ chỉ cần 10 phút là mình có lớp nền trong veo tự nhiên suốt cả ngày!”',
        ),
        array(
            'name'       => 'Lê Mỹ Diệu',
            'course'     => 'Khóa Makeup Chuyên Nghiệp',
            'grad'       => 'Tốt nghiệp Tháng 3/2026 · Hiện là Freelance MUA',
            'avatar'     => 'IMG_1644.webp',
            'quote'      => '“Đây là nơi xứng đáng nhất để học nghề tại Bình Dương, chỉ dạy cực kỳ nhiệt tình. Hoàn thành khóa chuyên nghiệp mình đã tự tin ra nghề nhận khách ngay. Điểm mình ưng nhất là đúng nghĩa lớp nhỏ 5 người, cô kèm sát từng buổi và học phí trọn gói 100%, không bị phát sinh thêm bất kỳ chi phí dụng cụ nào.”',
        ),
        array(
            'name'       => 'Nguyễn Minh Trang',
            'course'     => 'Khóa Makeup Chuyên Nghiệp',
            'grad'       => 'Tốt nghiệp Tháng 3/2026 · Đã mở Studio riêng',
            'avatar'     => 'IMG_1680.webp',
            'quote'      => '“Trong quá trình học thì mình gặp rất nhiều khó khăn, tay cứng và kẻ mắt không đều, nhưng cô luôn cầm tay chỉ dạy, kiên nhẫn sửa từng nét cọ, rất là biết ơn cô! Sau khi tốt nghiệp cô còn hướng dẫn mình cách chụp ảnh mẫu và set up ánh sáng. Giờ mình đã mở được góc studio nhỏ tại nhà với lượng khách quen ổn định.”',
        ),
    );
}

/**
 * Default data for FAQ Section
 *
 * @return array
 */
function lilychen_default_faqs() {
    return array(
        array(
            'q' => '1. Tôi chưa từng biết trang điểm hoặc vụng về kẻ mắt thì có học được không?',
            'a' => '<strong>Hoàn toàn học được và làm đẹp được!</strong> Tại Lily Chen Academy, giáo trình được xây dựng theo phương pháp <strong>Cầm tay chỉ việc 1 kèm 1</strong>. Dù bạn là người chưa từng cầm cọ, không biết chọn tone nền hay sợ kẻ eyeliner lệch, Master Lily Chen sẽ trực tiếp phân tích đặc điểm khuôn mặt bạn, uốn nắn từng động tác cổ tay, lực miết cọ và góc độ ánh sáng cho đến khi bạn tự tin làm đẹp cho chính mình hoặc khách hàng.',
        ),
        array(
            'q' => '2. Học phí có phát sinh thêm tiền mỹ phẩm hay dụng cụ trong quá trình học không?',
            'a' => '<strong>Tuyệt đối không phát sinh chi phí ẩn!</strong> Lily Chen Academy cam kết chính sách học phí trọn gói 100%. Toàn bộ mỹ phẩm cao cấp chính hãng (MAC, NARS, Shu Uemura, Clio, Espoir,...) cùng dụng cụ thực hành tại phòng lab đều được tài trợ miễn phí trong suốt khóa học. Bạn không phải lo lắng về việc bị ép mua cốp đồ nghề kém chất lượng.',
        ),
        array(
            'q' => '3. Khóa Chuyên Nghiệp có chính sách hỗ trợ chia nhỏ học phí trả góp không?',
            'a' => '<strong>Có! Lily Chen luôn đồng hành cùng ước mơ nghề nghiệp của bạn.</strong> Để giảm bớt áp lực tài chính ban đầu cho các bạn trẻ và Gen Z, học viện hỗ trợ chia học phí thành <strong>2 đến 3 đợt thanh toán</strong> linh hoạt trong suốt thời gian đào tạo 3 tháng. Chính sách hoàn toàn không tính lãi suất, thủ tục đơn giản, giúp bạn an tâm tập trung 100% rèn luyện tay nghề.',
        ),
        array(
            'q' => '4. Tốt nghiệp khóa Chuyên Nghiệp xong có cơ hội việc làm và thu nhập ra sao?',
            'a' => 'Học viên xuất sắc sẽ được <strong>giữ lại làm trợ giảng</strong> hoặc được Master Lily Chen trực tiếp kết nối việc làm tại các Bridal Studio, Wedding House uy tín tại Bình Dương và TP.HCM. Trong khóa học, bạn được trải nghiệm thực chiến tại các sự kiện quy mô (như show Hoa khôi Sinh viên TDMU King &amp; Queen 2025). Đặc biệt, bạn còn được đào tạo kỹ năng chụp ảnh beauty, xây dựng kênh TikTok cá nhân và tư vấn chiến lược mở Studio riêng để tự tin nhận khách với mức thu nhập từ 15 - 35 triệu/tháng.',
        ),
        array(
            'q' => '5. Trước khi nhập học tôi có cần tự mua mỹ phẩm hay cọ trang điểm không?',
            'a' => '<strong>Bạn không cần mua trước!</strong> Việc tự mua khi chưa có kiến thức chuyên môn rất dễ dẫn đến lãng phí mỹ phẩm sai tone da hoặc cọ kém chất lượng. Tại lớp đã có sẵn đầy đủ đồ nghề tiêu chuẩn. Sau khi bạn đã hiểu rõ loại da và chất liệu, Master Lily Chen sẽ định hướng danh mục mua sắm tối ưu nhất. Đặc biệt, học viên đăng ký sớm trong tháng này sẽ được <strong>tặng ngay bộ cọ trang điểm chuyên nghiệp cao cấp trị giá 850.000đ</strong>.',
        ),
        array(
            'q' => '6. Thời gian học có linh hoạt cho người đang đi làm văn phòng hoặc sinh viên không?',
            'a' => '<strong>Cực kỳ linh hoạt!</strong> Lily Chen Academy mở các ca học: <strong>Ca Sáng (09:00 - 11:30)</strong>, <strong>Ca Chiều (14:00 - 16:30)</strong> và <strong>Ca Tối (18:00 - 20:30)</strong> từ Thứ 2 đến Thứ 7. Nếu bạn có lịch công tác hoặc bận việc đột xuất, bạn chỉ cần báo trước để được dời lịch và bù bài 1:1 đầy đủ, đảm bảo tiếp thu 100% kiến thức mà không bị trôi bài.',
        ),
    );
}
