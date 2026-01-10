@extends('layouts.app')

@section('content')
    <div class="max-w-md mx-auto mt-10 p-6 bg-white rounded shadow" x-data="courtSelect({{ $courts->toJson() }})">
        <h2 class="text-xl font-semibold mb-6">Add or Select Court</h2>

        <!-- Searchable Select/Add -->
        <div class="mb-6">
            <label class="block mb-1 font-medium text-gray-700">Court Name</label>
            <input type="text" x-model="search" @input="filterCourts" @keydown.enter.prevent="addIfNotFound"
                placeholder="Search or add court..."
                class="w-full px-3 py-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-blue-600">
            <ul class="border border-gray-200 rounded mt-1 bg-white max-h-40 overflow-auto" x-show="filtered.length > 0">
                <template x-for="court in filtered" :key="court.id">
                    <li @click="selectCourt(court)" class="px-3 py-2 hover:bg-blue-100 cursor-pointer" x-text="court.name">
                    </li>
                </template>
            </ul>
            <template x-if="search && !filtered.length">
                <div class="mt-2 text-sm text-gray-600">
                    Not found. <button @click="addIfNotFound" class="text-blue-600 underline">Add "<span
                            x-text="search"></span>"</button>
                </div>
            </template>
        </div>

        <!-- Selected Court (hidden input for form submit) -->
        <form action="{{ route('courts.store') }}" method="POST" class="space-y-4">
            @csrf
            <input type="hidden" name="name" :value="selected ? selected.name : search">
            <button type="submit" class="w-full bg-blue-600 text-white py-2 rounded hover:bg-blue-700 transition">
                Save Court
            </button>
        </form>
    </div>

    <!-- Alpine.js logic -->
    <script>
        function courtSelect(courts) {
            return {
                courts: courts,
                search: '',
                filtered: courts,
                selected: null,
                filterCourts() {
                    this.filtered = this.courts.filter(c => c.name.toLowerCase().includes(this.search.toLowerCase()));
                    this.selected = null;
                },
                selectCourt(court) {
                    this.selected = court;
                    this.search = court.name;
                    this.filtered = [];
                },
                addIfNotFound() {
                    if (this.search && !this.filtered.length) {
                        this.selected = {
                            id: null,
                            name: this.search
                        };
                        this.filtered = [];
                    }
                }
            }
        }
    </script>
@endsection
{{-- Show court list only when input is focused --}}
<script>
    document.addEventListener('alpine:init', () => {
        Alpine.data('courtSelect', (courts) => ({
            courts: courts,
            search: '',
            filtered: [],
            selected: null,
            showList: false,
            filterCourts() {
                this.filtered = this.courts.filter(c => c.name.toLowerCase().includes(this.search.toLowerCase()));
                this.selected = null;
            },
            selectCourt(court) {
                this.selected = court;
                this.search = court.name;
                this.filtered = [];
                this.showList = false;
            },
            addIfNotFound() {
                if (this.search && !this.filtered.length) {
                    this.selected = {
                        id: null,
                        name: this.search
                    };
                    this.filtered = [];
                    this.showList = false;
                }
            }
        }));
    });
</script>