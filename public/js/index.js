// Selectors
const selectStore = document.getElementById('stores');

const addStoresToSelect = (stores) => {
    stores.forEach(store => {
        const option = document.createElement('option');
        option.value = store.id;
        option.text = store.name;
        selectStore.appendChild(option);
    });
}


const loadedStores = (e) => {
    fetch('/get/stores')
        .then(response => response.json())
        .then(data => {
            const stores = data.stores;
            addStoresToSelect(stores);
        })
}

document.addEventListener('DOMContentLoaded', loadedStores)
