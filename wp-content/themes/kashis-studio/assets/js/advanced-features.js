/**
 * Kashis Studio Advanced Features
 * Favorites System and Room Comparison
 *
 * @since 1.0.8
 */

(function() {
  'use strict';

  // ==========================================================================
  // お気に入り（Favorites）システム
  // ==========================================================================

  const Favorites = {
    STORAGE_KEY: 'kashis_studio_favorites',

    /**
     * Initialize favorites system
     */
    init() {
      this.renderFavoriteButtons();
      this.setupEventListeners();
      this.updateFavoriteCount();
    },

    /**
     * Get all favorites from localStorage
     */
    getFavorites() {
      const stored = localStorage.getItem(this.STORAGE_KEY);
      return stored ? JSON.parse(stored) : [];
    },

    /**
     * Save favorites to localStorage
     */
    saveFavorites(favorites) {
      localStorage.setItem(this.STORAGE_KEY, JSON.stringify(favorites));
      this.updateFavoriteCount();
    },

    /**
     * Check if room is favorited
     */
    isFavorited(roomId) {
      return this.getFavorites().includes(roomId);
    },

    /**
     * Toggle favorite status
     */
    toggle(roomId) {
      const favorites = this.getFavorites();
      const index = favorites.indexOf(roomId);

      if (index > -1) {
        favorites.splice(index, 1);
      } else {
        favorites.push(roomId);
      }

      this.saveFavorites(favorites);
      return index === -1; // Return true if added
    },

    /**
     * Render favorite buttons on room cards
     */
    renderFavoriteButtons() {
      const roomCards = document.querySelectorAll('[data-room-id]');

      roomCards.forEach(card => {
        const roomId = card.getAttribute('data-room-id');
        if (!roomId) return;

        const isFavorited = this.isFavorited(roomId);

        const button = document.createElement('button');
        button.className = 'kashis-favorite-btn' + (isFavorited ? ' favorited' : '');
        button.setAttribute('data-room-id', roomId);
        button.setAttribute('aria-label', isFavorited ? 'お気に入りから削除' : 'お気に入りに追加');
        button.innerHTML = isFavorited ? '❤️' : '🤍';

        card.style.position = 'relative';
        card.appendChild(button);
      });

      // Add styles
      if (!document.getElementById('favorites-styles')) {
        const style = document.createElement('style');
        style.id = 'favorites-styles';
        style.textContent = `
          .kashis-favorite-btn {
            position: absolute;
            top: 1rem;
            right: 1rem;
            width: 40px;
            height: 40px;
            background: rgba(255, 255, 255, 0.9);
            border: none;
            border-radius: 50%;
            font-size: 1.25rem;
            cursor: pointer;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.15);
            transition: transform 150ms ease, box-shadow 150ms ease;
            z-index: 10;
          }

          .kashis-favorite-btn:hover {
            transform: scale(1.1);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2);
          }

          .kashis-favorite-btn.favorited {
            animation: heartBeat 0.3s ease;
          }

          @keyframes heartBeat {
            0%, 100% { transform: scale(1); }
            50% { transform: scale(1.2); }
          }

          .kashis-favorites-count {
            display: inline-block;
            padding: 0.25rem 0.5rem;
            background: #FF5630;
            color: #FFFFFF;
            border-radius: 10px;
            font-size: 0.75rem;
            font-weight: 700;
            margin-left: 0.5rem;
          }
        `;
        document.head.appendChild(style);
      }
    },

    /**
     * Setup event listeners
     */
    setupEventListeners() {
      document.addEventListener('click', (e) => {
        const btn = e.target.closest('.kashis-favorite-btn');
        if (!btn) return;

        const roomId = btn.getAttribute('data-room-id');
        const wasAdded = this.toggle(roomId);

        btn.classList.toggle('favorited', wasAdded);
        btn.innerHTML = wasAdded ? '❤️' : '🤍';
        btn.setAttribute('aria-label', wasAdded ? 'お気に入りから削除' : 'お気に入りに追加');
      });
    },

    /**
     * Update favorite count in UI
     */
    updateFavoriteCount() {
      const count = this.getFavorites().length;
      const countElements = document.querySelectorAll('.kashis-favorites-count');

      countElements.forEach(el => {
        el.textContent = count;
      });
    }
  };

  // ==========================================================================
  // ルーム比較（Room Comparison）システム
  // ==========================================================================

  const Comparison = {
    STORAGE_KEY: 'kashis_studio_comparison',
    MAX_ITEMS: 3,

    /**
     * Initialize comparison system
     */
    init() {
      this.renderComparisonButtons();
      this.setupEventListeners();
      this.updateComparisonCount();
    },

    /**
     * Get comparison list from localStorage
     */
    getComparison() {
      const stored = localStorage.getItem(this.STORAGE_KEY);
      return stored ? JSON.parse(stored) : [];
    },

    /**
     * Save comparison list
     */
    saveComparison(items) {
      localStorage.setItem(this.STORAGE_KEY, JSON.stringify(items));
      this.updateComparisonCount();
    },

    /**
     * Check if room is in comparison
     */
    isInComparison(roomId) {
      return this.getComparison().includes(roomId);
    },

    /**
     * Toggle room in comparison
     */
    toggle(roomId) {
      const items = this.getComparison();
      const index = items.indexOf(roomId);

      if (index > -1) {
        items.splice(index, 1);
      } else {
        if (items.length >= this.MAX_ITEMS) {
          alert(`比較リストは最大${this.MAX_ITEMS}件までです`);
          return false;
        }
        items.push(roomId);
      }

      this.saveComparison(items);
      return index === -1;
    },

    /**
     * Render comparison buttons
     */
    renderComparisonButtons() {
      const roomCards = document.querySelectorAll('[data-room-id]');

      roomCards.forEach(card => {
        const roomId = card.getAttribute('data-room-id');
        if (!roomId) return;

        const isInComparison = this.isInComparison(roomId);

        const button = document.createElement('button');
        button.className = 'kashis-comparison-btn' + (isInComparison ? ' active' : '');
        button.setAttribute('data-room-id', roomId);
        button.setAttribute('aria-label', isInComparison ? '比較から削除' : '比較に追加');
        button.innerHTML = isInComparison ? '✓ 比較中' : '比較する';

        // Find a good place to add the button
        const content = card.querySelector('.kashis-room-content');
        if (content) {
          content.appendChild(button);
        }
      });

      // Add styles
      if (!document.getElementById('comparison-styles')) {
        const style = document.createElement('style');
        style.id = 'comparison-styles';
        style.textContent = `
          .kashis-comparison-btn {
            display: inline-block;
            padding: 0.5rem 1rem;
            background: #F4F5F7;
            color: #42526E;
            border: 2px solid #DFE1E6;
            border-radius: 3px;
            font-size: 0.875rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 150ms ease;
            margin-top: 0.5rem;
          }

          .kashis-comparison-btn:hover {
            background: #DEEBFF;
            border-color: #0052CC;
            color: #0052CC;
          }

          .kashis-comparison-btn.active {
            background: #0052CC;
            color: #FFFFFF;
            border-color: #0052CC;
          }

          .kashis-comparison-count {
            display: inline-block;
            padding: 0.25rem 0.5rem;
            background: #00875A;
            color: #FFFFFF;
            border-radius: 10px;
            font-size: 0.75rem;
            font-weight: 700;
            margin-left: 0.5rem;
          }
        `;
        document.head.appendChild(style);
      }
    },

    /**
     * Setup event listeners
     */
    setupEventListeners() {
      document.addEventListener('click', (e) => {
        const btn = e.target.closest('.kashis-comparison-btn');
        if (!btn) return;

        const roomId = btn.getAttribute('data-room-id');
        const wasAdded = this.toggle(roomId);

        if (wasAdded !== false) {
          btn.classList.toggle('active', wasAdded);
          btn.innerHTML = wasAdded ? '✓ 比較中' : '比較する';
          btn.setAttribute('aria-label', wasAdded ? '比較から削除' : '比較に追加');
        }
      });
    },

    /**
     * Update comparison count in UI
     */
    updateComparisonCount() {
      const count = this.getComparison().length;
      const countElements = document.querySelectorAll('.kashis-comparison-count');

      countElements.forEach(el => {
        el.textContent = count;
      });
    }
  };

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
    Favorites.init();
    Comparison.init();
    console.log('🌟 Kashis Studio Advanced Features Loaded');
  }

})();
