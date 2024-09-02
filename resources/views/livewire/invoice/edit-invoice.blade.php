<div class="container mx-auto p-6">
    <h1 class="text-2xl font-semibold mb-6">Edit Invoice #{{ $invoiceId }}</h1>

    @if (session()->has('message'))
        <div class="bg-green-500 text-white p-3 rounded mb-4">
            {{ session('message') }}
        </div>
    @endif

    <form wire:submit.prevent="updateInvoice">
        <div class="mb-4">
            <label class="block text-gray-700">Total Amount</label>
            <input type="number" wire:model="totalAmount" step="0.01" class="border border-gray-300 p-2 rounded w-full">
            @error('totalAmount') <span class="text-red-500">{{ $message }}</span> @enderror
        </div>

        <div class="mb-4">
            <label class="block text-gray-700">Status</label>
            <select wire:model="status" class="border border-gray-300 p-2 rounded w-full">
                <option value="Pending">Pending</option>
                <option value="Paid">Paid</option>
                <option value="Overdue">Overdue</option>
            </select>
            @error('status') <span class="text-red-500">{{ $message }}</span> @enderror
        </div>

        <button type="submit" class="bg-blue-500 text-white py-2 px-4 rounded">Update Invoice</button>
    </form>
</div>
