import Alpine from 'alpinejs';
import Echo from 'laravel-echo';
import Pusher from 'pusher-js';

window.Alpine = Alpine;

window.Pusher = Pusher;

const reverbKey = import.meta.env.VITE_REVERB_APP_KEY;

if (reverbKey) {
  window.Echo = new Echo({
    broadcaster: 'reverb',
    key: reverbKey,
    wsHost: import.meta.env.VITE_REVERB_HOST || '127.0.0.1',
    wsPort: Number(import.meta.env.VITE_REVERB_PORT || 8081),
    wssPort: Number(import.meta.env.VITE_REVERB_PORT || 8081),
    forceTLS: (import.meta.env.VITE_REVERB_SCHEME || 'http') === 'https',
    enabledTransports: ['ws', 'wss'],
  });
}

Alpine.data('themeToggle', () => ({
  dark: document.documentElement.classList.contains('dark'),
  init() {
    const savedTheme = localStorage.getItem('theme');
    if (savedTheme === 'dark') {
      this.setDark(true);
    }
  },
  setDark(value) {
    this.dark = value;
    document.documentElement.classList.toggle('dark', value);
    localStorage.setItem('theme', value ? 'dark' : 'light');
  },
  toggle() {
    this.setDark(!this.dark);
  },
}));

Alpine.data('layoutShell', () => ({
  mobileNav: false,
}));

document.addEventListener('DOMContentLoaded', () => {
  const seasonId = document.body.dataset.seasonId;

  if (!window.Echo || !seasonId) {
    return;
  }

  window.Echo.channel(`league.season.${seasonId}`).listen('.match.live.updated', (payload) => {
    const scoreLine = document.querySelector(`[data-match-score="${payload.match_id}"]`);
    if (scoreLine) {
      scoreLine.textContent = `${payload.home_score} - ${payload.away_score}`;
    }

    const feed = document.getElementById('live-feed');
    if (feed) {
      const item = document.createElement('div');
      item.className = 'rounded-2xl border border-slate-200 p-3 dark:border-slate-800';
      item.innerHTML = `<p class="text-sm font-medium text-slate-900 dark:text-white">${payload.home_team} ${payload.home_score} - ${payload.away_score} ${payload.away_team}</p><p class="text-xs text-slate-500 dark:text-slate-400">${payload.status} · ${payload.updated_at ?? 'just now'}</p>`;
      feed.prepend(item);
    }
  });

  window.Echo.private(`users.${document.body.dataset.userId}`).listen('.league.notification.created', (payload) => {
    const feed = document.getElementById('notification-feed');
    if (feed) {
      const item = document.createElement('div');
      item.className = 'rounded-2xl border border-slate-200 p-3 dark:border-slate-800';
      item.innerHTML = `<p class="text-sm font-medium text-slate-900 dark:text-white">${payload.title}</p><p class="text-xs text-slate-500 dark:text-slate-400">${payload.message}</p>`;
      feed.prepend(item);
    }
  });
});

Alpine.start();