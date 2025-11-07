<div x-data="{
        // Opciones
        position: 'bottom-end', // 'top-start', 'top-end', 'bottom-start', 'bottom-end'
        autoClose: true,
        autoCloseDelay: 5000,

        // Helpers
        notifications: [],
        nextId: 1,

        // Setea las clases de transición basadas en la posición
        transitionClasses: {
            'x-transition:enter-start'() {
                if (this.position === 'top-start' || this.position === 'bottom-start') {
                    return 'opacity-0 -translate-x-12 rtl:translate-x-12';
                } else if (this.position === 'top-end' || this.position === 'bottom-end') {
                    return 'opacity-0 translate-x-12 rtl:-translate-x-12';
                }
            },
            'x-transition:leave-end'() {
                if (this.position === 'top-start' || this.position === 'bottom-start') {
                    return 'opacity-0 -translate-x-12 rtl:translate-x-12';
                } else if (this.position === 'top-end' || this.position === 'bottom-end') {
                    return 'opacity-0 translate-x-12 rtl:-translate-x-12';
                }
            },
        },

        // Dispara una notificación
        toast(message, type, link) {
            const id = this.nextId++;

            this.notifications.push({ id, message, type, link, visible: false });

            setTimeout(() => {
                const index = this.notifications.findIndex(n => n.id === id);

                if (index > -1) {
                    this.notifications[index].visible = true;
                }
            }, 30);

            if (this.autoClose) {
                setTimeout(() => this.dismissNotification(id), this.autoCloseDelay);
            }
        },

        // Descartar una notificación
        dismissNotification(id) {
            const index = this.notifications.findIndex(n => n.id === id);

            if (index > -1) {
                this.notifications[index].visible = false;

                setTimeout(() => {
                    this.notifications.splice(index, 1);
                }, 300);
            }
        }
    }"
    x-on:toast.window="toast($event.detail.message, $event.detail.type, $event.detail.link)"
>
    <div
        x-cloak
        x-show="notifications.length > 0"
        role="region"
        aria-label="Notifications"
        class="fixed z-50 flex w-80 gap-2"
        :class="{
            'flex-col-reverse': position === 'top-start' || position === 'top-end',
            'flex-col': position === 'bottom-start' || position === 'bottom-end',
            'top-4': position === 'top-end' || position === 'top-start',
            'bottom-4': position === 'bottom-end' || position === 'bottom-start',
            'end-4': position === 'top-end' || position === 'bottom-end',
            'start-4': position === 'top-start' || position === 'bottom-start',
        }"
    >
        <template x-for="notification in notifications" :key="notification.id">
            <div
                x-show="notification.visible"
                x-bind="transitionClasses"
                x-transition:enter="transition ease-out duration-300"
                x-transition:enter-end="opacity-100 translate-x-0"
                x-transition:leave="transition ease-in duration-200"
                x-transition:leave-start="opacity-100 translate-x-0"
                class="flex items-center justify-between gap-2 px-3 py-4 rounded-xl border border-zinc-200 shadow-xs bg-white text-zinc-800 dark:border-zinc-800 dark:bg-zinc-900 dark:text-zinc-100"
                role="alert"
                :aria-live="notification.type === 'error' ? 'assertive' : 'polite'"
            >
                <template x-if="notification.type !== 'neutral'">
                    <div
                        class="flex size-6 flex-none items-center justify-center rounded-full"
                    >
                        <template x-if="notification.type === 'success'">
                            <flux:icon.check-circle variant="solid" class="size-5 text-green-500" />
                        </template>

                        <template x-if="notification.type === 'error'">
                            <flux:icon.x-circle variant="solid" class="size-5 text-red-500" />
                        </template>

                        <template x-if="notification.type === 'warning'">
                            <flux:icon.exclamation-triangle variant="solid" class="size-5 text-yellow-500" />
                        </template>

                        <template x-if="notification.type === 'info'">
                            <flux:icon.information-circle variant="solid" class="size-5 text-sky-500" />
                        </template>
                    </div>
                </template>
                <div class="">
                    <div x-text="notification.message" class="text-sm font-medium text-zinc-800 dark:text-zinc-200"></div>
                </div>
                <flux:button
                    @click="dismissNotification(notification.id)"
                    size="sm"
                    variant="subtle"
                    icon="x-mark"
                    class="!flex-none cursor-pointer"
                    square
                />
            </div>
        </template>
    </div>
</div>
