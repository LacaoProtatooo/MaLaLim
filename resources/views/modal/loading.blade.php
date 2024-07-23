<!-- Modal HTML -->
<div id="loading-modal" class="fixed inset-0 flex items-center justify-center bg-gray-900 bg-opacity-50 z-50 hidden">
    <div class='flex space-x-1 justify-center items-center bg-white p-4 rounded-md'>
      <span class='sr-only'>Loading...</span>
      <div class='h-6 w-6 bg-yellow-300 rounded-full animate-bounce [animation-delay:-0.2s]'></div>
      <div class='h-6 w-6 bg-yellow-300 rounded-full animate-bounce [animation-delay:-0.1s]'></div>
      <div class='h-6 w-6 bg-yellow-300 rounded-full animate-bounce'></div>
    </div>
  </div>

  <!-- JavaScript -->
  <script>
    function showLoadingModal() {
      document.getElementById('loading-modal').classList.remove('hidden');
    }

    function hideLoadingModal() {
      document.getElementById('loading-modal').classList.add('hidden');
    }
  </script>
