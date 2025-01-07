// Toggle App Drawer and Overlay
function toggleDrawer() {
    const drawer = document.querySelector('.app-drawer');
    const overlay = document.querySelector('.overlay');

    const isOpen = drawer.style.left === '0px';
    
    if (isOpen) {
        drawer.style.left = '-250px';
        overlay.classList.remove('active');
    } else {
        drawer.style.left = '0px';
        overlay.classList.add('active');
    }
}

// Close Drawer on Overlay Click
document.querySelector('.overlay').addEventListener('click', () => {
    toggleDrawer();
});
