document.addEventListener("DOMContentLoaded", function () {
    document.querySelectorAll('input[required], textarea[required], select[required]').forEach(input => {
        const label = document.querySelector(`label[for="${input.id}"]`);
        if (label && !label.querySelector('.required-asterisk')) {
            const asterisk = document.createElement('span');
            asterisk.className = 'text-red-500 font-bold ml-1 required-asterisk';
            asterisk.innerText = '*';
            label.appendChild(asterisk);
        }
    });
});
