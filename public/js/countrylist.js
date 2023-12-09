// Function to fetch and populate dropdown
async function populateDropdown() {
    const countriesSelect = document.getElementById('country');
    const citizenshipSelect = document.getElementById('citizenship');

    let previousCountry = '{{ $user->basicInformation->country }}';
    let previousCitizenship = '{{ $user->basicInformation->citizenship }}';

    try {
        const response = await fetch('https://restcountries.com/v3.1/all');
        const countriesData = await response.json();

        // Sort countries alphabetically by name
        countriesData.sort((a, b) => {
            if (a.name.common < b.name.common) return -1;
            if (a.name.common > b.name.common) return 1;
            return 0;
        });

        // Populate Country dropdown
        countriesData.forEach(country => {
            const option = document.createElement('option');
            option.value = country.name.common;
            option.textContent = country.name.common;
            if (country.name.common === previousCountry) {
                option.selected = true;
            }
            countriesSelect.appendChild(option);
        });

        // Populate Citizenship dropdown
        countriesData.forEach(country => {
            const option = document.createElement('option');
            option.value = country.name.common;
            option.textContent = country.name.common;
            if (country.name.common === previousCitizenship) {
                option.selected = true;
            }
            citizenshipSelect.appendChild(option);
        });
    } catch (error) {
        console.error('Error fetching data:', error);
    }
}

// Call the function to populate dropdowns when the page loads
populateDropdown();
