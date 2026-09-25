/**
 * Lily Chen Makeup Academy - Main Interactive Script
 * Lightweight Vanilla JS for fast Core Web Vitals (Zero dependencies)
 */

document.addEventListener('DOMContentLoaded', () => {
  // 1. Sticky Header scroll effect
  const header = document.querySelector('.site-header');
  const handleScroll = () => {
    if (window.scrollY > 30) {
      header?.classList.add('scrolled');
    } else {
      header?.classList.remove('scrolled');
    }
  };
  window.addEventListener('scroll', handleScroll, { passive: true });
  handleScroll();

  // 2. Mobile Navigation Toggle
  const mobileToggle = document.getElementById('mobileToggle');
  const mobileDrawer = document.getElementById('mobileDrawer');

  if (mobileToggle && mobileDrawer) {
    const closeDrawer = () => {
      mobileDrawer.classList.remove('open');
      mobileToggle.classList.remove('active');
      mobileToggle.setAttribute('aria-expanded', 'false');
      document.body.style.overflow = '';
    };

    const openDrawer = () => {
      mobileDrawer.classList.add('open');
      mobileToggle.classList.add('active');
      mobileToggle.setAttribute('aria-expanded', 'true');
      document.body.style.overflow = 'hidden';
    };

    const toggleMenu = () => {
      const isOpen = mobileDrawer.classList.contains('open');
      if (isOpen) {
        closeDrawer();
      } else {
        openDrawer();
      }
    };

    mobileToggle.addEventListener('click', toggleMenu);

    // Close drawer when clicking any link inside drawer
    mobileDrawer.querySelectorAll('a').forEach(link => {
      link.addEventListener('click', closeDrawer);
    });

    // Close when clicking outside
    document.addEventListener('click', (e) => {
      if (
        mobileDrawer.classList.contains('open') &&
        !mobileDrawer.contains(e.target) &&
        !mobileToggle.contains(e.target)
      ) {
        closeDrawer();
      }
    });

    // Close on Escape key press (Accessibility requirement)
    document.addEventListener('keydown', (e) => {
      if (e.key === 'Escape' && mobileDrawer.classList.contains('open')) {
        closeDrawer();
        mobileToggle.focus();
      }
    });
  }

  // 3. Smooth Anchor Scrolling with header offset
  document.querySelectorAll('a[href^="#"]').forEach(anchor => {
    anchor.addEventListener('click', function(e) {
      const href = this.getAttribute('href');
      if (href && href !== '#' && href.startsWith('#')) {
        const target = document.querySelector(href);
        if (target) {
          e.preventDefault();
          const headerOffset = 80;
          const elementPosition = target.getBoundingClientRect().top;
          const offsetPosition = elementPosition + window.pageYOffset - headerOffset;

          window.scrollTo({
            top: offsetPosition,
            behavior: 'smooth'
          });
        }
      }
    });
  });

  // Handle cross-page anchor offset when arriving with a hash (e.g. index.html#khoa-hoc)
  if (window.location.hash) {
    const hashTarget = document.querySelector(window.location.hash);
    if (hashTarget) {
      setTimeout(() => {
        const headerOffset = 80;
        const elementPosition = hashTarget.getBoundingClientRect().top;
        const offsetPosition = elementPosition + window.pageYOffset - headerOffset;
        window.scrollTo({
          top: offsetPosition,
          behavior: 'smooth'
        });
      }, 150);
    }
  }

  // 4. Interactive Category Filter Tabs (Gallery & Blog)
  const filterContainers = document.querySelectorAll('.gallery-filters');
  filterContainers.forEach(container => {
    const buttons = container.querySelectorAll('.gallery-filter-btn');
    buttons.forEach(btn => {
      btn.addEventListener('click', () => {
        const filter = btn.getAttribute('data-filter');
        if (!filter) return;

        buttons.forEach(b => b.classList.remove('active'));
        btn.classList.add('active');

        // Target either gallery-item or blog-card based on page content
        const targetItems = document.querySelectorAll('.gallery-item, .blog-card');
        targetItems.forEach(item => {
          const category = item.getAttribute('data-category');
          if (!category) return;
          if (filter === 'all' || category === filter) {
            item.style.display = '';
            setTimeout(() => {
              item.style.opacity = '1';
              item.style.transform = 'scale(1)';
            }, 10);
          } else {
            item.style.opacity = '0';
            item.style.transform = 'scale(0.95)';
            setTimeout(() => {
              item.style.display = 'none';
            }, 250);
          }
        });
      });
    });
  });

  // 5. Section 10: FAQ Accordion Toggle Logic
  const faqItems = document.querySelectorAll('.faq-item');
  faqItems.forEach(item => {
    const questionBtn = item.querySelector('.faq-question');
    const answer = item.querySelector('.faq-answer');

    if (questionBtn && answer) {
      questionBtn.addEventListener('click', () => {
        const isActive = item.classList.contains('active');

        // Close all other items
        faqItems.forEach(otherItem => {
          if (otherItem !== item && otherItem.classList.contains('active')) {
            otherItem.classList.remove('active');
            const otherBtn = otherItem.querySelector('.faq-question');
            const otherAns = otherItem.querySelector('.faq-answer');
            if (otherBtn) otherBtn.setAttribute('aria-expanded', 'false');
            if (otherAns) otherAns.style.maxHeight = null;
          }
        });

        // Toggle current item
        if (isActive) {
          item.classList.remove('active');
          questionBtn.setAttribute('aria-expanded', 'false');
          answer.style.maxHeight = null;
        } else {
          item.classList.add('active');
          questionBtn.setAttribute('aria-expanded', 'true');
          answer.style.maxHeight = answer.scrollHeight + 30 + 'px';
        }
      });
    }
  });

  // 6. Section 11: Lead Form Submission Feedback
  const leadForm = document.getElementById('leadForm');
  const formSuccessMsg = document.getElementById('formSuccessMsg');
  const successUserName = document.getElementById('successUserName');
  const successUserPhone = document.getElementById('successUserPhone');

  if (leadForm && formSuccessMsg) {
    leadForm.addEventListener('submit', (e) => {
      e.preventDefault();

      const nameInput = document.getElementById('leadName');
      const phoneInput = document.getElementById('leadPhone');
      const courseSelect = document.getElementById('leadCourse');

      const nameVal = nameInput ? nameInput.value.trim() : '';
      const phoneVal = phoneInput ? phoneInput.value.trim() : '';

      // Validation
      if (!nameVal) {
        alert('Vui lòng nhập Họ và tên của bạn.');
        nameInput?.focus();
        return;
      }

      // Vietnamese phone regex (10 digits starting with 0)
      const phoneRegex = /^(0|\+84)[3|5|7|8|9][0-9]{8}$/;
      const cleanedPhone = phoneVal.replace(/[\s.-]/g, '');
      if (!cleanedPhone || !phoneRegex.test(cleanedPhone)) {
        alert('Vui lòng nhập số điện thoại hợp lệ (10 số, ví dụ: 0987654321) để Lily Chen có thể liên hệ.');
        phoneInput?.focus();
        return;
      }

      // Show success feedback
      if (successUserName) successUserName.textContent = nameVal;
      if (successUserPhone) successUserPhone.textContent = phoneVal;

      formSuccessMsg.style.display = 'block';
      leadForm.reset();

      // Scroll smoothly to success box
      formSuccessMsg.scrollIntoView({ behavior: 'smooth', block: 'nearest' });
    });
  }
});
