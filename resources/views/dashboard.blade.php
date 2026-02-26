<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }} - {{ $colocationName }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                <div class="bg-white p-6 rounded-lg shadow-md border-l-4 border-blue-500">
                    <h3 class="text-gray-500 text-sm font-medium uppercase font-bold">Total Group Expenses</h3>
                    <p class="text-2xl font-bold text-gray-900">{{ number_format($totalExpenses, 2) }} DH</p>
                </div>

                <div class="bg-white p-6 rounded-lg shadow-md border-l-4 border-purple-500">
                    <h3 class="text-gray-500 text-sm font-medium uppercase font-bold">Individual Share</h3>
                    <p class="text-2xl font-bold text-gray-900">{{ number_format($individualShare, 2) }} DH</p>
                </div>

                <div class="bg-white p-6 rounded-lg shadow-md flex items-center justify-center">
                    <a href="{{ route('expenses.create') }}" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-3 px-6 rounded-lg transition-colors shadow-lg">
                        + Add New Expense
                    </a>
                </div>
            </div>

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-8">
                <div class="p-6">
                    <h3 class="text-lg font-bold text-gray-700 mb-4 italic underline">Roommates Balances</h3>
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Member</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Amount Paid</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Final Balance</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @foreach($membersBalances as $member)
                                    <tr class="hover:bg-gray-50 transition-colors">
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                            {{ $member['name'] }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                            {{ number_format($member['paid'], 2) }} DH
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-bold {{ $member['balance'] >= 0 ? 'text-green-600' : 'text-red-600' }}">
                                            {{ $member['balance'] >= 0 ? '+' : '' }}{{ number_format($member['balance'], 2) }} DH
                                            <span class="text-xs font-normal block italic">
                                                {{ $member['balance'] >= 0 ? 'To be reimbursed' : 'Owes others' }}
                                            </span>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <h3 class="text-lg font-bold text-gray-700 mb-4 italic underline">Latest 5 Expenses</h3>
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200 text-left">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase">User</th>
                                    <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase">Category</th>
                                    <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase">Amount</th>
                                    <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase">Date</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @foreach($latestExpenses as $expense)
                                    <tr class="hover:bg-gray-50 transition-colors">
                                        <td class="px-6 py-4 text-sm text-gray-900">{{ $expense->user->name }}</td>
                                        <td class="px-6 py-4">
                                            <span class="bg-blue-100 text-blue-800 text-xs px-2 py-1 rounded-full font-semibold">
                                                {{ $expense->category->name }}
                                            </span>
                                        </td>
                                        <td class="px-6 py-4 text-sm font-bold text-gray-900">{{ number_format($expense->amount, 2) }} DH</td>
                                        <td class="px-6 py-4 text-sm text-gray-500">{{ $expense->entry_date }}</td>
                                    </tr>
                                @endforeach
                                @if($latestExpenses->isEmpty())
                                    <tr>
                                        <td colspan="4" class="px-6 py-4 text-center text-gray-500 italic">No expenses recorded yet.</td>
                                    </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>
