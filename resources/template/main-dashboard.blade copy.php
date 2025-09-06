<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>E-Commerce User Dashboard</title>
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Alpine.js CDN -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>
<body class="min-h-screen font-sans bg-gray-100">
    <div x-data="{ openSidebar: false, activeSection: 'dashboard' }" class="flex flex-col min-h-screen md:flex-row">
        <!-- Sidebar -->
        <aside class="fixed inset-y-0 left-0 z-50 w-20 transition-all duration-300 ease-in-out bg-white shadow-lg md:static md:w-64"
               :class="{ 'w-64': openSidebar, 'hidden md:block': !openSidebar }">
            <div class="flex items-center justify-between p-4 border-b">
                <h1 :class="{ 'opacity-100': openSidebar || window.innerWidth >= 768, 'opacity-0 hidden': !openSidebar && window.innerWidth < 768 }" 
                    class="text-xl font-bold text-green-600 transition-opacity duration-300">E-Commerce</h1>
                <button @click="openSidebar = !openSidebar" class="p-2 rounded-full md:hidden hover:bg-gray-200">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7" />
                    </svg>
                </button>
            </div>
            <nav class="py-4">
                <ul class="space-y-2">
                    <li>
                        <a href="#" @click.prevent="activeSection = 'dashboard'; openSidebar = false" 
                           class="flex items-center px-4 py-2 space-x-3 transition-colors rounded-lg hover:bg-gray-100" 
                           :class="{ 'bg-gray-100': activeSection === 'dashboard' }">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-gray-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0l-2-2m2 2V4a1 1 0 00-1-1h-3a1 1 0 00-1 1z" />
                            </svg>
                            <span :class="{ 'block opacity-100': openSidebar || window.innerWidth >= 768, 'hidden opacity-0': !openSidebar && window.innerWidth < 768 }" 
                                  class="text-gray-700 transition-opacity duration-300">Dashboard</span>
                        </a>
                    </li>
                    <li>
                        <a href="#" @click.prevent="activeSection = 'orders'; openSidebar = false" 
                           class="flex items-center px-4 py-2 space-x-3 transition-colors rounded-lg hover:bg-gray-100" 
                           :class="{ 'bg-gray-100': activeSection === 'orders' }">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-gray-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4" />
                            </svg>
                            <span :class="{ 'block opacity-100': openSidebar || window.innerWidth >= 768, 'hidden opacity-0': !openSidebar && window.innerWidth < 768 }" 
                                  class="text-gray-700 transition-opacity duration-300">Orders</span>
                        </a>
                    </li>
                    <li>
                        <a href="#" @click.prevent="activeSection = 'profile'; openSidebar = false" 
                           class="flex items-center px-4 py-2 space-x-3 transition-colors rounded-lg hover:bg-gray-100" 
                           :class="{ 'bg-gray-100': activeSection === 'profile' }">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-gray-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                            </svg>
                            <span :class="{ 'block opacity-100': openSidebar || window.innerWidth >= 768, 'hidden opacity-0': !openSidebar && window.innerWidth < 768 }" 
                                  class="text-gray-700 transition-opacity duration-300">Profile</span>
                        </a>
                    </li>
                </ul>
            </nav>
        </aside>

        <!-- Main Content -->
        <main class="flex-1 p-4 overflow-y-auto md:p-6">
            <!-- Mobile Menu Toggle -->
            <div class="flex items-center justify-between mb-4 md:hidden">
                <h1 class="text-xl font-bold text-gray-800">E-Commerce</h1>
                <button @click="openSidebar = !openSidebar" class="p-2 rounded-full hover:bg-gray-200">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7" />
                    </svg>
                </button>
            </div>

            <!-- Dashboard Section -->
            <div x-show="activeSection === 'dashboard'" class="space-y-6">
                <header>
                    <h1 class="text-2xl font-bold text-gray-800">Welcome Back, John Doe!</h1>
                    <p class="text-gray-600">Here's what's happening with your account today.</p>
                </header>
                <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 lg:grid-cols-3">
                    <div class="p-4 bg-white rounded-lg shadow-md">
                        <h2 class="text-lg font-semibold text-gray-700">Total Orders</h2>
                        <p class="text-2xl font-bold text-green-600">12</p>
                    </div>
                    <div class="p-4 bg-white rounded-lg shadow-md">
                        <h2 class="text-lg font-semibold text-gray-700">Pending Orders</h2>
                        <p class="text-2xl font-bold text-yellow-600">3</p>
                    </div>
                    <div class="p-4 bg-white rounded-lg shadow-md">
                        <h2 class="text-lg font-semibold text-gray-700">Total Spent</h2>
                        <p class="text-2xl font-bold text-blue-600">$500.00</p>
                    </div>
                </div>
            </div>

            <!-- Orders Section -->
            <div x-show="activeSection === 'orders'" class="space-y-6">
                <header>
                    <h1 class="text-2xl font-bold text-gray-800">Your Orders</h1>
                    <p class="text-gray-600">View and manage your recent orders.</p>
                </header>
                <div class="p-4 overflow-x-auto bg-white rounded-lg shadow-md">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-4 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">Order ID</th>
                                <th class="px-4 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">Date</th>
                                <th class="px-4 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">Status</th>
                                <th class="px-4 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">Amount</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200">
                            <tr>
                                <td class="px-4 py-3 text-sm text-gray-900 whitespace-nowrap">#ORD12345</td>
                                <td class="px-4 py-3 text-sm text-gray-900 whitespace-nowrap">2023-10-10</td>
                                <td class="px-4 py-3 text-sm text-green-600 whitespace-nowrap">Completed</td>
                                <td class="px-4 py-3 text-sm text-gray-900 whitespace-nowrap">$100.00</td>
                            </tr>
                            <tr>
                                <td class="px-4 py-3 text-sm text-gray-900 whitespace-nowrap">#ORD67890</td>
                                <td class="px-4 py-3 text-sm text-gray-900 whitespace-nowrap">2023-10-05</td>
                                <td class="px-4 py-3 text-sm text-yellow-600 whitespace-nowrap">Pending</td>
                                <td class="px-4 py-3 text-sm text-gray-900 whitespace-nowrap">$50.00</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Profile Section -->
            <div x-show="activeSection === 'profile'" class="space-y-6">
                <header>
                    <h1 class="text-2xl font-bold text-gray-800">Your Profile</h1>
                    <p class="text-gray-600">Update your personal information and settings.</p>
                </header>
                <div class="p-4 bg-white rounded-lg shadow-md">
                    <form class="space-y-4">
                        <div>
                            <label for="name" class="block text-sm font-medium text-gray-700">Full Name</label>
                            <input type="text" id="name" class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-green-500 focus:border-green-500 sm:text-sm" placeholder="John Doe">
                        </div>
                        <div>
                            <label for="email" class="block text-sm font-medium text-gray-700">Email Address</label>
                            <input type="email" id="email" class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-green-500 focus:border-green-500 sm:text-sm" placeholder="john.doe@example.com">
                        </div>
                        <button type="submit" class="inline-flex justify-center w-full px-4 py-2 text-sm font-medium text-white bg-green-600 border border-transparent rounded-md shadow-sm sm:w-auto hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
                            Save Changes
                        </button>
                    </form>
                </div>
            </div>
        </main>
    </div>
</body>
</html>