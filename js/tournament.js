function showTab(tab) {
    document.getElementById('history').classList.add('hidden');
    document.getElementById('upcoming').classList.add('hidden');
    
    document.getElementById('history-btn').classList.remove('bg-orange-500', 'shadow-[0_0_15px_4px_rgba(255,120,0,0.9)]');
    document.getElementById('history-btn').classList.add('bg-gray-700');
    
    document.getElementById('upcoming-btn').classList.remove('bg-orange-500', 'shadow-[0_0_15px_4px_rgba(255,120,0,0.9)]');
    document.getElementById('upcoming-btn').classList.add('bg-gray-700');

    document.getElementById(tab).classList.remove('hidden');
    document.getElementById(tab + '-btn').classList.add('bg-orange-500', 'shadow-[0_0_15px_4px_rgba(255,120,0,0.9)]');
    document.getElementById(tab + '-btn').classList.remove('bg-gray-700');
}