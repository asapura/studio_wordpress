/**
 * Kashis Studio Theme JavaScript
 * プロフェッショナルなレンタルスタジオサイト向けのインタラクティブ機能
 */

(function() {
  'use strict';

  // ==========================================================================
  // 設定定数
  // ==========================================================================

  const CONFIG = {
    // スクロール関連
    SCROLL_THRESHOLD: 100,              // ヘッダー表示のしきい値
    SCROLL_OFFSET: 20,                  // スムーススクロールのオフセット
    BACK_TO_TOP_THRESHOLD: 300,         // 「トップへ戻る」ボタン表示しきい値

    // アニメーション関連
    COUNTER_DURATION: 2000,             // カウンターアニメーション時間（ミリ秒）
    COUNTER_STEPS: 60,                  // カウンターアニメーションステップ数
    LIGHTBOX_CLOSE_DURATION: 300,       // ライトボックス閉じる時間（ミリ秒）
    PAGE_LOAD_DELAY: 100,               // ページロードアニメーション遅延（ミリ秒）
    PAGE_LOAD_DURATION: 0.8,            // ページロードアニメーション時間（秒）
    HERO_TRANSLATE_Y: 30,               // ヒーローセクションの初期移動量（px）
    BUTTON_HOVER_TRANSLATE: -4,         // ボタンホバー時の移動量（px）
    BUTTON_HOVER_SCALE: 1.1,            // ボタンホバー時のスケール

    // Intersection Observer関連
    OBSERVER_THRESHOLD_LOW: 0.1,        // スクロールアニメーション用しきい値
    OBSERVER_THRESHOLD_MID: 0.5,        // カウンター用しきい値

    // エラーメッセージスタイル
    ERROR_FONT_SIZE: '0.875rem',        // エラーメッセージのフォントサイズ
    ERROR_MARGIN_TOP: '0.5rem',         // エラーメッセージの上マージン

    // 「トップへ戻る」ボタン
    BACK_TO_TOP_SIZE: 48,               // ボタンサイズ（px）
    BACK_TO_TOP_BOTTOM: '2rem',         // 下からの距離
    BACK_TO_TOP_RIGHT: '2rem',          // 右からの距離
    BACK_TO_TOP_FONT_SIZE: '1.5rem',    // フォントサイズ
    BACK_TO_TOP_Z_INDEX: 999,           // z-index
  };

  // ==========================================================================
  // ヘッダースクロール効果
  // ==========================================================================

  function initHeaderScroll() {
    const header = document.querySelector('.site-header');
    if (!header) return;

    let lastScrollTop = 0;

    window.addEventListener('scroll', function() {
      const scrollTop = window.pageYOffset || document.documentElement.scrollTop;

      // スクロールしたらヘッダーにクラスを追加
      if (scrollTop > CONFIG.SCROLL_THRESHOLD) {
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
        if (!target) {
          console.warn(`[Kashis Studio] Target element not found: ${href}`);
          return;
        }

        e.preventDefault();

        const headerHeight = document.querySelector('.site-header')?.offsetHeight || 0;
        const targetPosition = target.offsetTop - headerHeight - CONFIG.SCROLL_OFFSET;

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
      threshold: CONFIG.OBSERVER_THRESHOLD_LOW
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
        if (!image) {
          console.warn('[Kashis Studio] Gallery image not found in clicked item');
          return;
        }

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
    }, CONFIG.LIGHTBOX_CLOSE_DURATION);
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
    if (!formGroup) {
      console.warn('[Kashis Studio] Form group not found for input:', input);
      return;
    }

    const error = document.createElement('p');
    error.className = 'form-error';
    error.style.cssText = `color: var(--atlassian-red-500); font-size: ${CONFIG.ERROR_FONT_SIZE}; margin-top: ${CONFIG.ERROR_MARGIN_TOP};`;
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
      threshold: CONFIG.OBSERVER_THRESHOLD_MID
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

    if (isNaN(target)) {
      console.warn('[Kashis Studio] Invalid counter value:', element.getAttribute('data-counter'));
      return;
    }

    const stepValue = target / CONFIG.COUNTER_STEPS;
    let current = 0;

    const timer = setInterval(function() {
      current += stepValue;
      if (current >= target) {
        element.textContent = target.toLocaleString();
        clearInterval(timer);
      } else {
        element.textContent = Math.floor(current).toLocaleString();
      }
    }, CONFIG.COUNTER_DURATION / CONFIG.COUNTER_STEPS);
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
      bottom: ${CONFIG.BACK_TO_TOP_BOTTOM};
      right: ${CONFIG.BACK_TO_TOP_RIGHT};
      width: ${CONFIG.BACK_TO_TOP_SIZE}px;
      height: ${CONFIG.BACK_TO_TOP_SIZE}px;
      border-radius: 50%;
      background: var(--atlassian-blue-500);
      color: white;
      border: none;
      font-size: ${CONFIG.BACK_TO_TOP_FONT_SIZE};
      cursor: pointer;
      opacity: 0;
      visibility: hidden;
      transition: all var(--transition-base);
      box-shadow: var(--shadow-lg);
      z-index: ${CONFIG.BACK_TO_TOP_Z_INDEX};
    `;

    document.body.appendChild(button);

    // スクロールで表示/非表示
    window.addEventListener('scroll', function() {
      if (window.pageYOffset > CONFIG.BACK_TO_TOP_THRESHOLD) {
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
      this.style.transform = `translateY(${CONFIG.BUTTON_HOVER_TRANSLATE}px)`;
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
      heroContent.style.transform = `translateY(${CONFIG.HERO_TRANSLATE_Y}px)`;

      setTimeout(() => {
        heroContent.style.transition = `all ${CONFIG.PAGE_LOAD_DURATION}s ease-out`;
        heroContent.style.opacity = '1';
        heroContent.style.transform = 'translateY(0)';
      }, CONFIG.PAGE_LOAD_DELAY);
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

})();
