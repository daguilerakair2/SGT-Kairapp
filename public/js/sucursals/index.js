// Selectores
const selectSubStores = document.getElementById('subStores');
const token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');



const addSubStoresToSelect = (subStores) => {
    subStores.forEach((subStore, index) => {
        if (index === 0) {
            const option = document.createElement('option');
            option.value = subStore;
            option.text = subStore.name;
            option.selected = true;
            selectSubStores.appendChild(option);
        } else {
            const option = document.createElement('option');
            option.value = subStore;
            option.text = subStore.name;
            selectSubStores.appendChild(option);
        }

    });
}


const obtainSubStores = async () => {

    try {
        selectSubStores.disabled = true; // Deshabilita el select mientras se cargan los datos

        const loadingOption = selectSubStores.querySelector('option[value=""]');

        selectSubStores.classList.add('bg-gray-100', 'p-2', 'rounded');
        selectSubStores.disabled = true;
        loadingOption.classList.add('text-gray-500');
        loadingOption.textContent = 'Cargando...';

        const response = await fetch('/sucursals', {
            method: 'GET',
            headers: {
                'X-CSRF-TOKEN': token
            }
        });
        if (!response.ok) {
            throw new Error('La solicitud no se pudo completar correctamente.');
        }

        selectSubStores.classList.remove('bg-gray-100', 'p-2', 'rounded');
        selectSubStores.disabled = false;
        loadingOption.remove();

        const data = await response.json();
        const subStores = data.subStores;
        addSubStoresToSelect(subStores);

    } catch (error) {
        console.error('Hubo un error:', error);
    }
}


document.addEventListener('DOMContentLoaded', () => {
    obtainSubStores();
});
