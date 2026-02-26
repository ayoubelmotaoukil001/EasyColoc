<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Add Expense</h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white p-6 rounded-lg shadow">
                <form action="{{ route('expenses.store') }}" method="POST">
                    @csrf
                    <div class="mb-4">
                        <label>Title</label>
                        <input type="text" name="title" class="w-full border-gray-300 rounded" required>
                    </div>
                    <div class="mb-4">
                        <label>Amount (DH)</label>
                        <input type="number" name="amount" step="0.01" class="w-full border-gray-300 rounded" required>
                    </div>
                    <div class="mb-4">
                        <label>Category</label>
                        <select name="category_id" class="w-full border-gray-300 rounded" required>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-4">
                        <label>Date</label>
                        <input type="date" name="entry_date" value="{{ date('Y-m-d') }}" class="w-full border-gray-300 rounded" required>
                    </div>
                    <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">Save</button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
