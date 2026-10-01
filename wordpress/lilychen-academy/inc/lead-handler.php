<?php
/**
 * Lead Handler: Xử lý Đăng Ký Tư Vấn Khóa Học (Lily Chen Academy)
 *
 * Lưu trữ đăng ký vào Custom Post Type trong WordPress, bảo mật chống spam,
 * gửi email thông báo tới ban tư vấn và cung cấp giao diện quản trị trực quan.
 *
 * @package LilyChen_Academy
 */

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

// Danh sách địa chỉ email nhận thông báo đăng ký mới (đã được chủ dự án xác nhận)
if (!defined('LILYCHEN_LEAD_RECIPIENT_EMAILS')) {
    define('LILYCHEN_LEAD_RECIPIENT_EMAILS', array(
        'thlongntl@gmail.com',
        'danh39379@gmail.com',
    ));
}

// Giữ định nghĩa cũ để tương thích ngược nếu có module gọi hằng số đơn
if (!defined('LILYCHEN_LEAD_RECIPIENT_EMAIL')) {
    define('LILYCHEN_LEAD_RECIPIENT_EMAIL', 'thlongntl@gmail.com');
}

/**
 * Lấy danh sách địa chỉ email nhận thông báo đăng ký tư vấn
 *
 * @return array
 */
function lilychen_get_lead_recipient_emails() {
    $recipients = defined('LILYCHEN_LEAD_RECIPIENT_EMAILS') 
        ? LILYCHEN_LEAD_RECIPIENT_EMAILS 
        : array('thlongntl@gmail.com', 'danh39379@gmail.com');
    return apply_filters('lilychen_lead_recipient_emails', $recipients);
}

/**
 * Ghi nhận lỗi chi tiết khi wp_mail gặp sự cố
 */
function lilychen_catch_lead_mail_failed($wp_error) {
    if (is_wp_error($wp_error)) {
        $GLOBALS['lilychen_last_mail_error'] = $wp_error->get_error_message();
    }
}
add_action('wp_mail_failed', 'lilychen_catch_lead_mail_failed');

/**
 * 1. Đăng ký Custom Post Type 'dang_ky_tu_van'
 */
function lilychen_register_lead_cpt() {
    $labels = array(
        'name'               => esc_html__('Đăng Ký Tư Vấn', 'lilychen-academy'),
        'singular_name'      => esc_html__('Đăng Ký Tư Vấn', 'lilychen-academy'),
        'menu_name'          => esc_html__('Đăng Ký Tư Vấn', 'lilychen-academy'),
        'all_items'          => esc_html__('Tất cả Đăng Ký', 'lilychen-academy'),
        'view_item'          => esc_html__('Xem Đăng Ký', 'lilychen-academy'),
        'edit_item'          => esc_html__('Chi Tiết Đăng Ký', 'lilychen-academy'),
        'search_items'       => esc_html__('Tìm kiếm đăng ký', 'lilychen-academy'),
        'not_found'          => esc_html__('Chưa có đăng ký nào.', 'lilychen-academy'),
        'not_found_in_trash' => esc_html__('Thùng rác trống.', 'lilychen-academy'),
    );

    $args = array(
        'labels'              => $labels,
        'public'              => false,
        'publicly_queryable'  => false,
        'show_ui'             => true,
        'show_in_menu'        => true,
        'query_var'           => false,
        'rewrite'             => false,
        'capability_type'     => 'post',
        'map_meta_cap'        => true,
        'has_archive'         => false,
        'hierarchical'        => false,
        'menu_position'       => 26,
        'menu_icon'           => 'dashicons-id-alt',
        'supports'            => array('title'),
    );

    register_post_type('dang_ky_tu_van', $args);
}
add_action('init', 'lilychen_register_lead_cpt');

/**
 * 2. Phân quyền: Chỉ Administrator (manage_options) mới được xem và quản trị
 */
function lilychen_lead_cpt_access_check() {
    global $pagenow, $typenow;
    if ($typenow === 'dang_ky_tu_van' && !current_user_can('manage_options')) {
        wp_die(esc_html__('Bạn không có quyền truy cập trang danh sách đăng ký này.', 'lilychen-academy'));
    }
}
add_action('admin_init', 'lilychen_lead_cpt_access_check');

/**
 * 3. Tùy biến các cột hiển thị trong danh sách WP-Admin
 */
function lilychen_lead_cpt_columns($columns) {
    $new_cols = array(
        'cb'          => $columns['cb'],
        'title'       => esc_html__('Họ và Tên', 'lilychen-academy'),
        'lead_phone'  => esc_html__('Số Điện Thoại / Zalo', 'lilychen-academy'),
        'lead_course' => esc_html__('Khóa Học Quan Tâm', 'lilychen-academy'),
        'lead_time'   => esc_html__('Khung Giờ Tư Vấn', 'lilychen-academy'),
        'lead_source' => esc_html__('Nguồn Trang', 'lilychen-academy'),
        'lead_status' => esc_html__('Trạng Thái', 'lilychen-academy'),
        'date'        => esc_html__('Thời Gian Gửi', 'lilychen-academy'),
    );
    return $new_cols;
}
add_filter('manage_dang_ky_tu_van_posts_columns', 'lilychen_lead_cpt_columns');

function lilychen_lead_cpt_custom_column($column, $post_id) {
    switch ($column) {
        case 'lead_phone':
            $phone = get_post_meta($post_id, '_lead_phone', true);
            if ($phone) {
                echo '<a href="tel:' . esc_attr($phone) . '"><strong>' . esc_html($phone) . '</strong></a>';
            } else {
                echo '—';
            }
            break;

        case 'lead_course':
            $course = get_post_meta($post_id, '_lead_course', true);
            echo esc_html($course ? $course : '—');
            break;

        case 'lead_time':
            $time = get_post_meta($post_id, '_lead_time', true);
            echo esc_html($time ? $time : '—');
            break;

        case 'lead_source':
            $source = get_post_meta($post_id, '_lead_source', true);
            echo esc_html($source ? $source : 'Trang chủ');
            break;

        case 'lead_status':
            $status = get_post_meta($post_id, '_lead_status', true);
            if ($status === 'contacted') {
                echo '<span style="display:inline-block; padding:3px 8px; border-radius:4px; background:#d1e7dd; color:#0f5132; font-weight:600; font-size:12px;">Đã tư vấn</span>';
            } else {
                echo '<span style="display:inline-block; padding:3px 8px; border-radius:4px; background:#fff3cd; color:#664d03; font-weight:600; font-size:12px;">Mới nhận</span>';
            }
            break;
    }
}
add_action('manage_dang_ky_tu_van_posts_custom_column', 'lilychen_lead_cpt_custom_column', 10, 2);

/**
 * 4. Meta Box chi tiết thông tin đăng ký trong trang chỉnh sửa bài viết
 */
function lilychen_lead_register_meta_box() {
    add_meta_box(
        'lilychen_lead_details',
        esc_html__('Chi Tiết Yêu Cầu Tư Vấn', 'lilychen-academy'),
        'lilychen_lead_render_meta_box',
        'dang_ky_tu_van',
        'normal',
        'high'
    );
}
add_action('add_meta_boxes', 'lilychen_lead_register_meta_box');

function lilychen_lead_render_meta_box($post) {
    wp_nonce_field('lilychen_lead_save_status', 'lilychen_lead_status_nonce');

    $name        = get_post_meta($post->ID, '_lead_name', true);
    $phone       = get_post_meta($post->ID, '_lead_phone', true);
    $course      = get_post_meta($post->ID, '_lead_course', true);
    $time        = get_post_meta($post->ID, '_lead_time', true);
    $message     = get_post_meta($post->ID, '_lead_message', true);
    $source      = get_post_meta($post->ID, '_lead_source', true);
    $ip          = get_post_meta($post->ID, '_lead_ip', true);
    $status          = get_post_meta($post->ID, '_lead_status', true);
    $mail_status     = get_post_meta($post->ID, '_mail_status', true);
    $mail_error      = get_post_meta($post->ID, '_mail_error', true);
    $mail_recipients = get_post_meta($post->ID, '_mail_recipients', true);
    ?>
    <table class="form-table" style="width: 100%;">
        <tr>
            <th style="width: 200px;"><strong>Họ và tên:</strong></th>
            <td><strong style="font-size: 16px;"><?php echo esc_html($name ?: $post->post_title); ?></strong></td>
        </tr>
        <tr>
            <th><strong>Số điện thoại / Zalo:</strong></th>
            <td>
                <?php if ($phone): ?>
                    <a href="tel:<?php echo esc_attr($phone); ?>" class="button button-primary">Gọi <?php echo esc_html($phone); ?></a>
                    <a href="https://zalo.me/<?php echo esc_attr(preg_replace('/[^0-9]/', '', $phone)); ?>" target="_blank" rel="noopener noreferrer" class="button">Mở Zalo</a>
                <?php else: ?>
                    <em>Chưa có</em>
                <?php endif; ?>
            </td>
        </tr>
        <tr>
            <th><strong>Khóa học quan tâm:</strong></th>
            <td><?php echo esc_html($course ?: 'Chưa chọn'); ?></td>
        </tr>
        <tr>
            <th><strong>Khung giờ tư vấn thuận tiện:</strong></th>
            <td><?php echo esc_html($time ?: 'Linh hoạt'); ?></td>
        </tr>
        <tr>
            <th><strong>Lời nhắn / Câu hỏi:</strong></th>
            <td><div style="background:#f8f9fa; padding:12px; border-radius:4px; border:1px solid #ddd;"><?php echo nl2br(esc_html($message ?: '(Không có ghi chú thêm)')); ?></div></td>
        </tr>
        <tr>
            <th><strong>Nguồn trang đăng ký:</strong></th>
            <td><code><?php echo esc_html($source ?: '/'); ?></code></td>
        </tr>
        <tr>
            <th><strong>Địa chỉ IP người gửi:</strong></th>
            <td><code><?php echo esc_html($ip ?: 'N/A'); ?></code></td>
        </tr>
        <tr>
            <th><strong>Hộp thư nhận thông báo:</strong></th>
            <td><code><?php echo esc_html($mail_recipients ?: implode(', ', (array)lilychen_get_lead_recipient_emails())); ?></code></td>
        </tr>
        <tr>
            <th><strong>Trạng thái thông báo Email:</strong></th>
            <td>
                <?php if ($mail_status === 'sent'): ?>
                    <span style="color: green; font-weight:600;">✓ Đã gửi email thông báo thành công</span>
                <?php elseif ($mail_status === 'failed'): ?>
                    <span style="color: #b02a37; font-weight:600;">⚠ Gửi mail thất bại: <?php echo esc_html($mail_error ?: 'Lỗi SMTP/Server'); ?></span>
                <?php else: ?>
                    <span style="color: #666;">Chưa gửi</span>
                <?php endif; ?>
            </td>
        </tr>
        <tr>
            <th><strong>Trạng thái chăm sóc:</strong></th>
            <td>
                <select name="lead_status">
                    <option value="new" <?php selected($status, 'new'); ?>>Mới nhận (Chưa tư vấn)</option>
                    <option value="contacted" <?php selected($status, 'contacted'); ?>>Đã liên hệ / Đã tư vấn</option>
                </select>
            </td>
        </tr>
    </table>
    <?php
}

function lilychen_lead_save_meta_box($post_id) {
    if (!isset($_POST['lilychen_lead_status_nonce']) || !wp_verify_nonce($_POST['lilychen_lead_status_nonce'], 'lilychen_lead_save_status')) {
        return;
    }
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return;
    }
    if (!current_user_can('edit_post', $post_id)) {
        return;
    }
    if (isset($_POST['lead_status'])) {
        update_post_meta($post_id, '_lead_status', sanitize_text_field($_POST['lead_status']));
    }
}
add_action('save_post_dang_ky_tu_van', 'lilychen_lead_save_meta_box');

/**
 * 5. Bộ xử lý nghiệp vụ chung (Validation, Anti-spam, Lưu Database, Gửi Email)
 */
function lilychen_process_lead_submission($data) {
    // 5.1. Anti-spam: Honeypot check
    $hp_company = isset($data['_hp_company']) ? trim((string)$data['_hp_company']) : '';
    if (!empty($hp_company)) {
        // Giả lập thành công cho spam bot mà không lưu database hay gửi email
        return array(
            'success' => true,
            'message' => esc_html__('Cảm ơn bạn! Thông tin đăng ký đã được tiếp nhận.', 'lilychen-academy'),
        );
    }

    // 5.2. Anti-spam: Time gate (Form phải được nạp tối thiểu 2.5 giây trước khi submit)
    $form_load_time = isset($data['_form_load_time']) ? floatval($data['_form_load_time']) : 0;
    if ($form_load_time > 0) {
        // Hỗ trợ cả timestamp milliseconds (JS Date.now()) và seconds (PHP time())
        if ($form_load_time > 100000000000) {
            $elapsed_seconds = (microtime(true) * 1000 - $form_load_time) / 1000;
        } else {
            $elapsed_seconds = microtime(true) - $form_load_time;
        }
        if ($elapsed_seconds < 2.5) {
            return array(
                'success' => false,
                'message' => esc_html__('Thao tác quá nhanh. Vui lòng thử lại sau vài giây.', 'lilychen-academy'),
            );
        }
    }

    // 5.3. Anti-spam: Rate limiting theo IP (Tối đa 5 lần gửi / 10 phút)
    $client_ip = '';
    if (!empty($_SERVER['HTTP_CF_CONNECTING_IP'])) {
        $client_ip = sanitize_text_field($_SERVER['HTTP_CF_CONNECTING_IP']);
    } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
        $ip_list   = explode(',', $_SERVER['HTTP_X_FORWARDED_FOR']);
        $client_ip = sanitize_text_field(trim($ip_list[0]));
    } else {
        $client_ip = sanitize_text_field($_SERVER['REMOTE_ADDR'] ?? '');
    }

    $rate_limit_key   = 'lilychen_lead_limit_' . md5($client_ip);
    $submission_count = intval(get_transient($rate_limit_key));
    if ($submission_count >= 5) {
        return array(
            'success' => false,
            'message' => esc_html__('Bạn đã gửi đăng ký nhiều lần. Vui lòng đợi 10 phút hoặc liên hệ trực tiếp hotline.', 'lilychen-academy'),
        );
    }

    // 5.4. Validate & Sanitize Input
    $name    = isset($data['name']) ? sanitize_text_field(trim((string)$data['name'])) : '';
    $phone   = isset($data['phone']) ? sanitize_text_field(trim((string)$data['phone'])) : '';
    $course  = isset($data['course']) ? sanitize_text_field(trim((string)$data['course'])) : 'Tư vấn khóa học phù hợp';
    $time    = isset($data['time']) ? sanitize_text_field(trim((string)$data['time'])) : 'Linh hoạt';
    $message = isset($data['message']) ? sanitize_textarea_field(trim((string)$data['message'])) : '';
    $source  = isset($data['source_page']) ? sanitize_text_field(trim((string)$data['source_page'])) : '';

    if (empty($name) || mb_strlen($name) < 2) {
        return array(
            'success' => false,
            'message' => esc_html__('Vui lòng nhập họ và tên của bạn (tối thiểu 2 ký tự).', 'lilychen-academy'),
        );
    }

    // Kiểm tra định dạng số điện thoại Việt Nam chuẩn (10 chữ số, đầu 03, 05, 07, 08, 09 hoặc +84)
    $cleaned_phone = preg_replace('/[\s.-]+/', '', $phone);
    if (!preg_match('/^(?:(?:\+?84)|0)(?:3|5|7|8|9)\d{8}$/', $cleaned_phone)) {
        return array(
            'success' => false,
            'message' => esc_html__('Số điện thoại không hợp lệ. Vui lòng nhập số điện thoại Việt Nam 10 chữ số.', 'lilychen-academy'),
        );
    }

    // 5.5. LƯU ĐĂNG KÝ VÀO DATABASE TRƯỚC (Bắt buộc lưu thành công mới báo success)
    $post_title = $name . ' — ' . $cleaned_phone;
    $post_data = array(
        'post_type'    => 'dang_ky_tu_van',
        'post_title'   => $post_title,
        'post_status'  => 'publish',
        'post_content' => $message,
    );

    $post_id = wp_insert_post($post_data, true);
    if (is_wp_error($post_id) || !$post_id) {
        return array(
            'success' => false,
            'message' => esc_html__('Hệ thống đang bảo trì, chưa thể lưu đăng ký. Vui lòng gọi trực tiếp hotline.', 'lilychen-academy'),
        );
    }

    // Cập nhật Post Meta chi tiết
    update_post_meta($post_id, '_lead_name', $name);
    update_post_meta($post_id, '_lead_phone', $cleaned_phone);
    update_post_meta($post_id, '_lead_course', $course);
    update_post_meta($post_id, '_lead_time', $time);
    update_post_meta($post_id, '_lead_message', $message);
    update_post_meta($post_id, '_lead_source', $source);
    update_post_meta($post_id, '_lead_ip', $client_ip);
    update_post_meta($post_id, '_lead_status', 'new');

    // Tăng đếm rate-limit
    set_transient($rate_limit_key, $submission_count + 1, 600); // 10 phút

    // 5.6. GỬI EMAIL THÔNG BÁO TỚI CẢ HAI HỘP THƯ ĐÃ XÁC NHẬN (thlongntl@gmail.com, danh39379@gmail.com)
    $recipients = lilychen_get_lead_recipient_emails();
    if (!is_array($recipients)) {
        $recipients = array_filter(array_map('trim', explode(',', (string)$recipients)));
    }
    $recipients_str = implode(', ', $recipients);
    update_post_meta($post_id, '_mail_recipients', $recipients_str);

    $subject = sprintf('[Lily Chen Academy] Đăng ký tư vấn mới: %s — %s', $name, $cleaned_phone);

    $email_content = '<div style="font-family: Arial, sans-serif; line-height: 1.6; color: #333; max-width: 600px; margin: 0 auto; border: 1px solid #e0e0e0; border-radius: 8px; overflow: hidden;">';
    $email_content .= '<div style="background: #111; color: #fff; padding: 20px; text-align: center;">';
    $email_content .= '<h2 style="margin: 0; font-size: 20px; color: #e5c158;">LILY CHEN ACADEMY</h2>';
    $email_content .= '<p style="margin: 5px 0 0; font-size: 14px; opacity: 0.8;">Thông Báo Đăng Ký Tư Vấn Khóa Học Mới</p>';
    $email_content .= '</div>';
    $email_content .= '<div style="padding: 24px;">';
    $email_content .= '<p>Hệ thống vừa tiếp nhận yêu cầu tư vấn mới từ website:</p>';
    $email_content .= '<table style="width: 100%; border-collapse: collapse; margin: 16px 0;">';
    $email_content .= '<tr><td style="padding: 8px 12px; border-bottom: 1px solid #eee; width: 140px; font-weight: bold;">Họ và tên:</td><td style="padding: 8px 12px; border-bottom: 1px solid #eee; font-size: 16px; color: #000;"><strong>' . esc_html($name) . '</strong></td></tr>';
    $email_content .= '<tr><td style="padding: 8px 12px; border-bottom: 1px solid #eee; font-weight: bold;">Số điện thoại:</td><td style="padding: 8px 12px; border-bottom: 1px solid #eee;"><a href="tel:' . esc_attr($cleaned_phone) . '" style="color: #b38b29; font-weight: bold; font-size: 16px; text-decoration: none;">' . esc_html($cleaned_phone) . '</a></td></tr>';
    $email_content .= '<tr><td style="padding: 8px 12px; border-bottom: 1px solid #eee; font-weight: bold;">Khóa học quan tâm:</td><td style="padding: 8px 12px; border-bottom: 1px solid #eee;">' . esc_html($course) . '</td></tr>';
    $email_content .= '<tr><td style="padding: 8px 12px; border-bottom: 1px solid #eee; font-weight: bold;">Khung giờ tư vấn:</td><td style="padding: 8px 12px; border-bottom: 1px solid #eee;">' . esc_html($time) . '</td></tr>';
    $email_content .= '<tr><td style="padding: 8px 12px; border-bottom: 1px solid #eee; font-weight: bold;">Trang đăng ký:</td><td style="padding: 8px 12px; border-bottom: 1px solid #eee;"><code>' . esc_html($source ?: '/') . '</code></td></tr>';
    $email_content .= '<tr><td style="padding: 8px 12px; border-bottom: 1px solid #eee; font-weight: bold;">Thời gian gửi:</td><td style="padding: 8px 12px; border-bottom: 1px solid #eee;">' . current_time('d/m/Y H:i:s') . '</td></tr>';
    $email_content .= '<tr><td style="padding: 8px 12px; vertical-align: top; font-weight: bold;">Ghi chú thêm:</td><td style="padding: 8px 12px; background: #fafafa; border-radius: 4px;">' . nl2br(esc_html($message ?: '(Không có ghi chú)')) . '</td></tr>';
    $email_content .= '</table>';
    $email_content .= '<p style="margin-top: 24px; text-align: center;"><a href="' . esc_url(admin_url('post.php?post=' . $post_id . '&action=edit')) . '" style="display: inline-block; background: #111; color: #fff; padding: 10px 20px; text-decoration: none; border-radius: 4px; font-weight: bold;">Xem trong WordPress Admin</a></p>';
    $email_content .= '</div>';
    $email_content .= '<div style="background: #f4f4f4; padding: 12px 20px; font-size: 12px; color: #777; text-align: center;">Thông báo tự động từ Website Lily Chen Academy. Vui lòng liên hệ học viên trong vòng 24 giờ.</div>';
    $email_content .= '</div>';

    $headers = array(
        'Content-Type: text/html; charset=UTF-8',
    );

    // Bổ sung bản plain-text AltBody cho PHPMailer để tối ưu điểm spam (multipart/alternative)
    $alt_callback = function($mailer) use ($name, $cleaned_phone, $course, $time, $source, $message) {
        $mailer->AltBody = "THÔNG BÁO ĐĂNG KÝ TƯ VẤN KHÓA HỌC — LILY CHEN ACADEMY\n"
            . "--------------------------------------------------\n"
            . "Họ và tên: " . $name . "\n"
            . "Số điện thoại: " . $cleaned_phone . "\n"
            . "Khóa học quan tâm: " . $course . "\n"
            . "Khung giờ tư vấn: " . $time . "\n"
            . "Nguồn đăng ký: " . ($source ?: '/') . "\n"
            . "Thời gian gửi: " . current_time('d/m/Y H:i:s') . "\n"
            . "Ghi chú: " . ($message ?: '(Không có ghi chú)') . "\n\n"
            . "Thông báo tự động từ Website Lily Chen Academy. Vui lòng liên hệ học viên trong vòng 24 giờ.";
    };
    add_action('phpmailer_init', $alt_callback);

    // Gửi email không chặn luồng thành công nếu SMTP lỗi; vẫn bảo toàn dữ liệu đăng ký
    $GLOBALS['lilychen_last_mail_error'] = '';
    $mail_sent = @wp_mail($recipients, $subject, $email_content, $headers);
    remove_action('phpmailer_init', $alt_callback);

    if ($mail_sent) {
        update_post_meta($post_id, '_mail_status', 'sent');
        delete_post_meta($post_id, '_mail_error');
    } else {
        update_post_meta($post_id, '_mail_status', 'failed');
        $error_detail = !empty($GLOBALS['lilychen_last_mail_error']) 
            ? $GLOBALS['lilychen_last_mail_error'] 
            : 'wp_mail returned false (check SMTP configuration or Do Not Send setting)';
        update_post_meta($post_id, '_mail_error', sanitize_text_field($error_detail));
    }

    // 5.7. TRẢ VỀ KẾT QUẢ THÀNH CÔNG VÌ DỮ LIỆU ĐÃ LƯU AN TOÀN TRONG DATABASE
    return array(
        'success' => true,
        'message' => sprintf(
            esc_html__('Cảm ơn %s! Lily Chen Academy đã nhận được yêu cầu tư vấn khóa học và sẽ liên hệ qua số %s trong 24 giờ tới.', 'lilychen-academy'),
            esc_html($name),
            esc_html($cleaned_phone)
        ),
    );
}

/**
 * 6. Đăng ký REST API Route: POST /wp-json/lilychen/v1/lead
 */
function lilychen_register_lead_rest_routes() {
    register_rest_route('lilychen/v1', '/lead', array(
        'methods'             => 'POST',
        'callback'            => 'lilychen_rest_lead_handler',
        'permission_callback' => '__return_true', // Công khai cho khách truy cập gửi form
    ));
}
add_action('rest_api_init', 'lilychen_register_lead_rest_routes');

function lilychen_rest_lead_handler(WP_REST_Request $request) {
    $params = $request->get_json_params();
    if (empty($params)) {
        $params = $request->get_params();
    }

    $result = lilychen_process_lead_submission($params);
    $status_code = $result['success'] ? 200 : 400;

    return new WP_REST_Response($result, $status_code);
}

/**
 * 7. Đăng ký AJAX Fallback: Cho cả khách vãng lai và user đăng nhập
 */
function lilychen_ajax_lead_handler() {
    $data   = $_POST;
    $result = lilychen_process_lead_submission($data);

    if ($result['success']) {
        wp_send_json_success($result);
    } else {
        wp_send_json_error($result, 400);
    }
}
add_action('wp_ajax_nopriv_lilychen_lead', 'lilychen_ajax_lead_handler');
add_action('wp_ajax_lilychen_lead', 'lilychen_ajax_lead_handler');
