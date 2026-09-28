/**
 * Vercel Serverless Function: Lead Consultation Handler
 * Endpoint: /api/contact
 * Method: POST
 * Destination: thlongntl@gmail.com
 *
 * Supported delivery methods:
 * 1. Resend API (recommended on Vercel via RESEND_API_KEY)
 * 2. Fallback/Dev Mode (logs to console and returns 200 when running locally without secrets)
 */

function escapeHtml(str) {
  if (!str) return '';
  return String(str)
    .replace(/&/g, '&amp;')
    .replace(/</g, '&lt;')
    .replace(/>/g, '&gt;')
    .replace(/"/g, '&quot;')
    .replace(/'/g, '&#039;');
}

export default async function handler(req, res) {
  // CORS & Method Check
  res.setHeader('Access-Control-Allow-Credentials', 'true');
  res.setHeader('Access-Control-Allow-Origin', '*');
  res.setHeader('Access-Control-Allow-Methods', 'POST,OPTIONS');
  res.setHeader('Access-Control-Allow-Headers', 'Content-Type, X-Requested-With');

  if (req.method === 'OPTIONS') {
    return res.status(200).end();
  }

  if (req.method !== 'POST') {
    return res.status(405).json({
      success: false,
      error: 'Chỉ chấp nhận phương thức POST (Method Not Allowed).'
    });
  }

  try {
    const body = req.body || {};
    const {
      name,
      phone,
      course,
      time,
      message,
      source_page,
      _hp_company,    // Honeypot field
      _form_load_time // Client timestamp on form mount
    } = body;

    // 1. Anti-spam: Honeypot check (Bots fill invisible fields)
    if (_hp_company && String(_hp_company).trim() !== '') {
      console.warn('[Anti-Spam] Honeypot field filled. Bot submission silently discarded.');
      return res.status(200).json({
        success: true,
        message: 'Yêu cầu tư vấn đã được tiếp nhận.'
      });
    }

    // 2. Anti-spam: Minimum form completion time (< 2.0s is considered automated)
    if (_form_load_time) {
      const elapsedMs = Date.now() - Number(_form_load_time);
      if (elapsedMs < 2000) {
        console.warn(`[Anti-Spam] Submission too fast (${elapsedMs}ms). Silently discarded.`);
        return res.status(200).json({
          success: true,
          message: 'Yêu cầu tư vấn đã được tiếp nhận.'
        });
      }
    }

    // 3. Validation: Name & Vietnamese Phone Number
    const trimmedName = String(name || '').trim();
    const cleanPhone = String(phone || '').trim().replace(/[\s.-]+/g, '');
    const phoneRegex = /^(?:\+?84|0)(?:3|5|7|8|9)\d{8}$/;

    if (!trimmedName || trimmedName.length < 2) {
      return res.status(400).json({
        success: false,
        error: 'Vui lòng nhập họ và tên hợp lệ (tối thiểu 2 ký tự).'
      });
    }

    if (!cleanPhone || !phoneRegex.test(cleanPhone)) {
      return res.status(400).json({
        success: false,
        error: 'Số điện thoại không đúng định dạng. Vui lòng nhập số điện thoại Việt Nam (10 số, ví dụ 0889979791).'
      });
    }

    // 4. Data formatting
    const safeName = escapeHtml(trimmedName);
    const safePhone = escapeHtml(cleanPhone);
    const safeCourse = escapeHtml(course || 'Chưa chọn khóa học cụ thể (Cần tư vấn)');
    const safeTime = escapeHtml(time || 'Linh hoạt / Bất kỳ lúc nào');
    const safeMessage = escapeHtml(message || 'Không có ghi chú thêm');
    const safeSource = escapeHtml(source_page || req.headers.referer || 'Trang chủ Lily Chen Makeup Academy');

    const submittedAt = new Date().toLocaleString('vi-VN', {
      timeZone: 'Asia/Ho_Chi_Minh',
      dateStyle: 'full',
      timeStyle: 'medium'
    });

    const clientIp = req.headers['x-forwarded-for'] || req.socket?.remoteAddress || 'Không xác định';
    const targetEmail = process.env.TARGET_EMAIL || 'thlongntl@gmail.com';
    const resendApiKey = process.env.RESEND_API_KEY;
    const resendFrom = process.env.RESEND_FROM || 'Lily Chen Academy <onboarding@resend.dev>';

    // 5. Construct Email HTML
    const emailHtml = `
<!DOCTYPE html>
<html lang="vi">
<head>
  <meta charset="utf-8">
  <title>Đăng Ký Tư Vấn Mới - Lily Chen Makeup Academy</title>
</head>
<body style="font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Helvetica, Arial, sans-serif; background-color: #faf8f6; color: #1a1615; margin: 0; padding: 24px;">
  <table width="100%" cellpadding="0" cellspacing="0" style="max-width: 620px; margin: 0 auto; background-color: #ffffff; border-radius: 12px; overflow: hidden; border: 1px solid #ede8e3; box-shadow: 0 4px 20px rgba(0,0,0,0.05);">
    <!-- Header -->
    <tr>
      <td style="background: linear-gradient(135deg, #d4537a 0%, #b93b62 100%); padding: 28px 32px; color: #ffffff; text-align: center;">
        <h1 style="margin: 0; font-size: 22px; font-weight: 700; letter-spacing: 1px;">LILY CHEN MAKEUP ACADEMY</h1>
        <p style="margin: 6px 0 0; font-size: 14px; opacity: 0.9;">THÔNG BÁO ĐĂNG KÝ TƯ VẤN KHÓA HỌC MỚI</p>
      </td>
    </tr>

    <!-- Body -->
    <tr>
      <td style="padding: 32px;">
        <p style="font-size: 15px; line-height: 1.6; margin-top: 0; margin-bottom: 24px;">
          Xin chào <strong>Lily Chen Academy</strong>, hệ thống vừa ghi nhận một yêu cầu tư vấn mới từ khách hàng qua website. Dưới đây là thông tin chi tiết:
        </p>

        <!-- Information Table -->
        <table width="100%" cellpadding="12" cellspacing="0" style="border-collapse: collapse; margin-bottom: 24px; font-size: 14px;">
          <tr style="background-color: #fbf9f7; border-bottom: 1px solid #ede8e3;">
            <td width="36%" style="font-weight: 600; color: #5c5552;">Họ và tên khách hàng:</td>
            <td style="font-size: 16px; font-weight: 700; color: #1a1615;">${safeName}</td>
          </tr>
          <tr style="border-bottom: 1px solid #ede8e3;">
            <td style="font-weight: 600; color: #5c5552;">Số điện thoại:</td>
            <td>
              <a href="tel:${safePhone}" style="color: #d4537a; font-weight: 700; text-decoration: none; font-size: 16px;">
                ${safePhone}
              </a>
              <span style="display: inline-block; margin-left: 8px; font-size: 12px; background: #e8f5e9; color: #2e7d32; padding: 2px 8px; border-radius: 99px;">Nhấn để gọi</span>
            </td>
          </tr>
          <tr style="background-color: #fbf9f7; border-bottom: 1px solid #ede8e3;">
            <td style="font-weight: 600; color: #5c5552;">Khóa học quan tâm:</td>
            <td style="font-weight: 600; color: #b93b62;">${safeCourse}</td>
          </tr>
          <tr style="border-bottom: 1px solid #ede8e3;">
            <td style="font-weight: 600; color: #5c5552;">Thời gian tiện liên hệ:</td>
            <td>${safeTime}</td>
          </tr>
          <tr style="background-color: #fbf9f7; border-bottom: 1px solid #ede8e3;">
            <td style="font-weight: 600; color: #5c5552;">Nguồn / Trang đăng ký:</td>
            <td style="color: #6366f1;">${safeSource}</td>
          </tr>
          <tr style="border-bottom: 1px solid #ede8e3;">
            <td style="font-weight: 600; color: #5c5552; vertical-align: top;">Ghi chú / Mục tiêu học:</td>
            <td style="line-height: 1.5;">${safeMessage}</td>
          </tr>
          <tr style="background-color: #fbf9f7;">
            <td style="font-weight: 600; color: #5c5552;">Thời gian gửi:</td>
            <td style="color: #7d808c; font-size: 13px;">${submittedAt}</td>
          </tr>
        </table>

        <!-- Quick Action Box -->
        <div style="background-color: #fcf1f4; border: 1px solid #f5c6d3; border-radius: 8px; padding: 18px; text-align: center; margin-bottom: 24px;">
          <p style="margin: 0 0 12px; font-size: 14px; color: #882b47; font-weight: 600;">
            Liên hệ lại với học viên ngay để chốt lịch tư vấn:
          </p>
          <a href="tel:${safePhone}" style="display: inline-block; background-color: #d4537a; color: #ffffff; text-decoration: none; padding: 10px 22px; border-radius: 6px; font-weight: 600; font-size: 14px; margin-right: 8px;">
            📞 Gọi ${safePhone}
          </a>
          <a href="https://zalo.me/${safePhone}" target="_blank" style="display: inline-block; background-color: #0068ff; color: #ffffff; text-decoration: none; padding: 10px 22px; border-radius: 6px; font-weight: 600; font-size: 14px;">
            💬 Mở Zalo
          </a>
        </div>

        <p style="font-size: 12px; color: #9ca3af; margin: 0; line-height: 1.5;">
          IP người gửi: ${clientIp}<br>
          Email này được gửi tự động từ hệ thống website Lily Chen Makeup Academy.
        </p>
      </td>
    </tr>
  </table>
</body>
</html>
    `;

    // 6. Send Email using Resend if key exists
    if (resendApiKey) {
      const resendResponse = await fetch('https://api.resend.com/emails', {
        method: 'POST',
        headers: {
          'Authorization': `Bearer ${resendApiKey}`,
          'Content-Type': 'application/json'
        },
        body: JSON.stringify({
          from: resendFrom,
          to: [targetEmail],
          reply_to: 'thlongntl@gmail.com',
          subject: `[Lily Chen Academy] Khách đăng ký tư vấn mới: ${trimmedName} - ${course || 'Tư vấn chung'}`,
          html: emailHtml
        })
      });

      const resendData = await resendResponse.json();

      if (!resendResponse.ok) {
        console.error('[Resend Error]', resendData);
        return res.status(500).json({
          success: false,
          error: 'Dịch vụ gửi email gặp sự cố tạm thời. Vui lòng liên hệ trực tiếp hotline 088 997 97 91.'
        });
      }

      return res.status(200).json({
        success: true,
        message: 'Yêu cầu tư vấn của bạn đã được gửi thành công đến Lily Chen Academy!',
        id: resendData.id
      });
    }

    // 7. Dev / Simulation Mode (When RESEND_API_KEY is not configured yet)
    console.log('----------------------------------------------------');
    console.log('[Lily Chen Academy - Lead Received (Simulation Mode)]');
    console.log(`To: ${targetEmail}`);
    console.log(`Họ tên: ${trimmedName}`);
    console.log(`SĐT: ${cleanPhone}`);
    console.log(`Khóa học: ${course || 'Tư vấn chung'}`);
    console.log(`Khung giờ: ${time || 'Linh hoạt'}`);
    console.log(`Trang: ${source_page}`);
    console.log(`Thời gian: ${submittedAt}`);
    console.log('Ghi chú: Để gửi email thực tế đến thlongntl@gmail.com, cấu hình RESEND_API_KEY trong Vercel Environment Variables.');
    console.log('----------------------------------------------------');

    return res.status(200).json({
      success: true,
      simulated: true,
      message: 'Yêu cầu tư vấn đã được tiếp nhận thành công!'
    });

  } catch (error) {
    console.error('[Contact API Error]', error);
    return res.status(500).json({
      success: false,
      error: 'Đã xảy ra lỗi trong quá trình xử lý yêu cầu. Vui lòng thử lại hoặc gọi hotline 088 997 97 91.'
    });
  }
}
