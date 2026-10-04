<div id="updateModal" class="fixed inset-0 z-[90] hidden items-center justify-center p-4">
    <div class="absolute inset-0 bg-slate-900/50 backdrop-blur-sm" onclick="closeUpdateModal()"></div>

    <div class="relative card w-full max-w-md p-6 animate-fade-in-up">
        <div class="flex items-start justify-between gap-3 mb-5">
            <div>
                <p class="text-xs uppercase tracking-widest font-bold text-emerald-600 dark:text-emerald-400">Update Activity</p>
                <h3 id="modalTitle" class="mt-1 text-lg font-bold text-slate-900 dark:text-white"></h3>
            </div>
            <button type="button" onclick="closeUpdateModal()"
                    class="w-8 h-8 rounded-lg hover:bg-slate-100 dark:hover:bg-slate-800 flex items-center justify-center">
                <svg class="w-4 h-4 text-slate-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>

        <form id="updateForm" method="POST" class="space-y-4">
            @csrf

            {{-- Status toggle --}}
            <div>
                <label class="label">Status</label>
                <div class="grid grid-cols-2 gap-2">
                    <label class="cursor-pointer">
                        <input type="radio" name="status" value="done" class="peer sr-only" required>
                        <div class="px-4 py-3 rounded-xl border-2 border-slate-200 dark:border-slate-700 text-center
                                    peer-checked:border-emerald-500 peer-checked:bg-emerald-50 dark:peer-checked:bg-emerald-500/10
                                    hover:border-emerald-300 transition">
                            <svg class="w-5 h-5 mx-auto text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                            </svg>
                            <span class="block mt-1 text-sm font-semibold text-slate-700 dark:text-slate-200">Done</span>
                        </div>
                    </label>
                    <label class="cursor-pointer">
                        <input type="radio" name="status" value="pending" class="peer sr-only" required checked>
                        <div class="px-4 py-3 rounded-xl border-2 border-slate-200 dark:border-slate-700 text-center
                                    peer-checked:border-amber-500 peer-checked:bg-amber-50 dark:peer-checked:bg-amber-500/10
                                    hover:border-amber-300 transition">
                            <svg class="w-5 h-5 mx-auto text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3" />
                            </svg>
                            <span class="block mt-1 text-sm font-semibold text-slate-700 dark:text-slate-200">Pending</span>
                        </div>
                    </label>
                </div>
            </div>

            <div>
                <label class="label">Remark</label>
                <textarea name="remark" rows="3" class="input"
                          placeholder="e.g. SMS count matched logs (1,204 vs 1,204)"></textarea>
            </div>

            <div>
                <label class="label">Activity Date</label>
                <input type="date" name="activity_date" max="{{ now()->toDateString() }}" class="input">
            </div>

            <div class="flex justify-end gap-2 pt-2">
                <button type="button" onclick="closeUpdateModal()" class="btn-ghost">Cancel</button>
                <button type="submit" class="btn-primary">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                    </svg>
                    Save Update
                </button>
            </div>
        </form>
    </div>
</div>

@push('scripts')
<script>
    function openUpdateModal(id, title) {
        const modal = document.getElementById('updateModal');
        document.getElementById('modalTitle').textContent = title;
        document.getElementById('updateForm').action = `/activities/${id}/updates`;
        modal.classList.remove('hidden');
        modal.classList.add('flex');
    }
    function closeUpdateModal() {
        const modal = document.getElementById('updateModal');
        modal.classList.add('hidden');
        modal.classList.remove('flex');
    }
    document.addEventListener('keydown', e => { if (e.key === 'Escape') closeUpdateModal(); });
</script>
@endpush