@extends('Layouts.app')

@section('content')
    <div class="max-w-6xl mx-auto py-8 px-4 sm:px-6 lg:px-8">
        <!-- Header -->
        <div class="mb-6">
            <h1 class="text-2xl font-bold text-gray-900">Data Master</h1>
        </div>

        <!-- Table Container -->
        <div
            class="bg-white rounded-lg shadow-sm border border-gray-200 overflow-hidden"
        >
            <table class="w-full">
                <!-- Table Header -->
                <thead class="bg-blue-500">
                    <tr>
                        <th
                            class="px-6 py-4 text-left text-sm font-medium text-white uppercase tracking-wider w-16"
                        >
                            No
                        </th>
                        <th
                            class="px-6 py-4 text-left text-sm font-medium text-white uppercase tracking-wider"
                        >
                            Data
                        </th>
                        <th
                            class="px-6 py-4 text-center text-sm font-medium text-white uppercase tracking-wider w-24"
                        >
                            Action
                        </th>
                    </tr>
                </thead>

                <!-- Table Body -->
                <tbody class="bg-white divide-y divide-gray-100">
                    <!-- Row 1 -->
                    <tr class="hover:bg-gray-50 transition-colors duration-200">
                        <td
                            class="px-6 py-4 whitespace-nowrap text-sm text-gray-900"
                        >
                            1
                        </td>
                        <td
                            class="px-6 py-4 whitespace-nowrap text-sm text-gray-900"
                        >
                            Category
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-center">
                            <a
                                href={{ route('admin.master.category') }}
                                class="inline-flex items-center justify-center w-8 h-8 bg-green-500 hover:bg-green-600 text-white rounded-md transition-colors duration-200 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2"
                            >
                                <svg
                                    class="w-4 h-4"
                                    fill="none"
                                    stroke="currentColor"
                                    viewBox="0 0 24 24"
                                >
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"
                                    ></path>
                                </svg>
                            </a>
                        </td>
                    </tr>

                    <!-- Row 2 -->
                    <tr
                        class="bg-blue-50 hover:bg-blue-100 transition-colors duration-200"
                    >
                        <td
                            class="px-6 py-4 whitespace-nowrap text-sm text-gray-900"
                        >
                            2
                        </td>
                        <td
                            class="px-6 py-4 whitespace-nowrap text-sm text-gray-900"
                        >
                            Role
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-center">
                            <a
                                href="{{ route('admin.master.role') }}"
                                class="inline-flex items-center justify-center w-8 h-8 bg-green-500 hover:bg-green-600 text-white rounded-md transition-colors duration-200 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2"
                            >
                                <svg
                                    class="w-4 h-4"
                                    fill="none"
                                    stroke="currentColor"
                                    viewBox="0 0 24 24"
                                >
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"
                                    ></path>
                                </svg>
                            </a>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

        <!-- Header -->
        <div class="mb-6 mt-6">
            <h1 class="text-2xl font-bold text-gray-900">Admin Privilege</h1>
        </div>

        <!-- Table Container -->
        <div
            class="bg-white rounded-lg shadow-sm border border-gray-200 overflow-hidden"
        >
            <table class="w-full">
                <!-- Table Header -->
                <thead class="bg-blue-500">
                    <tr>
                        <th
                            class="px-6 py-4 text-left text-sm font-medium text-white uppercase tracking-wider w-16"
                        >
                            No
                        </th>
                        <th
                            class="px-6 py-4 text-left text-sm font-medium text-white uppercase tracking-wider"
                        >
                            Data
                        </th>
                        <th
                            class="px-6 py-4 text-center text-sm font-medium text-white uppercase tracking-wider w-24"
                        >
                            Action
                        </th>
                    </tr>
                </thead>

                <!-- Table Body -->
                <tbody class="bg-white divide-y divide-gray-100">
                    <!-- Row 1 -->
                    <tr class="hover:bg-gray-50 transition-colors duration-200">
                        <td
                            class="px-6 py-4 whitespace-nowrap text-sm text-gray-900"
                        >
                            1
                        </td>
                        <td
                            class="px-6 py-4 whitespace-nowrap text-sm text-gray-900"
                        >
                            User
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-center">
                            <button
                                class="inline-flex items-center justify-center w-8 h-8 bg-green-500 hover:bg-green-600 text-white rounded-md transition-colors duration-200 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2"
                            >
                                <svg
                                    class="w-4 h-4"
                                    fill="none"
                                    stroke="currentColor"
                                    viewBox="0 0 24 24"
                                >
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"
                                    ></path>
                                </svg>
                            </button>
                        </td>
                    </tr>

                    <!-- Row 2 -->
                    <tr
                        class="bg-blue-50 hover:bg-blue-100 transition-colors duration-200"
                    >
                        <td
                            class="px-6 py-4 whitespace-nowrap text-sm text-gray-900"
                        >
                            2
                        </td>
                        <td
                            class="px-6 py-4 whitespace-nowrap text-sm text-gray-900"
                        >
                            User Posting
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-center">
                            <button
                                class="inline-flex items-center justify-center w-8 h-8 bg-green-500 hover:bg-green-600 text-white rounded-md transition-colors duration-200 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2"
                            >
                                <svg
                                    class="w-4 h-4"
                                    fill="none"
                                    stroke="currentColor"
                                    viewBox="0 0 24 24"
                                >
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"
                                    ></path>
                                </svg>
                            </button>
                        </td>
                    </tr>

                    <!-- Row 3 -->
                    <tr
                        class="hover:bg-gray-50 transition-colors duration-200"
                    >
                        <td
                            class="px-6 py-4 whitespace-nowrap text-sm text-gray-900"
                        >
                            3
                        </td>
                        <td
                            class="px-6 py-4 whitespace-nowrap text-sm text-gray-900"
                        >
                            User Comments
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-center">
                            <button
                                class="inline-flex items-center justify-center w-8 h-8 bg-green-500 hover:bg-green-600 text-white rounded-md transition-colors duration-200 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2"
                            >
                                <svg
                                    class="w-4 h-4"
                                    fill="none"
                                    stroke="currentColor"
                                    viewBox="0 0 24 24"
                                >
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"
                                    ></path>
                                </svg>
                            </button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

        <div class="text-sm text-gray-700 mt-6">
            Powered by
            <span class="font-semibold">{{ Config::get('app.name') }}</span>
        </div>
    </div>
@endsection
