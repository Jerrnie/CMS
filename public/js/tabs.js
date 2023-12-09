document.addEventListener("DOMContentLoaded", function () {
    const tabButtons = document.querySelectorAll('.tab-button');
    const tabContents = document.querySelectorAll('.tab-content');

    // Function to toggle tabs and highlight the selected one
    const toggleTab = (target) => {
        tabContents.forEach(content => {
            content.classList.toggle('hidden', `#${content.id}` !== target);
        });

        tabButtons.forEach(btn => {
            btn.classList.remove('border-indigo-500', 'text-indigo-600');
            btn.classList.add('border-transparent', 'text-gray-500', 'hover:text-gray-700', 'hover:border-gray-500');
        });

        const activeButton = document.querySelector(`a[href='${target}']`);
        if (activeButton) {
            activeButton.classList.remove('border-transparent', 'text-gray-500', 'hover:text-gray-700', 'hover:border-gray-500');
            activeButton.classList.add('border-indigo-500', 'text-indigo-600');
        }
    };

    // Click event listener for tab buttons
    tabButtons.forEach(button => {
        button.addEventListener('click', function (e) {
            e.preventDefault();
            const target = button.getAttribute('href');
            if (target) {
                toggleTab(target);

                // Update the URL hash without scrolling
                history.replaceState(null, null, target);
            }
        });
    });

    // Get the hash value from the URL
    const hash = window.location.hash;

    // Function to show the corresponding tab based on the hash value
    const showTabFromHash = () => {
        // Show the tab corresponding to the hash value
        const tabToShow = document.querySelector(hash);
        if (tabToShow) {
            toggleTab(hash);
        } else {
            // If no hash, default to profileInfo
            toggleTab('#profileInfor');
        }
    };

    // Show the tab on page load if the hash exists
    if (hash) {
        showTabFromHash();

        // Update the URL hash without scrolling on page load
        history.replaceState(null, null, hash);
    } else {
        // If no hash on page load, default to profileInfo
        toggleTab('#profileInfo');
        history.replaceState(null, null, '#profileInfo');
    }
});
