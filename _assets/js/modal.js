/**
 * Modal Component for Notifications
 * Replaces alert() with modern modal dialogs
 */

class Modal {
    constructor() {
        this.createModalContainer();
    }

    createModalContainer() {
        // Remove existing modal if any
        const existing = document.getElementById('app-modal');
        if (existing) {
            existing.remove();
        }

        // Create modal HTML
        const modalHTML = `
            <div id="app-modal" class="fixed inset-0 z-50 hidden overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">
                <!-- Background overlay -->
                <div class="fixed inset-0 bg-gray-900 bg-opacity-75 transition-opacity" id="modal-backdrop"></div>

                <!-- Modal container -->
                <div class="flex min-h-full items-center justify-center p-4 text-center sm:p-0">
                    <div class="relative transform overflow-hidden rounded-2xl bg-white text-left shadow-2xl transition-all sm:my-8 sm:w-full sm:max-w-lg animate-slide-in">
                        <!-- Modal content -->
                        <div class="bg-white px-4 pb-4 pt-5 sm:p-6 sm:pb-4">
                            <div class="sm:flex sm:items-start">
                                <!-- Icon -->
                                <div class="mx-auto flex h-16 w-16 flex-shrink-0 items-center justify-center rounded-full sm:mx-0 sm:h-12 sm:w-12" id="modal-icon-container">
                                    <i class="text-3xl" id="modal-icon"></i>
                                </div>
                                <!-- Content -->
                                <div class="mt-3 text-center sm:ml-4 sm:mt-0 sm:text-left flex-1">
                                    <h3 class="text-xl font-semibold leading-6 text-gray-900" id="modal-title">
                                        Title
                                    </h3>
                                    <div class="mt-2">
                                        <p class="text-sm text-gray-600" id="modal-message">
                                            Message
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Modal actions -->
                        <div class="bg-gray-50 px-4 py-3 sm:flex sm:flex-row-reverse sm:px-6 gap-2">
                            <button type="button" id="modal-confirm-btn" class="inline-flex w-full justify-center rounded-lg px-4 py-2.5 text-sm font-semibold text-white shadow-sm sm:w-auto transition-all hover:scale-105">
                                OK
                            </button>
                            <button type="button" id="modal-cancel-btn" class="mt-3 inline-flex w-full justify-center rounded-lg bg-white px-4 py-2.5 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50 sm:mt-0 sm:w-auto hidden">
                                Cancel
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        `;

        document.body.insertAdjacentHTML('beforeend', modalHTML);
        this.setupEventListeners();
    }

    setupEventListeners() {
        const modal = document.getElementById('app-modal');
        const backdrop = document.getElementById('modal-backdrop');
        const confirmBtn = document.getElementById('modal-confirm-btn');
        const cancelBtn = document.getElementById('modal-cancel-btn');

        // Close on backdrop click
        backdrop.addEventListener('click', () => this.hide());

        // Close on confirm
        confirmBtn.addEventListener('click', () => {
            if (this.onConfirm) {
                this.onConfirm();
            }
            this.hide();
        });

        // Close on cancel
        cancelBtn.addEventListener('click', () => {
            if (this.onCancel) {
                this.onCancel();
            }
            this.hide();
        });

        // Close on ESC key
        document.addEventListener('keydown', (e) => {
            if (e.key === 'Escape' && !modal.classList.contains('hidden')) {
                this.hide();
            }
        });
    }

    show(options = {}) {
        const {
            title = 'Notification',
            message = '',
            type = 'info', // success, error, warning, info, confirm
            confirmText = 'OK',
            cancelText = 'Cancel',
            onConfirm = null,
            onCancel = null
        } = options;

        this.onConfirm = onConfirm;
        this.onCancel = onCancel;

        const modal = document.getElementById('app-modal');
        const titleEl = document.getElementById('modal-title');
        const messageEl = document.getElementById('modal-message');
        const iconContainer = document.getElementById('modal-icon-container');
        const icon = document.getElementById('modal-icon');
        const confirmBtn = document.getElementById('modal-confirm-btn');
        const cancelBtn = document.getElementById('modal-cancel-btn');

        // Set content
        titleEl.textContent = title;
        messageEl.textContent = message;
        confirmBtn.textContent = confirmText;
        cancelBtn.textContent = cancelText;

        // Set icon and colors based on type
        const config = this.getTypeConfig(type);
        iconContainer.className = `mx-auto flex h-16 w-16 flex-shrink-0 items-center justify-center rounded-full sm:mx-0 sm:h-12 sm:w-12 ${config.bgColor}`;
        icon.className = `${config.icon} ${config.iconColor} text-3xl`;
        confirmBtn.className = `inline-flex w-full justify-center rounded-lg px-4 py-2.5 text-sm font-semibold text-white shadow-sm sm:w-auto transition-all hover:scale-105 ${config.btnColor}`;

        // Show/hide cancel button
        if (type === 'confirm') {
            cancelBtn.classList.remove('hidden');
        } else {
            cancelBtn.classList.add('hidden');
        }

        // Show modal
        modal.classList.remove('hidden');
        document.body.style.overflow = 'hidden';
    }

    hide() {
        const modal = document.getElementById('app-modal');
        modal.classList.add('hidden');
        document.body.style.overflow = '';
        this.onConfirm = null;
        this.onCancel = null;
    }

    getTypeConfig(type) {
        const configs = {
            success: {
                icon: 'fas fa-check-circle',
                iconColor: 'text-green-600',
                bgColor: 'bg-green-100',
                btnColor: 'bg-green-600 hover:bg-green-700'
            },
            error: {
                icon: 'fas fa-times-circle',
                iconColor: 'text-red-600',
                bgColor: 'bg-red-100',
                btnColor: 'bg-red-600 hover:bg-red-700'
            },
            warning: {
                icon: 'fas fa-exclamation-triangle',
                iconColor: 'text-yellow-600',
                bgColor: 'bg-yellow-100',
                btnColor: 'bg-yellow-600 hover:bg-yellow-700'
            },
            info: {
                icon: 'fas fa-info-circle',
                iconColor: 'text-blue-600',
                bgColor: 'bg-blue-100',
                btnColor: 'bg-blue-600 hover:bg-blue-700'
            },
            confirm: {
                icon: 'fas fa-question-circle',
                iconColor: 'text-purple-600',
                bgColor: 'bg-purple-100',
                btnColor: 'bg-purple-600 hover:bg-purple-700'
            }
        };

        return configs[type] || configs.info;
    }

    // Helper methods
    success(message, title = 'Success') {
        this.show({ type: 'success', title, message });
    }

    error(message, title = 'Error') {
        this.show({ type: 'error', title, message });
    }

    warning(message, title = 'Warning') {
        this.show({ type: 'warning', title, message });
    }

    info(message, title = 'Information') {
        this.show({ type: 'info', title, message });
    }

    confirm(message, title = 'Confirm', onConfirm, onCancel) {
        this.show({
            type: 'confirm',
            title,
            message,
            confirmText: 'Yes',
            cancelText: 'No',
            onConfirm,
            onCancel
        });
    }
}

// Initialize global modal instance
const modal = new Modal();

// Expose to window for easy access
window.showModal = (options) => modal.show(options);
window.modalSuccess = (message, title) => modal.success(message, title);
window.modalError = (message, title) => modal.error(message, title);
window.modalWarning = (message, title) => modal.warning(message, title);
window.modalInfo = (message, title) => modal.info(message, title);
window.modalConfirm = (message, title, onConfirm, onCancel) => modal.confirm(message, title, onConfirm, onCancel);
