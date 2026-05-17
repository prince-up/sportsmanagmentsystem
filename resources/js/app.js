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

Alpine.data('bhojpuriChatbot', (config = {}) => ({
  open: false,
  input: '',
  title: config.title || 'Bhojpuri Sahayak',
  greeting: config.greeting || 'नमस्ते! हमार Bhojpuri सहायक ह।',
  quickPrompts: [
    'Dashboard dekhai',
    'Team kaise banayi?',
    'Match ka score ka ba?',
    'Injury update kaha milela?',
  ],
  messages: [],
  init() {
    const saved = localStorage.getItem('bhojpuri-chatbot-history');
    if (saved) {
      try {
        this.messages = JSON.parse(saved);
      } catch {
        this.messages = [];
      }
    }

    if (!this.messages.length) {
      this.messages = [this.createMessage('bot', this.greeting)];
    }
  },
  toggle() {
    this.open = !this.open;
    if (this.open) {
      this.$nextTick(() => this.scrollToBottom());
    }
  },
  sendPrompt(text) {
    this.input = text;
    this.send();
  },
  send() {
    const text = this.input.trim();
    if (!text) {
      return;
    }

    this.messages.push(this.createMessage('user', text));
    this.input = '';

    const reply = this.generateReply(text);
    window.setTimeout(() => {
      this.messages.push(this.createMessage('bot', reply));
      this.persist();
      this.$nextTick(() => this.scrollToBottom());
    }, 180);

    this.persist();
    this.$nextTick(() => this.scrollToBottom());
  },
  createMessage(role, text) {
    return {
      id: `${Date.now()}-${Math.random().toString(16).slice(2)}`,
      role,
      text,
    };
  },
  persist() {
    localStorage.setItem('bhojpuri-chatbot-history', JSON.stringify(this.messages.slice(-20)));
  },
  scrollToBottom() {
    const container = this.$refs.messages;
    if (container) {
      container.scrollTop = container.scrollHeight;
    }
  },
  generateReply(text) {
    const normalized = text.toLowerCase();

    if (/(help|madad|sahayata|kaise|कइसे|कैसे)/.test(normalized)) {
      return 'हम मदद खातिर इहाँ बानी। Team, Match, Injury, Transfer आ League Table पर पूछीं।';
    }

    if (/(dashboard|home|main|overview|डैशबोर्ड)/.test(normalized)) {
      return 'Dashboard पर league leader, live match, injury, transfer, आ notification सब देखाइत बा।';
    }

    if (/(team|club|team create|टीम)/.test(normalized)) {
      return 'Team section में नयका टीम बनाईं, coach भरिं, city चुनिं, आ public profile खोलीं।';
    }

    if (/(player|squad|खिलाड़ी|player create)/.test(normalized)) {
      return 'Player section में squad manage होखेला. Jersey number, position, rating, आ injury status update करीं।';
    }

    if (/(match|fixture|score|scoreboard|मैच)/.test(normalized)) {
      return 'Matches page पर fixture schedule करीं, live score update करीं, आ public match detail देखीं।';
    }

    if (/(injury|injured|fitness|चोट)/.test(normalized)) {
      return 'Injury updates live feed में आवेला. Recovery progress देखीं आ player fitness track करीं।';
    }

    if (/(transfer|trade|दलल|ट्रांसफर)/.test(normalized)) {
      return 'Transfer market में player move track होखेला, आ live feed में turant update आवेला।';
    }

    if (/(public|profile|view|open|देख|प्रोफाइल)/.test(normalized)) {
      return 'Public pages में team, player, आ match detail खुल जाला. Sidebar से direct पहुँचीं।';
    }

    return 'हमरा अनुसार ई league management system ह। अगर चाहीं त dashboard, team, match, injury, भा transfer पर specific सवाल पूछीं।';
  },
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

  window.Echo.channel(`league.season.${seasonId}`).listen('.league.injury.logged', (payload) => {
    const feed = document.getElementById('live-feed');
    if (feed) {
      const item = document.createElement('div');
      item.className = 'rounded-2xl border border-slate-200 p-3 dark:border-slate-800';
      item.innerHTML = `<p class="text-sm font-medium text-slate-900 dark:text-white">Injury update: ${payload.player_name}</p><p class="text-xs text-slate-500 dark:text-slate-400">${payload.team_name} · ${payload.injury_type} · ${payload.recovery_progress}%</p>`;
      feed.prepend(item);
    }
  });

  window.Echo.channel(`league.season.${seasonId}`).listen('.league.transfer.logged', (payload) => {
    const feed = document.getElementById('live-feed');
    if (feed) {
      const item = document.createElement('div');
      item.className = 'rounded-2xl border border-slate-200 p-3 dark:border-slate-800';
      item.innerHTML = `<p class="text-sm font-medium text-slate-900 dark:text-white">Transfer update: ${payload.player_name}</p><p class="text-xs text-slate-500 dark:text-slate-400">${payload.from_team} → ${payload.to_team} · ${payload.status}</p>`;
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