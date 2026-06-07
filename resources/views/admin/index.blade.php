<x-admin.layout>
    <div class="mx-auto max-w-7xl space-y-6">
        <div class="flex flex-col gap-2">
            <h1 class="text-2xl font-semibold text-gray-900 dark:text-white">ადმინ პანელი</h1>
            <p class="text-sm text-gray-500 dark:text-slate-400">
                ვებგვერდის ძირითადი მონაცემები და სწრაფი მოქმედებები.
            </p>
        </div>

        <div class="grid grid-cols-1 gap-4 md:grid-cols-2 xl:grid-cols-4">
            <section class="flex min-h-[180px] flex-col justify-between rounded-md border border-gray-200 bg-white p-5 shadow-[0_10px_30px_rgba(37,99,235,0.08)] transition hover:-translate-y-0.5 hover:shadow-[0_18px_45px_rgba(37,99,235,0.14)] dark:border-slate-700 dark:bg-slate-900">
                <div class="flex items-start justify-between gap-4">
                    <div class="flex h-12 w-12 shrink-0 items-center justify-center rounded-md bg-blue-50 text-blue-600 dark:bg-blue-950/50 dark:text-blue-300">
                        <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19a6 6 0 00-12 0m12 0h6a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0zm8 1a4 4 0 11-8 0 4 4 0 018 0z"/>
                        </svg>
                    </div>
                    <div class="min-w-0 text-right">
                        <p class="truncate text-sm font-medium text-gray-500 dark:text-slate-400">მომხმარებლები</p>
                        <p class="mt-1 text-3xl font-semibold text-blue-600 dark:text-blue-300">{{ $users }}</p>
                    </div>
                </div>
                <div class="mt-6 flex justify-end">
                    <a href="{{ route('admin.users') }}" class="inline-flex h-10 items-center justify-center rounded-md bg-blue-50 px-4 text-sm font-medium text-blue-700 transition hover:bg-blue-100 dark:bg-blue-950/50 dark:text-blue-300 dark:hover:bg-blue-900/60">
                        დეტალურად
                    </a>
                </div>
            </section>

            <section class="flex min-h-[180px] flex-col justify-between rounded-md border border-gray-200 bg-white p-5 shadow-[0_10px_30px_rgba(16,185,129,0.08)] transition hover:-translate-y-0.5 hover:shadow-[0_18px_45px_rgba(16,185,129,0.14)] dark:border-slate-700 dark:bg-slate-900">
                <div class="flex items-start justify-between gap-4">
                    <div class="flex h-12 w-12 shrink-0 items-center justify-center rounded-md bg-emerald-50 text-emerald-600 dark:bg-emerald-950/50 dark:text-emerald-300">
                        <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5h6m-7 4h8m-8 4h5m-8 8h14a2 2 0 002-2V7.5L15.5 3H5a2 2 0 00-2 2v14a2 2 0 002 2z"/>
                        </svg>
                    </div>
                    <div class="min-w-0 text-right">
                        <p class="truncate text-sm font-medium text-gray-500 dark:text-slate-400">ტესტები</p>
                        <p class="mt-1 text-3xl font-semibold text-emerald-600 dark:text-emerald-300">{{ $tests }}</p>
                    </div>
                </div>
                <div class="mt-6 flex justify-end">
                    <span class="inline-flex h-10 items-center justify-center rounded-md bg-emerald-50 px-4 text-sm font-medium text-emerald-700 dark:bg-emerald-950/50 dark:text-emerald-300">
                        ნახვა
                    </span>
                </div>
            </section>

            <section class="flex min-h-[180px] flex-col justify-between rounded-md border border-gray-200 bg-white p-5 shadow-[0_10px_30px_rgba(124,58,237,0.08)] transition hover:-translate-y-0.5 hover:shadow-[0_18px_45px_rgba(124,58,237,0.14)] dark:border-slate-700 dark:bg-slate-900">
                <div class="flex items-start justify-between gap-4">
                    <div class="flex h-12 w-12 shrink-0 items-center justify-center rounded-md bg-violet-50 text-violet-600 dark:bg-violet-950/50 dark:text-violet-300">
                        <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.25 6.75h7.5M8.25 12h5.25M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </div>
                    <div class="min-w-0 text-right">
                        <p class="truncate text-sm font-medium text-gray-500 dark:text-slate-400">კითხვები</p>
                        <p class="mt-1 text-3xl font-semibold text-violet-600 dark:text-violet-300">{{ $questions }}</p>
                    </div>
                </div>
                <div class="mt-6 flex flex-wrap justify-end gap-2">
                    <a href="{{ route('admin.questions.create') }}" class="inline-flex h-10 items-center justify-center rounded-md bg-violet-600 px-4 text-sm font-medium text-white transition hover:bg-violet-700">
                        დამატება
                    </a>
                    <a href="{{ route('admin.questions') }}" class="inline-flex h-10 items-center justify-center rounded-md bg-violet-50 px-4 text-sm font-medium text-violet-700 transition hover:bg-violet-100 dark:bg-violet-950/50 dark:text-violet-300 dark:hover:bg-violet-900/60">
                        ყველა
                    </a>
                </div>
            </section>

            <section class="flex min-h-[180px] flex-col justify-between rounded-md border border-gray-200 bg-white p-5 shadow-[0_10px_30px_rgba(245,158,11,0.08)] transition hover:-translate-y-0.5 hover:shadow-[0_18px_45px_rgba(245,158,11,0.14)] dark:border-slate-700 dark:bg-slate-900">
                <div class="flex items-start justify-between gap-4">
                    <div class="flex h-12 w-12 shrink-0 items-center justify-center rounded-md bg-amber-50 text-amber-600 dark:bg-amber-950/50 dark:text-amber-300">
                        <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.22 3.756a1 1 0 00.95.69h3.95c.969 0 1.371 1.24.588 1.81l-3.196 2.322a1 1 0 00-.363 1.118l1.22 3.756c.3.922-.755 1.688-1.538 1.118l-3.196-2.322a1 1 0 00-1.176 0l-3.196 2.322c-.783.57-1.838-.196-1.538-1.118l1.22-3.756a1 1 0 00-.363-1.118L4.337 9.183c-.784-.57-.38-1.81.588-1.81h3.95a1 1 0 00.95-.69l1.224-3.756z"/>
                        </svg>
                    </div>
                    <div class="min-w-0 text-right">
                        <p class="truncate text-sm font-medium text-gray-500 dark:text-slate-400">საშუალო ქულა</p>
                        <p class="mt-1 text-3xl font-semibold text-amber-600 dark:text-amber-300">{{ number_format($average_score ?? 0, 0) }}%</p>
                    </div>
                </div>
                <div class="mt-6 flex justify-end">
                    <span class="inline-flex h-10 items-center justify-center rounded-md bg-amber-50 px-4 text-sm font-medium text-amber-700 dark:bg-amber-950/50 dark:text-amber-300">
                        სტატისტიკა
                    </span>
                </div>
            </section>
        </div>
    </div>
</x-admin.layout>
