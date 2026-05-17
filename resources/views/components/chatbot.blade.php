<div
    x-data="bhojpuriChatbot({
        title: @js($title ?? 'Bhojpuri Sahayak'),
        greeting: @js($greeting ?? 'नमस्ते! हमार Bhojpuri सहायक ह। खेल, टीम, मैच, चोट, भा transfer पर पूछीं।'),
    })"
    x-init="init()"
    class="fixed bottom-4 right-4 z-50"
>
    <div x-cloak x-show="open" x-transition.opacity class="fixed inset-0 bg-slate-950/30" @click="open = false"></div>

    <div x-cloak x-show="open" x-transition class="relative mb-4 w-[calc(100vw-2rem)] max-w-sm overflow-hidden rounded-[1.75rem] border border-slate-200 bg-white shadow-2xl dark:border-slate-800 dark:bg-slate-950 sm:w-[22rem]">
        <div class="flex items-center justify-between border-b border-slate-200 px-4 py-3 dark:border-slate-800">
            <div>
                <p class="text-xs font-semibold uppercase tracking-[0.28em] text-brand-600">{{ $title ?? 'Bhojpuri Sahayak' }}</p>
                <p class="text-sm text-slate-500 dark:text-slate-400">Bhojpuri me baat karu</p>
            </div>
            <button type="button" class="btn-secondary px-3 py-2" @click="open = false">✕</button>
        </div>

        <div class="max-h-[28rem] space-y-3 overflow-y-auto px-4 py-4" x-ref="messages">
            <template x-for="message in messages" :key="message.id">
                <div :class="message.role === 'user' ? 'ml-auto bg-brand-600 text-white' : 'mr-auto bg-slate-100 text-slate-800 dark:bg-slate-900 dark:text-slate-100'" class="max-w-[85%] rounded-2xl px-3 py-2 text-sm leading-6 shadow-sm">
                    <p x-text="message.text"></p>
                </div>
            </template>
        </div>

        <div class="border-t border-slate-200 px-4 py-3 dark:border-slate-800">
            <div class="mb-3 flex flex-wrap gap-2">
                <template x-for="chip in quickPrompts" :key="chip">
                    <button type="button" class="rounded-full border border-slate-200 px-3 py-1.5 text-xs font-medium text-slate-700 hover:border-brand-400 hover:text-brand-700 dark:border-slate-800 dark:text-slate-300" @click="sendPrompt(chip)" x-text="chip"></button>
                </template>
            </div>

            <form class="flex gap-2" @submit.prevent="send()">
                <input class="input flex-1" type="text" x-model="input" placeholder="Bhojpuri, Hindi ya English me puchhi..." autocomplete="off">
                <button class="btn-primary px-4" type="submit">Bheji</button>
            </form>
        </div>
    </div>

    <button
        type="button"
        class="flex h-14 w-14 items-center justify-center rounded-full bg-brand-600 text-white shadow-2xl shadow-brand-900/30 transition hover:scale-105 hover:bg-brand-700"
        @click="toggle()"
        :aria-expanded="open.toString()"
        aria-label="Open Bhojpuri chatbot"
    >
        <span class="text-xl font-semibold">भा</span>
    </button>
</div>