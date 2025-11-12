/**
 * Kashis Studio Theme JavaScript
 * プロフェッショナルなレンタルスタジオサイト向けのインタラクティブ機能
 */

(function() {
  'use strict';

  // ==========================================================================
  // ヘッダースクロール効果
  // ==========================================================================

  function initHeaderScroll() {
    const header = document.querySelector('.site-header');
    if (!header) return;

    let lastScrollTop = 0;
    const scrollThreshold = 100;

    window.addEventListener('scroll', function() {
      const scrollTop = window.pageYOffset || document.documentElement.scrollTop;

      // スクロールしたらヘッダーにクラスを追加
      if (scrollTop > scrollThreshold) {
        header.classList.add('scrolled');
      } else {
        header.classList.remove('scrolled');
      }

      lastScrollTop = scrollTop <= 0 ? 0 : scrollTop;
    }, false);
  }

  // ==========================================================================
  // モバイルメニュートグル
  // ==========================================================================

  function initMobileMenu() {
    const menuToggle = document.querySelector('.mobile-menu-toggle');
    const navMenu = document.querySelector('.nav-menu');

    if (!menuToggle || !navMenu) return;

    menuToggle.addEventListener('click', function() {
      navMenu.classList.toggle('active');
      menuToggle.setAttribute('aria-expanded',
        navMenu.classList.contains('active') ? 'true' : 'false'
      );
    });

    // メニューリンクをクリックしたら閉じる
    const menuLinks = navMenu.querySelectorAll('a');
    menuLinks.forEach(link => {
      link.addEventListener('click', function() {
        navMenu.classList.remove('active');
        menuToggle.setAttribute('aria-expanded', 'false');
      });
    });

    // メニュー外をクリックしたら閉じる
    document.addEventListener('click', function(event) {
      if (!event.target.closest('.main-navigation')) {
        navMenu.classList.remove('active');
        menuToggle.setAttribute('aria-expanded', 'false');
      }
    });
  }

  // ==========================================================================
  // FAQ アコーディオン
  // ==========================================================================

  function initFAQ() {
    const faqItems = document.querySelectorAll('.faq-item');

    faqItems.forEach(item => {
      const question = item.querySelector('.faq-question');
      if (!question) return;

      question.addEventListener('click', function() {
        // 他のアイテムを閉じる
        faqItems.forEach(otherItem => {
          if (otherItem !== item && otherItem.classList.contains('active')) {
            otherItem.classList.remove('active');
          }
        });

        // 現在のアイテムをトグル
        item.classList.toggle('active');
      });
    });
  }

  // ==========================================================================
  // スムーススクロール
  // ==========================================================================

  function initSmoothScroll() {
    const links = document.querySelectorAll('a[href^="#"]');

    links.forEach(link => {
      link.addEventListener('click', function(e) {
        const href = this.getAttribute('href');
        if (href === '#' || href === '#!') return;

        const target = document.querySelector(href);
        if (!target) return;

        e.preventDefault();

        const headerHeight = document.querySelector('.site-header')?.offsetHeight || 0;
        const targetPosition = target.offsetTop - headerHeight - 20;

        window.scrollTo({
          top: targetPosition,
          behavior: 'smooth'
        });

        // URLを更新（ヒストリーに追加）
        if (history.pushState) {
          history.pushState(null, null, href);
        }
      });
    });
  }

  // ==========================================================================
  // スクロールアニメーション（Intersection Observer）
  // ==========================================================================

  function initScrollAnimations() {
    const observerOptions = {
      root: null,
      rootMargin: '0px',
      threshold: 0.1
    };

    const observer = new IntersectionObserver(function(entries) {
      entries.forEach(entry => {
        if (entry.isIntersecting) {
          entry.target.classList.add('fade-in');
          observer.unobserve(entry.target);
        }
      });
    }, observerOptions);

    // アニメーションさせたい要素を監視
    const animateElements = document.querySelectorAll('.card, .feature-item, .news-item, .timeline-item');
    animateElements.forEach(el => {
      observer.observe(el);
    });
  }

  // ==========================================================================
  // ギャラリーライトボックス（簡易版）
  // ==========================================================================

  function initGalleryLightbox() {
    const galleryItems = document.querySelectorAll('.gallery-item');

    galleryItems.forEach(item => {
      item.addEventListener('click', function() {
        const image = this.querySelector('.gallery-image');
        if (!image) return;

        // ライトボックスを作成
        const lightbox = document.createElement('div');
        lightbox.className = 'lightbox';
        lightbox.innerHTML = `
          <div class="lightbox-overlay"></div>
          <div class="lightbox-content">
            <button class="lightbox-close" aria-label="閉じる">&times;</button>
            <img src="${image.src}" alt="${image.alt || ''}">
            ${image.alt ? `<p class="lightbox-caption">${image.alt}</p>` : ''}
          </div>
        `;

        document.body.appendChild(lightbox);
        document.body.style.overflow = 'hidden';

        // 閉じるボタン・オーバーレイのクリックで閉じる
        const closeBtn = lightbox.querySelector('.lightbox-close');
        const overlay = lightbox.querySelector('.lightbox-overlay');

        [closeBtn, overlay].forEach(el => {
          el.addEventListener('click', function() {
            closeLightbox(lightbox);
          });
        });

        // Escキーで閉じる
        document.addEventListener('keydown', function onEscape(e) {
          if (e.key === 'Escape') {
            closeLightbox(lightbox);
            document.removeEventListener('keydown', onEscape);
          }
        });
      });
    });
  }

  function closeLightbox(lightbox) {
    lightbox.classList.add('closing');
    setTimeout(() => {
      lightbox.remove();
      document.body.style.overflow = '';
    }, 300);
  }

  // ==========================================================================
  // フォームバリデーション（簡易版）
  // ==========================================================================

  function initFormValidation() {
    const forms = document.querySelectorAll('form[data-validate]');

    forms.forEach(form => {
      form.addEventListener('submit', function(e) {
        let isValid = true;
        const inputs = form.querySelectorAll('[required]');

        inputs.forEach(input => {
          const formGroup = input.closest('.form-group');
          const errorMsg = formGroup?.querySelector('.form-error');

          // 既存のエラーメッセージを削除
          if (errorMsg) {
            errorMsg.remove();
          }

          // バリデーション
          if (!input.value.trim()) {
            isValid = false;
            showError(input, 'この項目は必須です');
          } else if (input.type === 'email' && !isValidEmail(input.value)) {
            isValid = false;
            showError(input, '正しいメールアドレスを入力してください');
          }
        });

        if (!isValid) {
          e.preventDefault();
        }
      });
    });
  }

  function showError(input, message) {
    const formGroup = input.closest('.form-group');
    if (!formGroup) return;

    const error = document.createElement('p');
    error.className = 'form-error';
    error.style.cssText = 'color: var(--atlassian-red-500); font-size: 0.875rem; margin-top: 0.5rem;';
    error.textContent = message;

    formGroup.appendChild(error);
    input.focus();
  }

  function isValidEmail(email) {
    return /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email);
  }

  // ==========================================================================
  // カウンターアニメーション
  // ==========================================================================

  function initCounters() {
    const counters = document.querySelectorAll('[data-counter]');

    const observerOptions = {
      root: null,
      rootMargin: '0px',
      threshold: 0.5
    };

    const observer = new IntersectionObserver(function(entries) {
      entries.forEach(entry => {
        if (entry.isIntersecting) {
          animateCounter(entry.target);
          observer.unobserve(entry.target);
        }
      });
    }, observerOptions);

    counters.forEach(counter => observer.observe(counter));
  }

  function animateCounter(element) {
    const target = parseInt(element.getAttribute('data-counter'));
    const duration = 2000; // 2秒
    const steps = 60;
    const stepValue = target / steps;
    let current = 0;

    const timer = setInterval(function() {
      current += stepValue;
      if (current >= target) {
        element.textContent = target.toLocaleString();
        clearInterval(timer);
      } else {
        element.textContent = Math.floor(current).toLocaleString();
      }
    }, duration / steps);
  }

  // ==========================================================================
  // タブ機能
  // ==========================================================================

  function initTabs() {
    const tabGroups = document.querySelectorAll('[data-tabs]');

    tabGroups.forEach(group => {
      const tabs = group.querySelectorAll('[data-tab]');
      const panels = group.querySelectorAll('[data-tab-panel]');

      tabs.forEach(tab => {
        tab.addEventListener('click', function() {
          const targetId = this.getAttribute('data-tab');

          // すべてのタブとパネルを非アクティブに
          tabs.forEach(t => t.classList.remove('active'));
          panels.forEach(p => p.classList.remove('active'));

          // クリックされたタブとパネルをアクティブに
          this.classList.add('active');
          const targetPanel = group.querySelector(`[data-tab-panel="${targetId}"]`);
          if (targetPanel) {
            targetPanel.classList.add('active');
          }
        });
      });
    });
  }

  // ==========================================================================
  // 画像遅延読み込み（Lazy Loading）
  // ==========================================================================

  function initLazyLoading() {
    const images = document.querySelectorAll('img[data-src]');

    if ('IntersectionObserver' in window) {
      const observer = new IntersectionObserver(function(entries) {
        entries.forEach(entry => {
          if (entry.isIntersecting) {
            const img = entry.target;
            img.src = img.getAttribute('data-src');
            img.removeAttribute('data-src');
            observer.unobserve(img);
          }
        });
      });

      images.forEach(img => observer.observe(img));
    } else {
      // フォールバック：Intersection Observerがサポートされていない場合
      images.forEach(img => {
        img.src = img.getAttribute('data-src');
        img.removeAttribute('data-src');
      });
    }
  }

  // ==========================================================================
  // 戻るトップボタン
  // ==========================================================================

  function initBackToTop() {
    // ボタンが既に存在する場合はスキップ
    if (document.querySelector('.back-to-top')) return;

    const button = document.createElement('button');
    button.className = 'back-to-top';
    button.setAttribute('aria-label', 'ページトップへ戻る');
    button.innerHTML = '↑';
    button.style.cssText = `
      position: fixed;
      bottom: 2rem;
      right: 2rem;
      width: 48px;
      height: 48px;
      border-radius: 50%;
      background: var(--atlassian-blue-500);
      color: white;
      border: none;
      font-size: 1.5rem;
      cursor: pointer;
      opacity: 0;
      visibility: hidden;
      transition: all var(--transition-base);
      box-shadow: var(--shadow-lg);
      z-index: 999;
    `;

    document.body.appendChild(button);

    // スクロールで表示/非表示
    window.addEventListener('scroll', function() {
      if (window.pageYOffset > 300) {
        button.style.opacity = '1';
        button.style.visibility = 'visible';
      } else {
        button.style.opacity = '0';
        button.style.visibility = 'hidden';
      }
    });

    // クリックでトップへ
    button.addEventListener('click', function() {
      window.scrollTo({
        top: 0,
        behavior: 'smooth'
      });
    });

    // ホバー効果
    button.addEventListener('mouseenter', function() {
      this.style.transform = 'translateY(-4px)';
    });

    button.addEventListener('mouseleave', function() {
      this.style.transform = 'translateY(0)';
    });
  }

  // ==========================================================================
  // ローディング完了時のアニメーション
  // ==========================================================================

  function initPageLoadAnimation() {
    document.body.classList.add('loaded');

    // ヒーローセクションのアニメーション
    const heroContent = document.querySelector('.hero-content');
    if (heroContent) {
      heroContent.style.opacity = '0';
      heroContent.style.transform = 'translateY(30px)';

      setTimeout(() => {
        heroContent.style.transition = 'all 0.8s ease-out';
        heroContent.style.opacity = '1';
        heroContent.style.transform = 'translateY(0)';
      }, 100);
    }
  }

  // ==========================================================================
  // ユーティリティ関数
  // ==========================================================================

  function debounce(func, wait) {
    let timeout;
    return function executedFunction(...args) {
      const later = () => {
        clearTimeout(timeout);
        func(...args);
      };
      clearTimeout(timeout);
      timeout = setTimeout(later, wait);
    };
  }

  function throttle(func, limit) {
    let inThrottle;
    return function() {
      const args = arguments;
      const context = this;
      if (!inThrottle) {
        func.apply(context, args);
        inThrottle = true;
        setTimeout(() => inThrottle = false, limit);
      }
    };
  }

  // ==========================================================================
  // 初期化
  // ==========================================================================

  // DOM読み込み完了時に実行
  if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', init);
  } else {
    init();
  }

  function init() {
    initHeaderScroll();
    initMobileMenu();
    initFAQ();
    initSmoothScroll();
    initScrollAnimations();
    initGalleryLightbox();
    initFormValidation();
    initCounters();
    initTabs();
    initLazyLoading();
    initBackToTop();
    initPageLoadAnimation();

    console.log('🎨 Kashis Studio Theme Loaded');
  }

  // ==========================================================================
  // ライトボックス用スタイルを動的に追加
  // ==========================================================================

  const lightboxStyles = document.createElement('style');
  lightboxStyles.textContent = `
    .lightbox {
      position: fixed;
      top: 0;
      left: 0;
      right: 0;
      bottom: 0;
      z-index: 9999;
      display: flex;
      align-items: center;
      justify-content: center;
      animation: fadeIn 0.3s ease-out;
    }

    .lightbox.closing {
      animation: fadeOut 0.3s ease-out;
    }

    .lightbox-overlay {
      position: absolute;
      top: 0;
      left: 0;
      right: 0;
      bottom: 0;
      background: rgba(0, 0, 0, 0.9);
      cursor: pointer;
    }

    .lightbox-content {
      position: relative;
      z-index: 1;
      max-width: 90%;
      max-height: 90%;
      text-align: center;
    }

    .lightbox-content img {
      max-width: 100%;
      max-height: 80vh;
      border-radius: 8px;
      box-shadow: 0 20px 60px rgba(0, 0, 0, 0.5);
    }

    .lightbox-caption {
      color: white;
      margin-top: 1rem;
      font-size: 1.125rem;
    }

    .lightbox-close {
      position: absolute;
      top: -40px;
      right: 0;
      background: transparent;
      border: none;
      color: white;
      font-size: 3rem;
      cursor: pointer;
      line-height: 1;
      transition: transform 0.2s;
    }

    .lightbox-close:hover {
      transform: scale(1.1);
    }

    @keyframes fadeIn {
      from { opacity: 0; }
      to { opacity: 1; }
    }

    @keyframes fadeOut {
      from { opacity: 1; }
      to { opacity: 0; }
    }
  `;
  document.head.appendChild(lightboxStyles);

})();
