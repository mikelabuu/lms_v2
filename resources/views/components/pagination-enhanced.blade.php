@props(['paginator'])

@if ($paginator->hasPages())
    <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
        <!-- Pagination Info -->
        <div class="px-6 py-4 bg-gradient-to-r from-green-50 to-emerald-50 border-b border-gray-200">
            <div class="flex items-center justify-between">
                <div class="flex items-center space-x-4">
                    <div class="flex items-center space-x-2">
                        <div class="w-8 h-8 bg-green-100 rounded-full flex items-center justify-center">
                            <i class="fas fa-info-circle text-green-600 text-sm"></i>
                        </div>
                        <div>
                            <p class="text-sm font-medium text-gray-900">
                                Showing <span class="font-semibold text-green-600">{{ $paginator->firstItem() }}</span> to 
                                <span class="font-semibold text-green-600">{{ $paginator->lastItem() }}</span> of 
                                <span class="font-semibold text-green-600">{{ $paginator->total() }}</span> results
                            </p>
                            <p class="text-xs text-gray-500">Page {{ $paginator->currentPage() }} of {{ $paginator->lastPage() }}</p>
                        </div>
                    </div>
                </div>
                
                <!-- Quick Page Jump -->
                <div class="flex items-center space-x-2">
                    <span class="text-sm text-gray-500">Go to:</span>
                    <select onchange="window.location.href = this.value" class="text-sm border border-gray-300 rounded-md px-2 py-1 focus:ring-2 focus:ring-green-500 focus:border-transparent">
                        @for ($page = 1; $page <= $paginator->lastPage(); $page++)
                            <option value="{{ $paginator->url($page) }}" {{ $page == $paginator->currentPage() ? 'selected' : '' }}>
                                Page {{ $page }}
                            </option>
                        @endfor
                    </select>
                </div>
            </div>
        </div>

        <!-- Pagination Controls -->
        <div class="px-6 py-4">
            <div class="flex items-center justify-between">
                <!-- Previous Button -->
                <div class="flex items-center">
                    @if ($paginator->onFirstPage())
                        <button disabled class="inline-flex items-center px-4 py-2 text-sm font-medium text-gray-400 bg-gray-100 border border-gray-300 rounded-lg cursor-not-allowed transition-all duration-200">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                            </svg>
                            Previous
                        </button>
                    @else
                        <a href="{{ $paginator->previousPageUrl() }}" class="inline-flex items-center px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-lg hover:bg-gray-50 hover:text-gray-900 hover:border-gray-400 transition-all duration-200 transform hover:-translate-y-0.5 hover:shadow-md">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                            </svg>
                            Previous
                        </a>
                    @endif
                </div>

                <!-- Page Numbers -->
                <div class="flex items-center space-x-1">
                    @php
                        $currentPage = $paginator->currentPage();
                        $lastPage = $paginator->lastPage();
                        $startPage = max(1, $currentPage - 2);
                        $endPage = min($lastPage, $currentPage + 2);
                    @endphp

                    {{-- First page --}}
                    @if ($startPage > 1)
                        <a href="{{ $paginator->url(1) }}" class="inline-flex items-center justify-center w-10 h-10 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-lg hover:bg-gray-50 hover:text-gray-900 hover:border-gray-400 transition-all duration-200 transform hover:-translate-y-0.5 hover:shadow-md">
                            1
                        </a>
                        @if ($startPage > 2)
                            <span class="inline-flex items-center justify-center w-10 h-10 text-sm font-medium text-gray-500">
                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                                </svg>
                            </span>
                        @endif
                    @endif

                    {{-- Page range --}}
                    @for ($page = $startPage; $page <= $endPage; $page++)
                        @if ($page == $currentPage)
                            <span class="inline-flex items-center justify-center w-10 h-10 text-sm font-medium text-white bg-gradient-to-r from-green-600 to-emerald-600 border border-green-600 rounded-lg shadow-md transform scale-105">
                                {{ $page }}
                            </span>
                        @else
                            <a href="{{ $paginator->url($page) }}" class="inline-flex items-center justify-center w-10 h-10 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-lg hover:bg-gray-50 hover:text-gray-900 hover:border-gray-400 transition-all duration-200 transform hover:-translate-y-0.5 hover:shadow-md">
                                {{ $page }}
                            </a>
                        @endif
                    @endfor

                    {{-- Last page --}}
                    @if ($endPage < $lastPage)
                        @if ($endPage < $lastPage - 1)
                            <span class="inline-flex items-center justify-center w-10 h-10 text-sm font-medium text-gray-500">
                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                                </svg>
                            </span>
                        @endif
                        <a href="{{ $paginator->url($lastPage) }}" class="inline-flex items-center justify-center w-10 h-10 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-lg hover:bg-gray-50 hover:text-gray-900 hover:border-gray-400 transition-all duration-200 transform hover:-translate-y-0.5 hover:shadow-md">
                            {{ $lastPage }}
                        </a>
                    @endif
                </div>

                <!-- Next Button -->
                <div class="flex items-center">
                    @if ($paginator->hasMorePages())
                        <a href="{{ $paginator->nextPageUrl() }}" class="inline-flex items-center px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-lg hover:bg-gray-50 hover:text-gray-900 hover:border-gray-400 transition-all duration-200 transform hover:-translate-y-0.5 hover:shadow-md">
                            Next
                            <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                            </svg>
                        </a>
                    @else
                        <button disabled class="inline-flex items-center px-4 py-2 text-sm font-medium text-gray-400 bg-gray-100 border border-gray-300 rounded-lg cursor-not-allowed transition-all duration-200">
                            Next
                            <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                            </svg>
                        </button>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endif
