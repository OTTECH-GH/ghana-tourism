@extends('layouts.app')

@section('content')
<div class="bg-emerald-700 text-white py-12">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <h1 class="text-4xl font-bold">Multi-Destination Trip Planner</h1>
        <p class="text-emerald-100 mt-2">Plan your perfect Ghana tourism trip visiting multiple sites.</p>
    </div>
</div>

<div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 py-8" x-data="tripPlanner()">
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <div class="lg:col-span-2 space-y-6">
            <div class="bg-white rounded-xl p-6 shadow-sm">
                <h2 class="text-lg font-semibold text-gray-800 mb-4">Select Tourism Sites</h2>
                <div class="space-y-3">
                    @foreach($tourismSites as $site)
                        <label class="flex items-center justify-between p-3 rounded-lg border hover:bg-emerald-50 cursor-pointer transition">
                            <div class="flex items-center">
                                <input type="checkbox" value="{{ $site->id }}" data-name="{{ $site->name }}" data-region="{{ $site->region->name }}" data-fee="{{ $site->entry_fee }}" @change="toggleSite($event)" class="rounded text-emerald-600 mr-3">
                                <div>
                                    <span class="font-medium text-gray-800">{{ $site->name }}</span>
                                    <span class="text-sm text-gray-500 ml-2">{{ $site->region->name }}</span>
                                </div>
                            </div>
                            <span class="text-sm text-emerald-600 font-medium">GHS {{ number_format($site->entry_fee, 2) }}</span>
                        </label>
                    @endforeach
                </div>
            </div>
        </div>

        <div class="space-y-6">
            <div class="bg-white rounded-xl p-6 shadow-sm sticky top-24">
                <h3 class="font-bold text-gray-800 mb-4">Trip Summary</h3>
                <div x-show="selectedSites.length === 0" class="text-gray-500 text-sm">Select tourism sites to plan your trip.</div>
                <template x-for="(site, i) in selectedSites" :key="site.id">
                    <div class="flex items-center justify-between py-2 border-b">
                        <span class="text-sm text-gray-700" x-text="(i+1) + '. ' + site.name"></span>
                        <button @click="removeSite(i)" class="text-red-400 hover:text-red-600 text-xs">Remove</button>
                    </div>
                </template>
                <div x-show="selectedSites.length > 0" class="mt-4 space-y-2 text-sm">
                    <div class="flex justify-between"><span class="text-gray-500">Sites</span><span x-text="selectedSites.length"></span></div>
                    <div class="flex justify-between"><span class="text-gray-500">Est. Entry Fees</span><span x-text="'GHS ' + totalFees.toFixed(2)"></span></div>
                    <div class="flex justify-between"><span class="text-gray-500">Est. Transport</span><span x-text="'GHS ' + estimatedTransport.toFixed(2)"></span></div>
                    <hr>
                    <div class="flex justify-between font-bold text-lg"><span>Total Estimate</span><span class="text-emerald-600" x-text="'GHS ' + totalEstimate.toFixed(2)"></span></div>
                </div>
                @auth
                    <a x-show="selectedSites.length > 0" href="{{ route('transport.book') }}" class="mt-4 block w-full bg-emerald-600 text-white text-center py-3 rounded-lg hover:bg-emerald-700">Book This Trip</a>
                @else
                    <a x-show="selectedSites.length > 0" href="{{ route('login') }}" class="mt-4 block w-full bg-emerald-600 text-white text-center py-3 rounded-lg hover:bg-emerald-700">Login to Book</a>
                @endauth
            </div>
        </div>
    </div>
</div>

<script>
function tripPlanner() {
    return {
        selectedSites: [],
        get totalFees() { return this.selectedSites.reduce((sum, s) => sum + parseFloat(s.fee), 0); },
        get estimatedTransport() { return this.selectedSites.length * 75; },
        get totalEstimate() { return this.totalFees + this.estimatedTransport; },
        toggleSite(e) {
            const cb = e.target;
            if (cb.checked) {
                this.selectedSites.push({ id: cb.value, name: cb.dataset.name, region: cb.dataset.region, fee: cb.dataset.fee });
            } else {
                this.selectedSites = this.selectedSites.filter(s => s.id !== cb.value);
            }
        },
        removeSite(index) {
            const site = this.selectedSites[index];
            document.querySelector(`input[value="${site.id}"]`).checked = false;
            this.selectedSites.splice(index, 1);
        }
    }
}
</script>
@endsection
